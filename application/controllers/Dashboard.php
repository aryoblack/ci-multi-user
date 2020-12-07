<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
    }

    function index()
    {
        $this->template->load('layoutbackend','dashboard/dashboard_data');
    }

}
/* End of file Controllername.php */
 