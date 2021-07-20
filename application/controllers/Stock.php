<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model(array('Auth_model','Product_model','Unit_model','Stock_model'));
		$this->load->library(array('session','form_validation'));
    }

	function index(){
		if($this->session->userdata('userId') == null){
			redirect('Auth','refresh');
		} 
		$data['stocks'] = $this->Stock_model->list();
		$data['header'] = $this->load->view('common/header','',true);
		$data['navbar'] = $this->load->view('common/navbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['topbar'] = $this->load->view('common/topbar','',true);
		$data['copyright'] = $this->load->view('common/copyright','',true);
		$data['body'] = $this->load->view('pages/stock',$data,true);
		$this->load->view('layout',$data);
	}
	
	function stock_detail($product_id){
	    $result = $this->Stock_model->stock_detail($product_id);
	    if(count($result)>0){
	        echo json_encode(array('data'=>$result,'status'=>200));
	    } else{
	        echo json_encode(array('msg'=>'no record found','status'=>500));
	    }
	}
	
	function getvendorlist(){
	    $data['item_id'] = $this->input->post('item_id');
	    $data['quantity'] = $this->input->post('quantity');
	    
	    $totalPQty = $this->db->query("SELECT p.vendor_id,sum(pi.qty) as total_qty FROM purchase_item pi
                        JOIN purchase p ON p.purchase_id = pi.purchase_id AND pi.status = 1
                        WHERE 
                        p.status = 1 AND
                        pi.product_id = ". $data['item_id'] ."
                        GROUP by p.vendor_id")->result_array();
	    
	    $totalSQty = $this->db->query("SELECT si.vendor_id,sum(si.qty) as total_qty FROM sales_item si
                        JOIN sales s ON s.sales_id = si.sale_id AND si.status = 1
                        WHERE 
                        s.status = 1 AND
                        si.product_id = ". $data['item_id'] ."
                        GROUP by si.vendor_id")->result_array();
	    
	    
	    $final_array = array();
	    $vendors = array();
	    foreach($totalPQty as $pur){
	        $temp = array();
	        $temp = $pur;
	        $temp['available_qty'] = $pur['total_qty'];
	        foreach($totalSQty as $sale){
	            if($sale['vendor_id'] == $pur['vendor_id']){
	                $temp['available_qty'] = $pur['total_qty'] - $sale['total_qty'];
	            }
	        }
	        if($temp['available_qty'] >= $data['quantity']){
	           $final_array[] = $temp;
	           $vendors[] = $temp['vendor_id']; 
	        }
	    }
	    
	    if(count($vendors)>0){
    	    $vendors = implode(',',$vendors);
    	    $vendorList = $this->db->query("select * from vendor_master where vendor_id in (". $vendors .")")->result_array();
    	    
    	    if(count($vendorList)>0){
    	        echo json_encode(array('data'=>$vendorList,'status'=>200));
    	    } else {
    	        echo json_encode(array('status'=>500));
    	    }
	    } else {
	        echo json_encode(array('status'=>500));
	    }
	    
	}
}
