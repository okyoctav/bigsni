<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class Forgot_password extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Forgot_model','model');
	}
		

	public function index()
	{
	
		if($this->alus_auth->logged_in())
         {
         	redirect('admin/Login','refresh');
		}else
		{
			$this->load->view('index');
		}
	}

	public function actiongo()
	{
		$emai = $this->input->post('fp_email', TRUE);
		$email = $this->alus_auth->encrypt($emai);
		$cek = $this->model->cek($email);
		if($cek->num_rows() > 0)
		{
			$forgotten = $this->alus_auth->forgotten_password($email);
				if ($forgotten) { 
					$row = $this->model->get_forgot_act($email);
				//	$this->load->library('email');
					// proses kirim email
						$isi = '<html>';
						$isi .= '<div style="padding: 10px 100px 10px 100px;">';
						$isi .= '<P align="middle"><img src="'.base_url().'assets/dist/img/logo.png" alt="Alus" width="255" height="100"></P>';
						$isi .= '<h1>Recovery Password Akun</h1>';
						$isi .= '<p align="left">Hi '.$row->first_name." ".$row->last_name.'</p>'; 
						$isi .= '<p align="left">Kami menerima permohonan bahwa Anda lupa kata sandi dan ingin mendapatkan kata sandi Anda kembali.</p>';
						$isi .= '<p align="left">Apabila benar Anda telah mengirimkan permohonan ini, silakan klik link ini, atau salin URL di bawah ke Internet Browser Anda.</p>';
						$isi .= '<p align="left"><strong>URL</strong> : </p>';
						$isi .= '<p align="left"><strong><a href="'.base_url().'recovery_password?activation_key='.$row->jkl.'">KLIK DISINI </a></strong></p>';
						$isi .= '<br/>';
						$isi .= '<hr/>';
						$isi .= '<p align="left">Untuk pertanyaan lebih lanjut, silahkan kirim email ke </p>';
						$isi .= '<p align="left">info@alus.co</p>';
						$isi .= '<p align="left">Terima Kasih,</p>';
						$isi .= '<p align="left"><strong>ALUS.CO - Your best partner</strong></p>';
						$isi .= '</div></html>';

				//		$this->email->from('your@example.com', 'Alus Solution');
				//		$this->email->to($email);
				//		$this->email->cc('maulana.code@gmail.com');
				//		$this->email->bcc('them@their-example.com');
				//		
				//		$this->email->subject('Recovery Password');
				//		$this->email->message($isi);
//
				//	$this->email->send();

					echo $isi;
				}
				else {
					
					echo "FALSE";
				}
		}else{
			echo "FALSE";
		}
	}

	public function recov()
	{
		if(! isset($_GET['activation_key']))
		{
			echo "Activation Code Error ! ";
			
		}else{
			
			$code = $_GET['activation_key'];
			$reset = $this->alus_auth->forgotten_password_complete($code);
			if ($reset) {

				$data['new'] = $reset;
				$data['message'] =  $this->alus_auth->messages();
				$this->load->view('recov',$data);	
			}
			else{
				$this->session->set_flashdata('message', $this->alus_auth->messages());
				redirect('admin/Login');	
			}
		}
	}

	public function reset()
	{
		$password = $this->input->post('password', TRUE);
		$activation = $this->input->post('act', TRUE);
	}
}

/* End of file  Home.php */
/* Location: ./application/controllers/ Home.php */