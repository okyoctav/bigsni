<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class Dashboard_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

    public function get_payplan($today,$minggu)
    {
<<<<<<< .mine
        $qurt = $this->db->query("SELECT A.* from t_payment_planning A INNER JOIN (SELECT tpp_tso_id,  MAX(tpp_flag) As MaxRevision FROM t_payment_planning GROUP BY tpp_tso_id ) B ON A.tpp_tso_id = B.tpp_tso_id AND A.tpp_flag = B.MaxRevision
||||||| .r78
        $qurt = $this->db->query("SELECT A.* from t_payment_planning A INNER JOIN (SELECT tpp_tso_id,  MAX(tpp_flag) As MaxRevision FROM t_payment_planning GROUP BY tpp_tso_id ) B ON A.tpp_tso_id = B.tpp_tso_id AND A.tpp_flag = B.MaxRevision 
=======
        /*$qurt = $this->db->query("SELECT A.* from t_payment_planning A INNER JOIN (SELECT tpp_tso_id,  MAX(tpp_flag) As MaxRevision FROM t_payment_planning GROUP BY tpp_tso_id ) B ON A.tpp_tso_id = B.tpp_tso_id AND A.tpp_flag = B.MaxRevision 
>>>>>>> .r79
            WHERE A.tpp_tp_1_date BETWEEN '$today' AND '$minggu'
            OR A.tpp_tp_2_date BETWEEN '$today' AND '$minggu'
            OR A.tpp_tp_3_date BETWEEN '$today' AND '$minggu'");*/
        $qurt = $this->db->query("SELECT
                    A.* , t_sales_order.*
                FROM
                    t_payment_planning A
                LEFT JOIN t_sales_order ON A.tpp_tso_id = t_sales_order.tso_id
                INNER JOIN (
                    SELECT
                        tpp_tso_id,
                        MAX(tpp_flag) AS MaxRevision
                    FROM
                        t_payment_planning
                    GROUP BY
                        tpp_tso_id
                ) B ON A.tpp_tso_id = B.tpp_tso_id
                AND A.tpp_flag = B.MaxRevision
                AND t_sales_order.tso_invoice IS NOT NULL
                WHERE
                    A.tpp_tp_1_date BETWEEN '$today'
                AND '$minggu'
                OR A.tpp_tp_2_date BETWEEN '$today'
                AND '$minggu'
                OR A.tpp_tp_3_date BETWEEN '$today'
                AND '$minggu'
                ");
        return $qurt->num_rows();
    }

    public function get_deliv_order($today,$minggu)
    {
        $qure = $this->db->query("SELECT * from t_delivery_order where tdo_date BETWEEN '$today' AND '$minggu' and tdo_status = 1 and tdo_history = 0 GROUP BY tdo_tso_id");

        return $qure->num_rows();
    }

    public function get_fittingschedule($today,$minggu)
    {
        $qure = $this->db->query("SELECT * from t_fitting_date where tfd_date BETWEEN '$today' AND '$minggu' GROUP BY tfd_tso_id");

        return $qure->num_rows();
    }

    public function get_payment_planning($today,$minggu){
        $qurt = $this->db->query("SELECT A.* from t_payment_planning A INNER JOIN (SELECT tpp_tso_id,  MAX(tpp_flag) As MaxRevision FROM t_payment_planning GROUP BY tpp_tso_id ) B ON A.tpp_tso_id = B.tpp_tso_id AND A.tpp_flag = B.MaxRevision
            WHERE A.tpp_tp_1_date BETWEEN '$today' AND '$minggu'
            OR A.tpp_tp_2_date BETWEEN '$today' AND '$minggu'
            OR A.tpp_tp_3_date BETWEEN '$today' AND '$minggu'");

        return $qurt->result();
    }

    public function get_delivery_order($today,$minggu){
        $qurt = $this->db->query("SELECT * from t_delivery_order LEFT JOIN t_sales_order on t_delivery_order.tdo_tso_id = t_sales_order.tso_id where tdo_date BETWEEN '$today' AND '$minggu' and tdo_status = 1 and tdo_history = 0 GROUP BY tdo_tso_id");
        //$qurt = $this->db->query("SELECT * from t_delivery_order where tdo_date BETWEEN '$today' AND '$minggu' and tdo_status = 1 and tdo_history = 0 GROUP BY tdo_tso_id");
        return $qurt->result();
    }

    public function get_fitting_schedule($today,$minggu){
        $qurt = $this->db->query("SELECT a.*, b.tso_invoice, b.tso_mcu_id, b.tso_mcu_name
                                        FROM t_fitting_date a
                                        LEFT JOIN t_sales_order b ON b.tso_id = a.tfd_tso_id
                                        WHERE b.tso_invoice != 'null'
                                        AND (DATE(tfd_date) BETWEEN '$today' AND '$minggu')");

        return $qurt->result();
    }
}

/* End of file  */
/* Location: ./application/models/ */