<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model{

    function login($data){
        $this->db->select('u.user_id,u.uname,ut.type');
        $this->db->join('user_type ut','ut.user_type_id = u.user_type_id');
        $result = $this->db->get_where('user u',array(
            'u.uname' => $data['identity'],
            'u.password' => $data['password'],
            'u.active' => 1
        ))->result_array();

        return $result;
    }
}