<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('Car_model');
        $this->load->library('upload');

    }
    function index($offset=0){
        // $offset =$this->uri->segment(3);
        $config['total_rows']=$this->Car_model->count_cars(); 
      
       
        $config ['per_page']=10;
        $config['base_url']=base_url().'Car/index';
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
        $data['cars'] = $this->Car_model->get_cars($config['per_page'],$page);
        $data['counter']= $offset+1;
        $data['total']= $config['total_rows'];
        $this->load->view('car/index',$data);
    
    }
    function create_car( ){
        $data['types'] = $this->Car_model->get_car_type();
        $this->load->view('car/create_car',$data);
    }
    function new_car(){   
       
        $this->form_validation->set_rules('palete','palete','trim|required|is_unique[car.palete]',array('required' => 'Palete must be filled in','is_unique' => 'This number Palete already taken'));
		$this->form_validation->set_rules('car_type','Car_type','trim|required',array('required' => 'Car Type must be filled in'));
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');   
        if($this->form_validation->run() ) 
        {
            
            $data['palete'] = $this->input->post('palete');
            $data['car_type_id'] = $this->input->post('car_type');
            if($this->Car_model->insert_car($data)){
                $this->session->set_flashdata('car_create_message','Car Added succefully');
                $this->session->set_flashdata('car_create_message_alert_type','alert-success');

                return redirect("Car/index");
            }else{
                $this->session->set_flashdata('car_create_message','failed rigister ');
                $this->session->set_flashdata('car_create_message_alert_type','alert-danger');

                return redirect("Car/create_user");
            }
            
            
        }
        else
        {
            $this->create_car();
        }
    }

    function delete_car(){
        $this->form_validation->set_rules('rowId','rowId','trim|required|numeric');

        if($this->form_validation->run()){
            $id = $this->input->post('rowId');
               
                if( $this->Car_model->delete_car($id)){
                    
                    $this->session->set_flashdata('car_delete_message','Car Deleted Succefully');
                    $this->session->set_flashdata('car_delete_message_alert_type','alert-success');
                    return redirect("Car/index");
                }else{
                    $this->session->set_flashdata('car_delete_message','fail to Delete Car');
                    $this->session->set_flashdata('car_delete_message_alert_type','alert-danger');
                    return redirect("Car/index");
                }
            
        }
        else{
            $this->session->set_flashdata('car_delete_message','fail to Delete Car');
            $this->session->set_flashdata('car_delete_message_alert_type','alert-danger');
            $this->index();
        }
    }
    function select_car_type( $id){
        
         $data = $this->Car_model->select_car_type($id);
         return $data->type_name;
    }
    function edit_car( $id){
        $data['car'] = $this->Car_model->select_car($id);
        $data['types'] = $this->Car_model->get_car_type();

        $this->load->view('car/edit_car',$data);
    }
    function update_car(){   
       
        $this->form_validation->set_rules('rowId','RowId','trim|required');
        $this->form_validation->set_rules('palete','palete','trim|required',array('required' => 'Palete must be filled'));
		$this->form_validation->set_rules('car_type','Car_type','trim|required',array('required' => 'Car Type must be filled'));
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 
        $return_id = $this->input->post('rowId');
        
        if($this->form_validation->run() ) 
        {
           
            $data['id'] = $this->input->post('rowId');
            $data['palete'] = $this->input->post('palete');
            $data['car_type_id'] = $this->input->post('car_type');
          
            if($this->Car_model->update_car($data,$data['id'])){
                $this->session->set_flashdata('car_edit_message','Car Edited succefully');
                $this->session->set_flashdata('car_edit_message_alert_type','alert-success');

                return redirect("Car/index");
                }else{
                $this->session->set_flashdata('car_edit_message','failed to edit ');
                $this->session->set_flashdata('car_edit_message_alert_type','alert-danger');

                return redirect("Car/index");
            }
            
            
            }
            else
            {
                
            $this->edit_car($return_id);
         }
    }

}
