<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_model extends CI_Model{

    
    function create($data){
        $this->db->insert('sales',$data);
        return $this->db->insert_id();
    }
    
    function itemCreate($data){
        $this->db->insert_batch('sales_item',$data);
        return true;
    }
    
    function bill_list($data){
        $this->db->select('s.*,b.broker_name,st.state_name,vm.vendor_name,DATE_FORMAT(s.invoice_date,"%d/%m/%Y") as invoice_date');
        $this->db->join('vendor_master vm','vm.vendor_id = s.vendor_id');
        $this->db->join('broker b','b.id = s.broker_id and b.status = 1');
        $this->db->join('state st','st.state_id = s.state_of_supply AND st.status = 1');
        $this->db->where('s.invoice_date >=',$data['from_date']);
        $this->db->where('s.invoice_date <=',$data['to_date']);
        $this->db->order_by('s.invoice_date','desc');
        $result = $this->db->get_where('sales s',array('s.status'=>1))->result_array();
        return $result;
    }
    
    function sales_list($data){
        $this->db->select('s.*,b.broker_name,st.state_name,c.customer_name,DATE_FORMAT(s.invoice_date,"%d/%m/%Y") as invoice_date');
        $this->db->join('customer c','c.id = s.customer_id');
        $this->db->join('broker b','b.id = s.broker_id and b.status = 1');
        $this->db->join('state st','st.state_id = s.state_of_supply AND st.status = 1');
        $this->db->where('s.invoice_date >=',$data['from_date']);
        $this->db->where('s.invoice_date <=',$data['to_date']);
        $this->db->order_by('s.invoice_date','desc');
        $result = $this->db->get_where('sales s',array('s.status'=>1))->result_array();
        return $result;
    }
    
    function sales_order_list(){
        $this->db->select('so.*,vm.vendor_name,b.broker_name,so.product_total_amount,DATE_FORMAT(so.bill_date,"%d/%m/%Y") as bill_date');
        $this->db->join('vendor_master vm','vm.vendor_id = so.vendor_id AND vm.status = 1');
        $this->db->join('broker b','b.id = so.broker_id AND so.status = 1');
        $result = $this->db->get_where('sales_order so',array('so.status'=>1))->result_array();
        return $result;
    }
    
    function sales_order_detail($sale_order_id){
        $this->db->select('so.*,vm.vendor_name,b.broker_name,DATE_FORMAT(so.bill_date,"%d/%m/%Y") as bill_date');
        $this->db->join('vendor_master vm','vm.vendor_id = so.vendor_id AND vm.status = 1');
        $this->db->join('broker b','b.id = so.broker_id AND so.status = 1');
        $result = $this->db->get_where('sales_order so',array('so.status'=>1))->result_array();
        return $result;
    }
    
    function sales_detail($sale_id){
        $this->db->select('s.*,st.state_name,vm.vendor_name');
        $this->db->join('Vendor_master vm','vm.vendor_id = s.vendor_id');
        $this->db->join('state st','st.state_id = s.state_of_supply AND st.status = 1');
        $result = $this->db->get_where('sales s',array('s.sales_id'=>$sale_id,'s.status'=>1))->result_array();
        return $result;
    }
    
    function sales_billitem_detail($sale_id){
        $this->db->select('si.*,p.name as product_name,u.name as unit_name');
        $this->db->join('products p','p.product_id = si.product_id');
        $this->db->join('unit u','u.unit_id = si.unit_id');
        $result = $this->db->get_where('sales_item si',array('si.sale_id'=>$sale_id,'si.status'=>1))->result_array();
        return $result;
    }
    
    function sales_order_billitem_detail($sale_order_id){
        $this->db->select('soi.*,p.name as product_name,u.name as unit_name');
        $this->db->join('products p','p.product_id = soi.product_id');
        $this->db->join('unit u','u.unit_id = soi.unit_id');
        $result = $this->db->get_where('sales_order_item soi',array('soi.sales_order_id'=>$sale_order_id,'soi.status'=>1))->result_array();
        return $result;
    }
    
    function payment_detail($data){
        $this->db->insert('sale_payment_details',$data);
        return true;
    }
    
    function sales_order_create($data){
        $this->db->insert('sales_order',$data);
        return $this->db->insert_id();
    }
    
    function sales_order_itemCreate($data){
        $this->db->insert_batch('sales_order_item',$data);
        return true;
    }
    function generate_bill($bill_no){
        //
    }
}