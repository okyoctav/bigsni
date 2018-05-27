<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class Group extends CI_Controller {

	private $privilege;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Group_model','model');

		if(!$this->alus_auth->logged_in())
		{
			redirect('admin/Login','refresh');
		}
		$this->privilege = $this->Alus_hmvc->cek_privilege($this->uri->segment(1));
		if($this->privilege['can_view'] == '0')
        {
            echo "<script type='text/javascript'>alert('You dont have permission to access this menu');</script>";
            redirect('dashboard','refresh');
        }
	}

	public function index()
	{
	
		if($this->alus_auth->logged_in())
         {
         	$head['title'] = "Manajemen Group";
         	$data['can_add'] = $this->privilege['can_add'];
     		
		 	$this->load->view('template/temaalus/header',$head);
		 	$this->load->view('index.php',$data);
		 	$this->load->view('template/temaalus/footer');
		}else
		{
			redirect('admin/Login','refresh');
		}
	}


	public function hak_akses($id)
	{
		$data['id'] = $id;
		$sql = $this->model->hak_akses_mod($id);
		foreach ($sql->result() as $oo) {
					$data['menus'][] = $oo->id_menu;
					$data['canad'][] = $oo->can_add;
					$data['canedit'][] = $oo->can_edit;
					$data['candelet'][] = $oo->can_delete;
					$data['canview'][] = $oo->can_view;
					$data['psv'][] = $oo->psv;
					$data['pev'][] = $oo->pev;
					$data['psed'][] = $oo->psed;
					$data['peed'][] = $oo->peed;
				}
		$data['result'] = $this->model->all_tree();
		$this->load->view('group/hak_akses',$data);
	}

	public function save_hak_akses()
	{
		if($this->privilege['can_edit'] == 0)
		{
			echo json_encode(array("status" => FALSE,"msg" => "You Dont Have Permission"));
		}else
		{
			$this->form_validation->set_rules('bot[]', 'Menu', 'required');
		if ($this->form_validation->run() == true)
		{
			$id_group = $this->input->post('id_group');
			$mlist = $this->input->post('bot');
			$result = array();
			$i = 0;
			$sum =0;
			foreach($mlist AS $key=>$val){
						if($val){
							//delete hak sebelumnya clear all 
							$this->model->del_ga($id_group);
							//buat baru
							$result[] = array(
							"id_group" 	 => $id_group,
							"id_menu" 	 => $_POST['menu'][$val],
							"can_view" 	 => $_POST['canview'][$val],
							"can_edit" 	 => $_POST['canedit'][$val],
							"can_add" 	 => $_POST['canadd'][$val],
							"can_delete" => $_POST['candelete'][$val],
							"psv" 		 => date('Y-m-d H:i:s' , strtotime($_POST['psv'][$val])),
							"pev" 		 => date('Y-m-d H:i:s' , strtotime($_POST['pev'][$val])),
							"psed" 		 => date('Y-m-d H:i:s' , strtotime($_POST['psed'][$val])),
							"peed" 		 => date('Y-m-d H:i:s' , strtotime($_POST['peed'][$val]))
							);
						}			
			}

			$a = $this->model->upres($result);
			if($a)
			{
				echo json_encode(array("status" => TRUE));
			}else{
				echo json_encode(array("status" => FALSE,"msg" => "Gagal update hak akses !"));
			}
			}else{
			echo json_encode(array("status" => FALSE,"msg" => "ERROR[ID NOT FOUND]"));
		}
		}
	}
	/* SERVER SIDE */
	/* Server Side Data */
	/* Modified by : Maulana.code@gmail.com */
	public function ajax_list()
    {
        $list = $this->model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $person->name;
            $row[] = $person->description;
 			if($this->privilege['can_edit'] == 1 && $this->privilege['can_delete'] == 1)
        	{
        		$row[] = '<a class="btn btn-flat btn-xs btn-primary" href="javascript:void(0)" title="Edit Group" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';

        		$row[] = '<a class="btn btn-flat btn-xs btn-primary" href="javascript:void(0)" title="Edit Hak Akses" onclick="openform('."'".$person->id."'".')"><i class="glyphicon glyphicon-list-alt"></i></a>';

        		$row[] = '<a class="btn btn-flat btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

        	}elseif($this->privilege['can_edit'] == 0 && $this->privilege['can_delete'] == 1)
        	{
        		$row[] ='';
        		$row[] ='';
        		$row[] = '<a class="btn btn-flat btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

        	}elseif($this->privilege['can_edit'] == 1 && $this->privilege['can_delete'] == 0)
        	{
        		$row[] = '<a class="btn btn-flat btn-xs btn-primary" href="javascript:void(0)" title="Edit Group" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';

        		$row[] = '<a class="btn btn-flat btn-xs btn-primary" href="javascript:void(0)" title="Edit Hak Akses" onclick="openform('."'".$person->id."'".')"><i class="glyphicon glyphicon-list-alt"></i></a>';

        		$row[] = '';
        	}else{
        		$row[] = '';
        		$row[] = '';
        		$row[] = '';
        	}
            //add html for action
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model->count_all(),
                        "recordsFiltered" => $this->model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->model->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
    	if($this->privilege['can_add'] == 0)
		{
			echo json_encode(array("status" => FALSE,"msg" => "You Dont Have Permission"));
		}else
		{
			$this->form_validation->set_rules('group_nama', 'Nama Group', 'required');
		if ($this->form_validation->run() == true)
		{
        	$data = array(
        	        'name' => $this->input->post('group_nama'),
					'description' => $this->input->post('des_group'),
        	    );
        	$insert = $this->model->save($data);
        	echo json_encode(array("status" => TRUE));
    	}else{
    		echo json_encode(array("status" => FALSE,"msg" => validation_errors() ));
    	}
		}
        
    }
 
    public function ajax_update()
    {
    	if($this->privilege['can_edit'] == 0)
		{
			echo json_encode(array("status" => FALSE,"msg" => "You Dont Have Permission"));
		}else
		{

		$this->form_validation->set_rules('group_nama', 'Nama Group', 'required');
		if ($this->form_validation->run() == true)
		{
        	$data = array(
        	        'name' => $this->input->post('group_nama'),
					'description' => $this->input->post('des_group'),
        	    );
        	$this->model->update(array('id' => $this->input->post('id')), $data);
        	echo json_encode(array("status" => TRUE));
        }else{
        	echo json_encode(array("status" => FALSE,"msg" => validation_errors() ));
        }
		}
    }
 
    public function ajax_delete($id)
    {
    	if($this->privilege['can_delete'] == 0)
		{
			echo json_encode(array("status" => FALSE,"msg" => "You Dont Have Permission"));
		}else{
			$this->model->delete_by_id($id);
        	echo json_encode(array("status" => TRUE));	
		}
        
    }

}

/* End of file  Home.php */
/* Location: ./application/controllers/ Home.php */