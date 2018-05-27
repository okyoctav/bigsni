<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class Dashboard_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

    function get_location()
    {
        return $this->db->get('m_location')->result();
    }

    function get_floor()
    {
        return $this->db->get('m_floor')->result();
    }
    function get_janji()
    {
        $this->db->like('mp_date',date('y-m-d'));
        $this->db->order_by('mp_date', 'desc');
        return $this->db->get('m_perjanjian');
    }

    function total_pasien()
    {
        return $this->db->get('m_pasien')->num_rows();
    }

    function total_dokter()
    {
        return $this->db->get('m_dokter')->num_rows();
    }

    function get_total($idgroup)
    {
        $a = $this->db->query("SELECT COUNT(*) as TOTAL
            FROM `t_cuti`
            LEFT JOIN `alus_u` ON `alus_u`.`id` = `t_cuti`.`tc_staffregistrationid`
            LEFT JOIN `alus_g` ON `alus_g`.`id` = `t_cuti`.`tc_category`
            LEFT JOIN `t_cuti_type` ON `t_cuti_type`.`tct_id` = `t_cuti`.`tc_type`
            WHERE `tc_status` = 1
            AND `alus_g`.`id` = $idgroup
            AND (NOW() BETWEEN DATE(tc_date_start) AND DATE(tc_date_end))
            ORDER BY `tc_id` ASC")->row();
        return $a;
    }
}


/* End of file  */
/* Location: ./application/models/ */