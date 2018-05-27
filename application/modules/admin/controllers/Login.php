<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->helper('captcha');
	}
		

	public function index()
	{
	
		if($this->alus_auth->logged_in())
         {
		 redirect('dashboard/','refresh');
		}else
		{	
			$this->load->view('index_login');
		}
	}

	public function login()
	{
		$this->data['title'] = "Login";
		//login attemp . jika sudah melampaui kesempatan ( jumlah kesempatan ada di config ) maka dilempar kembali ke halaman login . 
		if ($this->alus_auth->is_max_login_attempts_exceeded($this->input->post('identity')))
		{
				if($this->alus_auth->is_time_locked_out($this->input->post('identity')))
				{
					//$this->session->set_flashdata('message', 'You have too many login attempts. please wait 5 minutes and try again');
          			echo json_encode(array("status" => FALSE,"msg" => "You have too many login attempts. please wait 5 minutes and try again" ));
				}
		}

		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			
				//if the login is successful
				//redirect them back to the home page
				// mereset kesemepatan login
				if ($this->alus_auth->login($this->input->post('identity'), $this->input->post('password')))
				{
					$this->alus_auth->clear_login_attempts($this->input->post('identity'));
					//$this->get_token($this->input->post('identity'),$this->input->post('password'));
        			echo json_encode(array("status" => TRUE,"redirect" => base_url('dashboard'), "msg" => "Selamat Datang"));
				}else
				{
					// if the login was un-successful
					// redirect them back to the login page
					// saat gagal login, mengurangi sisa kesempatan .
        			//$this->session->set_flashdata('message', $this->alus_auth->errors());
        			echo json_encode(array("status" => FALSE,"msg" => $this->alus_auth->errors()));
				}		
		
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
      		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
      		//$this->session->set_flashdata('message', $this->data['message']);
      		echo json_encode(array("status" => FALSE,"msg" => $this->data['message']));
			
		}
	}

	public function logout()
	{
		// log the user out
		$logout = $this->alus_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->alus_auth->messages());
		redirect('admin/Login','refresh');
	}

	public function get_token($iden='admin@admin.com',$pass='badmin123.')
	{
		/*curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json' //mintanya json
            ));/**/

		/*$post = [
		    'identity' => $iden,
		    'password' => $pass,
		];

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://pusdiklatwas.bpkp.go.id:8099/reservasi/gettoken/login/login"); //ini endpointnya
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

		$as = json_decode($server_output);
		$this->session->set_userdata('tokens', $as->token);*/
		//$this->session->set_userdata('tokens','MTIzNDU2Nzg5MDEyMzQ1Nqn748RglvvtJ1UmiGCTdl8CmmAGgImqwSAjEcAM+iJlHZweoW/mjg==');
	}

	
}

/* End of file  Home.php */
/* Location: ./application/controllers/ Home.php */