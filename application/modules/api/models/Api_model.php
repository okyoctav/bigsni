<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class Api_model extends CI_Model {

//=============================================== Sales Order ======================================//
	public function get_by_id_all($id)
    {
        $this->db->from('t_sales_order');
        $this->db->where('tso_id',$id);
        $this->db->join('t_fitting_date', 't_sales_order.tso_id = t_fitting_date.tfd_tso_id', 'left');
        $this->db->join('t_delivery_order', 't_sales_order.tso_id = t_delivery_order.tdo_tso_id', 'left');
        $this->db->join('t_payment_planning', 't_sales_order.tso_id = t_payment_planning.tpp_tso_id', 'left');
        $this->db->join('m_customers', 't_sales_order.tso_mcu_id = m_customers.mcu_id', 'left');

        $query = $this->db->get();

        return $query->row();
    }

    public function get_detail_by_id($id)
    {
        $this->db->where('tsoi_tso_id', $id);
        $this->db->join('m_items', 't_sales_order_item.tsoi_mi_id = m_items.mi_id', 'left');
        $query = $this->db->get('t_sales_order_item');
        return $query->result();
    }
//=============================================== end Sales Order ===================================//

//=============================================== Sales return ======================================//
    public function get_by_id_sales_return($id)
    {
        $this->db->from('t_sales_return');
        $this->db->where('tsr_id',$id);
        $this->db->join('t_sales_order', 't_sales_order.tso_id = t_sales_return.tsr_tso_id', 'left');
        $this->db->join('m_customers', 't_sales_order.tso_mcu_id = m_customers.mcu_id', 'left');

        $query = $this->db->get();

        return $query->row();
    }

    public function get_detail_by_id_sales_return($id)
    {
        $this->db->where('tsri_tsr_id', $id);
        $this->db->join('m_items', 't_sales_return_item.tsri_mi_id = m_items.mi_id', 'left');
        $query = $this->db->get('t_sales_return_item');
        return $query->result();
    }
//=============================================== end Sales return ===================================//

//=============================================== Sales refund ======================================//
    public function get_by_id_sales_refund($id)
    {
        $this->db->from('t_sales_refund');
        $this->db->where('tsre_id',$id);
        $this->db->join('t_sales_return', 't_sales_return.tsr_id = t_sales_refund.tsre_tsr_id', 'left');
        $this->db->join('t_sales_order', 't_sales_order.tso_id = t_sales_return.tsr_tso_id', 'left');
        $this->db->join('m_customers', 't_sales_order.tso_mcu_id = m_customers.mcu_id', 'left');

        $query = $this->db->get();

        return $query->row();
    }

    public function get_id_refund_voucher($id)
    {
        $this->db->from('t_sales_refund');
        $this->db->where('tsre_id',$id);
        $this->db->join('t_sales_return', 't_sales_return.tsr_id = t_sales_refund.tsre_tsr_id', 'left');
        $query = $this->db->get();

        return $query->row();
    }
//=============================================== end Sales refund ===================================//

}

/* End of file  */
/* Location: ./application/models/ */