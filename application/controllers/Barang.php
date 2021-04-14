<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Barang extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model(array('Mod_barang'));
	}

	public function index()
	{
		$this->load->helper('url');
        $this->template->load('layoutbackend','barang');
	}

	 public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_barang->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pel) {
            $no++;
            $row = array();
            $row[] = $pel->kdbarang;
            $row[] = $pel->nama;
            $row[] = $pel->harga;
            $row[] = $pel->satuan;
            $row[] = $pel->id;
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mod_barang->count_all(),
                        "recordsFiltered" => $this->Mod_barang->count_filtered(),
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
			'kdbarang'  	=> $kode,
            'nama'			=> $this->input->post('nama'),
            'harga'  		=> $this->input->post('harga'),
            'satuan'   		=> $this->input->post('satuan')
        );
            $this->Mod_barang->insert_barang("barang", $save);
            echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $this->_validate();
        $id      = $this->input->post('id');
        $save  = array(
            'nama' => $this->input->post('nama'),
            'harga'      => $this->input->post('harga'),
            'satuan'      => $this->input->post('satuan')
        );
        $this->Mod_barang->update_barang($id, $save);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_barang($id)
    {
            $data = $this->Mod_barang->get_brg($id);
            echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Mod_barang->delete_brg($id, 'barang');        
        echo json_encode(array("status" => TRUE));
    }
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama Barang Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('harga') == '')
        {
            $data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Harga Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('satuan') == '')
        {
            $data['inputerror'][] = 'satuan';
            $data['error_string'][] = 'Satuan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}