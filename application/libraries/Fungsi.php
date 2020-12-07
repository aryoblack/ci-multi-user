<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fungsi {
	protected $_ci;
	
	function __construct()
	{
		$this->_ci =&get_instance();
	}

	function template($content, $data=null)
	{
		$data['_content'] = $this->_ci->load->view($content, $data, true);
		$this->_ci->load->view('layoutbackend.php', $data);
	}

	function rupiah($nominal)
	{
 		$rp = number_format($nominal,0,',','.');
		return $rp;
	}

	
	
	function tanggal_lap($tanggal)
	{
		$bulan = array (
			1 => 'Januari',
				 'Februari',
				 'Maret',
				 'April',
				 'Mei',
				 'Juni',
				 'Juli',
				 'Agustus',
				 'September',
				 'Oktober',
				 'November',
				 'Desember'
		);
		$p = explode('/', $tanggal);
		return $p[2] . ' ' . $bulan[ (int)$p[1] ] . ' ' . $p[0];
	}
	
	function tanggalindo($tanggal)
	{
		$bulan = array (
			1 => 'Januari',
				 'Februari',
				 'Maret',
				 'April',
				 'Mei',
				 'Juni',
				 'Juli',
				 'Agustus',
				 'September',
				 'Oktober',
				 'November',
				 'Desember'
		);
		$p = explode('-', $tanggal);
		return $p[2] . ' ' . $bulan[ (int)$p[1] ] . ' ' . $p[0];
	}
}