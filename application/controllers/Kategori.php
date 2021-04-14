<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Kategori extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model(array('Mod_kategori'));
	}

	public function index()
	{
		$this->load->helper('url');
        $this->template->load('layoutbackend','kategori');
	}

	 public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_kategori->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {
            $no++;
            $row = array();
            $row[] = $pel->id_kat;//array 0
            $row[] = $pel->nama_kat;//array 1
            $row[] = $pel->id_kat;//array 2
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mod_kategori->count_all(),
                        "recordsFiltered" => $this->Mod_kategori->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        $this->_validate();
        $kode= date('ymsi');
		$save  = array(
            'nama_kat'			=> $this->input->post('nama_kat')
        );
            $this->Mod_kategori->insert_kat("kategori", $save);
            echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id      = $this->input->post('id');
        $save  = array(
            'nama_kat' => $this->input->post('nama_kat')
        );
        $this->Mod_kategori->update_kat($id, $save);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_kat($id)
    {
            $data = $this->Mod_kategori->get_kat($id);
            echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Mod_kategori->delete_kat($id, 'kategori');        
        echo json_encode(array("status" => TRUE));
    }
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nama_kat') == '')
        {
            $data['inputerror'][] = 'nama_kat';
            $data['error_string'][] = 'Nama Barang Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}