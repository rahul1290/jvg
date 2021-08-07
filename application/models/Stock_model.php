<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_model extends CI_Model{

    
    function stock_entry($item){
        $this->db->select('*');
        $result = $this->db->get_where('stock_master',array('product_id'=>$item['item']))->result_array();
        
        if(count($result)>0){
            $this->db->where('product_id',$item['item']);
            $this->db->update('stock_master',array(
                'qty'=> $result[0]['qty'] + $item['qty']
            ));
        } else {
            $this->db->insert('stock_master',array('product_id'=>$item['item'],'qty'=>$item['qty']));
        }  
        return true;
    }
    
    function stock_sale($item){
        $this->db->select('*');
        $result = $this->db->get_where('stock_master',array('product_id'=>$item['item']))->result_array();
        
        if(count($result)>0){
            $this->db->where('product_id',$item['item']);
            $this->db->update('stock_master',array(
                'qty'=> $result[0]['qty'] - $item['qty']
            ));
        }
        return true;
    }
    
    
    function stock_detail($product_id){
        $this->db->select('*');
        $result = $this->db->get_where('stock_master',array('product_id'=>$product_id,'status'=>1))->result_array();
        return $result; 
    }
}