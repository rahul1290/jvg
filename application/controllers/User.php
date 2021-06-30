<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model(array('Auth_model','Vendor_model','User_model'));
		$this->load->library(array('session','form_validation'));
    }

	function index(){
		if($this->session->userdata('userId') == null){
			redirect('Auth','refresh');
		} 
		$data['user_list'] = $this->User_model->list();
		$data['user_types'] = $this->User_model->user_type_list();
		$data['header'] = $this->load->view('common/header','',true);
		$data['navbar'] = $this->load->view('common/navbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['topbar'] = $this->load->view('common/topbar','',true);
		$data['copyright'] = $this->load->view('common/copyright','',true);
		$data['body'] = $this->load->view('pages/user',$data,true);
		$this->load->view('layout',$data);
	}

	function create(){
	    
	    if($this->input->post('userid')){
	        $this->update($this->input->post());
	        die;
	    }
		$this->form_validation->set_rules('fname', 'First Name', 'required|trim');
		$this->form_validation->set_rules('lname', 'Last Name', 'required|trim');
		$this->form_validation->set_rules('uname', 'User Name', 'required|trim');
		$this->form_validation->set_rules('contact', 'Contact No', 'required|trim|min_length[10]');
		$this->form_validation->set_rules('user_type', 'User type', 'required|trim|is_natural_no_zero');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');
		
		$this->form_validation->set_error_delimiters('<span class="custom_error text-danger text-center">', '</span>');
		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('msg', 'Something wrong.');
		    $this->index();
		}
		else {
		    $data['user_type_id'] = $this->input->post('user_type');
		    $data['uname'] = $this->input->post('uname');
		    $data['fname'] = $this->input->post('fname');
		    $data['lname'] = $this->input->post('lname');
		    $data['contact_no'] = $this->input->post('contact');
		    $data['password'] = $this->input->post('password');
		    $data['created_by'] = $this->session->userdata('userId');
		    $data['created_at'] = date('Y-m-d H:i:s');
		    $result = $this->User_model->create($data);
		    if($result){
		        $this->session->set_flashdata('msg', 'User created successfully.');
		        redirect('master/user');
		    } else {
		        $this->session->set_flashdata('msg', 'User not created successfully.');
		        redirect('master/user');
		    }
		    
			
			
		}
	}

	function update($data){
        $result = $this->User_model->update($data);
        $this->session->set_flashdata('msg', 'User updated successfully.');
        redirect('master/user');
	}

	function delete(){
        $userId = $this->input->post('userId');
        $result = $this->User_model->delete($userId);
        if($result){
            echo json_encode(array('msg'=>'user deleted successfully.','status'=>200));
        } else {
            echo json_encode(array('msg'=>'something wend wrong.','status'=>500));
        }
	}
	
	function getdetail(){
	   $user_id = $this->input->post('userId'); 
	   $result = $this->User_model->getdetail($user_id);
	   if(count($result)>0){
	       echo json_encode(array('data'=>$result,'msg'=>'user detail','status'=>200));
	   } else {
	       echo json_encode(array('msg'=>'no record found.','status'=>500));
	   }
	}

}
