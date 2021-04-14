<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');
        // backButtonHandle();
    }

    function index()
    {
    	$logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        }else{
        	$this->template->load('layoutbackend','dashboard/dashboard_data');
        }
        
    }

}
/* End of file Controllername.php */
 