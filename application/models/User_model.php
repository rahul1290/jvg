<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{

    
    function create($data){
        $this->db->insert('user',$data);
        return true;
    }
    
    function list(){
        $this->db->select('u.*,ut.type');
        $this->db->join('user_type ut','ut.user_type_id = u.user_type_id AND ut.user_type_id <> 1');
        $result = $this->db->get_where('user u',array('u.status'=>1))->result_array();
        return $result;
    }
    
    function user_type_list(){
        $this->db->select('*');
        return $this->db->get_where('user_type',array('status'=>1,'user_type_id<>'=>'1'))->result_array();
    }
    
    function getdetail($userId){
        $this->db->select('*');
        return $result = $this->db->get_where('user',array('status'=>1,'user_id'=>$userId))->result_array();
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
    
    function delete($userId){
        $this->db->where('user_id',$userId);
        $this->db->update('user',array('status'=>0));
        return true;
    }
}