<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Submenu extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_submenu','Mod_menu'));
        $this->load->model(array('Mod_userlevel'));
    }

    public function index()
    {
        $this->load->helper('url');
        $data['menu'] = $this->Mod_menu->getAll()->result();
        $this->template->load('layoutbackend','admin/submenu_data',$data);
    }

    public function ajax_list()
    {
        $list = $this->Mod_submenu->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $submenu) {
            $no++;
            $row = array();
            $row[] = $submenu->nama_submenu;
            $row[] = $submenu->link;
            $row[] = $submenu->icon;
            $row[] = $submenu->nama_menu;
            $row[] = $submenu->is_active;
            $row[] = $submenu->id_submenu;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_submenu->count_all(),
            "recordsFiltered" => $this->Mod_submenu->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }




    public function viewsubmenu()
    {
     $id = $this->input->post('id');
     $table = $this->input->post('table');
     $data_field = $this->db->field_data($table);
     $detail = $this->Mod_submenu->view_submenu($id)->result_array();
     $data=array(
        'table'=>$table,
        'data_field'=>$this->db->field_data($table),
        'data_table'=> $detail,
    );  
     $this->load->view('admin/view', $data);
     
 }

 public function editsubmenu($id)
 {
     
    $data = $this->Mod_submenu->get_submenu($id);
    echo json_encode($data);
    
}

public function insert()
{
 $this->_validate();
 $save  = array(
    'nama_submenu'	=> $this->input->post('nama_submenu'),
    'link'  	=> $this->input->post('link'),
    'icon'   	=> $this->input->post('icon'),
    'id_menu'  	=> $this->input->post('id_menu'),
    'is_active' => $this->input->post('is_active')
);
 $this->Mod_submenu->insertsubmenu("tbl_submenu", $save);
 $insert_id = $this->db->insert_id();
 /*$nama_submenu = $this->input->post('nama_submenu');
 $get_id= $this->Mod_submenu->get_by_nama($nama_submenu);*/
 $id_level = $this->session->userdata['id_level'];
 $levels = $this->Mod_userlevel->getAll()->result();
 foreach ($levels as $row) {
    $data = array(
        'id_submenu' => $insert_id,
        'id_level'   => $row->id_level,
    );
    $this->Mod_submenu->insert_akses_submenu("tbl_akses_submenu",$data);
}
echo json_encode(array("status" => TRUE));

}

public function update()
{
    
    $this->_validate();
    $id = $this->input->post('id');
    $data  = array(
        'nama_submenu' => $this->input->post('nama_submenu'),
        'link'      => $this->input->post('link'),
        'icon'      => $this->input->post('icon'),
        'id_menu'    => $this->input->post('id_menu'),
        'is_active' => $this->input->post('is_active')
    );
    $this->Mod_submenu->updatesubmenu($id, $data);
    echo json_encode(array("status" => TRUE));
    
}
public function delete()
{
    $id_submenu = $this->input->post('id_submenu');
    $this->Mod_submenu->deletesubmenu($id_submenu, 'tbl_submenu');
    $this->Mod_submenu->deleteakses($id_submenu, 'tbl_akses_submenu');
    $data['status'] = TRUE;
    echo json_encode($data);
    
}

public function download()
{
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama Submenu');
    $sheet->setCellValue('C1', 'Link');
    $sheet->setCellValue('D1', 'Icon');
    $sheet->setCellValue('E1', 'Menu');
    $sheet->setCellValue('F1', 'Is Active');

    $menu = $this->Mod_submenu->getAll()->result();
    $no = 1;
    $x = 2;
    foreach($menu as $row)
    {
        $sheet->setCellValue('A'.$x, $no++);
        $sheet->setCellValue('B'.$x, $row->nama_submenu);
        $sheet->setCellValue('C'.$x, $row->link);
        $sheet->setCellValue('D'.$x, $row->icon);
        $sheet->setCellValue('E'.$x, $row->nama_menu);
        $sheet->setCellValue('F'.$x, $row->is_active);
        $x++;
    }
    $writer = new Xlsx($spreadsheet);
    $filename = 'laporan-Submenu';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    
    $writer->save('php://output');
}


private function _validate()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('nama_submenu') == '')
    {
        $data['inputerror'][] = 'nama_submenu';
        $data['error_string'][] = 'Submenu is required';
        $data['minlength'] = '2';
        $data['status'] = FALSE;
    }

    if($this->input->post('link') == '')
    {
        $data['inputerror'][] = 'link';
        $data['error_string'][] = 'Link is required';
        $data['minlength'] = '2';
        $data['status'] = FALSE;
    }

    if($this->input->post('icon') == '')
    {
        $data['inputerror'][] = 'icon';
        $data['error_string'][] = 'Icon is required';
        $data['minlength'] = '2';
        $data['status'] = FALSE;
    }

    if($this->input->post('is_active') == '')
    {
        $data['inputerror'][] = 'is_active';
        $data['error_string'][] = 'Please select Is Active';
        $data['minlength'] = '2';
        $data['status'] = FALSE;
    }

    if($this->input->post('id_menu') == '')
    {
        $data['inputerror'][] = 'id_menu';
        $data['error_string'][] = 'Please select Menu';
        $data['minlength'] = '2';
        $data['status'] = FALSE;
    }

    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}
}