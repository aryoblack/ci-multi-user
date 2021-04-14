<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_userlevel extends CI_Model {
	var $table = 'tbl_userlevel';
    var $tbl_akses_menu = 'tbl_akses_menu';
    var $tbl_akses_submenu = 'tbl_akses_submenu';
    var $column_order = array('id_level','nama_level');
    var $column_search = array('id_level','nama_level'); 
    var $order = array('id_level' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

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
        
        $this->db->from('tbl_userlevel');
        return $this->db->count_all_results();
    }

    function getuser($id_level)
    {
        $this->db->where('id_level',$id_level);
        $this->db->where('is_active','Y');
        $this->db->from('tbl_user');
        return $this->db->count_all_results();
    }

     function getAll()
    {   
        
        return $this->db->get('tbl_userlevel');
    }

    function insertlevel($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function view($id)
    {   
        $this->db->where('id_level',$id);
        return $this->db->get('tbl_userlevel');
    }

    function getUserlevel($id)
    {   
        $this->db->where("id_level", $id);
        return $this->db->get("tbl_userlevel")->row();
    }

    function update($id, $data)
    {
        $this->db->where('id_level', $id);
		$this->db->update('tbl_userlevel', $data);
    }
    

    function delete($id, $table)
    {
        $this->db->where('id_level', $id);
        $this->db->delete($table);
    }

    function getId($nama_level)
    {
        $this->db->from($this->table);
        $this->db->where('nama_level', $nama_level);
        $query = $this->db->get();
        return $query->row();
    }


    function getMenu()
    {
        $this->db->select('id_menu');
        return $this->db->get('tbl_menu');
    }

    function getSubmenu()
    {

        return $this->db->get('tbl_submenu');
    }

    function getIdsubmenu($id_menu)
    {
        $this->db->where('id_menu',$id_menu);
        return $this->db->get('tbl_submenu');
    }
    function insert_akses_menu($tbl_akses_menu, $data)
    {
        $insert = $this->db->insert($tbl_akses_menu, $data);
        return $insert;
    }

    function insert_akses_submenu($tbl_akses_submenu, $data)
    {
        $insert = $this->db->insert($tbl_akses_submenu, $data);
        return $insert;
    }

    function deleteakses($id, $tbl_akses_menu){
        $this->db->where('id_level', $id);
        $this->db->delete($tbl_akses_menu);
    }

    function deleteaksessubmenu($id, $tbl_akses_submenu){
        $this->db->where('id_level', $id);
        $this->db->delete($tbl_akses_submenu);
    }

    function view_akses_menu($id)
    {   
        $this->db->join('tbl_menu b','a.id_menu=b.id_menu');
        $this->db->where('id_level',$id);
        return $this->db->get('tbl_akses_menu a');
    }

    function akses_submenu($id)
    {   
        $this->db->select("a.*,b.id_menu,b.nama_submenu,c.nama_menu");
        $this->db->join('tbl_submenu b','a.id_submenu=b.id_submenu');
        $this->db->join('tbl_menu c','b.id_menu=c.id_menu');
        $this->db->where('a.id_level',$id);
        $this->db->group_by('a.id_submenu');
        return $this->db->get('tbl_akses_submenu a');
    }

    function update_aksesmenu($id, $data)
    {
       $this->db->where('id', $id);
       $this->db->update('tbl_akses_menu', $data);
    }
    function update_akses_submenu($id, $data)
    {
       $this->db->where('id', $id);
       $this->db->update('tbl_akses_submenu', $data);
    }
}