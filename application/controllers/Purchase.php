<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model(array('Auth_model','Vendor_model','Product_model','Unit_model','Purchase_model','Stock_model','Broker_model'));
		$this->load->library(array('session','form_validation','pdf'));
    }

	function index(){
		if($this->session->userdata('userId') == null){
			redirect('Auth','refresh');
		} 
		$data['vendor_list'] = $this->Vendor_model->list();
		$data['broker_list'] = $this->Broker_model->list();
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
	    $seller_id = $this->input->post('seller_id');
	    
	    if($this->input->post('seller_id') == 'oth'){
	        $data['vendor_name'] = $this->input->post('other_vendor');
	        $data['contact_no'] = $this->input->post('contact_no');
	        $data['Alternate_contact_no'] = $this->input->post('alternet_contact');
	        $data['gst_no'] = $this->input->post('gst_no');
	        $data['address'] = $this->input->post('address');
	        $data['created_by'] = $this->session->userdata('userId');
	        $data['createdate'] = date('Y-m-d H:i:s');
	        if($this->Vendor_model->create($data)){
	            $seller_id = $this->db->insert_id();
	        }
	    }
	    
	    $items = $this->input->post('items');
	    $product_total_amount = 0;
	    $itemTableData = array();
	    
	    foreach($items as $item){
	        $product_total_amount += ($item['total']);
	    }
	    
	    $cgst_amount = 0;
	    $sgst_amount = 0;
	    $igst_amount = 0;
	    if($this->input->post('cgst_amount') == ''){
	        $cgst_amount = 0;
	    } else {
	        $cgst_amount = $this->input->post('cgst_amount');
	    }
	    
	    if($this->input->post('sgst_amount') == ''){
	        $sgst_amount = 0;
	    } else {
	        $sgst_amount = $this->input->post('sgst_amount');
	    }
	    
	    if($this->input->post('igst_amount') == ''){
	        $igst_amount = 0;
	    } else {
	        $igst_amount = $this->input->post('igst_amount');
	    }
	    
	    $purchaseData['bill_date'] = date("Y-m-d", strtotime($this->input->post('billdate')));
	    $purchaseData['vendor_id'] = $seller_id;
	    $purchaseData['broker_id'] = $this->input->post('broker_id');
	    $purchaseData['product_total_amount'] = $product_total_amount;
	    $purchaseData['purchase_date'] = date("Y-m-d", strtotime($this->input->post('billdate')));
	    $purchaseData['discount'] = 0;
	    $purchaseData['cgst_amount'] = ($product_total_amount * $cgst_amount)/100;
	    $purchaseData['sgst_amount'] = ($product_total_amount * $sgst_amount)/100;
	    $purchaseData['igst_amount'] = ($product_total_amount * $igst_amount)/100;
	    $purchaseData['grandtotal_amount'] = ($product_total_amount + $purchaseData['cgst_amount'] + $purchaseData['sgst_amount'] + $purchaseData['igst_amount']);
	    $purchaseData['created_at'] = date('Y-m-d H:i:s');
	    $purchaseData['created_by'] = $this->session->userdata('userId');
	    
	    $this->db->trans_begin();
	    
    	    $result = $this->Purchase_model->create($purchaseData);
    	    
    	    foreach($items as $item){
    	        $temp = array();
    	        $temp['purchase_id'] = $result;
    	        $temp['product_id'] = $item['item'];
    	        $temp['unit_id'] = $item['unit'];
    	        $temp['perunit_price'] = $item['ppu'];
    	        $temp['qty'] = $item['qty'];
    	        $temp['product_total_amount'] = $item['total'];
    	        $itemTableData[] = $temp; 
    	        
    	        $this->Stock_model->stock_entry($item);
    	    }
    	    $this->Purchase_model->itemCreate($itemTableData);
	    
	    if ($this->db->trans_status() === FALSE){
	        $this->db->trans_rollback();
	        echo json_encode(array('msg'=>'something went wrong','status'=>500));
	    }
	    else{
	        $this->db->trans_commit();
	        echo json_encode(array('msg'=>'purchase successfully.','status'=>200));
	    }
	}
	
	
	function bill_entry_update($bill_no){
	    $data['billno'] = $bill_no;
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
	    $data['bill_detail'] = $this->Purchase_model->purchase_bill_detail($data);
	    $data['vendor_detail'] = $this->Vendor_model->getdetail($data['bill_detail'][0]['vendor_id']);
	    $data['bill_items'] = $this->Purchase_model->purchase_billitem_detail($data['bill_detail'][0]['purchase_id']);
	    $data['broker_list'] = $this->Broker_model->list();
	    
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['navbar'] = $this->load->view('common/navbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['topbar'] = $this->load->view('common/topbar','',true);
	    $data['copyright'] = $this->load->view('common/copyright','',true);
	    $data['body'] = $this->load->view('pages/purchase_update',$data,true);
	    $this->load->view('layout',$data);
	}
	
	
	function bill_update(){
	    $seller_id = $this->input->post('seller_id');
	    $bill_id = $this->input->post('bill_id');
	    
	    if($this->input->post('seller_id') == 'oth'){
	        $data['vendor_name'] = $this->input->post('other_vendor');
	        $data['contact_no'] = $this->input->post('contact_no');
	        $data['Alternate_contact_no'] = $this->input->post('alternet_contact');
	        $data['gst_no'] = $this->input->post('gst_no');
	        $data['address'] = $this->input->post('address');
	        $data['created_by'] = $this->session->userdata('userId');
	        $data['createdate'] = date('Y-m-d H:i:s');
	        if($this->Vendor_model->create($data)){
	            $seller_id = $this->db->insert_id();
	        }
	    }
	    
	    $items = $this->input->post('items');
	    $product_total_amount = 0;
	    $itemTableData = array();
	    
	    foreach($items as $item){
	        $product_total_amount += $item['total'];
	    }
	    $purchaseData['broker_id'] = $this->input->post('broker_id');
	    $purchaseData['bill_id'] = $bill_id;
	    $purchaseData['bill_date'] = date("Y-m-d", strtotime($this->input->post('billdate')));
	    $purchaseData['vendor_id'] = $seller_id;
	    $purchaseData['product_total_amount'] = $product_total_amount;
	    $purchaseData['purchase_date'] = date("Y-m-d", strtotime($this->input->post('billdate')));
	    $purchaseData['discount'] = ($product_total_amount * $this->input->post('discount_per'))/100;
	    $purchaseData['gst_amount'] = $this->input->post('get_amount');
	    $purchaseData['grandtotal_amount'] = (($product_total_amount + $purchaseData['gst_amount']) - $purchaseData['discount']);
	    $purchaseData['created_at'] = date('Y-m-d H:i:s');
	    $purchaseData['created_by'] = $this->session->userdata('userId');
	    
	    $this->db->trans_begin();
	    
	    $result = $this->Purchase_model->update($purchaseData);
	    
	    foreach($items as $item){
	        $temp = array();
	        $temp['purchase_id'] = $result;
	        $temp['product_id'] = $item['item'];
	        $temp['unit_id'] = $item['unit'];
	        $temp['qty'] = $item['qty'];
	        $temp['product_total_amount'] = $item['total'];
	        $itemTableData[] = $temp;
	        
	        $this->Stock_model->stock_entry($item);
	    }
	    $this->Purchase_model->itemUpdate($itemTableData);
	    
	    if ($this->db->trans_status() === FALSE){
	        $this->db->trans_rollback();
	        echo json_encode(array('msg'=>'something went wrong','status'=>500));
	    }
	    else{
	        $this->db->trans_commit();
	        echo json_encode(array('msg'=>'purchase successfully updated.','status'=>200));
	    }
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	
	function purchase_list(){
	    if($this->session->userdata('userId') == null){
	        redirect('Auth','refresh');
	    }
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['navbar'] = $this->load->view('common/navbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['topbar'] = $this->load->view('common/topbar','',true);
	    $data['copyright'] = $this->load->view('common/copyright','',true);
	    $data['body'] = $this->load->view('pages/purchaseList',$data,true);
	    $this->load->view('layout',$data);
	}
	
	function purchase_list_ajax(){
	    if($this->input->post('from_date') == ''){
	        $data['from_date'] = date('Y-m-01');
	    } else {
	        $data['from_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('from_date'))));
	    }
	    
	    if($this->input->post('to_date') == ''){
	        $data['to_date'] = date('Y-m-t');
	    } else {
	        $data['to_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('to_date'))));
	    }
	    
	    $data['broker_id'] = $this->input->post('broker');
	    
	    $purchase_list = $this->Purchase_model->purchase_list($data);
	    
	    if(count($purchase_list)>0){
	       echo json_encode(array('data'=>$purchase_list,'status'=>200));
	    } else {
	       echo json_encode(array('status'=>500));
	    }
	}
	
	function purchase_bill_detail_ajax(){
	    $data['billno'] = $this->input->post('bill_no');
	    
	    $data['billdetail'] = $this->Purchase_model->purchase_bill_detail($data);
	    $data['items'] = $this->Purchase_model->purchase_billitem_detail($data['billdetail'][0]['purchase_id']);
	    //print_r($data); die;
	    echo json_encode(array('data'=>$data,'status'=>200));
	}
	
	function purchase_pdf($bill_no){
	    if($this->session->userdata('userId') == null){
	        redirect('Auth','refresh');
	    }
	    $data['billno'] = $bill_no;
	    $this->db->select('*');
	    $data['company_info'] = $this->db->get('company_info')->result_array();
	    $data['purchase_data'] = $this->Purchase_model->purchase_bill_detail($data);
	    $data['bill_detail'] = $this->Purchase_model->purchase_billitem_detail($data['purchase_data'][0]['purchase_id']);
	    
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $htmlcontant = $this->load->view('pages/generate_purchase_bill_pdf',$data,true);
	    
	    
	    $this->pdf->loadHtml($htmlcontant);
	    $this->pdf->render();
	    $this->pdf->stream("$bill_no.pdf",array('Attachment'=>0));
	}
	
	
	function purchase_order_report(){
	    if($this->session->userdata('userId') == null){
	        redirect('Auth','refresh');
	    }
	    $this->db->select('*');
	    $data['brokers'] = $this->db->get_where('broker',array('status'=>1))->result_array();
	    
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['navbar'] = $this->load->view('common/navbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['topbar'] = $this->load->view('common/topbar','',true);
	    $data['copyright'] = $this->load->view('common/copyright','',true);
	    $data['body'] = $this->load->view('report/purchase_order',$data,true);
	    $this->load->view('layout',$data);
	}
}
