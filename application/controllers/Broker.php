<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Broker extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model(array('Auth_model','Vendor_model','User_model','Customer_model','Broker_model'));
		$this->load->library(array('session','form_validation'));
    }

	function index(){
		if($this->session->userdata('userId') == null){
			redirect('Auth','refresh');
		} 
		$data['broker_list'] = $this->Broker_model->list();
		
		$data['header'] = $this->load->view('common/header','',true);
		$data['navbar'] = $this->load->view('common/navbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['topbar'] = $this->load->view('common/topbar','',true);
		$data['copyright'] = $this->load->view('common/copyright','',true);
		$data['body'] = $this->load->view('pages/broker',$data,true);
		$this->load->view('layout',$data);
	}

	function create(){
	    
	    if($this->input->post('brokerid')){
	        $this->update($this->input->post());
	        die;
	    }
		$this->form_validation->set_rules('name', 'Broker Name', 'required|trim');
		$this->form_validation->set_rules('contact_no', 'Contact No', 'trim|min_length[10]');
		$this->form_validation->set_rules('alternet_no', 'Alternet No', 'trim|min_length[10]');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		
		$this->form_validation->set_error_delimiters('<span class="custom_error text-danger text-center">', '</span>');
		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('msg', 'Something wrong.');
		    $this->index();
		}
		else {
		    $data['broker_name'] = $this->input->post('name');
		    $data['contact_no'] = $this->input->post('contact_no');
		    $data['alternet_no'] = $this->input->post('alternet_no');
		    $data['email'] = $this->input->post('email');
		    $data['created_by'] = $this->session->userdata('userId');
		    $data['created_at'] = date('Y-m-d H:i:s');
		    $result = $this->Broker_model->create($data);
		    if($result){
		        $this->session->set_flashdata('msg', 'Broker created successfully.');
		        redirect('master/broker');
		    } else {
		        $this->session->set_flashdata('msg', 'Broker not created successfully.');
		        redirect('master/broker');
		    }
		}
	}

	function update($data){
        $result = $this->Broker_model->update($data);
        $this->session->set_flashdata('msg', 'broker updated successfully.');
        redirect('master/broker');
	}

	function delete(){
        $brokerId = $this->input->post('brokerId');
        $result = $this->Broker_model->delete($brokerId);
        if($result){
            echo json_encode(array('msg'=>'Broker deleted successfully.','status'=>200));
        } else {
            echo json_encode(array('msg'=>'something wend wrong.','status'=>500));
        }
	}
	
	function getdetail(){
	   $broker_id = $this->input->post('brokerId'); 
	   $result = $this->Broker_model->getdetail($broker_id);
	   if(count($result)>0){
	       echo json_encode(array('data'=>$result,'msg'=>'broker detail','status'=>200));
	   } else {
	       echo json_encode(array('msg'=>'no record found.','status'=>500));
	   }
	}
	
	function report(){
	    if($this->session->userdata('userId') == null){
	        redirect('Auth','refresh');
	    }
	    $data['report_data'] = $this->Broker_model->report();
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['navbar'] = $this->load->view('common/navbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['topbar'] = $this->load->view('common/topbar','',true);
	    $data['copyright'] = $this->load->view('common/copyright','',true);
	    $data['body'] = $this->load->view('report/broker_report',$data,true);
	    $this->load->view('layout',$data);
	}

}
