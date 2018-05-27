<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author 		Oky Octaviansyah <oky.octaviansyah@yahoo.co.id>
*/

class Listnonsni extends CI_Controller {
	
	

	public function __construct()
	{	
		parent::__construct();
		$this->load->model('Alus_items');
	}

	public function index()
	{
		if($this->alus_auth->logged_in())
         {
         	$title_head = "List Non SNI";
         	$head['title'] = $title_head;
         	$data['title_head'] = $title_head;

         	/*DATA*/

         	/*END DATA*/

		 	$this->load->view('template/temaalus/header',$head);
		 	$this->load->view('index',$data);
		 	$this->load->view('template/temaalus/footer');
		}else
		{
			redirect('admin/Login','refresh');
		}
	}


	/*AJAX LIST*/

	public function ajax_list()
    {
        $list = $this->Alus_items->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $person->mbs_kodesni;
            $row[] = $person->mbs_tahun;
            $row[] = $person->mbs_ics;
            $row[] = $person->mbs_namesni;
            $row[] = $person->mbs_konsensus;

            $row[] = "<i class='fa fa-caret-right'></i>";

            if($person->mfs_mbs_id) {
                if($person->jumlahtahap=='10') {
                    $prosessni = '<span class="badge bg-green">Finish</span>';
                }else{
                    $prosessni = '<span class="badge bg-yellow">Progress '.$person->jumlahtahap.'0%</span>';
                }
            }
            else
            {
                $prosessni = '<span class="badge bg-grey">No Progress</span>';
            }

            $row[] = $prosessni;
 			
            $btnview   = "<a href='javascript:' onClick='btn_modal_view(".$person->mbs_id.")' data-toggle='tooltip' data-placement='bottom' title='Lihat Data Lengkap' class='btn btn-xs btn-flat btn-primary' style='background:#00897b'><i class='fa fa-eye'></i> View</a>";
        	$btnedit   = "<a href='javascript:' onClick='btn_modal_edit(".$person->mbs_id.")' data-toggle='tooltip' data-placement='bottom' title='Ubah Data' class='btn btn-xs btn-flat btn-primary' style='background:#00897b'><i class='fa fa-edit'></i> Edit</a>";
        	$btndelet  = "<a href='javascript:' onClick='btn_modal_delete(".$person->mbs_id.")' data-toggle='tooltip' data-placement='bottom' title='Hapus Data' class='btn btn-xs btn-flat btn-danger'><i class='fa fa-trash'></i> Delete</a>";
            $btntahap  = "<a href='".base_url()."listnonsni/stagesni/".$person->mbs_id."' data-toggle='tooltip' data-placement='bottom' title='Tahapan Data' class='btn btn-xs btn-flat btn-warning'><i class='fa fa-cog'></i> Stage</a>";

         	
            //add html for action
            $row[] = $btnview.' '.$btnedit.' '.$btndelet.' '.$btntahap;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Alus_items->count_all(),
                        "recordsFiltered" => $this->Alus_items->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    /*MODAL*/

    function modal_add()
    {
    	$data['title'] = "Add List Non SNI";
    	$this->load->view('ajax/modal_add', $data, FALSE);
    }

    function modal_edit($id)
    {
    	$data['data'] = $this->Alus_items->getid($id);
    	$data['title'] = "Edit List Non SNI";
    	$this->load->view('ajax/modal_edit', $data, FALSE);
    }

    /*ACTION*/

    function save()
    {
    	$data = array(
                        'mbs_syscode' => $this->input->post('mbs_syscode'),
                        'mbs_namesni' => $this->input->post('mbs_namesni'),
                        'mbs_kodesni' => $this->input->post('mbs_kodesni'),
                        'mbs_tanggal' => date("Y-m-d h:i:s"),
                        'mbs_type'    => 1,
                        'mbs_users'   => $this->session->userdata('user_id'),
                        'mbs_tahun' => $this->input->post('mbs_tahun'),
                        'mbs_ics' => $this->input->post('mbs_ics'),
                        'mbs_nameiso' => $this->input->post('mbs_nameiso'),
                        'mbs_pnp' => $this->input->post('mbs_pnp'),
                        'mbs_konsensus' => $this->input->post('mbs_konsensus'),
                        'mbs_jajakpendapat' => $this->input->post('mbs_jajakpendapat'),
                        'mbs_tanggalpenetapan' => $this->input->post('mbs_tanggalpenetapan'),
                        'mbs_sk_penetapan' => $this->input->post('mbs_sk_penetapan'),
                        'mbs_keterangan' => $this->input->post('mbs_keterangan'),
                        'mbs_klasifikasi' => $this->input->post('mbs_klasifikasi'),
                        'mbs_klas' => $this->input->post('mbs_klas')
    				 );

    	$q = $this->Alus_items->save($data);
    	if($q)
    	{
    		echo "Tersimpan";
    	}
    	else
    	{
    		echo "Tidak Tersimpan";
    	}
    }

    function edit()
    {
    	$data = array(
                        'mbs_namesni' => $this->input->post('mbs_namesni'),
                        'mbs_kodesni' => $this->input->post('mbs_kodesni'),
                        'mbs_tanggal' => date("Y-m-d h:i:s"),
                        'mbs_type'    => 1,
                        'mbs_tahun' => $this->input->post('mbs_tahun'),
                        'mbs_ics' => $this->input->post('mbs_ics'),
                        'mbs_nameiso' => $this->input->post('mbs_nameiso'),
                        'mbs_pnp' => $this->input->post('mbs_pnp'),
                        'mbs_konsensus' => $this->input->post('mbs_konsensus'),
                        'mbs_jajakpendapat' => $this->input->post('mbs_jajakpendapat'),
                        'mbs_tanggalpenetapan' => $this->input->post('mbs_tanggalpenetapan'),
                        'mbs_sk_penetapan' => $this->input->post('mbs_sk_penetapan'),
                        'mbs_keterangan' => $this->input->post('mbs_keterangan'),
                        'mbs_klasifikasi' => $this->input->post('mbs_klasifikasi'),
                        'mbs_klas' => $this->input->post('mbs_klas')
    				 );

    	$q = $this->Alus_items->edit($data);
    	if($q)
    	{
    		echo "Tersimpan";
    	}
    	else
    	{
    		echo "Tidak Tersimpan";
    	}
    }

    function delete($id)
    {
    	$q = $this->Alus_items->delete($id);
    	if($q)
    	{
    		echo "Terhapus";
    	}
    	else
    	{
    		echo "Tidak Terhapus";
    	}
    }

    function stagesni($id)
    {
        $title_head = "List Non SNI";
        
            $head['title'] = $title_head;
            $batas = ' <i class="fa fa-caret-right"></i>';
            $data['title_head'] = $title_head.$batas.' Stage ';

        $data['id'] = $id;
        $this->load->view('template/temaalus/header',$head);
        $this->load->view('ajax/stagesni', $data, FALSE);
        $this->load->view('template/temaalus/footer');
    }

    function stagesni_tahap($id,$idtahap)
    {
        $title_head = "Tahap Non SNI";
        
            $head['title'] = $title_head;
            $batas = ' <i class="fa fa-caret-right"></i>';
            $data['title_head'] = $title_head.$batas.' Stage'.$batas.' Tahap';
            $data['idtahap'] = $idtahap;

        $data['id'] = $id;
        $this->load->view('template/temaalus/header',$head);
        $this->load->view('ajax/stagesni_tahap', $data, FALSE);
        $this->load->view('template/temaalus/footer');
    }

    function modal_uploadfile($id,$id_mbs)
    {
        $data['idmts'] = $id;
        $data['id'] = $id_mbs;
        $this->load->view('ajax/modal_uploadfile', $data, FALSE);
    }

    function saveupload()
    {
        $get_sni = $this->db->query("SELECT * FROM m_bigsni WHERE mbs_id='".$this->input->post('mbs_id')."'");
        foreach ($get_sni->result() as $key => $value);

        $path = "uploads/".str_replace("/","",$value->mbs_syscode);

        if(!is_dir($path)) //create the folder if it's not already exists
        {
          mkdir($path,0777,TRUE);
        }

        $namafile = round(microtime(true) * 1000).$_FILES['userfile']['name'];

        $config['upload_path']      = './uploads/'.str_replace("/","",$value->mbs_syscode);
        $config['allowed_types']    = 'gif|jpg|png|pdf';
        $config['max_size']         = '100000';
        $config['file_name']        = $namafile;
        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('userfile')){
            $this->session->set_flashdata('message', $this->upload->display_errors('',''));
            echo json_encode(array('status' => FALSE , 'msg' => $this->upload->display_errors('','')));
        }
        else{
            //$nama_file = $this->upload->data('file_name');
            $data = array(
                    'mfs_mts_id' => $this->input->post('mts_id'),
                    'mfs_mbs_id' => $this->input->post('mbs_id'),
                    'mfs_mbsj_id' => $this->input->post('mfs_mbsj_id'),
                    'mfs_file' => $namafile,
                    'mfs_keterangan' => $this->input->post('mfs_keterangan'),
                    'mfs_date' => date("Y-m-d h:i:s"),
                    'mfs_status' => 0,
                    'mfs_version' => 0,
                    'mfs_user' => $this->session->userdata('user_id')
                );
            $this->db->insert('m_file_sni', $data);
             echo json_encode(array('status' => TRUE , 'msg' => $this->upload->display_errors('','')));
        }
    }


    function savepublish($id,$status)
    {
        if($status==1)
        {
            $this->alus_auth->DuplicateMySQLRecord('m_file_sni','m_file_sni_history','mfs_id',$id,'publish');
        }
        else
        {
            $this->alus_auth->DuplicateMySQLRecord('m_file_sni','m_file_sni_history','mfs_id',$id,'unpublish');   
        }

        $this->db->where('mfs_id', $id);
        $data = array('mfs_status' => $status );
        return $this->db->update('m_file_sni', $data);
    }

    function savedelete($id)
    {
        $this->alus_auth->DuplicateMySQLRecord('m_file_sni','m_file_sni_history','mfs_id',$id,'delete');

        $this->db->where('mfs_id', $id);
        return $this->db->delete('m_file_sni');
    }

    function saveselesai($id_tahap,$id_mbs)
    {
        //$this->alus_auth->DuplicateMySQLRecord('m_file_sni','m_file_sni_history','mfs_id','0','tahap selesai');

        if($id_tahap==1)
        {
            $cek_datatahap1 = $this->db->query("SELECT * FROM m_file_sni WHERE mfs_mbs_id='".$id_mbs."' GROUP BY mfs_mbsj_id");
            if($cek_datatahap1->num_rows() >= 2)
            {
                $data = array(
                    'mfs_mts_id' => $id_tahap,
                    'mfs_mbs_id' => $id_mbs,
                    'mfs_mbsj_id' => 0,
                    'mfs_file' => 'selesai',
                    'mfs_keterangan' => '',
                    'mfs_date' => date("Y-m-d h:i:s"),
                    'mfs_status' => 0,
                    'mfs_version' => 0,
                    'mfs_user' => $this->session->userdata('user_id')
                );
                $this->db->insert('m_file_sni', $data);
            }
            else
            {
                echo "FALSE";
            }
        }
        else
        {

            $data = array(
                    'mfs_mts_id' => $id_tahap,
                    'mfs_mbs_id' => $id_mbs,
                    'mfs_mbsj_id' => 0,
                    'mfs_file' => 'selesai',
                    'mfs_keterangan' => '',
                    'mfs_date' => date("Y-m-d h:i:s"),
                    'mfs_status' => 0,
                    'mfs_version' => 0,
                    'mfs_user' => $this->session->userdata('user_id')
                );
            $this->db->insert('m_file_sni', $data);
        }
    }

    function savebatalselesai($id_tahap,$id_mbs)
    {
        //$this->alus_auth->DuplicateMySQLRecord('m_file_sni','m_file_sni_history','mfs_id','','batal selesai');

        $this->db->where('mfs_mts_id', $id_tahap);
        $this->db->where('mfs_mbs_id', $id_mbs);
        $this->db->where('mfs_file', 'selesai');

        $this->db->delete('m_file_sni');
    }

    function modal_view($id)
    {
        $data['id'] = $id;
        $data['title'] = "Form View";
        $this->load->view('ajax/modal_view', $data, FALSE);
    }

}

/* End of file X.php */
/* Location: ./application/modules/X/controllers/X.php */