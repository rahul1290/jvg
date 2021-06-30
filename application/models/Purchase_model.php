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
}