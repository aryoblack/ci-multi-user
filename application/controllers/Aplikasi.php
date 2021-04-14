<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * Create By : Aryo
 * Youtube : Aryo Coding
 */
class Aplikasi extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_aplikasi');
        
	}

	public function index()
	{
		$this->template->load('layoutbackend', 'admin/aplikasi');
	}

	    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_aplikasi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $apl) {
            $no++;
            $row = array();
            $row[] = $apl->nama_owner;
            $row[] = $apl->alamat;
            $row[] = $apl->tlp;
            $row[] = $apl->title;
            $row[] = $apl->nama_aplikasi;
            $row[] = $apl->copy_right;
            $row[] = $apl->versi;
            $row[] = $apl->tahun;
            $row[] = $apl->logo;  
            $row[] = $apl->id;
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mod_aplikasi->count_all(),
                        "recordsFiltered" => $this->Mod_aplikasi->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function edit_aplikasi($id)
    {
            
            $data = $this->Mod_aplikasi->getAplikasi($id);
            echo json_encode($data);
        
    }

        public function update()
    {
        if(!empty($_FILES['imagefile']['name'])) {
        $this->_validate();
        $id = $this->input->post('id');
        
        $nama = slug($this->input->post('logo'));
        $config['upload_path']   = './assets/foto/logo/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '1000';
        $config['max_width']     = '2000';
        $config['max_height']    = '1024';
        $config['file_name']     = $nama; 
        
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('imagefile')){
            $gambar = $this->upload->data();
            $save  = array(
                'nama_owner' => $this->input->post('nama_owner'),
                'title' => $this->input->post('title'),
                'nama_aplikasi'  => $this->input->post('nama_aplikasi'),
                'copy_right'  => $this->input->post('copy_right'),
                'tahun' => $this->input->post('tahun'),
                'versi' => $this->input->post('versi'),
                'logo' => $gambar['file_name']
            );
            
            $g = $this->Mod_aplikasi->getImage($id)->row_array();

            if ($g != null) {
                //hapus gambar yg ada diserver
                unlink('assets/foto/logo/'.$g['logo']);
            }
           
            $this->Mod_aplikasi->updateAplikasi($id, $save);
            echo json_encode(array("status" => TRUE));
            }else{//Apabila tidak ada gambar yang di upload
                $save  = array(
                'nama_owner' => $this->input->post('nama_owner'),
                'title' => $this->input->post('title'),
                'nama_aplikasi'  => $this->input->post('nama_aplikasi'),
                'copy_right'  => $this->input->post('copy_right'),
                'tahun' => $this->input->post('tahun'),
                'versi' => $this->input->post('versi')
            );
                $this->Mod_aplikasi->updateAplikasi($id, $save);
                echo json_encode(array("status" => TRUE));
            }
        }else{
            $this->_validate();
            $id = $this->input->post('id');
            $save  = array(
                'nama_owner' => $this->input->post('nama_owner'),
                'alamat'    => $this->input->post('alamat'),
                'tlp'       => $this->input->post('tlp'),
                'title' => $this->input->post('title'),
                'nama_aplikasi'  => $this->input->post('nama_aplikasi'),
                'copy_right'  => $this->input->post('copy_right'),
                'tahun' => $this->input->post('tahun'),
                'versi' => $this->input->post('versi')
            );
            $this->Mod_aplikasi->updateAplikasi($id, $save);
            echo json_encode(array("status" => TRUE));
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nama_owner') == '')
        {
            $data['inputerror'][] = 'nama_owner';
            $data['error_string'][] = 'Nama PT Tidak Boleh kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('nama_aplikasi') == '')
        {
            $data['inputerror'][] = 'nama_aplikasi';
            $data['error_string'][] = 'Nama Aplikasi Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('alamat') == '')
        {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('tlp') == '')
        {
            $data['inputerror'][] = 'tlp';
            $data['error_string'][] = 'No Telpon Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('title') == '')
        {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Title Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('copy_right') == '')
        {
            $data['inputerror'][] = 'copy_right';
            $data['error_string'][] = 'Copy Right tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('tahun') == '')
        {
            $data['inputerror'][] = 'tahun';
            $data['error_string'][] = 'Tahun tidak boleh kosong';
            $data['status'] = FALSE;
        }


        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }


     public function download()
        {
            
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Nama Aplikasi');
            $sheet->setCellValue('C1', 'Nama Owner');
            $sheet->setCellValue('D1', 'No Telp');
            $sheet->setCellValue('E1', 'Title');
            $sheet->setCellValue('F1', 'Copy Right');
            $sheet->setCellValue('G1', 'Alamat');

            $aplikasi = $this->Mod_aplikasi->getAll()->result();
            $no = 1;
            $x = 2;
            foreach($aplikasi as $row)
            {
                $sheet->setCellValue('A'.$x, $no++);
                $sheet->setCellValue('B'.$x, $row->nama_aplikasi);
                $sheet->setCellValue('C'.$x, $row->nama_owner);
                $sheet->setCellValue('D'.$x, $row->tlp);
                $sheet->setCellValue('E'.$x, $row->title);
                $sheet->setCellValue('F'.$x, $row->copy_right);
                $sheet->setCellValue('G'.$x, $row->alamat);
                $x++;
            }
            $writer = new Xlsx($spreadsheet);
            $filename = 'laporan-Aplikasi';
            
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
            header('Cache-Control: max-age=0');
    
            $writer->save('php://output');
        }
   
}