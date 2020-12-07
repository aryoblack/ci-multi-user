<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * Create BY ARYO
 * Youtube : Aryo Coding
 */

class Download extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_aplikasi');
    }

}