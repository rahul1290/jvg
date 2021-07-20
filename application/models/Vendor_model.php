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
    
    function report(){
        $purchaseDetail = $this->db->query("SELECT v.vendor_id,v.vendor_name,p.purchase_id,pi.product_id,pro.name as product_name,u.name as unit_name,sum(pi.qty) as total_pur FROM vendor_master v
            JOIN purchase p on p.vendor_id = v.vendor_id AND p.status = 1
            JOIN purchase_item pi on pi.purchase_id = p.purchase_id AND pi.status = 1
            JOIN products pro on pro.product_id = pi.product_id AND pro.status = 1
            JOIN unit u on u.unit_id = pi.unit_id AND u.status = 1
            WHERE v.status = 1
            GROUP BY v.vendor_id,pi.product_id")->result_array();
       
        $saleDetail = $this->db->query("select v.vendor_id,v.vendor_name,s.invoice_no,si.product_id,pro.name as product_name,sum(si.qty) total_sale FROM vendor_master v
            JOIN sales_item si on si.vendor_id = v.vendor_id AND si.status = 1
            JOIN sales s on s.sales_id = si.sale_id AND s.status = 1
            JOIN products pro on pro.product_id = si.product_id AND pro.status = 1
            GROUP by v.vendor_id,si.product_id")->result_array();
        
        $final_array = array();
        
        foreach($purchaseDetail as $pd){
            $temp = array();
            $temp = $pd;
            $temp['available'] = $pd['total_pur'];
            foreach ($saleDetail as $sd){
                if($sd['vendor_id'] == $pd['vendor_id'] && $sd['product_id'] == $pd['product_id']){
                    $temp['total_sale'] = $sd['total_sale'];
                    $temp['available'] = $pd['total_pur'] - $sd['total_sale'];
                } else {
                    continue;
                }
                $final_array[] = $temp;
            }
        }
        
        return $final_array;
    }
}