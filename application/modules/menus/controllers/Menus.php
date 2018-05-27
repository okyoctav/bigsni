<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class Menus extends CI_Controller {

	private $privilege;

	public function __construct()
	{
		parent::__construct();
		//load model
		$this->load->model('menus_model','model');

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
            $head['title'] = "Manajemen Menu";
         	$data['tree'] = $this->model->all_tree();
         	$data['can_add'] = $this->privilege['can_add'];
    		
		 	$this->load->view('template/temaalus/header',$head);
		 	$this->load->view('menus/index.php',$data);
		 	$this->load->view('template/temaalus/footer');
		}else
		{
			redirect('admin/Login','refresh');
		}
	}

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
            $row[] = $person->menu_nama;
            $row[] = $person->menu_uri;
            $row[] = $person->order_num;
 			if($this->privilege['can_edit'] == 1 && $this->privilege['can_delete'] == 1)
        	{
        		$row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->menu_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->menu_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        	}

        	if($this->privilege['can_edit'] == 1 && $this->privilege['can_delete'] == 0)
        	{
        		$row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->menu_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
        	}

        	if($this->privilege['can_edit'] == 0 && $this->privilege['can_delete'] == 1)
        	{
        		$row[] = '<a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->menu_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        	}

            if($this->privilege['can_edit'] == 0 && $this->privilege['can_delete'] == 0)
            {
                $row[] = ' ';
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
        $m_nama = $data->menu_nama;
        $m_uri =  $data->menu_uri;
        $arr = array('data' => $data,
                     'nama' => $m_nama,
                     'uri' => $m_uri
                     );
        echo json_encode($arr);
    }
 
    public function ajax_add()
    {
    	if($this->privilege['can_add'] == 0)
		{
			echo json_encode(array("status" => FALSE,"msg" => "You Dont Have Permission"));
		}
        else
        {

        $this->form_validation->set_rules('name', 'Nama Menu', 'required');
        $this->form_validation->set_rules('uri', 'URI', 'required');
        $this->form_validation->set_rules('parent', 'Parent Menu', 'required');

        if ($this->form_validation->run() == true)
        {
            $data = array(
                'menu_parent' => $this->input->post('parent'),
                'menu_nama' => $this->input->post('name'),
                'menu_uri' => $this->input->post('uri'),
                'menu_target' => $this->input->post('target'),
                'menu_icon' => $this->input->post('icon'),
                'order_num' => $this->input->post('order'),
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
		}else{

        $this->form_validation->set_rules('name', 'Nama Menu', 'required');
        $this->form_validation->set_rules('uri', 'URI', 'required');
        $this->form_validation->set_rules('parent', 'Parent Menu', 'required');

        if ($this->form_validation->run() == true)
        {
            $data = array(
                'menu_parent' => $this->input->post('parent'),
                'menu_nama' => $this->input->post('name'),
                'menu_uri' => $this->input->post('uri'),
                'menu_target' => $this->input->post('target'),
                'menu_icon' => $this->input->post('icon'),
                'order_num' => $this->input->post('order')
            );
            $this->model->update(array('menu_id' => $this->input->post('id')), $data);
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode(array("status" => FALSE,"msg" => validation_errors()));
        }
        }
        
    }
 
    public function ajax_delete($id)
    {
    	if($this->privilege['can_delete'] == 0)
		{
			echo json_encode(array("status" => FALSE,"msg" => "You Dont Have Permission"));
		}else
        {
            $this->model->delete_by_id($id);
            $this->model->delete_detail_grupakses($id);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function refresh_menu_list()
    {
        $data = $this->model->all_tree();
        echo json_encode(array("status" => FALSE,"data" => $data));
        
    }
}

/* End of file  Home.php */
/* Location: ./application/controllers/ Home.php */