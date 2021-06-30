<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model(array('Auth_model','Vendor_model','Product_model','Unit_model','Purchase_model'));
		$this->load->library(array('session','form_validation'));
    }

	function index(){
		if($this->session->userdata('userId') == null){
			redirect('Auth','refresh');
		} 
		$data['vendor_list'] = $this->Vendor_model->list();
		$data['products'] = $this->Product_model->list();
	
		$filtredList = array();
		$search = array();
		foreach($data['products'] as $product){
			if(!in_array($product['code'],$search)){
				array_push($search,$product['code']);
				$filtredList[] = $product;
			}
		}
		$data['products'] = $filtredList;
		
		$data['units'] = $this->Unit_model->list();
		$data['header'] = $this->load->view('common/header','',true);
		$data['navbar'] = $this->load->view('common/navbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['topbar'] = $this->load->view('common/topbar','',true);
		$data['copyright'] = $this->load->view('common/copyright','',true);
		$data['body'] = $this->load->view('pages/purchase',$data,true);
		$this->load->view('layout',$data);
	}
	
	function bill_entry(){
	    if($this->input->post('seller_id') == 'oth'){
	        $data['vendor_name'] = $this->input->post('other_vendor');
	        $data['contact_no'] = $this->input->post('contact_no');
	        $data['Alternate_contact_no'] = $this->input->post('alternet_contact');
	        $data['gst_no'] = $this->input->post('gst_no');
	        $data['address'] = $this->input->post('address');
	        $data['created_by'] = $this->session->userdata('userId');
	        $data['createdate'] = date('Y-m-d H:i:s');
	        $this->Vendor_model->create($data);
	    }
	    
	    $items = $this->input->post('items');
	    $product_total_amount = 0;
	    $itemTableData = array();
	    
	    foreach($items as $item){
	        $product_total_amount += ($item['ppu'] * $item['qty']);
	    }
	    
	    $purchaseData['bill_no'] = $this->input->post('bill_no');
	    $purchaseData['vendor_id'] = 1;
	    $purchaseData['product_total_amount'] = $product_total_amount;
	    $purchaseData['purchase_date'] = date("Y-m-d", strtotime($this->input->post('billdate')));
	    $purchaseData['discount'] = '100';
	    $purchaseData['gst_amount'] = '200';
	    $purchaseData['grandtotal_amount'] = (int)$product_total_amount - 100;
	    $purchaseData['created_at'] = date('Y-m-d H:i:s');
	    $purchaseData['created_by'] = $this->session->userdata('userId');
	    
	    
	    
	    $this->db->trans_begin();
	    
    	    $result = $this->Purchase_model->create($purchaseData);
    	    
    	    foreach($items as $item){
    	        $temp = array();
    	        $temp['purchase_id'] = $result;
    	        $temp['product_id'] = $item['item'];
    	        $temp['unit_id'] = $item['unit'];
    	        $temp['qty'] = $item['qty'];
    	        $temp['perunit_price'] = $item['ppu'];
    	        $temp['product_total_amount'] = $item['ppu'] * $item['qty'];
    	        $itemTableData[] = $temp; 
    	    }
    	    $this->Purchase_model->itemCreate($itemTableData);
	    
	    if ($this->db->trans_status() === FALSE){
	        $this->db->trans_rollback();
	        echo json_encode(array('msg'=>'something went wrong','status'=>500));
	    }
	    else{
	        $this->db->trans_commit();
	        echo json_encode(array('msg'=>'purchse successfully.','status'=>200));
	    }
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	
	function purchase_list(){
	    
	}
}
