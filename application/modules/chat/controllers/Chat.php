<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/

class Chat extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		/*$this->load->model('Group_model','model');*/

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
         	$head['title'] = "Chat";
     		
		 	$this->load->view('template/temaalus/header',$head);
		 	$this->load->view('index.php');
		 	$this->load->view('template/temaalus/footer');
		}else
		{
			redirect('admin/Login','refresh');
		}
	}
	public function proces_chat()
	{
	$function = $_POST['function'];
    $log = array();
    
    switch($function) {
    
    	 case('getState'):
            if($_POST['tipe'] == "ZZ")
            {
                 if(file_exists('assets/temaalus/dist/chat/chat.txt')){
                    $lines = file('assets/temaalus/dist/chat/chat.txt');
                }    
            }else{
                if(file_exists('assets/temaalus/dist/chat/'.$_POST['tipe'].'.txt')){
                    $lines = file('assets/temaalus/dist/chat/'.$_POST['tipe'].'.txt');
                }elseif(file_exists('assets/temaalus/dist/chat/'.$_POST['tipedua'].'.txt')){
                    $lines = file('assets/temaalus/dist/chat/'.$_POST['tipedua'].'.txt');
                }else{
                    fopen('assets/temaalus/dist/chat/'.$_POST['tipe'].'.txt', "w+");
                    $lines = file('assets/temaalus/dist/chat/'.$_POST['tipe'].'.txt');
                }
            }
                     $log['state'] = count($lines);
                     $text= array();
                     foreach ($lines as $line_num => $line)
                       {
                            $text[] =  $line = str_replace("\n", "", $line);      
                        }
                     $log['text'] = $text; 
        	 break;	
    	
    	 case('update'):
        	$state = $_POST['state'];
            if($_POST['tipe'] == "ZZ")
            {
                 if(file_exists('assets/temaalus/dist/chat/chat.txt')){
                    $lines = file('assets/temaalus/dist/chat/chat.txt');
                }    
            }else{
                 if(file_exists('assets/temaalus/dist/chat/'.$_POST['tipe'].'.txt')){
                    $lines = file('assets/temaalus/dist/chat/'.$_POST['tipe'].'.txt');
                }elseif(file_exists('assets/temaalus/dist/chat/'.$_POST['tipedua'].'.txt')){
                    $lines = file('assets/temaalus/dist/chat/'.$_POST['tipedua'].'.txt');
                }else{
                    fopen('assets/temaalus/dist/chat/'.$_POST['tipe'].'.txt', "w+");
                    $lines = file('assets/temaalus/dist/chat/'.$_POST['tipe'].'.txt');
                }
            }
        	 $count = count($lines);
        	if($state == $count){
                 $log['state'] = $state;
                 $log['text'] = false;
                 
                 }
                 else{
                     $text= array();
                     $log['state'] = $state + count($lines) - $state;
                     foreach ($lines as $line_num => $line)
                       {
                           if($line_num >= $state){
                         $text[] =  $line = str_replace("\n", "", $line);
                           }
         
                        }
                     $log['text'] = $text; 
                 }
        	  
             break;
    	 
    	 case('send'):
		  $nickname = htmlentities(strip_tags($_POST['nickname']));
			 $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
			  $message = htmlentities(strip_tags($_POST['message']), ENT_COMPAT, 'UTF-8');
		 if(($message) != "\n"){
        	
			 if(preg_match($reg_exUrl, $message, $url)) {
       			$message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
				}
            if($_POST['tipe'] == "ZZ")           
            {
                 fwrite(fopen('assets/temaalus/dist/chat/chat.txt', 'a'),"<div class='direct-chat-msg'><div class='direct-chat-info clearfix'><span class='direct-chat-name pull-left'>". $nickname ."</span><span class='direct-chat-timestamp pull-right'>".gmdate("d-F-Y H:i:s",time()+60*60*7)."</span></div><img class='direct-chat-img' src='assets/temaalus/dist/img/avatar5.png' alt='Image Pic'><div class='direct-chat-text'>". $message = str_replace("\n", " ", $message) . "</div></div> \n"); 

            }else{

                if(file_exists('assets/temaalus/dist/chat/'.$_POST['tipe'].'.txt')){
                    fwrite(fopen('assets/temaalus/dist/chat/'.$_POST['tipe'].'.txt', 'a'),"<div class='direct-chat-msg'><div class='direct-chat-info clearfix'><span class='direct-chat-name pull-left'>". $nickname ."</span><span class='direct-chat-timestamp pull-right'>".gmdate("d-F-Y H:i:s",time()+60*60*7)."</span></div><img class='direct-chat-img' src='assets/temaalus/dist/img/avatar5.png' alt='Image Pic'><div class='direct-chat-text'>". $message = str_replace("\n", " ", $message) . "</div></div> \n");     
                }else{
                    fwrite(fopen('assets/temaalus/dist/chat/'.$_POST['tipedua'].'.txt', 'a'),"<div class='direct-chat-msg'><div class='direct-chat-info clearfix'><span class='direct-chat-name pull-left'>". $nickname ."</span><span class='direct-chat-timestamp pull-right'>".gmdate("d-F-Y H:i:s",time()+60*60*7)."</span></div><img class='direct-chat-img' src='assets/temaalus/dist/img/avatar5.png' alt='Image Pic'><div class='direct-chat-text'>". $message = str_replace("\n", " ", $message) . "</div></div> \n");     
                }
                }
    		 }
        	 break;
    	
    }
    
    echo json_encode($log);
	}
}

/* End of file X.php */
/* Location: ./application/modules/X/controllers/X.php */