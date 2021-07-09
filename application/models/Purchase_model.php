<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_model extends CI_Model{

    
    function create($data){
        $this->db->insert('purchase',$data);
        return $this->db->insert_id();
    }
    
    function update($data){
        $this->db->where('bill_no',$data['bill_no']);
        $this->db->update('purchase',array(
            'bill_date'=>$data['bill_date'],
            'vendor_id' => $data['vendor_id'],
            'product_total_amount' => $data['product_total_amount'],
            'purchase_date' => $data['purchase_date'],
            'discount' => $data['discount'],
            'gst_amount' => $data['gst_amount'],
            'grandtotal_amount' => $data['grandtotal_amount'],
            'created_at' => $data['created_at'],
            'created_by' => $data['created_by']
        ));
        
        $this->db->select('*');
        $result = $this->db->get_where('purchase',array('bill_no'=>$data['bill_no'],'status'=>1))->result_array();
        return $result[0]['purchase_id'];
    }
    
    function itemCreate($data){
        $this->db->insert_batch('purchase_item',$data);
        return true;
    }
    
    function itemUpdate($data){
        $this->db->where('purchase_id',$data[0]['purchase_id']);
        $this->db->delete('purchase_item');
        
        $this->db->insert_batch('purchase_item',$data);
        return true;
    }
    
    function purchase_list($data){
        $this->db->select('*,v.vendor_name,date_format(p.bill_date,"%d/%m/%Y") as bill_date');
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