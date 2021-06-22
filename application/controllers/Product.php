<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model(array('Auth_model','Product_model','Unit_model'));
		$this->load->library(array('session','form_validation'));
    }

	function index(){
		if($this->session->userdata('userId') == null){
			redirect('Auth','refresh');
		} 
		$data['unit_list'] = $this->Unit_model->list();
		$data['product_list'] = $this->Product_model->list();
		$data['header'] = $this->load->view('common/header','',true);
		$data['navbar'] = $this->load->view('common/navbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['topbar'] = $this->load->view('common/topbar','',true);
		$data['copyright'] = $this->load->view('common/copyright','',true);
		$data['body'] = $this->load->view('pages/product',$data,true);
		$this->load->view('layout',$data);
	}

	function create(){
	    
	    if($this->input->post('productid')){
	        $this->update($this->input->post());
	        die;
	    }
		$this->form_validation->set_rules('name', 'Product Name', 'required|trim');
		$this->form_validation->set_rules('code', 'Product code', 'required|trim');
		$this->form_validation->set_rules('unit', 'Product unit', 'required|trim');
		$this->form_validation->set_rules('ppu', 'price per unit', 'required|trim');
		$this->form_validation->set_error_delimiters('<span class="custom_error text-danger text-center">', '</span>');
		if ($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('msg', 'Something wrong.');
		    $this->index();
		}
		else {
		    $data['name'] = $this->input->post('name');
		    $data['code'] = $this->input->post('code');
		    $data['unit_id'] = $this->input->post('unit');
		    $data['ppu'] = $this->input->post('ppu');
		    $data['created_by'] = $this->session->userdata('userId');
		    $data['created_at'] = date('Y-m-d H:i:s');
		    $result = $this->Product_model->create($data);
		    if($result){
		        $this->session->set_flashdata('msg', 'Product created successfully.');
		        redirect('master/product');
		    } else {
		        $this->session->set_flashdata('msg', 'Product not created successfully.');
		        redirect('master/product');
		    }
		    
			
			
		}
	}

	function update($data){
        $result = $this->Product_model->update($data);
        $this->session->set_flashdata('msg', 'Product updated successfully.');
        redirect('master/product');
	}

	function delete(){
        $productId = $this->input->post('productId');
        $result = $this->Product_model->delete($productId);
        if($result){
            echo json_encode(array('msg'=>'Product deleted successfully.','status'=>200));
        } else {
            echo json_encode(array('msg'=>'something wend wrong.','status'=>500));
        }
	}
	
	function getdetail(){
	   $product_id = $this->input->post('productId'); 
	   $result = $this->Product_model->getdetail($product_id);
	   if(count($result)>0){
	       echo json_encode(array('data'=>$result,'msg'=>'product detail','status'=>200));
	   } else {
	       echo json_encode(array('msg'=>'no record found.','status'=>500));
	   }
	}

}
