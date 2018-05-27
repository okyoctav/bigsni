<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author 		Oky Octaviansyah <oky.octaviansyah@yahoo.co.id>
*/

class Home extends CI_Controller {
	
	

	public function __construct()
	{	
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = "Home";
		$this->load->view('index2', $data, FALSE);
	}

	public function coba()
	{
		$this->load->view('coba');
	}

	public function showsni()
	{
		$this->load->view('SNI/showsni');
	}

}

/* End of file X.php */
/* Location: ./application/modules/X/controllers/X.php */