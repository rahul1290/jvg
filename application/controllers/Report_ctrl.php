<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_ctrl extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model(array('Broker_model','Report_model'));
		$this->load->library(array('session','form_validation'));
    }

    function index(){
        if($this->session->userdata('userId') == null){
            redirect('Auth','refresh');
        }
        $data['stocks'] = $this->Report_model->product_stock();
        $data['header'] = $this->load->view('common/header','',true);
        $data['navbar'] = $this->load->view('common/navbar','',true);
        $data['footer'] = $this->load->view('common/footer','',true);
        $data['topbar'] = $this->load->view('common/topbar','',true);
        $data['copyright'] = $this->load->view('common/copyright','',true);
        $data['body'] = $this->load->view('pages/report/product_stock',$data,true);
        $this->load->view('layout',$data);
    }
    
    
    function purchase_sales($brokerId =null){
        if($this->session->userdata('userId') == null){
            redirect('Auth','refresh');
        }
        $data['brokerList'] = $this->Broker_model->list();
        $data['records'] = $this->Report_model->purchase_sales($brokerId);
        $data['header'] = $this->load->view('common/header','',true);
        $data['navbar'] = $this->load->view('common/navbar','',true);
        $data['footer'] = $this->load->view('common/footer','',true);
        $data['topbar'] = $this->load->view('common/topbar','',true);
        $data['copyright'] = $this->load->view('common/copyright','',true);
        $data['body'] = $this->load->view('pages/report/purchase_sales_report',$data,true);
        $this->load->view('layout',$data);
    }
    
    function vendor_report(){
        if($this->session->userdata('userId') == null){
            redirect('Auth','refresh');
        }
        $data['records'] = $this->Report_model->vendor_report();
        $data['header'] = $this->load->view('common/header','',true);
        $data['navbar'] = $this->load->view('common/navbar','',true);
        $data['footer'] = $this->load->view('common/footer','',true);
        $data['topbar'] = $this->load->view('common/topbar','',true);
        $data['copyright'] = $this->load->view('common/copyright','',true);
        $data['body'] = $this->load->view('pages/report/vendor_report',$data,true);
        $this->load->view('layout',$data);
    }
    
    function vendor_purchase_sales(){
        if($this->session->userdata('userId') == null){
            redirect('Auth','refresh');
        }
        $data['records'] = $this->Report_model->vendor_report();
        $data['header'] = $this->load->view('common/header','',true);
        $data['navbar'] = $this->load->view('common/navbar','',true);
        $data['footer'] = $this->load->view('common/footer','',true);
        $data['topbar'] = $this->load->view('common/topbar','',true);
        $data['copyright'] = $this->load->view('common/copyright','',true);
        $data['body'] = $this->load->view('pages/report/vendor_purchase_sales_report',$data,true);
        $this->load->view('layout',$data);
    }
}
