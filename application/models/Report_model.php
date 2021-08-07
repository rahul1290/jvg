<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model{

    function product_stock(){
        $result = $this->db->query("select t1.product_id,p.code,p.name,ifnull((buy-sales),0) as available
        from
        (select pi.product_id,sum(pi.qty) as buy
            from purchase_item pi
            WHERE status = 1
            GROUP by product_id
            ) t1
            join products p on p.product_id = t1.product_id AND p.status = 1
            left join
            (select so.product_id,sum(so.qty) as sales from
                sales_order_item so
                WHERE status = 1
                GROUP by product_id
                ) t2
                on t2.product_id = t1.product_id
                group BY t2.product_id ")->result_array();
        return $result;
    }
    
    
    function purchase_sales($brokerId){
        if(is_null($brokerId)){
            $result = $this->db->query("select t1.*,DATE_FORMAT(t1.bill_date,'%d/%m/%Y %H:%i:%s') as bill_date ,v.vendor_name,pro.name as product_name,b.broker_name from ((select p.purchase_id,'Purchase',p.bill_date,p.vendor_id,pi.product_id,pi.qty,pi.perunit_price,p.broker_id from purchase p
            JOIN purchase_item pi on p.purchase_id = pi.purchase_id
            WHERE p.status = 1
            ORDER by p.bill_date)
            union
            (select so.sales_order_id,'Sales',so.bill_date,so.vendor_id,soi.product_id,soi.qty,soi.perunit_price,so.broker_id from sales_order so
            JOIN sales_order_item soi on soi.sales_order_id = so.sales_order_id
            WHERE so.status = 1
            ORDER by so.bill_date)) as t1
            JOIN vendor_master v on t1.vendor_id = v.vendor_id
            JOIN products pro on pro.product_id = t1.product_id
            JOIN broker b on b.id = t1.broker_id")->result_array();
        }
        else {
            $result = $this->db->query("select t1.*,DATE_FORMAT(t1.bill_date,'%d/%m/%Y %H:%i:%s') as bill_date ,v.vendor_name,pro.name as product_name,b.broker_name from ((select p.purchase_id,'Purchase',p.bill_date,p.vendor_id,pi.product_id,pi.qty,pi.perunit_price,p.broker_id from purchase p
            JOIN purchase_item pi on p.purchase_id = pi.purchase_id
            WHERE p.status = 1
            ORDER by p.bill_date)
            union
            (select so.sales_order_id,'Sales',so.bill_date,so.vendor_id,soi.product_id,soi.qty,soi.perunit_price,so.broker_id from sales_order so
            JOIN sales_order_item soi on soi.sales_order_id = so.sales_order_id
            WHERE so.status = 1
            ORDER by so.bill_date)) as t1
            JOIN vendor_master v on t1.vendor_id = v.vendor_id
            JOIN products pro on pro.product_id = t1.product_id
            JOIN broker b on b.id = t1.broker_id AND b.id = ".$brokerId)->result_array();
        }
        usort($result, function($a, $b) {
            return strtotime($a['bill_date']) <=> strtotime($b['bill_date']);
        });
        
        return $result;
    }
    
    function vendor_report(){
        $result = $this->db->query("select v.vendor_id,v.vendor_name,t1.product_id,pro.code,pro.name as product_name,(ifnull(t1.qty,0) - ifnull(t2.qty,0)) qty from (select p.vendor_id,pi.product_id,sum(pi.qty) as qty from purchase p
        JOIN purchase_item pi on pi.purchase_id = p.purchase_id AND pi.status = 1
        WHERE p.status = 1
        GROUP by p.vendor_id,pi.product_id) as t1
        left join 
        	(select si.vendor_id,si.product_id,sum(si.qty) as qty from sales_item si
        		GROUP by si.vendor_id,si.product_id
            ) t2 on t2.vendor_id = t1.vendor_id AND t2.product_id = t1.product_id
        JOIN vendor_master v on v.vendor_id = t1.vendor_id
        JOIN products pro on pro.product_id = t1.product_id ORDER by vendor_id asc")->result_array();
        
        return $result;
    }
}