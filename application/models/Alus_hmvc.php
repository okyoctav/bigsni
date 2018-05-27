<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author     Maulana Rahman <maulana.code@gmail.com>
*/
class Alus_hmvc extends CI_Model {

   public function __construct()
   {
      parent::__construct();
      $this->alus_co  = $this->config->item('alus', 'alus_auth');
   }
   
   public function get_menu()
         {

         if($this->alus_auth->logged_in())
         { 

            /*if($this->session->userdata('menus') != "")
            {
               return $this->session->userdata('menus');

            }else{*/
               $group = $this->session->userdata('group');
               if (!$this->session->userdata('group')) {
                      $menu = "";
                     return $menu;
               }
                  
                  $this->db->distinct('id_menu');
                  $this->db->from($this->alus_co['alus_mga']);
                     foreach ($group as $key){
                     $grup[] = $key->id;
                  }
                  $this->db->where_in('id_group',$grup);  
                  $this->db->where('can_view', 1 );
   
                  $result = $this->db->get();
                  if($result->num_rows()>0)
                  {
                     foreach ($result->result() as $key) {
                        $menuid[] = $key->id_menu;
                     }
                     $this->db->where_in('menu_id',$menuid);  
                     $this->db->order_by('menu_parent', 'desc');
                     $this->db->order_by('order_num', 'ASC');
                  $nodes = $this->db->get($this->alus_co['alus_mg']);
                     foreach ($nodes->result_array() as $key) {
                        $assoc_all[] = $key;
                     } 
                  $menu = $this->get_menu_html($assoc_all, 0);

                 $this->session->set_userdata('menus', $menu);
                  return $menu;

                  }
                     else
                  {
                  $menu = "";
                  return $menu;  
                  };
            /*}*/
         }else
         {
               redirect('admin/Login','refresh');
         };

         }


         public function get_menu_home()
         {

               $this->db->from($this->alus_co['alus_mga']);
                  $this->db->where_in('id_group',7);  
                  $this->db->where('can_view', 1 );
   
                  $result = $this->db->get();
                  if($result->num_rows()>0)
                  {
                     foreach ($result->result() as $key) {
                        $menuid[] = $key->id_menu;
                     }
                     $this->db->where_in('menu_id',$menuid);  
                     $this->db->order_by('menu_parent', 'desc');
                     $this->db->order_by('order_num', 'ASC');
                  $nodes = $this->db->get($this->alus_co['alus_mg']);
                     foreach ($nodes->result_array() as $key) {
                        $assoc_all[] = $key;
                     } 
                  $menu = $this->get_menu_html2($assoc_all, 0);

                 $this->session->set_userdata('menus', $menu);
                  return $menu;

                  }
                     else
                  {
                  $menu = "";
                  return $menu;  
                  };


         }


      function get_menu_html($menu_list, $root_menu_id = 0 )
   {
      $this->html  = array();
      $this->items = $menu_list;
      
      foreach ( $this->items as $item )
         $children[$item['menu_parent']][] = $item;
      
      // loop will be false if the root has no children (i.e., an empty menu!)
      $loop = !empty( $children[$root_menu_id] );
      
      // initializing $parent as the root
      $parent = $root_menu_id;
      $parent_stack = array();
      
      // HTML wrapper for the menu (open)
      $this->html[] = '<ul class="sidebar-menu">';
      $this->html[] = '<li class="header">MAIN NAVIGATION</li>';
      if($this->uri->segment(1) == 'dashboard')
      {
         $this->html[] = '<li class="active"><a href="'.base_url().'dashboard" ><i class="fa fa-home fa-fw"></i> <span>Dashboard</span></a></li>';   
      }else{
         $this->html[] = '<li><a href="'.base_url().'dashboard" ><i class="fa fa-home fa-fw" ></i> <span>Dashboard</span></a></li>';
      }
      
      //print_r($children[$parent]);

      while ( $loop && ( ( $option = each( $children[$parent] ) ) || ( $parent > $root_menu_id ) ) )
      {
         if ( $option === false )
         {
            $parent = array_pop( $parent_stack );
            
            // HTML for menu item containing childrens (close)
            $this->html[] = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 ) . '</ul>';
            $this->html[] = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ) . '</li>';
         }
         elseif ( !empty( $children[$option['value']['menu_id']] ) )
         {
            $tab = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 );
            if(count($parent_stack) == 1)
            {
               $this->html[] = sprintf(
               '%1$s<li><a href="#"><i class="%5$s"></i> %3$s <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>',
               $tab,   // %1$s = tabulation
               $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
               $option['value']['menu_nama'],   // %3$s = menu_nama
               $option['value']['menu_target'],   // %4$s = menu_target
               $option['value']['menu_icon']   // %5$s = menu_target
            );   
            }else{
               // HTML for menu item containing childrens (open)
               //ini buat yang di paling atas (navbar)

            $get_menu_ya = $this->db->query('SELECT
A.menu_nama as menu_utama,
A.menu_uri as menu_utama_uri,
B.menu_nama as menu_parent,
B.menu_uri as menu_parent_uri,
C.menu_nama as menu_parent_parent,
C.menu_uri as menu_parent_parent_uri
FROM 
alus_mg A
LEFT JOIN alus_mg B ON A.menu_parent = B.menu_id
LEFT JOIN alus_mg C ON B.menu_parent = C.menu_id');

            foreach ($get_menu_ya->result() as $key => $value_menu_ya) {
               
               if($value_menu_ya->menu_utama_uri==$this->uri->segment(1))
               {
                     $menu_master = $value_menu_ya->menu_parent;
                     $menu_master_king =$value_menu_ya->menu_parent_parent;
                     break;
               }
               else
               {
                      $menu_master = ''; 
                      $menu_master_king = ''; 
               }
            }

             

            if($option['value']['menu_nama']==$menu_master_king)
            {
                $this->html[] = sprintf(
               '%1$s<li class="treeview menu-open active"><a href="#"><i class="%5$s" aria-hidden="true"></i><span> %3$s </span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>',
               
               $tab,   // %1$s = tabulation
               $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
               $option['value']['menu_nama'],   // %3$s = menu_nama
               $option['value']['menu_target'],   // %4$s = menu_target
               $option['value']['menu_icon']   // %5$s = menu_target
               );
            }
            else
            {
                $this->html[] = sprintf(
               '%1$s<li class="treeview"><a href="#"><i class="%5$s" aria-hidden="true"></i><span> %3$s </span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>',
               
               $tab,   // %1$s = tabulation
               $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
               $option['value']['menu_nama'],   // %3$s = menu_nama
               $option['value']['menu_target'],   // %4$s = menu_target
               $option['value']['menu_icon']   // %5$s = menu_target
               );
            }

               
            }

            if($option['value']['menu_nama']==$menu_master)
            {
               $ya = 'style="display: block;"';
            }
            else
            {
               $ya = '';
            }

            $pupu = '';
            $this->html[] = $tab . "\t" . '<ul class="treeview-menu menu-open"'.$ya.'>';
            
            
            
            array_push( $parent_stack, $option['value']['menu_parent'] );
            $parent = $option['value']['menu_id'];
         }
         else
            // HTML for menu item with no children (aka "leaf") 
            // yang navbar atas gada anak, 
            if($option['value']['menu_uri'] == $this->uri->segment(1))
            {
               $this->html[] = sprintf(
                  '%1$s<li class="active"><a href="'.base_url().'%2$s" target="%4$s"><i class="%5$s" ></i><span> %3$s</span></a></li>',
                  str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ),   // %1$s = tabulation
                  $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
                  $option['value']['menu_nama'],   // %3$s = menu_nama
                  $option['value']['menu_target'],   // %4$s = menu_target
                  $option['value']['menu_icon']   // %5$s = menu_target
               );   
            }else{
               $this->html[] = sprintf(
                  '%1$s<li><a href="'.base_url().'%2$s" target="%4$s"><i class="%5$s" aria-hidden="true"></i><span> %3$s</span></a></li>',
                  str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ),   // %1$s = tabulation
                  $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
                  $option['value']['menu_nama'],   // %3$s = menu_nama
                  $option['value']['menu_target'],   // %4$s = menu_target
                  $option['value']['menu_icon']   // %5$s = menu_target
               ); 
            }
            
      }
      
      // HTML wrapper for the menu (close)
      $this->html[] = '</ul>';
      
      return implode( "\r\n", $this->html );
   }

   function get_menu_html2($menu_list, $root_menu_id = 0 )
   {
      $this->html  = array();
      $this->items = $menu_list;
      
      foreach ( $this->items as $item )
         $children[$item['menu_parent']][] = $item;
      
      // loop will be false if the root has no children (i.e., an empty menu!)
      $loop = !empty( $children[$root_menu_id] );
      
      // initializing $parent as the root
      $parent = $root_menu_id;
      $parent_stack = array();
      
      // HTML wrapper for the menu (open)
      $this->html[] = '<ul id="lesun_navigation" class="sidebar-menu">';
      //$this->html[] = '<li class="header">MAIN NAVIGATION</li>';
      if($this->uri->segment(1) == 'dashboard')
      {
         //$this->html[] = '<li class="active"><a href="'.base_url().'dashboard" ><i class="fa fa-home fa-fw"></i> <span>Dashboard</span></a></li>';   
      }else{
         //$this->html[] = '<li><a href="'.base_url().'dashboard" ><i class="fa fa-home fa-fw" ></i> <span>Dashboard</span></a></li>';
      }

      $this->html[] = '<li class="current-page-item"><a href="">Home</a></li>';
      
      //print_r($children[$parent]);

      while ( $loop && ( ( $option = each( $children[$parent] ) ) || ( $parent > $root_menu_id ) ) )
      {
         if ( $option === false )
         {
            $parent = array_pop( $parent_stack );
            
            // HTML for menu item containing childrens (close)
            $this->html[] = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 ) . '</ul>';
            $this->html[] = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ) . '</li>';
         }
         elseif ( !empty( $children[$option['value']['menu_id']] ) )
         {
            $tab = str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 );
            if(count($parent_stack) == 1)
            {
               $this->html[] = sprintf(
               '%1$s<li><a href="#"><i class="%5$s"></i> %3$s <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>',
               $tab,   // %1$s = tabulation
               $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
               $option['value']['menu_nama'],   // %3$s = menu_nama
               $option['value']['menu_target'],   // %4$s = menu_target
               $option['value']['menu_icon']   // %5$s = menu_target
            );   
            }else{
               // HTML for menu item containing childrens (open)
               //ini buat yang di paling atas (navbar)

            $get_menu_ya = $this->db->query('SELECT
A.menu_nama as menu_utama,
A.menu_uri as menu_utama_uri,
B.menu_nama as menu_parent,
B.menu_uri as menu_parent_uri,
C.menu_nama as menu_parent_parent,
C.menu_uri as menu_parent_parent_uri
FROM 
alus_mg A
LEFT JOIN alus_mg B ON A.menu_parent = B.menu_id
LEFT JOIN alus_mg C ON B.menu_parent = C.menu_id');

            foreach ($get_menu_ya->result() as $key => $value_menu_ya) {
               
               if($value_menu_ya->menu_utama_uri==$this->uri->segment(1))
               {
                     $menu_master = $value_menu_ya->menu_parent;
                     $menu_master_king =$value_menu_ya->menu_parent_parent;
                     break;
               }
               else
               {
                      $menu_master = ''; 
                      $menu_master_king = ''; 
               }
            }

             

            if($option['value']['menu_nama']==$menu_master_king)
            {
                $this->html[] = sprintf(
               '%1$s<li class="treeview menu-open active"><a href="#"><i class="%5$s" aria-hidden="true"></i><span> %3$s </span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>',
               
               $tab,   // %1$s = tabulation
               $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
               $option['value']['menu_nama'],   // %3$s = menu_nama
               $option['value']['menu_target'],   // %4$s = menu_target
               $option['value']['menu_icon']   // %5$s = menu_target
               );
            }
            else
            {
                $this->html[] = sprintf(
               '%1$s<li class="treeview"><a href="#"><i class="%5$s" aria-hidden="true"></i><span> %3$s </span> <span class="pull-right-container"><i class="fa fa-angle-down"></i></span></a>',
               
               $tab,   // %1$s = tabulation
               $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
               $option['value']['menu_nama'],   // %3$s = menu_nama
               $option['value']['menu_target'],   // %4$s = menu_target
               $option['value']['menu_icon']   // %5$s = menu_target
               );
            }

               
            }

            if($option['value']['menu_nama']==$menu_master)
            {
               $ya = 'style="display: block;"';
            }
            else
            {
               $ya = '';
            }

            $pupu = '';
            $this->html[] = $tab . "\t" . '<ul class="treeview-menu menu-open"'.$ya.'>';
            
            
            
            array_push( $parent_stack, $option['value']['menu_parent'] );
            $parent = $option['value']['menu_id'];
         }
         else
            // HTML for menu item with no children (aka "leaf") 
            // yang navbar atas gada anak, 
            if($option['value']['menu_uri'] == $this->uri->segment(1))
            {
               $this->html[] = sprintf(
                  '%1$s<li class="active"><a href="'.base_url().'%2$s" target="%4$s"><i class="%5$s" ></i><span> %3$s</span></a></li>',
                  str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ),   // %1$s = tabulation
                  $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
                  $option['value']['menu_nama'],   // %3$s = menu_nama
                  $option['value']['menu_target'],   // %4$s = menu_target
                  $option['value']['menu_icon']   // %5$s = menu_target
               );   
            }else{
               $this->html[] = sprintf(
                  '%1$s<li ><a href="'.base_url().'%2$s" target="%4$s"><i class="%5$s" aria-hidden="true"></i><span> %3$s</span></a></li>',
                  str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ),   // %1$s = tabulation
                  $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
                  $option['value']['menu_nama'],   // %3$s = menu_nama
                  $option['value']['menu_target'],   // %4$s = menu_target
                  $option['value']['menu_icon']   // %5$s = menu_target
               ); 
            }
            
      }
      
      // HTML wrapper for the menu (close)
      $this->html[] = '</ul>';
      
      return implode( "\r\n", $this->html );
   }

      function cek_privilege($menu_uri) //return array (can_add,can_edit,can_delete,can_view)
      {
         $group = $this->session->userdata('group');
         //get ht user
         $ht = $this->alus_auth->user($this->session->userdata('user_id'))->row()->ht;
         if($ht == '1')
         {
            date_default_timezone_set('Asia/Jakarta');
            $harini = date('Y-m-d H:i:s');
            $id = $this->cek_id_menu($menu_uri);
            if($id)
            {
               foreach ($group as $key){
                  $grup[] = $key->id;
               }
               $this->db->where_in('id_group',$grup);   
               $this->db->where('id_menu', $id);
               $hak = $this->db->get($this->alus_co['alus_mga']);
               if($hak->num_rows() > 0)
               {
                  foreach ($hak->result() as $key) {
                     $can_add[] = $key->can_add;
                     $can_edit[] = $key->can_edit;
                     $can_delete[] = $key->can_delete;
                     $can_view[] = $key->can_view;
                     $psv  = date('Y-m-d H:i:s',strtotime($key->psv));
                     $pev  = date('Y-m-d H:i:s',strtotime($key->pev));
                     $psed = date('Y-m-d H:i:s',strtotime($key->psed));
                     $peed = date('Y-m-d H:i:s',strtotime($key->peed));
                  }
                  // diantara period view
                  if($harini >= $psv && $harini <= $pev)
                  {
                     if(in_array('1', $can_view))
                     {
                        $view = 1;
                     }else
                     {
                        $view = 0;
                     }
                  }else
                  {
                     $view = 0;
                  }

                  if($harini >= $psed && $harini <= $peed)
                  {
                     if(in_array('1', $can_edit))
                     {
                        $edit = 1;
                     }else
                     {
                        $edit = 0;
                     }
                     if(in_array('1', $can_delete))
                     {
                        $delete = 1;
                     }else
                     {
                        $delete = 0;
                     }
                     if(in_array('1', $can_add))
                     {
                        $add = 1;
                     }else
                     {
                        $add = 0;
                     }
                  }else{
                     $edit = 0;
                     $delete = 0;
                     $add = 0;
                  }
                  $privil = array('can_add'=>$add,'can_edit'=>$edit,'can_delete'=>$delete,'can_view'=>$view);
                  return $privil;
               }else
               {
                  $privil = array('can_add'=>0,'can_edit'=>0,'can_delete'=>0,'can_view'=>0);
                  return $privil;   
               }

            }else{
               $privil = array('can_add'=>0,'can_edit'=>0,'can_delete'=>0,'can_view'=>0);
               return $privil;
            }

         }elseif($ht == '0')
         {
            $id = $this->cek_id_menu($menu_uri);
            if($id)
            {
               foreach ($group as $key){
                  $grup[] = $key->id;
               }
               $this->db->where_in('id_group',$grup);   
               $this->db->where('id_menu', $id);
               $hak = $this->db->get($this->alus_co['alus_mga']);
               if($hak->num_rows() > 0)
               {
                  foreach ($hak->result() as $key) {
                     $can_add[] = $key->can_add;
                     $can_edit[] = $key->can_edit;
                     $can_delete[] = $key->can_delete;
                     $can_view[] = $key->can_view;
                  }
                  if(in_array('1', $can_add))
                     {
                        $add = 1;
                     }else
                     {
                        $add = 0;
                     }
                  if(in_array('1', $can_edit))
                     {
                        $edit = 1;
                     }else
                     {
                        $edit = 0;
                     }
                  if(in_array('1', $can_delete))
                     {
                        $delete = 1;
                     }else
                     {
                        $delete = 0;
                     }
                  if(in_array('1', $can_view))
                     {
                        $view = 1;
                     }else
                     {
                        $view = 0;
                     }
                  $privil = array('can_add'=>$add,'can_edit'=>$edit,'can_delete'=>$delete,'can_view'=>$view);
                  return $privil;
               }else
               {
                  $privil = array('can_add'=>0,'can_edit'=>0,'can_delete'=>0,'can_view'=>0);
                  return $privil;   
               }

            }else{
               $privil = array('can_add'=>0,'can_edit'=>0,'can_delete'=>0,'can_view'=>0);
               return $privil;
            }

         }else
         {
            echo '<script type="text/javascript">alert("Error Saat mendapatkan hak akses ! Hubungi Administrator");</script>';
            redirect(base_url(),'refresh');
         }

      }

      function cek_id_menu($menu_uri) //jika ada return angka ,  jika tidak return false
      {
         $this->db->select('menu_id');
         $this->db->where('menu_uri', $menu_uri);
         $this->db->limit(1);
         $menu = $this->db->get($this->alus_co['alus_mg']);
         if($menu->num_rows() < 1)
         {
            return false;
         }else
         {
            return $menu->row()->menu_id;
         }
      }
      function cek_view_privilege($menu_uri) // return boolean
      {  

         date_default_timezone_set('Asia/Jakarta');
         $harini = date('Y-m-d H:i:s');
         $group = $this->session->userdata('group');
         $idmenus = $this->cek_id_menu($menu_uri);
         if(!$idmenus)
         {
            return false;
         }

         $this->db->from($this->alus_co['alus_mga']);
            foreach ($group as $key){
               $grup[] = $key->id;
            }
         $this->db->where_in('id_group',$grup);   
         $this->db->where('id_menu', $idmenus); 
         $result = $this->db->get();
         if($result->num_rows() > 0)
         {
            foreach ($result->result() as $key) {
               $can_view[] = $key->can_view;
               $psv  = date('Y-m-d H:i:s',strtotime($key->psv));
               $pev  = date('Y-m-d H:i:s',strtotime($key->pev));
            }
            $ht = $this->alus_auth->user($this->session->userdata('user_id'))->row()->ht;
            if($ht == '1')
            {
                  if($harini >= $psv && $harini <= $pev)
                  {
                     if(in_array('1', $can_view))
                     {
                        return true;
                     }else
                     {
                        return false;
                     }
                  }else
                  {
                     return false;
                  }
               
            }else
            {
               if(in_array('1', $can_view))
               {
                  return true;
               }else
               {
                  return false;
               }
            }

         }else
         {
            return false;
         }
      }


      function ping_server()
      {
         $serverurl = exec('ping www.google.com');

         $string  = $serverurl;
         $start   = 'Maximum = ';
         $end     = ', Average';
         //Ping Server
          


         $string = ' ' . $string;
         $ini = strpos($string, $start);
         if ($ini == 0) return '';
         $ini += strlen($start);
         $len = strpos($string, $end, $ini) - $ini;
         return substr($string, $ini, $len);
      }


      function format_nip($nip)
      {
         if(strlen(trim($nip)) != 18)
         {
            /*karena bukan 18 karakter maka dibalikan seperti aslinya */
            return $nip;
         }else{
            /*lakukan formating*/
            $number = $nip;

            $awal = substr($number,0,8);
            $kedua = substr($number,8,6);
            $ketiga = substr($number,14,1);
            $keempat = substr($number,15);
            
            return $awal." ".$kedua." ".$ketiga." ".$keempat;
         }
      }

   function cUrlGetData($url, $post_fields = null, $headers = null) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($post_fields && !empty($post_fields)) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    }
    if ($headers && !empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    return $data;
}
}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */