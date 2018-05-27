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

            if($this->session->userdata('menus') != "")
            {
               return $this->session->userdata('menus');

            }else{
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
            }
         }else
         {
               redirect('admin/Login','refresh');
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
      $this->html[] = '<ul class="nav navbar-nav">';
      $this->html[] = '<li><a href="'.base_url().'dashboard" target="" ><i class="fa fa-home fa-fw" aria-hidden="true"></i> Home</a></li>';
      
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
               '%1$s<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="%5$s" aria-hidden="true"></i> %3$s <i class="fa fa-caret-right text-right" aria-hidden="true"></i></a>',
               $tab,   // %1$s = tabulation
               $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
               $option['value']['menu_nama'],   // %3$s = menu_nama
               $option['value']['menu_target'],   // %4$s = menu_target
               $option['value']['menu_icon']   // %5$s = menu_target
            );   
            }else{
               // HTML for menu item containing childrens (open)
               //ini buat yang di paling atas (navbar)

            $this->html[] = sprintf(
               '%1$s<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="%5$s" aria-hidden="true"></i> %3$s<b class="caret"></b></a>',
               $tab,   // %1$s = tabulation
               $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
               $option['value']['menu_nama'],   // %3$s = menu_nama
               $option['value']['menu_target'],   // %4$s = menu_target
               $option['value']['menu_icon']   // %5$s = menu_target
            );    
            }
            
            $this->html[] = $tab . "\t" . '<ul class="dropdown-menu">';
            
            array_push( $parent_stack, $option['value']['menu_parent'] );
            $parent = $option['value']['menu_id'];
         }
         else
            // HTML for menu item with no children (aka "leaf") 
            // yang navbar atas , 
            $this->html[] = sprintf(
               '%1$s<li><a href="'.base_url().'%2$s" target="%4$s"><i class="%5$s" aria-hidden="true"></i> %3$s</a></li>',
               str_repeat( "\t", ( count( $parent_stack ) + 1 ) * 2 - 1 ),   // %1$s = tabulation
               $option['value']['menu_uri'],   // %2$s = menu_uri (URL)
               $option['value']['menu_nama'],   // %3$s = menu_nama
               $option['value']['menu_target'],   // %4$s = menu_target
               $option['value']['menu_icon']   // %5$s = menu_target
            );
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



}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */