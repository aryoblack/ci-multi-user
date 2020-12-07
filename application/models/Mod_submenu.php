<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_submenu extends CI_Model {

    var $table = 'tbl_submenu';
    var $tblakses = 'tbl_akses_submenu';
    var $column_search = array('a.nama_submenu','a.link','b.nama_menu','a.is_active'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $column_order = array('nama_submenu','link','icon','nama_menu','is_active',null);
    var $order = array('id_submenu' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    private function _get_datatables_query($term='')
    {
        
        $this->db->select('a.*,b.nama_menu');
        $this->db->from('tbl_submenu as a');
        $this->db->join('tbl_menu as b','a.id_menu=b.id_menu');
        $this->db->like('a.nama_submenu',$term);
        $this->db->or_like('a.link',$term);
        $this->db->or_like('b.nama_menu',$term);
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
        $term = $_REQUEST['search']['value'];  
        $this->_get_datatables_query($term);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $term = $_REQUEST['search']['value'];  
        $this->_get_datatables_query($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        
        $this->db->from('tbl_submenu as a');
        $this->db->join('tbl_menu as b','a.id_menu=b.id_menu');
        return $this->db->count_all_results();
    }

    public function get_by_nama($nama_submenu)
    {
        $this->db->from($this->table);
        $this->db->where('nama_submenu',$nama_submenu);
        $query = $this->db->get();
        return $query->row();
    }
    function getAll()
    {
        $this->db->select('a.*,b.nama_menu');
        $this->db->join('tbl_menu b','a.id_menu=b.id_menu');
       return $this->db->get('tbl_submenu a');
    }
    function view_submenu($id)
    {	
    	$this->db->where('id_submenu',$id);
    	return $this->db->get('tbl_submenu');
    }

    function get_submenu($id)
    {   
        $this->db->where('id_submenu',$id);
        return $this->db->get('tbl_submenu')->row();
    }

    function edit_submenu($id)
    {	
    	$this->db->where('id_submenu',$id);
    	return $this->db->get('tbl_submenu');
    }

    function insertsubmenu($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function insert_akses_submenu($tbl_akses_submenu, $data)
    {
        $insert = $this->db->insert($tbl_akses_submenu, $data);
        return $insert;
    }

    function updatesubmenu($id, $data)
    {
        $this->db->where('id_submenu', $id);
        $this->db->update('tbl_submenu', $data);
    }
    function deletesubmenu($id, $table)
    {
        $this->db->where('id_submenu', $id);
        $this->db->delete($table);
    }

    function deleteakses($id, $tbl_akses_submenu){
        $this->db->where('id_submenu', $id);
        $this->db->delete($tbl_akses_submenu);
    }
}

/* End of file Mod_login.php */
