<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class LocalApi extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->checklogin = $this->session->userdata('logged_in');
        $this->load->model('Order_model');
    }

    function testGet_get() {
        print_r($this->checklogin['user_type']);
    }

    //function for user settingt
    function updateUserSession_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("admin_users", $data);
            if (isset($this->checklogin[$fieldname])) {

                $this->checklogin[$fieldname] = $value;
                $this->session->set_userdata('logged_in', $this->checklogin);
            }
        }
    }

    function updateUserClient_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("admin_users", $data);
        }
    }

    function updateUser() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');

        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("admin_user", $data);
        }
    }

    function updateAppointment_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $tablename = $this->post('appointment_entry');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("aid", $pk_id);
            $this->db->update('appointment_entry', $data);
        }
    }

    function updateAppointmentTime_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $tablename = $this->post('appointment_entry');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update('appointment_entry', $data);
        }
    }

    //function for curd update
    function updateCurd_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $tablename = $this->post('tablename');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update($tablename, $data);
        }
    }

    //function for curd update
    function curd_get($table_name) {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update($table_name, $data);
        }
    }

    //function for product list
    function deleteCurd_post($table_name) {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update($table_name, $data);
        }
    }

    //function for curd update
    function cartUpdate_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $quantity = $this->post('quantity');
        $totalPrice = (intval($quantity) * intval($value));
        if ($this->checklogin) {
            $data = array($fieldname => $value, "total_price" => "$totalPrice");
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("cart");

            $this->db->where('id', $pk_id);
            $query = $this->db->get('cart');
            $cart_items = $query->row();

            $order_details = $this->Order_model->recalculateOrder($cart_items->order_id);
        }
    }

    //function for order update
    function orderUpdate_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("web_order");
        }
    }

    function notificationUpdate_get() {
        $this->db->order_by('id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get('system_log');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function checkUnseenOrder_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', "0");
        $query = $this->db->get('web_order');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function inboxOrderMail_get() {
        $this->Order_model->orderInboxEmail();
        $this->response();
    }

    function inboxOrderMailIndb_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('seen', "0");
        $query = $this->db->get('web_order_email');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function inboxOrderMaildb_get() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('web_order_email');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function sendEmailOrderCancle_get($order_key) {
        $this->Order_model->order_mail($order_key);
    }

    //mobile app api
    function inboxOrderMailIndbMobileUnseen_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('seen', "0");
        $query = $this->db->get('web_order_email');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->response($systemlog);
    }

    function checkUnseenOrderMobileUnseen_get() {

        $this->db->order_by('id', 'desc');
        $this->db->where('status', "0");
        $query = $this->db->get('web_order');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        $this->response($systemlog);
    }

    function inboxOrderMailIndbMobile_get() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('web_order_email');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $tamparray = [];
        foreach ($systemlog as $key => $value) {
            $emp = $value['from_email'];
            $tmp = explode("<", $emp);
            $name = $tmp[0];
            $emailf = str_replace(">", "", $tmp[1]);
            $value["femail"] = $emailf;
            $value["name"] = $name;
            array_push($tamparray, $value);
        }
        $this->response($tamparray);
    }

    function checkUnseenOrderMobile_get() {
        $this->db->order_by('id', 'desc');

        $query = $this->db->get('web_order');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->response($systemlog);
    }

    function checkClientMobile_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('user_type', "");
        $query = $this->db->get('admin_users');

        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->response($systemlog);
    }

    function registerMobileUser_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $reg_id = $this->post('reg_id');
        $model = $this->post('model');
        $manufacturer = $this->post('manufacturer');
        $uuid = $this->post('uuid');
        $regArray = array(
            "reg_id" => $reg_id,
            "manufacturer" => $manufacturer,
            "uuid" => $uuid,
            "model" => $model,
            "user_id" => "Admin",
            "user_type" => "Admin",
            "datetime" => date("Y-m-d H:i:s a")
        );
        $this->db->insert('gcm_registration', $regArray);


        $this->response(array("status" => "done"));
    }

    function updateOrderStatus_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $order_id = $this->post('order_id');
        $data = array("status" => "1");
        $this->db->set($data);
        $this->db->where("id", $order_id);
        $this->db->update("web_order");

        $order_status_data = array(
            'c_date' => date('Y-m-d'),
            'c_time' => date('H:i:s'),
            'order_id' => $order_id,
            'status' => "Received",
            'user_id' => "Mobile user",
            'remark' => "Order Received From Mobile App",
            "process_by" => "Mobile App",
            "process_user" => "Admin Mobile App",
        );
        $this->db->insert('user_order_status', $order_status_data);

        $this->response(array("status" => "done"));
    }

    function updateEmailStatus_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $email_id = $this->post('email_id');
        $data = array("seen" => "1");
        $this->db->set($data);
        $this->db->where("id", $email_id);
        $this->db->update("web_order_email");
        $this->response(array("status" => "done"));
    }

}

?>