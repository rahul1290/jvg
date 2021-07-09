<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model(array('Auth_model','Vendor_model','User_model','Customer_model'));
		$this->load->library(array('session','form_validation'));
    }

	function index(){
		if($this->session->userdata('userId') == null){
			redirect('Auth','refresh');
		} 
		$data['customer_list'] = $this->Customer_model->list();
		$data['header'] = $this->load->view('common/header','',true);
		$data['navbar'] = $this->load->view('common/navbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['topbar'] = $this->load->view('common/topbar','',true);
		$data['copyright'] = $this->load->view('common/copyright','',true);
		$data['body'] = $this->load->view('pages/customer',$data,true);
		$this->load->view('layout',$data);
	}

	function create(){
	    
	    if($this->input->post('customerid')){
	        $this->update($this->input->post());
	        die;
	    }
		$this->form_validation->set_rules('name', 'Customer Name', 'required|trim');
		$this->form_validation->set_rules('gst_no', 'GST Name', 'required|trim|exact_length[15]');
		$this->form_validation->set_rules('contact_no', 'Contact No', 'required|trim|min_length[10]');
		$this->form_validation->set_rules('alternet_no', 'Alternet No', 'trim|min_length[10]');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		
		$this->form_validation->set_error_delimiters('<span class="custom_error text-danger text-center">', '</span>');
		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('msg', 'Something wrong.');
		    $this->index();
		}
		else {
		    $data['customer_name'] = $this->input->post('name');
		    $data['gst_no'] = $this->input->post('gst_no');
		    $data['contact_no'] = $this->input->post('contact_no');
		    $data['alternet_no'] = $this->input->post('alternet_no');
		    $data['email'] = $this->input->post('email');
		    $data['address'] = $this->input->post('address');
		    $data['created_by'] = $this->session->userdata('userId');
		    $data['created_at'] = date('Y-m-d H:i:s');
		    $result = $this->Customer_model->create($data);
		    if($result){
		        $this->session->set_flashdata('msg', 'Customer created successfully.');
		        redirect('master/customer');
		    } else {
		        $this->session->set_flashdata('msg', 'Customer not created successfully.');
		        redirect('master/customer');
		    }
		    
			
			
		}
	}

	function update($data){
        $result = $this->User_model->update($data);
        $this->session->set_flashdata('msg', 'User updated successfully.');
        redirect('master/user');
	}

	function delete(){
        $customerId = $this->input->post('customerId');
        $result = $this->Customer_model->delete($customerId);
        if($result){
            echo json_encode(array('msg'=>'Customer deleted successfully.','status'=>200));
        } else {
            echo json_encode(array('msg'=>'something wend wrong.','status'=>500));
        }
	}
	
	function getdetail(){
	   $customer_id = $this->input->post('customerId'); 
	   $result = $this->Customer_model->getdetail($customer_id);
	   if(count($result)>0){
	       echo json_encode(array('data'=>$result,'msg'=>'customer detail','status'=>200));
	   } else {
	       echo json_encode(array('msg'=>'no record found.','status'=>500));
	   }
	}

}
