<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('upload');

    }
    function index($offset=0){
        // $offset =$this->uri->segment(3);
        $config['total_rows']=$this->User_model->count_users(); 
      
       
        $config ['per_page']=3;
        $config['base_url']=base_url().'User/index';
        $config['full_tag_open'] = '<ul class="pagination" style="margin: 4px 0">';
        $config['full_tag_close'] = '</ul>';
    
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = ' <li>';
        $config['first_tag_close'] = '</li>';
    
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li >';
        $config['last_tag_close'] = '</li>';
    
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li >';
        $config['next_tag_close'] = '</li>';
    
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li >';
        $config['prev_tag_close'] = '</li>';
    
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
    
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        // $config['num_links']= $config['total_rows']/$config ['per_page'];
        // $this->pagination->initialize( $config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['users'] = $this->User_model->get_users($config['per_page'],$page);
        $data['counter']= $offset+1;
        $data['total']= $config['total_rows'];
        $this->load->view('users/index',$data);
    
    }
    function create_user( ){
        $this->load->view('users/create_user');
    }
    function new_user(){   
       
        $this->form_validation->set_rules('name','Name','trim|required',array('required' => 'Name must be filled in'));
		$this->form_validation->set_rules('lastname','Lastname','trim|required',array('required' => 'Lastname must be filled in'));
		$this->form_validation->set_rules('username','Username','trim|required|is_unique[admin.username]',array('required' => 'Username must be filled in','is_unique' => 'username must be unique'));
		$this->form_validation->set_rules('password','Password','trim|required',array('required' => 'Password must be filled in'));
        $this->form_validation->set_rules('role','Gender','trim|required',array('required' => 'Role must be filled in'));
        $this->form_validation->set_rules('photo','Photo','trim'); 
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');   
        if($this->form_validation->run() ) 
        {
            
            $data['name'] = $this->input->post('name');
            $data['lastname'] = $this->input->post('lastname');
            $data['username'] = $this->input->post('username');
            $data['password']  = $this->input->post('password');
            $data['role']  = $this->input->post('role');
            if (!$_FILES['photo']['name']=='') {
                $new_filename = uniqid('a',true);
                $config['file_name'] = $new_filename;
                $config = array(
                'upload_path' => "uploads/userImage/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "",
                'max_width' => "",
                'encrypt_name'=> TRUE   
                );
                $this->upload->initialize($config);


                if ( ! $this->upload->do_upload('photo'))
                {
                    echo " not upload";
                    $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $file = $this->upload->data();
                    $data['photo_name'] = $file['file_name'];
                }            
            }
            else
            {
                $data['photo_name']= 'user.png';
              
            }
            if($this->User_model->insert_user($data)){
                $this->session->set_flashdata('user_create_message','User Rirgestred succefully');
                $this->session->set_flashdata('user_create_message_alert_type','alert-success');

                return redirect("User/index");
            }else{
                $this->session->set_flashdata('user_create_message','failed rigister ');
                $this->session->set_flashdata('user_create_message_alert_type','alert-danger');

                return redirect("User/create_user");
            }
            
            
        }
        else
        {
            $this->create_user();
        }
    }

    function delete_user(){
        $this->form_validation->set_rules('rowId','rowId','trim|required|numeric');
        $id = $this->input->post('rowId');
       
        if($this->form_validation->run()){
            $id = $this->input->post('rowId');
            $photo_name = $this->User_model->get_user_photo_name($id);
            $path = $_SERVER['DOCUMENT_ROOT'].'/ci/uploads/userImage/'.$photo_name->photo_name;
            
            if($photo_name->photo_name=='user.png'){
                if( $this->User_model->delete_user($id)){                    
                    $this->session->set_flashdata('user_delete_message','User Deleted Succefully');
                    $this->session->set_flashdata('user_delete_message_alert_type','alert-success');
                    return redirect("User/index");
                }else{
                    $this->session->set_flashdata('user_delete_message','fail to Delete ');
                    $this->session->set_flashdata('user_delete_message_alert_type','alert-danger');
                    return redirect("User/index");
                }
            }else{
                if(is_file($path)){
               
                    if( $this->User_model->delete_user($id)){
                        unlink($path);
                        
                        $this->session->set_flashdata('user_delete_message','User Deleted Succefully');
                        $this->session->set_flashdata('user_delete_message_alert_type','alert-success');
                        return redirect("User/index");
                    }else{
                        $this->session->set_flashdata('user_delete_message','fail to Delete ');
                        $this->session->set_flashdata('user_delete_message_alert_type','alert-danger');
                        return redirect("User/index");
                    }
                } else {
                  
                    $this->session->set_flashdata('user_delete_message','fail to Delete ');
                    $this->session->set_flashdata('user_delete_message_alert_type','alert-danger');
                    return redirect("User/index");                
                }
            }
           
        }
        else{
            $this->session->set_flashdata('user_delete_message','fail to Delete ');
            $this->session->set_flashdata('user_delete_message_alert_type','alert-danger');
            $this->index();
        }
    }
    function edit_user( $id){
        $data = $this->User_model->select_user($id);
        $this->load->view('users/edit_user',['user'=>$data]);
    }
    function update_user(){   
       
        $this->form_validation->set_rules('rowId','RowId','trim|required');
        $this->form_validation->set_rules('name','Name','trim|required',array('required' => 'نام نباید  خالی  باشد'));
		$this->form_validation->set_rules('lastname','Lastname','trim|required',array('required' => 'تخلص نباید خالی  باشد'));
		$this->form_validation->set_rules('username','Username','trim|required',array('required' => 'نام کاربری نباید خالی  باشد'));
		$this->form_validation->set_rules('password','Password','trim|required',array('required' => 'رمز عبور نباید خالی  باشد'));
        $this->form_validation->set_rules('role','Role','trim|required',array('required' => 'جنسیت نباید خالی باشد'));
        $this->form_validation->set_rules('photo','Photo','trim'); 
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 
        $return_id = $this->input->post('rowId');
        
        if($this->form_validation->run() ) 
        {
           
            $data['id'] = $this->input->post('rowId');
            $data['name'] = $this->input->post('name');
            $data['lastname'] = $this->input->post('lastname');
            $data['username'] = $this->input->post('username');
            $data['password']  = $this->input->post('password');
            $data['role']  = $this->input->post('role');
            $oldPhoto  = $this->input->post('oldPhoto');
           // echo $_FILES['photo']['name'];
            if (!$_FILES['photo']['name']=='') {
                $new_filename = uniqid('a',true);
                $config['file_name'] = $new_filename;
                $config = array(
                'upload_path' => "uploads/userImage/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "",
                'max_width' => "",
                'encrypt_name'=> TRUE   
                );
                $this->upload->initialize($config);


                if ( ! $this->upload->do_upload('photo'))
                {
                    echo " not upload";
                    $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $file = $this->upload->data();
                    $data['photo_name'] = $file['file_name'];
                }            
                }
             else
             {
                $data['photo_name'] = $oldPhoto;  
            }
            if($this->User_model->update_user($data,$data['id'])){
                $this->session->set_flashdata('user_edit_message','User Edited succefully');
                $this->session->set_flashdata('user_edit_message_alert_type','alert-success');

                return redirect("User/index");
                }else{
                $this->session->set_flashdata('user_edit_message','failed to edit ');
                $this->session->set_flashdata('user_edit_message_alert_type','alert-danger');

                return redirect("User/index");
            }
            
            
            }
            else
            {
                
            $this->edit_user($return_id);
         }
    }

}
