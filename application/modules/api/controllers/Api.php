<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author 		Oky Octaviansyah <oky.octaviansyah@yahoo.co.id>
 * @modified 	Maulana Rahman <maulana.code@gmail.com>
*/

class Api extends CI_Controller {

	private $privilege;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_model','model');
		$this->load->helper('terbilang2');
	}

	public function index()
	{
		echo "HA";
	}

	public function cmd()
	{
		$data = $this->input->get('data');
		$tables = $this->input->get('tables');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$describe = $this->input->get('describe');
		$like = $this->input->get('like');

		if($describe and $tables)
		{
			$row = array();
			$datafield = $this->db->field_data($tables);
			foreach ($datafield as $key => $value) {
				$data_array = array();
				$data_array['column_name'] = $value->name;
				$data_array['column_type'] = $value->type."(".$value->max_length.")";
				$row[] = $data_array;
			}

			echo json_encode(array('status' => true , 'data' => $row ));
		}
		else
		{
			if($tables)
			{
				if($data)
				{
				foreach ($data as $key => $value) {
							$this->db->where($key, $value);
							if($like)
							{
								$this->db->like($key, $like);
							}
						}
					}

				if(!$limit){
					$data = $this->db->get($tables)->result();
				}
				elseif($limit and $offset)
				{
					$data = $this->db->get($tables,$limit,$offset)->result();
				}
				else
				{
					$data = $this->db->get($tables,$limit)->result();
				}
				echo json_encode(array('status' =>200 , 'data' => $data ));
			}
			else
			{
				$tabletolak = array("alus_u",
									"alus_g",
								    "alus_gd",
								    "alus_la",
								    "alus_mg",
								    "alus_mga",
								    "alus_ug",
								    "ci_sessions",
								    "themes",
    								"token_db",
    								"t_pull"
    								);

				$sql = $this->db->list_tables();
				$data = array();
				foreach ($sql as $key => $value) {
					if(in_array($value, $tabletolak)){}
					else{ $data[] = $value;}
				}
				echo json_encode(array('table' =>$data));
			}
		}
	}

	//sales order invoice
	public function makepdf($tsoid)
    {
        $data['item'] = $this->model->get_by_id_all($tsoid);
        $data['detail'] = $this->model->get_detail_by_id($tsoid);
        $this->load->view('pdf_sales_order', $data);
    }

    //sales order invoice
	public function sales_order_pdf($tsoid)
    {
        $data['item'] = $this->model->get_by_id_all($tsoid);
        $data['detail'] = $this->model->get_detail_by_id($tsoid);
        $this->load->view('pdf_sales_order_blminv', $data);
    }

    //sales Return PDF
	public function sales_return_pdf($tsrid)
    {
        $data['item'] = $this->model->get_by_id_sales_return($tsrid);
        $data['detail'] = $this->model->get_detail_by_id_sales_return($tsrid);
        $this->load->view('pdf_sales_return', $data);
    }

    //sales REFUND PDF
	public function sales_refund_pdf($tsreid,$tsrid)
    {
        $data['item'] = $this->model->get_by_id_sales_refund($tsreid);
        $data['item_return'] = $this->model->get_by_id_sales_return($tsrid);
        $data['detail_return'] = $this->model->get_detail_by_id_sales_return($tsrid);
        $this->load->view('pdf_sales_refund', $data);
    }

    public function sales_refund_voucher_pdf($id)
    {
        $data['vo'] = $this->model->get_id_refund_voucher($id);
        $ter = $this->model->get_id_refund_voucher($id);
        $data['terbilang'] = terbilangs($ter->tsre_total_price);
        $this->load->view('pdf_sales_refund_voucher', $data);
    }

    function a2018_vw_kaldik()
    {
    	echo '{"status":200,"data":[{"id_kaldik":"174","Tahun":"2013","UraianDiklat":"Pembentukan Auditor Ahli di Lingkungan Inspektorat Provinsi\/Kabupaten\/Kota","NamaLokasi":"Denpasar","UraianSbrBiaya":"Rupiah Murni Pusdiklatwas","KodeJenisDiklat":"1","NamaJenisDiklat":"Fungsional Auditor","RlsTglMulai":"2013-02-04","RlsTglSelesai":"2013-02-25","statRealisasi":"1","LokasiDetail":null}]}';
    }

    function a2018_vw_pst()
    {
    	
    	echo '{"status":200,"data":[{"Tahun":"2013","id_kaldik":"174","nip_baru_nospace":"196911021992031006","NamaPst":"I Wayan Ruja Armaya","NoUrutSTTPM":"0017","UraianDiklat":"Pembentukan Auditor Ahli di Lingkungan Inspektorat Provinsi\/Kabupaten\/Kota","NamaDiklat":"Pembentukan Auditor Ahli","RlsTglMulai":"2013-02-04","RlsTglSelesai":"2013-02-25","statRealisasi":"1","Kelas":"","NamaSubUnit":"Inspektorat Kabupaten Badung","Alamat":"Denpasar","AlamatKantor":"Jl. raya Sempidi Mengwi badung","Telepon":null,"TelpKantor":null,"UraianSbrBiaya":"Rupiah Murni Pusdiklatwas","email":null,"NamaJabatan":"Staf","KetJabatan":"","KodeJenisDiklat":"1","NamaJenisDiklat":"Fungsional Auditor","NamaLokasi":"Denpasar","nama_instansi":"Pemerintah Kabupaten Badung","kabupaten":"Kabupaten Badung","propinsi":"Bali","NIP_Baru":"19691102 199203 1 006"},{"Tahun":"2013","id_kaldik":"174","nip_baru_nospace":"196911251989032003","NamaPst":"Sagung Agung Mayasari","NoUrutSTTPM":"0018","UraianDiklat":"Pembentukan Auditor Ahli di Lingkungan Inspektorat Provinsi\/Kabupaten\/Kota","NamaDiklat":"Pembentukan Auditor Ahli","RlsTglMulai":"2013-02-04","RlsTglSelesai":"2013-02-25","statRealisasi":"1","Kelas":"","NamaSubUnit":"Inspektorat Kabupaten Badung","Alamat":"","AlamatKantor":null,"Telepon":null,"TelpKantor":null,"UraianSbrBiaya":"Rupiah Murni Pusdiklatwas","email":null,"NamaJabatan":"Staf","KetJabatan":"","KodeJenisDiklat":"1","NamaJenisDiklat":"Fungsional Auditor","NamaLokasi":"Denpasar","nama_instansi":"Pemerintah Kabupaten Badung","kabupaten":"Kabupaten Badung","propinsi":"Bali","NIP_Baru":"19691125 198903 2 003"},{"Tahun":"2013","id_kaldik":"174","nip_baru_nospace":"196909141991032006","NamaPst":"Ni Made Padmini","NoUrutSTTPM":"0019","UraianDiklat":"Pembentukan Auditor Ahli di Lingkungan Inspektorat Provinsi\/Kabupaten\/Kota","NamaDiklat":"Pembentukan Auditor Ahli","RlsTglMulai":"2013-02-04","RlsTglSelesai":"2013-02-25","statRealisasi":"1","Kelas":"","NamaSubUnit":"Inspektorat Kabupaten Badung","Alamat":null,"AlamatKantor":null,"Telepon":null,"TelpKantor":null,"UraianSbrBiaya":"Rupiah Murni Pusdiklatwas","email":null,"NamaJabatan":"Staf","KetJabatan":"","KodeJenisDiklat":"1","NamaJenisDiklat":"Fungsional Auditor","NamaLokasi":"Denpasar","nama_instansi":"Pemerintah Kabupaten Badung","kabupaten":"Kabupaten Badung","propinsi":"Bali","NIP_Baru":"19690914 199103 2 006"},{"Tahun":"2013","id_kaldik":"174","nip_baru_nospace":"3","NamaPst":"No Name","NoUrutSTTPM":"0020","UraianDiklat":"Pembentukan Auditor Ahli di Lingkungan Inspektorat Provinsi\/Kabupaten\/Kota","NamaDiklat":"Pembentukan Auditor Ahli","RlsTglMulai":"2013-02-04","RlsTglSelesai":"2013-02-25","statRealisasi":"1","Kelas":"","NamaSubUnit":"Inspektorat Kabupaten Badung","Alamat":null,"AlamatKantor":null,"Telepon":null,"TelpKantor":null,"UraianSbrBiaya":"Rupiah Murni Pusdiklatwas","email":null,"NamaJabatan":"Staf","KetJabatan":"","KodeJenisDiklat":"1","NamaJenisDiklat":"Fungsional Auditor","NamaLokasi":"Denpasar","nama_instansi":"Pemerintah Kabupaten Badung","kabupaten":"Kabupaten Badung","propinsi":"Bali","NIP_Baru":"19821205 200604 1 001"},{"Tahun":"2013","id_kaldik":"174","nip_baru_nospace":"197105162007012008","NamaPst":"Ni Luh Putu Sariasih Wiryantini","NoUrutSTTPM":"021","UraianDiklat":"Pembentukan Auditor Ahli di Lingkungan Inspektorat Provinsi\/Kabupaten\/Kota","NamaDiklat":"Pembentukan Auditor Ahli","RlsTglMulai":"2013-02-04","RlsTglSelesai":"2013-02-25","statRealisasi":"1","Kelas":"","NamaSubUnit":"Inspektorat Kabupaten Badung","Alamat":null,"AlamatKantor":null,"Telepon":null,"TelpKantor":null,"UraianSbrBiaya":"Rupiah Murni Pusdiklatwas","email":null,"NamaJabatan":"Staf","KetJabatan":"","KodeJenisDiklat":"1","NamaJenisDiklat":"Fungsional Auditor","NamaLokasi":"Denpasar","nama_instansi":"Pemerintah Kabupaten Badung","kabupaten":"Kabupaten Badung","propinsi":"Bali","NIP_Baru":"19710516 200701 2 008"}]}';
    }
}

/* End of file Api.php */
/* Location: ./application/modules/api/controllers/Api.php */