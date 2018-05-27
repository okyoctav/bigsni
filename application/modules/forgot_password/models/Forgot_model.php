<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class Forgot_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->alus_co = $this->alus_auth->alus_co();
	}

	public function cek($abc)
	{
		$this->db->where('abc', $abc);
		$this->db->limit(1);
		return $this->db->get($this->alus_co['alus_u']);
	}

	public function get_forgot_act($abc)
	{
		$this->db->where('abc', $abc);
		$this->db->limit(1);
		$a = $this->db->get($this->alus_co['alus_u'])->row();

		return $a;

	}
}

/* End of file  */
/* Location: ./application/models/ */