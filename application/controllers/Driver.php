<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('Driver_model');
        $this->load->library('upload');

    }
    function index($offset=0){
        // $offset =$this->uri->segment(3);
        $config['total_rows']=$this->Driver_model->count_drivers(); 
      
       
        $config ['per_page']=10;
        $config['base_url']=base_url().'Driver/index';
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
        $data['drivers'] = $this->Driver_model->get_drivers($config['per_page'],$page);
        $data['counter']= $offset+1;
        $data['total']= $config['total_rows'];
        $this->load->view('driver/index',$data);
    
    }
    function create_driver( ){
        $this->load->view('driver/create_driver');
    }
    function new_driver(){   
       
        $this->form_validation->set_rules('name','Name','trim|required',array('required' => 'Name must be filled in'));
		$this->form_validation->set_rules('lastname','Lastname','trim|required',array('required' => 'Lastname must be filled in'));
		$this->form_validation->set_rules('phone','Phone','trim|required',array('required' => 'Phone must be filled in','is_unique' => 'username must be unique'));
		$this->form_validation->set_rules('address','Address','trim');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');   
        if($this->form_validation->run() ) 
        {
            
            $data['name'] = $this->input->post('name');
            $data['lastname'] = $this->input->post('lastname');
            $data['phone'] = $this->input->post('phone');
            $data['address']  = $this->input->post('address');
            
            if($this->Driver_model->insert_driver($data)){
                $this->session->set_flashdata('driver_create_message','Driver Rirgestred succefully');
                $this->session->set_flashdata('driver_create_message_alert_type','alert-success');

                return redirect("Driver/index");
            }else{
                $this->session->set_flashdata('driver_create_message','failed rigister ');
                $this->session->set_flashdata('driver_create_message_alert_type','alert-danger');

                return redirect("Driver/create_driver");
            }
            
            
        }
        else
        {
            $this->create_driver();
        }
    }

    function delete_driver(){
        $this->form_validation->set_rules('rowId','rowId','trim|required|numeric');
        if($this->form_validation->run()){
            $id = $this->input->post('rowId');
           
            if( $this->Driver_model->delete_driver($id)){                    
                $this->session->set_flashdata('driver_delete_message','Driver Deleted Succefully');
                $this->session->set_flashdata('driver_delete_message_alert_type','alert-success');
                return redirect("Driver/index");
            }else{
                $this->session->set_flashdata('driver_delete_message','fail to Delete ');
                $this->session->set_flashdata('driver_delete_message_alert_type','alert-danger');
                return redirect("Driver/index");
            }
        }
        else{
            $this->session->set_flashdata('driver_delete_message','fail to Delete ');
            $this->session->set_flashdata('driver_delete_message_alert_type','alert-danger');
            $this->index();
        }
    }
    function edit_driver($id){
        $data= $this->Driver_model->select_driver($id);
        $this->load->view('driver/edit_driver',['driver'=>$data]);
    }
    function update_driver(){   
       
        $this->form_validation->set_rules('name','Name','trim|required',array('required' => 'Name must be filled in'));
		$this->form_validation->set_rules('lastname','Lastname','trim|required',array('required' => 'Lastname must be filled in'));
		$this->form_validation->set_rules('phone','Phone','trim|required',array('required' => 'Phone must be filled in','is_unique' => 'username must be unique'));
		$this->form_validation->set_rules('address','Address','trim');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 
        $return_id = $this->input->post('rowId');
        
        if($this->form_validation->run() ) 
        {
           
            $data['id'] = $this->input->post('rowId');
            $data['name'] = $this->input->post('name');
            $data['lastname'] = $this->input->post('lastname');
            $data['phone'] = $this->input->post('phone');
            $data['address']  = $this->input->post('address');
                       
            if($this->Driver_model->update_driver($data,$data['id'])){
                $this->session->set_flashdata('driver_edit_message','Driver Edited succefully');
                $this->session->set_flashdata('driver_edit_message_alert_type','alert-success');

                return redirect("Driver/index");
            }else{
                $this->session->set_flashdata('driver_edit_message','failed to edit ');
                $this->session->set_flashdata('driver_edit_message_alert_type','alert-danger');

                return redirect("Driver/index");
            }
            
            
        }else
        {
            $this->edit_driver($return_id);
        }
    }

}
