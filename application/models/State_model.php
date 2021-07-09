<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class State_model extends CI_Model{

    
    function list(){
        $this->db->select('*');
        $result = $this->db->get_where('state',array('status'=>1))->result_array();
        return $result;
    }
}