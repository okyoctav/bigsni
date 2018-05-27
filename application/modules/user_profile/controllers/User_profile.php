<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class User_profile extends CI_Controller {

	private $privilege;

	public function __construct()
	{
		parent::__construct();

		if(!$this->alus_auth->logged_in())
		{
			redirect('admin/Login','refresh');
		}
		$this->privilege = $this->Alus_hmvc->cek_privilege($this->uri->segment(1));
        $this->load->library('upload');

	}


	public function index($id=null)
	{

		if($this->alus_auth->logged_in())
         {
            $head['title'] = "User Profile";
            $data['data'] = $this->alus_auth->user($this->session->userdata('id'))->row();

            $this->load->view('template/temaalus/header',$head);
            $this->load->view('index.php',$data);
            $this->load->view('template/temaalus/footer');

		}else
		{
			redirect('admin/Login','refresh');
		}
	}

	public function update()
    {
        $config['upload_path'] = './assets/avatar/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']  = '2000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';
        $config['overwrite'] = TRUE;
        $config['file_name'] = time();


        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if($_FILES['userfile']['name'] != "")
        {
        if ( ! $this->upload->do_upload()){
            echo '<script type="text/javascript">alert("'.$this->upload->display_errors().'");window.location = "'.base_url('user_profile').'"</script>';
        }
        else{
             ////[ RESIZE IMAGE ]
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
            $config2['new_image'] = './assets/avatar';
            $config2['maintain_ratio'] = TRUE;
            $config2['create_thumb'] = TRUE;
            $config2['thumb_marker'] = '';
            $config2['width'] = 100;
            $config2['height'] = 100;
            $this->load->library('image_lib',$config2);
            if ( !$this->image_lib->resize()){
                $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
              }
            $data_upload = array('upload_data' => $this->upload->data());

            if($this->session->userdata('avatar') != 'avatar_default.png')
            {
                unlink('./assets/avatar/'.$this->session->userdata('avatar'));
            }
            //update session
            $this->session->set_userdata('avatar',$this->upload->file_name);


            $id = $this->input->post('id', TRUE);
            $email = $this->alus_auth->encrypt($this->input->post('email'));
            $data = array(
                        'abc' => $email,
                        'first_name' => $this->input->post('first_name'),
                        'last_name'  => $this->input->post('last_name'),
                        'phone'      => $this->input->post('phone'),
                        'picture'    => $data_upload['upload_data']['file_name']
                    );
            if ($this->input->post('password') != "")
            {
                if($this->input->post('password') != $this->input->post('repassword'))
                {
                    echo '<script type="text/javascript">alert("Password dan Re-password tidak sesuai");window.location = "'.base_url('user_profile').'"</script>';
                }else{
                    $data['ghi'] = $this->input->post('password');    
                }
            }

            $this->alus_auth->update($id, $data);
           echo '<script type="text/javascript">window.location = "'.base_url('user_profile').'"</script>';
        }
      }else{
            $id = $this->input->post('id', TRUE);
            $email = $this->alus_auth->encrypt($this->input->post('email'));
            $data = array(
                        'abc' => $email,
                        'first_name' => $this->input->post('first_name'),
                        'last_name'  => $this->input->post('last_name'),
                        'phone'      => $this->input->post('phone')
                    );
            if ($this->input->post('password') != "")
            {
                if($this->input->post('password') != $this->input->post('repassword'))
                {
                    echo '<script type="text/javascript">alert("Password dan Re-password tidak sesuai");window.location = "'.base_url('user_profile').'"</script>';
                }else{
                    $data['ghi'] = $this->input->post('password');    
                }
            }

            $this->alus_auth->update($id, $data);
           echo '<script type="text/javascript">window.location = "'.base_url('user_profile').'"</script>';

      }
    }
}

/* End of file  Home.php */
/* Location: ./application/controllers/ Home.php */