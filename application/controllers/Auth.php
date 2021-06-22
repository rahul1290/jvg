<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->helper(array('form','url'));
        $this->load->database();
        $this->load->model(array('Auth_model'));
		$this->load->library(array('session','form_validation'));
    }

	function index(){
		if($this->session->userdata('userId') != null){
			redirect('Dashboard','refresh');
		}
		$data['header'] = $this->load->view('common/header','',true);
		$data['navbar'] = '';
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['body'] = $this->load->view('auth/login','',true);
		$this->load->view('layout',$data);
	}

	function login(){
		$this->form_validation->set_rules('identity', 'identity', 'required|trim');
		$this->form_validation->set_rules('password', 'password', 'required|trim');
		$this->form_validation->set_error_delimiters('<span class="custom_error text-danger text-center">', '</span>');
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('msg', 'Enter identity and password');
			$this->index();
		}
		else {
			$data['identity'] = trim($this->input->post('identity'));
			$data['password'] = trim($this->input->post('password'));
			
			$result = $this->Auth_model->login($data);
			
			if(count($result)>0){
				$this->session->set_userdata(array(
					'userId' => $result[0]['user_id'],
					'userName' => $result[0]['uname'],
					'role' => $result[0]['type']
				));
				redirect('Dashboard','refresh');
			} else {
				$this->session->set_flashdata('msg', 'Wrong credentials');
				$this->index();
			}
		}
	}
}