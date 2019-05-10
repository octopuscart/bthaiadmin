<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->userdata = $this->session->userdata('logged_in');
    }

    public function index() {
        $data = array();
      
        $data['login_user'] = $this->session->userdata('logged_in');
        $userdata = $this->userdata;
        if ($userdata) {
            redirect("Order/index", "refresh");
        } else {
           //    redirect("Authentication/index");
        }

        //login conroller
        if (isset($_POST['signIn'])) {
            $username = $this->input->post('email');
            $password = $this->input->post('password');
            $this->db->select('id,first_name,last_name,email,password,user_type, image');
            $this->db->from('admin_users');
            $this->db->where('email', $username);
            $this->db->where('password', md5($password));
            $this->db->limit(1);
            $query = $this->db->get();
            $checkuser = $query->row();

            if ($checkuser) {
                $usr = $checkuser->email;
                $pwd = $checkuser->password;

                if ($username == $usr && md5($password) == $pwd) {
                    $sess_data = array(
                        'username' => $username,
                        'first_name' => $checkuser->first_name,
                        'last_name' => $checkuser->last_name,
                        'login_id' => $checkuser->id,
                        'user_type' => $checkuser->user_type,
                        'image' => $checkuser->image,
                    );
                    $this->session->set_userdata('logged_in', $sess_data);

                    redirect('Order/index');
                }
            } else {
                $data1['msg'] = 'this';
                //redirect('LoginAndLogout/login_admin/');
            }
        }

        //end of login controller

        $this->load->view('authentication/login', $data);
    }

    public function profile() {
        $data = array();
        $this->load->view('authentication/profile', $data);
    }

    public function logout() {
        $userdata = array();
        $this->session->unset_userdata($userdata);
        $this->session->sess_destroy();
        redirect('Authentication', 'refresh');
    }

    public function error_404() {
        $this->load->view('errors/404');
    }

}
