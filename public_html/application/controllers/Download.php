<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {

		function __construct() {
 parent::__construct();
 $this->load->helper('form');
 $this->load->helper('url');
 $this->load->helper('security');
 $this->load->helper('language');
 $this->load->library('session');
 $this->load->library('encryption');
 $this->load->library('encrypt');
 $this->load->library('form_validation');
 $this->form_validation->set_error_delimiters('<div
 class="alert alert-warning" role="alert">', '</div>');
 //$this->lang->load('en_admin', 'english');
 $this->load->model('sdl_model');

 }

//************************************************************************

//************************************************************************
   public function index()
 {
        $data['title'] = 'Download';

   $this->load->view('download/download_view',$data);


 }
//************************************************************************
	
//************************** fin ****************************************
}