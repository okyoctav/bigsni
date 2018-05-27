<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class Enc extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('alus_auth');
	}

	public function index()
	{

		$this->load->view('index.php');
	}

     /* encrypt NAMA USER */
    public static function encrypt2()
    {
        $ci =& get_instance();
        $hasil = $ci->alus_auth->encrypt($_POST['teks']);
        echo json_encode($hasil);
    }
    /* end */
    
    /* decrypt nama */
    public static function decrypt2()
    {
        $ci =& get_instance();
        $hasil = $ci->alus_auth->decrypt($_POST['teks']);
        echo json_encode($hasil);
    }
    /* end decrypt email */

    public function hspas()
    {
        $pw = $_POST['pw'];
        $slt = $_POST['slt'];

        if($slt != '')
        {
            $new = $this->alus_auth->hash_password($pw, $slt);    
        }else
        {
            $new = $this->alus_auth->hash_password($pw);
        }
        
        echo json_encode($new);
        
    }
}

/* End of file  Home.php */
/* Location: ./application/controllers/ Home.php */