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
    
    function getdetail($productId,$unitCode){
        
        if(!is_null($unitCode)){
            $this->db->select('*');
            $result = $this->db->get_where('products',array('product_id'=>$productId,'status'=>1))->result_array();
            
            $this->db->select('*');
            $this->db->where('unit_id',$unitCode);
            return $result = $this->db->get_where('products',array('status'=>1,'code'=>$result[0]['code']))->result_array();
        } else {
            $this->db->select('*');
            return $result = $this->db->get_where('products',array('status'=>1,'product_id'=>$productId))->result_array();
        }
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

    function getproductUnit($productId){
        $this->db->select('code');
        $result = $this->db->get_where('products',array('status'=>1,'product_id'=>$productId))->result_array();

        $result = $this->db->query("SELECT * FROM unit WHERE unit_id in (select unit_id from products where code = '". $result[0]['code'] ."')")->result_array();
        return $result;
    }
}