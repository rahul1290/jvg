<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model{

    
    function create($data){
        $this->db->insert('customer',$data);
        return true;
    }
    
    function list(){
        $this->db->select('*');
        $result = $this->db->get_where('customer',array('status'=>1))->result_array();
        return $result;
    }
    
    function user_type_list(){
        $this->db->select('*');
        return $this->db->get_where('user_type',array('status'=>1,'user_type_id<>'=>'1'))->result_array();
    }
    
    function getdetail($customerId){
        $this->db->select('*');
        return $result = $this->db->get_where('customer',array('status'=>1,'id'=>$customerId))->result_array();
    }
    
    function update($data){
        $this->db->where('user_id',$data['userid']);
        $this->db->update('user',array(
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'uname' => $data['uname'],
            'user_type_id' => $data['user_type'],
            'contact_no' => $data['contact'],
            'password' => $data['password']
        ));
        
        return true;
    }
    
    function delete($customerId){
        $this->db->where('id',$customerId);
        $this->db->update('customer',array('status'=>0));
        return true;
    }
}