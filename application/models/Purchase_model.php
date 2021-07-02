<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_model extends CI_Model{

    
    function create($data){
        $this->db->insert('purchase',$data);
        return $this->db->insert_id();
    }
    
    function itemCreate($data){
        $this->db->insert_batch('purchase_item',$data);
        return true;
    }
    
    function purchase_list($data){
        $this->db->select('*,v.vendor_name');
        $this->db->join('vendor_master v','v.vendor_id = p.vendor_id');
        $this->db->where('p.bill_date >=',$data['from_date']);
        $this->db->where('p.bill_date <=',$data['to_date']);
        $this->db->order_by('p.bill_date','desc');
        $result = $this->db->get_where('purchase p',array('p.status'=>1))->result_array();
        return $result;
    }
    
    
    function purchase_bill_detail($data){
        $this->db->select('p.*,vm.vendor_name');
        $this->db->join('vendor_master vm','vm.vendor_id = p.vendor_id');
        $result = $this->db->get_where('purchase p',array('p.bill_no'=>$data['billno'],'p.status'=>1))->result_array();
        return $result;
    }
    
    function purchase_billitem_detail($data){
        $this->db->select('pi.*,p.code as productcode,p.name as productname,u.name as unitname');
        $this->db->join('products p','p.product_id = pi.product_id');
        $this->db->join('unit u','u.unit_id = pi.unit_id');
        $result = $this->db->get_where('purchase_item pi',array('pi.purchase_id'=>$data))->result_array();
        return $result;
    }
}