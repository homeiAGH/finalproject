<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('Welcome_model');
    }
	
	public function index()
	{
		$this->load->view('login');
	}
	public function main_page()
	{
		$data['users'] = $this->Welcome_model->count_users();
		$data['drivers'] = $this->Welcome_model->count_drivers();
		$data['cars'] = $this->Welcome_model->count_cars();
		$data['tickets'] = $this->Welcome_model->count_tickets();

		$this->load->view('layout/main',$data);
	}
}
