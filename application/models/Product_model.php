<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{

    
    function create($data){
        $this->db->insert('products',$data);
        return true;
    }
    
    function list(){
        $this->db->select('*');
        $result = $this->db->get_where('products',array('status'=>1))->result_array();
        return $result;
    }
    
    function getdetail($productId){
        $this->db->select('*');
        return $result = $this->db->get_where('products',array('status'=>1,'product_id'=>$productId))->result_array();
    }
    
    function update($data){
        $this->db->where('product_id',$data['productid']);
        $this->db->update('products',array(
            'name' => $data['name'], 
            'code' => $data['code'],
            'unit_id' => $data['unit'],
            'ppu' => $data['ppu']
        ));
        
        return true;
    }
    
    function delete($productId){
        $this->db->where('product_id',$productId);
        $this->db->update('products',array('status'=>0));
        return true;
    }
}