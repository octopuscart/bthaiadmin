<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class LocalApi extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->checklogin = $this->session->userdata('logged_in');
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

}

?>