<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model(array('Auth_model','Vendor_model'));
		$this->load->library(array('session','form_validation'));
    }

	function index(){
		if($this->session->userdata('userId') == null){
			redirect('Auth','refresh');
		} 
		$data['vendor_list'] = $this->Vendor_model->list();
		$data['header'] = $this->load->view('common/header','',true);
		$data['navbar'] = $this->load->view('common/navbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['topbar'] = $this->load->view('common/topbar','',true);
		$data['copyright'] = $this->load->view('common/copyright','',true);
		$data['body'] = $this->load->view('pages/vendor',$data,true);
		$this->load->view('layout',$data);
	}

	function create(){
	    
	    if($this->input->post('vendorid')){
	        $this->update($this->input->post());
	        die;
	    }
		$this->form_validation->set_rules('name', 'Vendor Name', 'required|trim');
		$this->form_validation->set_rules('contact', 'Contact No', 'required|trim|min_length[10]');
		$this->form_validation->set_rules('alternet_contact', 'Alternet No', 'trim');
		$this->form_validation->set_rules('gst_no', 'Alternet No', 'required|trim|exact_length[15]');
		$this->form_validation->set_rules('address', 'Address', 'trim');
		$this->form_validation->set_error_delimiters('<span class="custom_error text-danger text-center">', '</span>');
		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('msg', 'Something wrong.');
		    $this->index();
		}
		else {
		    $data['vendor_name'] = $this->input->post('name');
		    $data['contact_no'] = $this->input->post('contact');
		    $data['Alternate_contact_no'] = $this->input->post('alternet_contact');
		    $data['gst_no'] = $this->input->post('gst_no');
		    $data['address'] = $this->input->post('address');
		    $data['created_by'] = $this->session->userdata('userId');
		    $data['createdate'] = date('Y-m-d H:i:s');
		    $result = $this->Vendor_model->create($data);
		    if($result){
		        $this->session->set_flashdata('msg', 'Vendor created successfully.');
		        redirect('master/vendor');
		    } else {
		        $this->session->set_flashdata('msg', 'Vendor not created successfully.');
		        redirect('master/vendor');
		    }
		    
			
			
		}
	}

	function update($data){
        $result = $this->Vendor_model->update($data);
        $this->session->set_flashdata('msg', 'Vendor updated successfully.');
        redirect('master/vendor');
	}

	function delete(){
        $verndorId = $this->input->post('vendorId');
        $result = $this->Vendor_model->delete($verndorId);
        if($result){
            echo json_encode(array('msg'=>'vendor deleted successfully.','status'=>200));
        } else {
            echo json_encode(array('msg'=>'something wend wrong.','status'=>500));
        }
	}
	
	function getdetail(){
	   $vendor_id = $this->input->post('vendorId'); 
	   $result = $this->Vendor_model->getdetail($vendor_id);
	   if(count($result)>0){
	       echo json_encode(array('data'=>$result,'msg'=>'vendor detail','status'=>200));
	   } else {
	       echo json_encode(array('msg'=>'no record found.','status'=>500));
	   }
	}

}
