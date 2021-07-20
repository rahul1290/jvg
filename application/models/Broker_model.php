<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Broker_model extends CI_Model{

    
    function create($data){
        $this->db->insert('broker',$data);
        return true;
    }
    
    function list(){
        $this->db->select('*');
        $result = $this->db->get_where('broker',array('status'=>1))->result_array();
        return $result;
    }
    
    function user_type_list(){
        $this->db->select('*');
        return $this->db->get_where('user_type',array('status'=>1,'user_type_id<>'=>'1'))->result_array();
    }
    
    function getdetail($brokerId){
        $this->db->select('*');
        return $result = $this->db->get_where('broker',array('status'=>1,'id'=>$brokerId))->result_array();
    }
    
    function update($data){
        $this->db->where('id',$data['brokerid']);
        $this->db->update('broker',array(
            'broker_name' => $data['name'],
            'contact_no' => $data['contact_no'],
            'alternet_no' => $data['alternet_no'],
            'email' => $data['email']
        ));
        
        return true;
    }
    
    function delete($brokerId){
        $this->db->where('id',$brokerId);
        $this->db->update('broker',array('status'=>0));
        return true;
    }
    
    function report(){
        
        $purchaseDetail = $this->db->query("SELECT v.vendor_id,v.vendor_name,p.purchase_id,pi.product_id,pro.name as product_name,u.name as unit_name,sum(pi.qty) as total_pur FROM vendor_master v
            JOIN purchase p on p.vendor_id = v.vendor_id AND p.status = 1
            JOIN purchase_item pi on pi.purchase_id = p.purchase_id AND pi.status = 1
            JOIN products pro on pro.product_id = pi.product_id AND pro.status = 1
            JOIN unit u on u.unit_id = pi.unit_id AND u.status = 1
            WHERE v.status = 1
            GROUP BY v.vendor_id,pi.product_id")->result_array();
    }
}