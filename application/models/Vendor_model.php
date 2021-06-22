<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor_model extends CI_Model{

    
    function create($data){
        $this->db->insert('vendor_master',$data);
        return true;
    }
    
    function list(){
        $this->db->select('*');
        $result = $this->db->get_where('vendor_master',array('status'=>1))->result_array();
        return $result;
    }
    
    function getdetail($vendorId){
        $this->db->select('*');
        return $result = $this->db->get_where('vendor_master',array('status'=>1,'vendor_id'=>$vendorId))->result_array();
    }
    
    function update($data){
        $this->db->where('vendor_id',$data['vendorid']);
        $this->db->update('vendor_master',array(
            'vendor_name' => $data['name'], 
            'contact_no' => $data['contact'],
            'Alternate_contact_no' => $data['alternet_contact'],
            'gst_no' => $data['gst_no'],
            'address' => $data['address']
        ));
        
        return true;
    }
    
    function delete($vendorId){
        $this->db->where('vendor_id',$vendorId);
        $this->db->update('vendor_master',array('status'=>0));
        return true;
    }
}