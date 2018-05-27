<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class Users extends CI_Controller {

	private $privilege;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BASED_model','model');

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
            $head['title'] = "Manajemen BASED";
         	$data['list'] = $this->model->groupdpt();
         	$data['can_add'] = $this->privilege['can_add'];
     		
		 	$this->load->view('template/temaalus/header',$head);
		 	$this->load->view('index.php',$data);
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

            $row = array();
            $row[] = $person->first_name;
            $row[] = $person->last_name;
            $row[] = $this->alus_auth->decrypt($person->abc);
            
 			if($this->privilege['can_edit'] == 1 && $this->privilege['can_delete'] == 1)
        	{
        		$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        	}

        	if($this->privilege['can_edit'] == 1 && $this->privilege['can_delete'] == 0)
        	{
        		$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
        	}

        	if($this->privilege['can_edit'] == 0 && $this->privilege['can_delete'] == 1)
        	{
        		$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        	}
            if($this->privilege['can_edit'] == 0 && $this->privilege['can_delete'] == 0)
            {
                $row[] = ' ';
            }
            //add html for action
            $data[] = $row;
            $no++;
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
    	$currentGroups = $this->alus_auth->get_users_groups($id)->result();
    	foreach ($currentGroups as $cur) {
    		$current[] = $cur->id;
    	}
        $data = $this->model->get_by_id($id);
        $email = $this->alus_auth->decrypt($data->abc);
        $arr = array(
        	'data' => $data,
        	'grup' => $current,
        	'email' => $email
        	);
        echo json_encode($arr);
    }
 
    public function ajax_add()
    {
    	if($this->privilege['can_add'] == 0)
		{
            header('Content-Type: application/json');
			echo json_encode(array("status" => FALSE,"msg" => "You Dont Have Permission"));
		}
		else{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|callback__notMatch[re_password]|min_length[' . $this->config->item('min_password_length', 'alus_auth') . ']|max_length[' . $this->config->item('max_password_length', 'alus_auth') . ']');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback__emailUnique[email]');
        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim');
        $this->form_validation->set_rules('phone', 'Phone', 'numeric');
        $this->form_validation->set_rules('group[]', 'Group', 'required');

        if ($this->form_validation->run() == true)
        {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            $email = $this->input->post('email', TRUE);
            foreach ($this->input->post('group') as $key) {
                $group[] = $key;
             };
            $additional_data = array(
                                'username' => $this->input->post('username'),
                                'job_title' => $this->input->post('job'),
                                'first_name' => $this->input->post('first_name', TRUE),
                                'last_name' => $this->input->post('last_name', TRUE),
                                'phone' => $this->input->post('phone', TRUE),
                                'active' => $this->input->post('active', TRUE),
                                'ht' => $this->input->post('ht', TRUE),
                                'picture' => 'avatar_default.png',
                                );
            $proces =   $this->alus_auth->register($username, $password, $email, $additional_data,$group);

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
            header('Content-Type: application/json');
			echo json_encode(array("status" => FALSE,"msg" => "You Dont Have Permission"));
		}
		else
		{

        $this->form_validation->set_rules('id', 'id', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim');
        $this->form_validation->set_rules('phone', 'Phone', 'numeric');
        $this->form_validation->set_rules('group[]', 'Group', 'required');
        if($this->input->post('email') != $this->input->post('elama'))
        {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback__emailUnique[email]');
        }
        if($this->input->post('password') != "")
        {
        	 $this->form_validation->set_rules('password', 'Password', 'required|trim|callback__notMatch[re_password]|min_length[' . $this->config->item('min_password_length', 'alus_auth') . ']|max_length[' . $this->config->item('max_password_length', 'alus_auth') . ']');
        }

        if ($this->form_validation->run() == true)
        {
           		$id = $this->input->post('id', TRUE);
           		$email = $this->alus_auth->encrypt($this->input->post('email'));
                $data = array(
                	'username' => $this->input->post('username'),
                    'job_title' => $this->input->post('job'),
                    'abc' => $email,
                    'first_name' => $this->input->post('first_name'),
                    'last_name'  => $this->input->post('last_name'),
                    'phone'      => $this->input->post('phone'),
                    'active'     => $this->input->post('active'),
                    'ht'     => $this->input->post('ht')
                    
                );
                // update the password if it was posted
                if ($this->input->post('password') != "")
                {
                    $data['ghi'] = $this->input->post('password');
                }
                $groupData = $this->input->post('group');
                if (isset($groupData) && !empty($groupData)) {
                        $this->alus_auth->remove_from_group('', $id);
                        foreach ($groupData as $grp) {
                            $this->alus_auth->add_to_group($grp, $id);
                        }
                    }

                $this->alus_auth->update($id, $data);

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
            header('Content-Type: application/json');
			echo json_encode(array("status" => FALSE,"msg" => "You Dont Have Permission"));

		}else
		{

			if($this->session->userdata('user_id') == $id)
			{
				echo json_encode(array("status" => FALSE,"msg" => "You Cant kill yourself !"));
			}else
			{
				$proces = $this->alus_auth->delete_user($id);
        		echo json_encode(array("status" => TRUE));			
			}
		}

		

    }
}

/* End of file  Home.php */
/* Location: ./application/controllers/ Home.php */