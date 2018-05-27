<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author 		Maulana Rahman <maulana.code@gmail.com>
*/
class Group_model extends CI_Model {

	var $table = 'alus_g';
    var $column_order = array('name','description',null);
    var $column_search = array('name','description');
    var $order = array('id' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->alus_co = $this->alus_auth->alus_co();
	}

	function del_ga($id)
	{
		$this->db->delete($this->alus_co['alus_mga'], array('id_group' => $id)); 
	}
    
	function upres($res)
	{
		return $this->db->insert_batch($this->alus_co['alus_mga'], $res);
	}

	function hak_akses_mod($id)
	{
		$this->db->where('id_group',$id);
		return $this->db->get($this->alus_co['alus_mga']);
	}
	function hak_akses_list()
	{
		return $this->db->get($this->alus_co['alus_mg']);
	}
	public function all_tree()
	{
		$nodes = $this->db->get($this->alus_co['alus_mg'])->result();
		return $this->getChildren($nodes, 0, 0);
	}
	public function getChildren($nodes ,$pid = 0, $depth = 0)
	{
		$tree = [];

		foreach($nodes as $node) {

			if ($node->menu_parent == $pid) {
				
				$node->menu_nama = $node->menu_nama;
                $node->order_num = str_repeat('---', $depth);
				$children   = $this->getChildren($nodes, $node->menu_id, ($depth + 1));
				$tree[]     = $node;

				if (count($children) > 0) {
					$tree   = array_merge($tree, $children);
				}
			}

		}

		return $tree;
	}

	/* Server Side Data */
	/* Modified by : Maulana.code@gmail.com */
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);

        $this->db->where('id_group', $id);
        $this->db->delete('alus_mga');
    }

}

/* End of file  */
/* Location: ./application/models/ */