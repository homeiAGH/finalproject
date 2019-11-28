<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
    }
     
    function index(){
        $this->load->view('login');
    }

    function login(){
        $username    = $this->input->post('username',TRUE);
        $password = $this->input->post('password');
        ///check if there is admin exist in database if yes get the his data and store to session 
        $validate = $this->Login_model->validate($username,$password);
        
        
        if($validate){
            $id  = $validate['id'];
            $name  = $validate['name'];
            $lastname = $validate['lastname'];
            $level = $validate['role'];
            $photo = $validate['photo_name'];

            $sesdata = array(
             
                'id'  => $id,
                'name'  => $name,
                'lastname'     => $lastname,
                'level'     => $level,
                'photo'     => $photo,
                'logged_in' => TRUE
            );
        //    if( $this->sessin->userdaata('logged_in')){


        //    }else{
        //        redirect('Welcome')
        //    }
            $this->session->set_userdata($sesdata);

           
            redirect('Welcome/main_page');
            
        }else{
            echo $this->session->set_flashdata('msg','Username or Password is Wrong');
            redirect('Welcome/index');
        }
    }
    function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

}
