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
}
