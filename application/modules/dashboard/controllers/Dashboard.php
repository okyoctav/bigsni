<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->alus_auth->logged_in())
		{
			redirect('admin/Login','refresh');
		}
		$this->load->model('Dashboard_model','model');
	}


	public function index()
	{

		if($this->alus_auth->logged_in())
         {
         	$head['title'] = "Beranda";
         	/*data*/
         	/*$data['janji'] = $this->model->get_janji()->result();
         	$data['total_janji'] = $this->model->get_janji()->num_rows();
         	$data['total_pasien'] = $this->model->total_pasien();
         	$data['total_dokter'] = $this->model->total_dokter();
         	$data['total_cuti_staff'] = $this->model->get_total('7')->TOTAL;
         	$data['total_cuti_dokter'] = $this->model->get_total('6')->TOTAL;*/
         	$data['title'] = "Beranda";

		 	$this->load->view('template/temaalus/header',$head);
		 	//$this->load->view('dashboard/index',$data);
		 	$this->load->view('dashboard/index_dashboard',$data);
		 	$this->load->view('template/temaalus/footer');
		}else
		{
			redirect('admin/Login','refresh');
		}
	}

	function error404()
	{
		if($this->alus_auth->logged_in())
         {
         	$head['title'] = "Ups Page Not Found";

		 	$this->load->view('template/temaalus/header',$head);
		 	$this->load->view('template/temaalus/404');
		 	$this->load->view('template/temaalus/footer');
		}else
		{
			redirect('admin/Login','refresh');
		}
	}

	function get_room()
	{
		$location 	= $_POST['L'];
		$floor 		= $_POST['F'];

		$this->db->where('mr_ml_id', $location);
		$this->db->where('mr_mf_id', $floor);
		$data = $this->db->get('v_room')->result();

		echo json_encode(array('status' => TRUE, 'data' => $data));
	}

}

/* End of file  Home.php */
/* Location: ./application/controllers/ Home.php */