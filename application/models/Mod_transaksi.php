<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Create By : Aryo
* Youtube : Aryo Coding
*/
class Mod_transaksi extends CI_Model
{
	var $table = 'transaksi';
	var $column_search = array('a.no_trx','a.tgl_masuk','b.nama','a.tgl_ambil'); 
	var $column_order = array('a.no_trx','a.tgl_masuk','b.nama','a.tgl_ambil');
	var $order = array('id' => 'desc'); 
public function __construct()
{
	parent::__construct();
	$this->load->database();
}

private function _get_datatables_query()
{
	$this->db->select('a.*,b.nama');
	$this->db->from('transaksi a');
	$this->db->join('pelanggan b', 'b.id=a.id_pelanggan','left');
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
	$this->db->select('a.*,b.nama');
	$this->db->from('transaksi a');
	$this->db->join('pelanggan b', 'b.id=a.id_pelanggan','left');
	return $this->db->count_all_results();
}

    function getAll()
    {
       return $this->db->get('pelanggan');
    }

}