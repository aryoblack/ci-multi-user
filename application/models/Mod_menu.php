<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_menu extends CI_Model {

    var $table = 'tbl_menu';
    var $tbl_akses_menu = 'tbl_akses_menu';
    var $column_order = array('nama_menu','link','icon','urutan','is_active');
    var $column_search = array('nama_menu','link','nama_menu','is_active'); 
    var $order = array('id_menu' => 'desc'); // default order 

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
        
        $this->db->from('tbl_menu');
        return $this->db->count_all_results();
    }



    function getAll()
    {
       return $this->db->get('tbl_menu');
    }

    function view_menu($id)
    {	
    	$this->db->where('id_menu',$id);
    	return $this->db->get('tbl_menu');
    }

    function get_nama_menu($nama_menu){
        $this->db->from($this->table);
        $this->db->where('nama_menu',$nama_menu);
        $query = $this->db->get();

        return $query->row();
    }

    function get_menu($id)
    {   
        $this->db->where('id_menu',$id);
        return $this->db->get('tbl_menu')->row();
    }

    function edit_menu($id)
    {	
    	$this->db->where('id_menu',$id);
    	return $this->db->get('tbl_menu');
    }

    function insertMenu($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    //khusus administrator
    function insertaksesmenu($tbl_akses_menu, $data)
    {
        $insert = $this->db->insert($tbl_akses_menu, $data);
        return $insert;
    }

    function updateMenu($id_menu, $data)
    {
        $this->db->where('id_menu', $id_menu);
        $this->db->update('tbl_menu', $data);
    }
    function deleteMenu($id, $table)
    {
        $this->db->where('id_menu', $id);
        $this->db->delete($table);
    }

    function deleteakses($id, $tbl_akses_menu){
        $this->db->where('id_menu', $id);
        $this->db->delete($tbl_akses_menu);
    }
    function deleteakses_submenu($id, $tbl_akses_submenu){
        $this->db->where('id_menu', $id);
        $this->db->delete($tbl_akses_submenu);
    }
}

/* End of file Mod_login.php */
