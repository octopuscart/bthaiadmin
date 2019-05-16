<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CMS extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->curd = $this->load->model('Curd_model');
        $session_user = $this->session->userdata('logged_in');
        if ($session_user) {
            $this->user_id = $session_user['login_id'];
        } else {
            $this->user_id = 0;
        }
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->user_type = $this->session->logged_in['user_type'];
    }

    public function blogCategories() {
        $data = array();
        $data['title'] = "Blog Categories";
        $data['description'] = "Blog Categories";
        $data['form_title'] = "Add Category";
        $data['table_name'] = 'style_category';
        $form_attr = array(
            "category_name" => array("title" => "Category Name", "required" => true, "place_holder" => "Category Name", "type" => "text", "default" => ""),
            "parent_id" => array("title" => "", "required" => false, "place_holder" => "", "type" => "hidden", "default" => ""),
            "display_index" => array("title" => "", "required" => false, "place_holder" => "", "type" => "hidden", "default" => ""),
        );

        if (isset($_POST['submitData'])) {
            $postarray = array();
            foreach ($form_attr as $key => $value) {
                $postarray[$key] = $this->input->post($key);
            }
            $this->Curd_model->insert('style_category', $postarray);
            redirect("CMS/blogCategories");
        }


        $categories_data = $this->Curd_model->get('style_category');
        $data['list_data'] = $categories_data;

        $fields = array(
            "id" => array("title" => "ID#", "width" => "100px"),
            "category_name" => array("title" => "Category Name", "width" => "50%"),
        );

        $data['fields'] = $fields;
        $data['form_attr'] = $form_attr;
        $this->load->view('layout/curd', $data);
    }

    public function blogTag() {
        $data = array();
        $data['title'] = "Blog Tags";
        $data['description'] = "";
        $data['form_title'] = "Add Tags";
        $data['table_name'] = 'style_tags';
        $form_attr = array(
            "tag_name" => array("title" => "Tag Name", "required" => true, "place_holder" => "Tag Name", "type" => "text", "default" => ""),
            "parent_id" => array("title" => "", "required" => false, "place_holder" => "", "type" => "hidden", "default" => ""),
            "display_index" => array("title" => "", "required" => false, "place_holder" => "", "type" => "hidden", "default" => ""),
        );

        if (isset($_POST['submitData'])) {
            $postarray = array();
            foreach ($form_attr as $key => $value) {
                $postarray[$key] = $this->input->post($key);
            }
            $this->Curd_model->insert('style_tags', $postarray);
            redirect("CMS/blogTag");
        }


        $tag_data = $this->Curd_model->get('style_tags');
        $data['list_data'] = $tag_data;

        $fields = array(
            "id" => array("title" => "ID#", "width" => "100px"),
            "tag_name" => array("title" => "Tag Name", "width" => "50%"),
        );

        $data['fields'] = $fields;
        $data['form_attr'] = $form_attr;
        $this->load->view('layout/curd', $data);
    }

    public function newBlog() {
        $data = array();
        $tag_data = $this->Curd_model->get('style_tags');
        $tags = [];
        foreach ($tag_data as $key => $value) {
            array_push($tags, $value['tag_name']);
        }
        $data['tags'] = $tags;


        $categories_data = $this->Curd_model->get('style_category');
        $data['categories'] = $categories_data;

        $config['upload_path'] = 'assets/blog_images';
        $config['allowed_types'] = '*';
        if (isset($_POST['submit_data'])) {
            $picture = '';

            if (!empty($_FILES['picture']['name'])) {
                $temp1 = rand(100, 1000000);
                $config['overwrite'] = TRUE;
                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . "$userid." . $ext;
                $picture = $file_newname;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            }



            $tags = implode(", ", $this->input->post("tags"));

            $blogArray = array(
                "image" => $picture,
                "tag" => $tags,
                "category_id"=> $this->input->post("category_id"),
                "title" => $this->input->post("title"),
                "description" => $this->input->post("description"),
            );

            $this->Curd_model->insert('style_tips', $blogArray);
            redirect("CMS/newBlog");
        }

        $this->load->view('CMS/blog/new_blog', $data);
    }
    
    
    function blogList(){
        $blog_data = $this->Curd_model->get('style_tips', 'desc');
        $data['blog_data'] = $blog_data;
        $this->load->view('CMS/blog/blog_list', $data);
    }
    
    function blogDetails($blog_id){
         $data = array();
        $blog_data = $this->Curd_model->get_single('style_tips', $blog_id);
        $data['blog_data'] = $blog_data;
        
        
       
        $tag_data = $this->Curd_model->get('style_tags');
        $tags = [];
        foreach ($tag_data as $key => $value) {
            array_push($tags, $value['tag_name']);
        }
        $data['tags'] = $tags;


        $categories_data = $this->Curd_model->get('style_category');
        $data['categories'] = $categories_data;

        $config['upload_path'] = 'assets/blog_images';
        $config['allowed_types'] = '*';
        if (isset($_POST['submit_data'])) {
            $picture = '';

            if (!empty($_FILES['picture']['name'])) {
                $temp1 = rand(100, 1000000);
                $config['overwrite'] = TRUE;
                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . "$userid." . $ext;
                $picture = $file_newname;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            }



            $tags = implode(", ", $this->input->post("tags"));

            $blogArray = array(
                "image" => $picture,
                "tag" => $tags,
                "category_id"=> $this->input->post("category_id"),
                "title" => $this->input->post("title"),
                "description" => $this->input->post("description"),
            );

            $this->Curd_model->insert('style_tips', $blogArray);
            redirect("CMS/newBlog");
        }
        
        $this->load->view('CMS/blog/blog_edit', $data);
    }

}

?>
