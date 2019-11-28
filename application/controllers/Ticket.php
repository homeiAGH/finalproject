<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('Ticket_model');
    }
    function index($offset=0){
        // $offset =$this->uri->segment(3);
        $config['total_rows']=$this->Ticket_model->count_tickets(); 
        $config ['per_page']=3;
        $config['base_url']=base_url().'Ticket/index';
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
        $data['tickets'] = $this->Ticket_model->get_tickets($config['per_page'],$page);
        $data['counter']= $offset+1;
        $data['total']= $config['total_rows'];
        $this->load->view('ticket/index',$data);
    
    }
    function create_ticket(){
        $data['cars'] = $this->Ticket_model->get_cars();
        $data['drivers'] = $this->Ticket_model->get_drivers();
        // var_dump($data['cars']);
        // exit();
        $this->load->view('ticket/create_ticket',$data);
    }
    function new_ticket(){   
        $this->form_validation->set_rules('name','Name','trim|required',array('required' => 'Name must be filled in'));
		$this->form_validation->set_rules('lastname','Lastname','trim|required',array('required' => 'Lastname must be filled in'));
		$this->form_validation->set_rules('gender','Gender','trim|required|is_unique[admin.username]',array('required' => 'Gender must be filled in','is_unique' => 'username must be unique'));
		$this->form_validation->set_rules('passportNumber','PassportNumber','trim|required',array('required' => 'PassportNumber must be filled in'));
        $this->form_validation->set_rules('phone','Phone','trim|required',array('required' => 'Phone must be filled in'));
        $this->form_validation->set_rules('address','Photo','trim');
        $this->form_validation->set_rules('from_to','From_to','trim|required',array('required' => 'From_to must be filled in'));
        $this->form_validation->set_rules('driver','Driver','trim|required',array('required' => 'Driver must be select'));
        $this->form_validation->set_rules('car','Car','trim|required',array('required' => 'Car must be select'));
        $this->form_validation->set_rules('travel_date','Travel_date','trim|required',array('required' => 'Travel Date must be filled in'));
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');   
        if($this->form_validation->run() ) 
        {
            
            $passenger['name'] = $this->input->post('name');
            $passenger['lastname'] = $this->input->post('lastname');
            $passenger['phone'] = $this->input->post('phone');
            $passenger['address'] = $this->input->post('address');
            $passenger['passportNumber'] = $this->input->post('passportNumber');
            $admin_id = $this->session->userdata('id');
            $passenger['admin_id'] = $admin_id;
            $ticket['from_to'] = $this->input->post('from_to');
            $ticket['travel_date'] = $this->input->post('travel_date');
            $ticket['car_id'] = $this->input->post('car');
            $ticket['driver_id'] = $this->input->post('driver');
            $ticket['passenger_id'] ='';

            if($this->Ticket_model->insert_ticket($passenger,$ticket)){
                $this->session->set_flashdata('ticket_create_message','ticket Rirgestred succefully');
                $this->session->set_flashdata('ticket_create_message_alert_type','alert-success');
                return redirect("Ticket/index");

            }else{
                $this->session->set_flashdata('ticket_create_message','failed rigister ');
                $this->session->set_flashdata('ticket_create_message_alert_type','alert-danger');

                return redirect("Ticket/create_ticket");

            }
       
        }
        else
        {
            $this->create_ticket();
        }
    }

    function delete_ticket(){
        $this->form_validation->set_rules('rowId','rowId','trim|required|numeric');
        $id = $this->input->post('rowId');
        if($this->form_validation->run()){
            $id = $this->input->post('rowId');
            if( $this->Ticket_model->delete_ticket($id)){                
                $this->session->set_flashdata('ticket_delete_message','ticket Deleted Succefully');
                $this->session->set_flashdata('ticket_delete_message_alert_type','alert-success');
                return redirect("Ticket/index");
            }else{
                $this->session->set_flashdata('ticket_delete_message','fail to Delete ');
                $this->session->set_flashdata('ticket_delete_message_alert_type','alert-danger');
                return redirect("Ticket/index");
            }
                
           
        }
        else{
            $this->session->set_flashdata('ticket_delete_message','fail to Delete ');
            $this->session->set_flashdata('ticket_delete_message_alert_type','alert-danger');
            $this->index();
        }
    }
    function edit_ticket($id){
        $data['ticket'] = $this->Ticket_model->select_ticket($id);
        $data['cars'] = $this->Ticket_model->get_cars();
        $data['drivers'] = $this->Ticket_model->get_drivers();
        
        $this->load->view('ticket/edit_ticket',$data);
    }
    function update_ticket(){   
        $this->form_validation->set_rules('passenger_id','Passenger_id','trim|required',array('required' => ''));
        $this->form_validation->set_rules('ticket_id','Ticket_id','trim|required',array('required' => ''));
        $this->form_validation->set_rules('name','Name','trim|required',array('required' => 'Name must be filled in'));
		$this->form_validation->set_rules('lastname','Lastname','trim|required',array('required' => 'Lastname must be filled in'));
		$this->form_validation->set_rules('gender','Gender','trim|required|is_unique[admin.username]',array('required' => 'Gender must be filled in','is_unique' => 'username must be unique'));
		$this->form_validation->set_rules('passportNumber','PassportNumber','trim|required',array('required' => 'PassportNumber must be filled in'));
        $this->form_validation->set_rules('phone','Phone','trim|required',array('required' => 'Phone must be filled in'));
        $this->form_validation->set_rules('address','Photo','trim');
        $this->form_validation->set_rules('from_to','From_to','trim|required',array('required' => 'From_to must be filled in'));
        $this->form_validation->set_rules('driver','Driver','trim|required',array('required' => 'Driver must be select'));
        $this->form_validation->set_rules('car','Car','trim|required',array('required' => 'Car must be select'));
        $this->form_validation->set_rules('travel_date','Travel_date','trim|required',array('required' => 'Travel Date must be filled in'));
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 
        $return_id = $this->input->post('ticket_id');
        if($this->form_validation->run() ) 
        { 
            $passenger['name'] = $this->input->post('name');
            $passenger['lastname'] = $this->input->post('lastname');
            $passenger['gender'] = $this->input->post('gender');
            $passenger['passportNumber']  = $this->input->post('passportNumber');
            $passenger['phone']  = $this->input->post('phone');
            $passenger['address']  = $this->input->post('address');
            $passenger['id']  = $this->input->post('passenger_id');
            $ticket['id'] = $this->input->post('ticket_id');
            $ticket['from_to'] = $this->input->post('from_to');
            $ticket['driver_id'] = $this->input->post('driver');
            $ticket['car_id'] = $this->input->post('car');
            $ticket['travel_date'] = $this->input->post('travel_date');

            if($this->Ticket_model->update_ticket($ticket,$passenger)){
                $this->session->set_flashdata('ticket_edit_message','ticket Edited succefully');
                $this->session->set_flashdata('ticket_edit_message_alert_type','alert-success');

                return redirect("Ticket/index");
                }else{
                $this->session->set_flashdata('ticket_edit_message','failed to edit ');
                $this->session->set_flashdata('ticket_edit_message_alert_type','alert-danger');

                return redirect("Ticket/index");
            }
            
            
            }
            else
            {
                
            $this->edit_ticket($return_id);
         }
    }

}
