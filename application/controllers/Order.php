<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->model('Order_model');
        $this->curd = $this->load->model('Curd_model');
        $session_user = $this->session->userdata('logged_in');
        $this->session_user = $session_user;
        if ($session_user) {
            $this->user_id = $session_user['login_id'];
        } else {
            $this->user_id = 0;
        }
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->user_type = $this->session->logged_in['user_type'];
    }

//list of data according to date list
    public function date_graph_data($date1, $date2, $datalist) {
        $period = new DatePeriod(
                new DateTime($date1), new DateInterval('P1D'), new DateTime($date2)
        );
        $daterangearray = [$date1];
        foreach ($period as $key => $value) {
            array_push($daterangearray, $value->format('Y-m-d'));
        }
        array_push($daterangearray, $date2);

        $date_list_data = array();

        foreach ($daterangearray as $key => $value) {
            if (isset($datalist[$value])) {
                $date_list_data[$value] = $datalist[$value];
            } else {
                $date_list_data[$value] = 0;
            }
        }
        return $date_list_data;
    }

    public function index() {

        $date1 = date('Y-m-') . "01";
        $date2 = date('Y-m-d');

        $data = array();
        $blog_data = $this->Curd_model->get('style_tips', 'desc');
        $data['blog_data'] = $blog_data;

        $this->db->order_by('id', 'desc');
        $this->db->where('order_date between "' . $date1 . '" and "' . $date2 . '"');
        $query = $this->db->get('web_order');
        $orderlist = $query->result();
        $orderslistr = [];
        foreach ($orderlist as $key => $value) {
            $this->db->order_by('id', 'desc');
            $this->db->where('order_id', $value->id);
            $query = $this->db->get('user_order_status');
            $status = $query->row();
            $value->status = $status ? $status->status : $value->status = $status ? $status->status : "--";
            ;
            $value->status_datetime = $status ? $status->c_date . " " . $status->c_time : $value->order_date;

            $value->itemsarray = array();
            $value->items = implode(", ", array());
            array_push($orderslistr, $value);
        }
        $data['orderslist'] = $orderslistr;


        $data['exportdata'] = 'no';
        if ($this->user_type == '') {
            redirect('UserManager/not_granted');
        }
        $date1 = date('Y-m-') . "01";
        $date2 = date('Y-m-d');
        if (isset($_GET['daterange'])) {
            $daterange = $this->input->get('daterange');
            $datelist = explode(" to ", $daterange);
            $date1 = $datelist[0];
            $date2 = $datelist[1];
        }
        $daterange = $date1 . " to " . $date2;
        $data['daterange'] = $daterange;
        $this->db->order_by('id', 'desc');
        $this->db->where('order_date between "' . $date1 . '" and "' . $date2 . '"');
        $query = $this->db->get('user_order');
        $orderlist = $query->result_array();
        $orderslistr = [];
        $total_amount = 0;
        foreach ($orderlist as $key => $value) {
            $this->db->order_by('id', 'desc');
            $this->db->where('order_id', $value['id']);
            $total_amount += $value['total_price'];
            $query = $this->db->get('user_order_status');
            $status = $query->row();
            $value['status'] = $status ? $status->status : $value['status'];
            array_push($orderslistr, $value);
        }
        $data['total_amount'] = $total_amount;



        $this->db->order_by('id', 'desc');

        $query = $this->db->get('admin_users');
        $userlist = $query->result_array();

        $this->db->order_by('c.id', 'desc');
        $query = $this->db->from('cart as c');
        $this->db->join('user_order as uo', 'uo.id = c.order_id');
        $this->db->where('c.order_id > 0');
        $this->db->where('uo.order_date between "' . $date1 . '" and "' . $date2 . '"');
        $query = $this->db->get();
        $vendororderlist = $query->result_array();


        $data['vendor_orders'] = count($vendororderlist);
        $data['total_order'] = count($orderslistr);
        $data['total_users'] = count($userlist);

        $this->load->library('JsonSorting', $orderslistr);
        $orderstatus = $this->jsonsorting->collect_data('status');
        $orderuser = $this->jsonsorting->collect_data('name');
        $orderdate = $this->jsonsorting->collect_data('order_date');
        $data['orderstatus'] = $orderstatus;
        $data['orderuser'] = $orderuser;
        $data['orderdate'] = $orderdate;




//order graph date
        $dategraphdata = $this->date_graph_data($date1, $date2, $orderdate);
        $data['order_date_graph'] = $dategraphdata;


        $amount_date = $this->jsonsorting->data_combination_quantity('total_price', 'order_date');

        $salesgraph = array();

        foreach ($dategraphdata as $key => $value) {
            $salesgraph[$key] = 0;
            if (isset($amount_date[$key])) {
                $salesgraph[$key] = $amount_date[$key];
            }
        }

        $data['salesgraph'] = $salesgraph;



        $this->db->order_by('id', 'desc');
        $this->db->limit(10);
        $query = $this->db->get('admin_users');
        $systemlog = $query->result_array();

        $data['latestusers'] = $systemlog;


        $this->db->order_by('id', 'desc');
        $this->db->limit(10);
        $query = $this->db->get('system_log');
        $systemlog = $query->result_array();

        $data['systemlog'] = $systemlog;


        $this->load->view('Order/dashboard', $data);
    }

    public function orderPrint($order_id, $subject = "") {
        setlocale(LC_MONETARY, 'en_US');
        $order_details = $this->Order_model->getOrderDetails($order_id, 0);
        if ($order_details) {
            $order_no = $order_details['order_data']->order_no;
            echo $html = $this->load->view('Email/order_pdf', $order_details, true);
        }
    }

//order details
    public function orderdetails($order_key) {
        $order_status = $this->input->get('status');
        $data['status'] = $order_status;
        if ($this->user_type == 'Customer') {
            redirect('UserManager/not_granted');
        }




        $order_details = $this->Order_model->getOrderDetailsV3($order_key, 'key');

        if ($order_details) {
            $order_id = $order_details['order_data']->id;
            $data['ordersdetails'] = $order_details;
            $data['order_key'] = $order_key;
            $this->db->order_by('id', 'desc');
            $this->db->where('order_id', $order_id);
            $query = $this->db->get('user_order_status');
            $orderstatuslist = $query->result();

            $updateStatus = array(
                "status" => "1",
                "process_by" => $this->session_user['login_id'],
                "process_user" => $this->session_user['username'],
            );

            $this->db->set($updateStatus);
            $this->db->where("id", $order_id);
            $this->db->update('web_order');

            if (count($orderstatuslist)) {
                
            } else {
                $usertype = $order_details['order_data']->usertype;
                $ordertype = $order_details['order_data']->booking_type;
                $ordertsource = $order_details['order_data']->order_source;



                $order_status_data = array(
                    'c_date' => date('Y-m-d'),
                    'c_time' => date('H:i:s'),
                    'order_id' => $order_id,
                    'status' => "Received",
                    'user_id' => $usertype,
                    'remark' => "Reservation $ordertype From $ordertsource",
                    "process_by" => $this->session_user['login_id'],
                    "process_user" => $this->session_user['username'],
                );
                $this->db->insert('user_order_status', $order_status_data);

                $orderlog = array(
                    'log_type' => "Reservation Received",
                    'log_datetime' => date('Y-m-d H:i:s'),
                    'user_id' => "",
                    'order_id' => $order_id,
                    'log_detail' => "Reservation Received " . " Reservation $ordertype From $ordertsource",
                    "process_by" => $this->session_user['login_id'],
                    "process_user" => $this->session_user['username'],
                );
                $this->db->insert('system_log', $orderlog);


                redirect("Order/orderdetails/$order_key");
            }

            $currentstatus = $orderstatuslist ? $orderstatuslist[0]->status : array();

            if ($order_status) {
                
            } else {
                //redirecttion
                switch ($currentstatus) {


                    case "Booking Enquiry":
                        redirect("Order/orderdetails_enquiry/$order_key");
                        break;
                    case "Confirmed":
                        redirect("Order/orderdetails/$order_key/?status=Delivered");
                        break;

                    default:

                        redirect("Order/orderdetails/$order_key/?status=Confirmed");
                }
            }
            //end of redirection



            $data['user_order_status'] = $orderstatuslist;
            if (isset($_POST['submit'])) {
                $productattr = array(
                    'c_date' => date('Y-m-d'),
                    'c_time' => date('H:i:s'),
                    'status' => $this->input->post('status'),
                    'remark' => $this->input->post('remark'),
                    'description' => $this->input->post('description'),
                    'order_id' => $order_id,
                    "process_by" => $this->session_user['login_id'],
                    "process_user" => $this->session_user['username'],
                );
                $this->db->insert('user_order_status', $productattr);

                $orderlog = array(
                    'log_type' => $this->input->post('status'),
                    'log_datetime' => date('Y-m-d H:i:s'),
                    'user_id' => "",
                    'order_id' => $order_id,
                    'log_detail' => $this->input->post('status') . " " . $this->input->post('remark'),
                    "process_by" => $this->session_user['login_id'],
                    "process_user" => $this->session_user['username'],
                );
                $this->db->insert('system_log', $orderlog);


                if ($this->input->post('sendmail') == TRUE) {
                    try {
                        $this->Order_model->order_mail($order_key, "");
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                    }
                }
                redirect("Order/orderdetails/$order_key");
            }
        } else {
            redirect('/');
        }
        $this->load->view('Order/orderdetails', $data);
    }

    public function orderMailTest($order_key) {
        $this->Order_model->order_mail_confirm($order_key, "");
    }

    public function orderdetails_enquiry($order_key) {
        $order_status = $this->input->get('status');
        $data['status'] = $order_status;
        if ($this->user_type == 'Customer') {
            redirect('UserManager/not_granted');
        }
        $order_details = $this->Order_model->getOrderDetailsV2($order_key, 'key');

        $vendor_order_details = $this->Order_model->getVendorsOrder($order_key);
        $data['vendor_order'] = $vendor_order_details;
        if ($order_details) {
            $order_id = $order_details['order_data']->id;
            $data['ordersdetails'] = $order_details;



            $data['order_key'] = $order_key;
            $this->db->order_by('id', 'desc');
            $this->db->where('order_id', $order_id);
            $query = $this->db->get('user_order_status');
            $orderstatuslist = $query->result();
            $data['user_order_status'] = $orderstatuslist;
            if (isset($_POST['submit'])) {
                $productattr = array(
                    'c_date' => date('Y-m-d'),
                    'c_time' => date('H:i:s'),
                    'status' => $this->input->post('status'),
                    'remark' => $this->input->post('remark'),
                    'description' => $this->input->post('description'),
                    'order_id' => $order_id
                );
                $this->db->insert('user_order_status', $productattr);


                $orderlog = array(
                    'log_type' => $this->input->post('status'),
                    'log_datetime' => date('Y-m-d H:i:s'),
                    'user_id' => "",
                    'order_id' => $order_id,
                    'log_detail' => $this->input->post('remark'),
                );
                $this->db->insert('system_log', $orderlog);

                if ($this->input->post('sendmail') == TRUE) {
                    try {
                        $this->Order_model->order_mail_confirm($order_key, "");
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                    }
                }
                redirect("Order/orderdetails/$order_key");
            }
        } else {
            redirect('/');
        }
        $this->load->view('Order/orderdetails_enquiry', $data);
    }

    function order_mail_send($order_id) {
        $this->Order_model->order_mail($order_id);
    }

    function order_mail_send_direct($order_key) {
        $this->Order_model->order_mail($order_key);
        redirect("Order/orderdetails/$order_key");
    }

    function order_mail_send_direct2($order_key) {
        $this->Order_model->order_mail2($order_key);
        redirect("Order/orderdetails/$order_key");
    }

    
    
    function order_pdf($order_id) {
        $this->Order_model->order_pdf($order_id);
    }

    function order_pdf_worker($order_id) {
        $this->Order_model->order_pdf_worker($order_id);
    }

    public function remove_order_status($status_id, $orderkey) {
        $this->db->delete('user_order_status', array('id' => $status_id));
        redirect("Order/orderdetails/$orderkey");
    }

//order list accroding to user type
    public function orderslist() {
        $data['exportdata'] = 'yes';
        $date1 = date('Y-m-') . "01";
        $date2 = date('Y-m-d');
        if (isset($_GET['daterange'])) {
            $daterange = $this->input->get('daterange');
            $datelist = explode(" to ", $daterange);
            $date1 = $datelist[0];
            $date2 = $datelist[1];
        }
        $daterange = $date1 . " to " . $date2;
        $data['daterange'] = $daterange;
        if ($this->user_type == 'Admin' || $this->user_type == 'Manager') {
            $this->db->order_by('id', 'desc');
            $this->db->where('order_date between "' . $date1 . '" and "' . $date2 . '"');
            $query = $this->db->get('web_order');
            $orderlist = $query->result();
            $orderslistr = [];
            foreach ($orderlist as $key => $value) {
                $this->db->order_by('id', 'desc');
                $this->db->where('order_id', $value->id);
                $query = $this->db->get('user_order_status');
                $status = $query->row();
                $value->status = $status ? $status->status : $value->status = $status ? $status->status : "--";
                ;
                $value->status_datetime = $status ? $status->c_date . " " . $status->c_time : $value->order_date;

                $value->itemsarray = array();
                $value->items = implode(", ", array());
                array_push($orderslistr, $value);
            }
            $data['orderslist'] = $orderslistr;
            $this->load->view('Order/orderslist', $data);
        }
        if ($this->user_type == 'Vendor') {
            $this->db->order_by('vo.id', 'desc');
            $this->db->group_by('vo.id');
            $this->db->select('o.order_no, vo.id, o.name, o.email, o.address, o.city,'
                    . 'o.state, vo.vendor_order_no, vo.total_price, vo.total_quantity, vo.c_date, vo.c_time');
            $this->db->join('user_order as o', 'o.id = vo.order_id', 'left');
            $this->db->where('vo.vendor_id', $this->user_id);
            $this->db->where('c_date between "' . $date1 . '" and "' . $date2 . '"');

            $this->db->from('vendor_order as vo');
            $query = $this->db->get();
            $orderlist = $query->result();
            $orderslistr = [];
            foreach ($orderlist as $key => $value) {

                $this->db->order_by('id', 'desc');
                $this->db->where('vendor_order_id', $value->id);
                $query = $this->db->get('vendor_order_status');
                $status = $query->row();
                $value->status = $status ? $status->status : $value->status;
                array_push($orderslistr, $value);
            }
            $data['orderslist'] = $orderslistr;
            $this->load->view('Order/vendororderslist', $data);
        }
    }

//order list xls 
    public function orderslistxls($daterange) {
        $datelist = explode(" to ", urldecode($daterange));
        $date1 = $datelist[0];
        $date2 = $datelist[1];
        $daterange = $date1 . " to " . $date2;
        $data['daterange'] = $daterange;
        if ($this->user_type == 'Admin' || $this->user_type == 'Manager') {
            $this->db->order_by('id', 'desc');
            $this->db->where('order_date between "' . $date1 . '" and "' . $date2 . '"');
            $query = $this->db->get('web_order');
            $orderlist = $query->result();
            $orderslistr = [];
            foreach ($orderlist as $key => $value) {
                $this->db->order_by('id', 'desc');
                $this->db->where('order_id', $value->id);
                $query = $this->db->get('user_order_status');
                $status = $query->row();

                $value->status = $status ? $status->status : "--";
//                array_push($orderslistr, $value);

                $this->db->order_by('id', 'desc');
                $this->db->where('order_id', $value->id);
                $query = $this->db->get('cart');
                $cartdata = $query->result();
                $tempdata = array();
                foreach ($cartdata as $key1 => $value1) {
                    array_push($tempdata, $value1->item_name . "(" . $value1->quantity . ")");
                }

                $value->items = implode(", ", $tempdata);
                array_push($orderslistr, $value);
            }
            $data['orderslist'] = $orderslistr;
            $html = $this->load->view('Order/orderslist_xls', $data, TRUE);
        }
        if ($this->user_type == 'Vendor') {
            $this->db->order_by('vo.id', 'desc');
            $this->db->group_by('vo.id');
            $this->db->select('o.order_no, vo.id, o.name, o.email, o.address, o.city, o.contact_no, o.pincode,'
                    . 'o.state, vo.vendor_order_no, vo.total_price, vo.total_quantity, vo.c_date, vo.c_time');
            $this->db->join('user_order as o', 'o.id = vo.order_id', 'left');
            $this->db->where('vo.vendor_id', $this->user_id);
            $this->db->where('c_date between "' . $date1 . '" and "' . $date2 . '"');

            $this->db->from('vendor_order as vo');
            $query = $this->db->get();
            $orderlist = $query->result();
            $orderslistr = [];
            foreach ($orderlist as $key => $value) {
                $this->db->order_by('id', 'desc');
                $this->db->where('vendor_order_id', $value->id);
                $query = $this->db->get('vendor_order_status');
                $status = $query->row();
                $value->status = $status ? $status->status : $value->status;
                array_push($orderslistr, $value);
            }
            $data['orderslist'] = $orderslistr;
            $html = $this->load->view('Order/vendororderslist_xls', $data, TRUE);
        }
        $filename = 'booking_report_' . $daterange . ".xls";
        ob_clean();
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/vnd.ms-excel");
        echo $html;
    }

//vendor order status
    public function remove_vendor_order_status($status_id, $order_id) {
        $this->db->delete('vendor_order_status', array('id' => $status_id));
        redirect("Order/vendor_order_details/$order_id");
    }

//order analisys
    public function orderAnalysis() {
        $data['exportdata'] = 'no';
        if ($this->user_type != 'Admin') {
            redirect('UserManager/not_granted');
        }
        $date1 = date('Y-m-') . "01";
        $date2 = date('Y-m-d');
        if (isset($_GET['daterange'])) {
            $daterange = $this->input->get('daterange');
            $datelist = explode(" to ", $daterange);
            $date1 = $datelist[0];
            $date2 = $datelist[1];
        }
        $daterange = $date1 . " to " . $date2;
        $data['daterange'] = $daterange;
        $this->db->order_by('id', 'desc');
        $this->db->where('order_date between "' . $date1 . '" and "' . $date2 . '"');
        $query = $this->db->get('user_order');
        $orderlist = $query->result_array();
        $orderslistr = [];
        $total_amount = 0;
        foreach ($orderlist as $key => $value) {
            $this->db->order_by('id', 'desc');
            $this->db->where('order_id', $value['id']);
            $total_amount += $value['total_price'];
            $query = $this->db->get('user_order_status');
            $status = $query->row();
            $value['status'] = $status ? $status->status : $value['status'];
            array_push($orderslistr, $value);
        }
        $data['total_amount'] = $total_amount;



        $this->db->order_by('id', 'desc');

        $query = $this->db->get('admin_users');
        $userlist = $query->result_array();

        $this->db->order_by('c.id', 'desc');
        $query = $this->db->from('cart as c');
        $this->db->join('user_order as uo', 'uo.id = c.order_id');
        $this->db->where('c.order_id > 0');
        $this->db->where('uo.order_date between "' . $date1 . '" and "' . $date2 . '"');
        $query = $this->db->get();
        $vendororderlist = $query->result_array();


        $data['vendor_orders'] = count($vendororderlist);
        $data['total_order'] = count($orderslistr);
        $data['total_users'] = count($userlist);
        $data['orderslist'] = $orderslistr;
        $this->load->library('JsonSorting', $orderslistr);
        $orderstatus = $this->jsonsorting->collect_data('status');
        $orderuser = $this->jsonsorting->collect_data('name');
        $orderdate = $this->jsonsorting->collect_data('order_date');
        $data['orderstatus'] = $orderstatus;
        $data['orderuser'] = $orderuser;
        $data['orderdate'] = $orderdate;




//order graph date
        $dategraphdata = $this->date_graph_data($date1, $date2, $orderdate);
        $data['order_date_graph'] = $dategraphdata;


        $amount_date = $this->jsonsorting->data_combination_quantity('total_price', 'order_date');

        $salesgraph = array();

        foreach ($dategraphdata as $key => $value) {
            $salesgraph[$key] = 0;
            if (isset($amount_date[$key])) {
                $salesgraph[$key] = $amount_date[$key];
            }
        }

        $data['salesgraph'] = $salesgraph;

        $this->load->view('Order/orderanalysis', $data);
    }

    //book now
    public function booknow($userid) {

        $data = array();
        $data['submitdata'] = "";
        $data['usertype'] = $userid;
        if (isset($_POST['submit'])) {
            $web_order = array(
                'last_name' => $this->input->post('first_name'),
                'first_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'contact' => $this->input->post('contact_no'),
                'select_date' => $this->input->post('select_date'),
                'select_time' => $this->input->post('select_time'),
                'booking_type' => $this->input->post('booking_type'),
                'extra_remark' => $this->input->post('extra_remark'),
                'select_table' => $this->input->post('select_table'),
                'people' => $this->input->post('people'),
                "usertype" => $this->input->post('usertype'),
                'datetime' => date("Y-m-d H:i:s a"),
                "order_source" => "Walk In",
                'order_date' => date("Y-m-d"),
                'status' => "0",
            );
            $this->db->insert('web_order', $web_order);
            $last_id = $this->db->insert_id();
            redirect("Order/orderdetails/" . $last_id);

            $ordertype = $this->input->post('booking_type');
            $data['submitdata'] = 'yes';
        }
        $this->load->view('Order/booknow', $data);
    }

    function orderInbox() {
        $this->load->view('Order/orderinbox');
    }

    function orderInboxDetails($msg_id) {
        $this->db->where('id', $msg_id);
        $query = $this->db->get('web_order_email');
        $emaildetail = $query->row();
        $data['emaildetail'] = $emaildetail;



        $orderlog = array(
            'log_type' => "Email ",
            'log_datetime' => date('Y-m-d H:i:s'),
            'user_id' => "",
            'order_id' => "",
            'log_detail' => "Email Received ",
            "process_by" => $this->session_user['login_id'],
            "process_user" => $this->session_user['username'],
        );
        $this->db->insert('system_log', $orderlog);


        $updateStatus = array(
            "seen" => "1",
            "process_by" => $this->session_user['login_id'],
            "process_user" => $this->session_user['username'],
        );

        $this->db->set($updateStatus);
        $this->db->where("id", $msg_id);
        $this->db->update('web_order_email');

        $this->load->view('Order/orderinboxdetail', $data);
    }
    
    
    public function deleteBookingDateBlock($date_id) {
        $this->db->where('id', $date_id);
        $query = $this->db->delete('booking_date_block');
        redirect("Order/bookingDateBlock");
    }

    public function bookingDateBlock() {
        $data = array();
        $data['title'] = "Block Booking Date";
        $data['description'] = "Block booking dates";
        $data['form_title'] = "Add Blocked Date";
        $data['table_name'] = 'booking_date_block';
        $form_attr = array(
            "select_date" => array("title" => "Select Date", "required" => true, "place_holder" => "Title", "type" => "date", "default" => ""),
        );

        if (isset($_POST['submitData'])) {
            $select_date = $this->input->post("select_date");
            $postarray = array(
                "select_date" => $this->input->post("select_date")
            );

            $this->db->where('select_date', $select_date);

            $query = $this->db->get('booking_date_block');
            $listofdatetemp = $query->result_array();
            if (count($listofdatetemp)) {
                
            } else {
                $this->Curd_model->insert('booking_date_block', $postarray);
            }
            redirect("Order/bookingDateBlock");
        }


        $categories_data = $this->Curd_model->get('booking_date_block');


        $cdate = date("Y-m-d");
        $this->db->where('select_date >=', $cdate);
        $this->db->order_by("select_date");
        $query = $this->db->get('booking_date_block');
        $listofdatetemp = $query->result_array();

        $data['list_data'] = $listofdatetemp;

        $fields = array(
            "select_date" => array("title" => "Block Date", "width" => "200px", "edit" => 0),
        );

        $data['fields'] = $fields;
        $data['form_attr'] = $form_attr;
        $this->load->view('Order/bookingdateblock', $data);
    }


}

?>
