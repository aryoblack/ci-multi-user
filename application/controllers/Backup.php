<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Create By 	: ARYO
 * Youtube 		: Aryo Coding
 */
class Backup extends CI_Controller
{
	
	public function backupdb()
	{
		$this->load->dbutil();
		$aturan = array(
			'format'	=> 'zip',
			'filename'	=> 'my_db_backup.sql'
		);

		$backup= $this->dbutil->backup($aturan);

		$nama_database = 'backup-on-'. date("Y-m-d-H-i-s").'.zip';
		$simpan= '/backup'.$nama_database;

		$this->load->helper('file');
		write_file($simpan, $backup);

		$this->load->helper('download');
		force_download($nama_database, $backup);
	}
}