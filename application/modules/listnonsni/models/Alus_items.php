<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alus_items extends CI_Model {

	var $table = 'm_bigsni';
    var $idtable = 'mbs_id';
    var $column_order = array(
                                'mbs_id',
                                'mbs_syscode',
                                'mbs_namesni',
                                'mbs_kodesni',
                                'mbs_tanggal'
                            );
    var $column_search = array(
                                'mbs_id',
                                'mbs_syscode',
                                'mbs_namesni',
                                'mbs_kodesni',
                                'mbs_tanggal'
                            );

    var $order = array('mbs_id' => 'ASC');


    /* Server Side Data */
	/* Modified by : Maulana.code@gmail.com */
    private function _get_datatables_query()
    {
        
        $group = $this->session->userdata('group');
        $namagroup = $group[0]->name;

        $this->db->from($this->table);
        $this->db->where('mbs_type',2);
        //$this->db->join('(SELECT count(*) as jumlahtahap , mfs_mbs_id FROM m_file_sni GROUP BY mfs_mbs_id) A', 'm_bigsni.mbs_id = A.mfs_mbs_id', 'left');
        $this->db->join('(SELECT COUNT(*) as jumlahtahap,mfs_mbs_id FROM (SELECT * FROM m_file_sni GROUP BY mfs_mts_id,mfs_mbs_id) A GROUP BY mfs_mbs_id) A', 'm_bigsni.mbs_id = A.mfs_mbs_id', 'left');

        if($namagroup=='GS01')
        {
            $this->db->where('mbs_users', $this->session->userdata('user_id'));
        }
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $group = $this->session->userdata('group');
        $namagroup = $group[0]->name;

        $this->db->from($this->table);
         $this->db->where('mbs_type',2);
        if($namagroup=='GS01')
        {
            $this->db->where('mbs_users', $this->session->userdata('user_id'));
        }
        return $this->db->count_all_results();
    }

    /* end server side  */

    function getid($id)
    {
        $this->db->where($this->idtable, $id);
        return $this->db->get($this->table)->result();
    }

    function save($data)
    {
        return $this->db->insert($this->table, $data);
    }

    function edit($data)
    {
        $this->db->where($this->idtable, $this->input->post($this->idtable));
        return $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where($this->idtable, $id);
        return $this->db->delete($this->table);
    }
}

