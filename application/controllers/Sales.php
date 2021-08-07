<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model(array('Auth_model','Vendor_model','Product_model','Unit_model','Stock_model','Customer_model','State_model','Sales_model','Broker_model'));
		$this->load->library(array('session','form_validation','pdf','mylibrary'));
    }
    
    function sale_order(){
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
        $data['body'] = $this->load->view('pages/sales_order',$data,true);
        $this->load->view('layout',$data);
    }
    
    function sale_order_update($s_orderId){
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
        $data['orderDetail'] = $this->Sales_model->sales_order_detail($s_orderId);
        $data['orderItems'] = $this->Sales_model->sales_order_billitem_detail($s_orderId);
        
        $data['units'] = $this->Unit_model->list();
        $data['header'] = $this->load->view('common/header','',true);
        $data['navbar'] = $this->load->view('common/navbar','',true);
        $data['footer'] = $this->load->view('common/footer','',true);
        $data['topbar'] = $this->load->view('common/topbar','',true);
        $data['copyright'] = $this->load->view('common/copyright','',true);
        $data['body'] = $this->load->view('pages/sales_order_update',$data,true);
        $this->load->view('layout',$data);
    }

	function index(){
	    $data['billno'] = 'jvg-'.rand(1,99).'-'.date('U');
		if($this->session->userdata('userId') == null){
			redirect('Auth','refresh');
		} 
		$data['vendor_list'] = $this->Vendor_model->list();
		$data['broker_list'] = $this->Broker_model->list();
		$data['states'] = $this->State_model->list();
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
		$data['body'] = $this->load->view('pages/sales',$data,true);
		$this->load->view('layout',$data);
	}
	
	function bill_entry(){
	    $vendor_id = $this->input->post('vendor_id');
	    $broker_id = $this->input->post('broker_id');
	    
	    if($this->input->post('vendor_id') == 'oth'){
	        $data['vendor_name'] = $this->input->post('other_vendor');
	        $data['contact_no'] = $this->input->post('contact_no');
	        $data['Alternate_contact_no'] = $this->input->post('alternet_contact');
	        $data['gst_no'] = $this->input->post('gst_no');
	        $data['address'] = $this->input->post('address');  
	        $data['created_by'] = $this->session->userdata('userId');
	        $data['createdate'] = date('Y-m-d H:i:s');
	        if($this->Vendor_model->create($data)){
	            $vendor_id = $this->db->insert_id();
	        }
	    }
	    
	    $items = $this->input->post('items');
	    $product_total_amount = 0;
	    $itemTableData = array();
	    
	    foreach($items as $item){
	        $product_total_amount += ($item['ppu'] * $item['qty']);
	    }
	    
	    $saleData['invoice_no'] = $this->input->post('bill_no');
	    $saleData['invoice_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('billdate')))).' '.date('H:i:s');
	    $saleData['GR/RRNo'] = $this->input->post('grrr_no');
	    $saleData['vendor_id'] = $vendor_id;
	    $saleData['broker_id'] = $broker_id;
	    $saleData['trasport'] = $this->input->post('transname');
	    $saleData['vehicle_no'] = $this->input->post('vechileno');
	    $saleData['eway_no'] = $this->input->post('ewaybillno');
	    $saleData['destination'] = $this->input->post('shipping_destination');
	    $saleData['bill_address'] = $this->input->post('address');
	    $saleData['shipping_address'] = $this->input->post('shipping_address');
	    $saleData['state_of_supply'] = $this->input->post('shipping_state');
	    $saleData['insurance'] = $this->input->post('insurance');
	    $saleData['cgst_amount'] = (($saleData['insurance'] + $product_total_amount) * $this->input->post('cgst'))/100;
	    $saleData['sgst_amount'] = (($saleData['insurance'] + $product_total_amount) * $this->input->post('sgst'))/100;
	    $saleData['igst_amount'] = (($saleData['insurance'] + $product_total_amount) * $this->input->post('igst'))/100;
	    $saleData['total_tax_amount'] = $saleData['cgst_amount'] + $saleData['sgst_amount'] + $saleData['igst_amount'];
	    $saleData['grand_total'] = $product_total_amount;
	    $saleData['frieght'] = $this->input->post('frieght');
	    $saleData['created_at'] = date('Y-m-d H:i:s');
	    $saleData['created_by'] = $this->session->userdata('userId');
	    
	    $this->db->trans_begin();
    	    $result = $this->Sales_model->create($saleData);
    	    foreach($items as $item){
    	        $temp = array();
    	        $temp['sale_id'] = $result;
    	        $temp['product_id'] = $item['item'];
    	        $temp['unit_id'] = 3;
    	        $temp['qty'] = $item['qty'];
    	        $temp['sales_per_unit'] = $item['ppu'];
    	        $temp['sales_product_amount'] = $item['ppu'] * $item['qty'];
    	        $temp['vendor_id'] = $item['vendor_id'];
    	        $itemTableData[] = $temp; 
    	        
    	        $this->Stock_model->stock_sale($item);
    	    }
    	    
    	    $this->Sales_model->itemCreate($itemTableData);
    	    
    	    $dataPaymentDetail['sales_id'] = $result;
    	    
    	    //$this->Sales_model->payment_detail($dataPaymentDetail);
	    
	    if ($this->db->trans_status() === FALSE){
	        $this->db->trans_rollback();
	        echo json_encode(array('msg'=>'something went wrong','status'=>500));
	    }
	    else{
	        $this->db->trans_commit();
	        echo json_encode(array('msg'=>'Billing successfully.','status'=>200));
	    }
	}
	
	/////////////////////////////////////////////////////////////////////////////////////
	
	function generate_bill($bill_id){
	    if($this->session->userdata('userId') == null){
	        redirect('Auth','refresh');
	    }
	    
	    $this->db->select('*');
	    $data['company_info'] = $this->db->get('company_info')->result_array();
	    $data['sales_data'] = $this->Sales_model->sales_detail($bill_id);
	    $data['bill_detail'] = $this->Sales_model->sales_billitem_detail($bill_id);
	    
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    //$data['copyright'] = $this->load->view('common/copyright','',true);
	    $htmlcontant = $this->load->view('pages/generate_bill',$data,true);
	    //$this->load->view('layout',$data);
// 	    $htmlcontant = $this->load->view('layout',$data,true);
	    
	    $this->pdf->loadHtml($htmlcontant);
	    $this->pdf->render();
	    $this->pdf->stream($data['sales_data'][0]['invoice_no'].".pdf",array('Attachment'=>0));
	}
	
	//////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	
	function sales_list(){
	    if($this->session->userdata('userId') == null){
	        redirect('Auth','refresh');
	    }
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['navbar'] = $this->load->view('common/navbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['topbar'] = $this->load->view('common/topbar','',true);
	    $data['copyright'] = $this->load->view('common/copyright','',true);
	    $data['body'] = $this->load->view('pages/salesList',$data,true);
	    $this->load->view('layout',$data);
	}
	
	function bill_list(){
	    if($this->session->userdata('userId') == null){
	        redirect('Auth','refresh');
	    }
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['navbar'] = $this->load->view('common/navbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['topbar'] = $this->load->view('common/topbar','',true);
	    $data['copyright'] = $this->load->view('common/copyright','',true);
	    $data['body'] = $this->load->view('pages/billList',$data,true);
	    $this->load->view('layout',$data);
	}
	
	function sale_list_ajax(){
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
	    
	    //$sales_list = $this->Sales_model->sales_list($data);
	    $sales_list = $this->Sales_model->sales_order_list($data);
	    
	    if(count($sales_list)>0){
	       echo json_encode(array('data'=>$sales_list,'status'=>200));
	    } else {
	       echo json_encode(array('status'=>500));
	    }
	}
	
	
	function bill_list_ajax(){
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
	    
	    $sales_list = $this->Sales_model->bill_list($data);
	    
	    if(count($sales_list)>0){
	        echo json_encode(array('data'=>$sales_list,'status'=>200));
	    } else {
	        echo json_encode(array('status'=>500));
	    }
	}
	
	function sales_billdetail_ajax(){
	    $sale_order_id = $this->input->post('bill_no');
	    
	    $data['company_info'] = $this->db->get('company_info')->result_array();
	    $data['sale_detail'] = $this->Sales_model->sales_detail($sale_order_id);
	    $data['sale_detail'][0]['rrno'] = $data['sale_detail'][0]['GR/RRNo'];
	    $data['sale_detail'][0]['total_in_words'] = $this->mylibrary->get_words_r($data['sale_detail'][0]['grand_total']);
	    
	    $data['bill_detail'] = $this->Sales_model->sales_billitem_detail($sale_order_id);
	    echo json_encode(array('data'=>$data,'status'=>200));
	}
	
	function sales_bill_detail_ajax(){
	    $sale_order_id = $this->input->post('bill_no');
	    
	    
	    //$data['company_info'] = $this->db->get('company_info')->result_array();
	    $data['sale_detail'] = $this->Sales_model->sales_order_detail($sale_order_id);
	    //$data['sale_detail'][0]['rrno'] = $data['sale_detail'][0]['GR/RRNo'];
	    
	    $data['sale_detail'][0]['total_in_words'] = $this->mylibrary->get_words_r($data['sale_detail'][0]['grandtotal_amount']);
	    $data['bill_detail'] = $this->Sales_model->sales_order_billitem_detail($sale_order_id);
	    echo json_encode(array('data'=>$data,'status'=>200));
	}
	
	
	function sales_order_entry(){
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
	    $salesorder['bill_date'] = date("Y-m-d", strtotime($this->input->post('billdate'))).' '.date('H:i:s');
	    $salesorder['vendor_id'] = $seller_id;
	    $salesorder['broker_id'] = $this->input->post('broker_id');
	    $salesorder['product_total_amount'] = $product_total_amount;
	    $salesorder['purchase_date'] = date("Y-m-d", strtotime($this->input->post('billdate')));
	    $salesorder['grandtotal_amount'] = (
	        ($product_total_amount + 
	            (($product_total_amount * $this->input->post('cgst') ?? 0)/100) + 
	            (($product_total_amount * $this->input->post('sgst')?? 0 )/100) + 
	            (($product_total_amount * $this->input->post('igst')?? 0)/100) )
	        );
	    $salesorder['cgst'] = ($product_total_amount * $this->input->post('cgst')?? 0)/100;
	    $salesorder['sgst'] = ($product_total_amount * $this->input->post('sgst')?? 0)/100;
	    $salesorder['igst'] = ($product_total_amount * $this->input->post('igst')?? 0)/100;
	    $salesorder['created_at'] = date('Y-m-d H:i:s');
	    $salesorder['created_by'] = $this->session->userdata('userId');
	    
	    
	    
	    $this->db->trans_begin();
	    
	    $result = $this->Sales_model->sales_order_create($salesorder);
	    foreach($items as $item){
	        $temp = array();
	        $temp['sales_order_id'] = $result;
	        $temp['product_id'] = $item['item'];
	        $temp['unit_id'] = $item['unit'];
	        $temp['qty'] = $item['qty'];
	        $temp['perunit_price'] = $item['ppu'];
	        $temp['product_total_amount'] = $item['total'];
	        $itemTableData[] = $temp;
	        
	        //$this->Stock_model->stock_entry($item);
	    }
	    $this->Sales_model->sales_order_itemCreate($itemTableData);
	    
	    if ($this->db->trans_status() === FALSE){
	        $this->db->trans_rollback();
	        echo json_encode(array('msg'=>'something went wrong','status'=>500));
	    }
	    else{
	        $this->db->trans_commit();
	        echo json_encode(array('msg'=>'sales order successfully.','status'=>200));
	    }
	}
	
	
	function sales_order_entry_update(){
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
	    $bill_no = $this->input->post('bill_no');
	    $salesorder['bill_date'] = date("Y-m-d", strtotime($this->input->post('billdate'))).' '.date('H:i:s');
	    $salesorder['vendor_id'] = $seller_id;
	    $salesorder['broker_id'] = $this->input->post('broker_id');
	    $salesorder['product_total_amount'] = $product_total_amount;
	    $salesorder['purchase_date'] = date("Y-m-d", strtotime($this->input->post('billdate')));
	    $salesorder['discount'] = 0;
	    $salesorder['grandtotal_amount'] = (
	        ($product_total_amount +
	            (($product_total_amount * $this->input->post('cgst') ?? 0)/100) +
	            (($product_total_amount * $this->input->post('sgst')?? 0 )/100) +
	            (($product_total_amount * $this->input->post('igst')?? 0)/100) )
	        );
	    $salesorder['cgst'] = ($product_total_amount * $this->input->post('cgst')?? 0)/100;
	    $salesorder['sgst'] = ($product_total_amount * $this->input->post('sgst')?? 0)/100;
	    $salesorder['igst'] = ($product_total_amount * $this->input->post('igst')?? 0)/100;
	    $salesorder['created_at'] = date('Y-m-d H:i:s');
	    $salesorder['created_by'] = $this->session->userdata('userId');
	   
	    $this->db->trans_begin();
	    
	    $result = $this->Sales_model->sales_order_update($salesorder,$bill_no);
	    foreach($items as $item){
	        $temp = array();
	        $temp['sales_order_id'] = $result;
	        $temp['product_id'] = $item['item'];
	        $temp['unit_id'] = $item['unit'];
	        $temp['qty'] = $item['qty'];
	        $temp['perunit_price'] = $item['ppu'];
	        $temp['product_total_amount'] = $item['total'];
	        $itemTableData[] = $temp;
	        //$this->Stock_model->stock_entry($item);
	    }
	    $this->db->where('sales_order_id',$bill_no);
	    $this->db->delete('sales_order_item');
	    
	    $this->Sales_model->sales_order_itemCreate($itemTableData);
	    
	    if ($this->db->trans_status() === FALSE){
	        $this->db->trans_rollback();
	        echo json_encode(array('msg'=>'something went wrong','status'=>500));
	    }
	    else{
	        $this->db->trans_commit();
	        echo json_encode(array('msg'=>'sales order updated successfully.','status'=>200));
	    }
	}
	
	
	function delete(){
	    $billno = $this->input->post('bill_no');
	    $this->db->where('sales_order_id',$billno);
	    $this->db->update('sales_order',array('status'=>0));
	    
	    echo json_encode(array('msg'=>'Record deleted successfully.','status'=>200));
	}
}
