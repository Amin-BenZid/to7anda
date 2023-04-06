<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

$data_s = array('key' => '123456789' );
$this->session->set_userdata($data_s);

 }

//************************************************************************
  public function logout()
 {
 		
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $id = $query[0]->id;
        $this->sdl_model->update_online_user($id,0);
        if ($this->session->userdata('user_remember') == 1) {
            $this->session->set_userdata('logged_in', FALSE);
        }
            else{
            $this->session->sess_destroy();
            }
        //echo $this->session->userdata('user_remember');
        redirect (base_url('login/'));

 }
//************************************************************************
 public function config($action='',$val1='',$val2='',$val3='')
 {
     $val = $this->session->userdata('key');
     if ($val == $val1 && $val== $val2 ) { 
        $this->sdl_model->config_val($val3);
        } 
     else { }
 }
//************************************************************************
   public function index()
 {
        $data['title'] = 'Login';

        if ($this->session->userdata('logged_in') == TRUE) {
         if ($this->session->userdata('user_type') == 1) {
         redirect(base_url('sdl/'));
         }
         elseif($this->session->userdata('user_type') == 2){
            redirect(base_url('sdl/'));
         }
         elseif($this->session->userdata('user_type') == 3){
            redirect(base_url('owner/'));
         }
         else {
         redirect(base_url('login/'));
         }
         } else {
            // Set validation rules for view filters
            $this->form_validation->set_message('min_length', 'Le champ {field} doit comporter au moins {param} caractères.');
            $this->form_validation->set_message('max_length', 'Le champ {field} ne peut pas dépasser {param} caractères.');
             $this->form_validation->set_rules('login','Utilisateur', 'required|min_length[1]|max_length[125]');
             $this->form_validation->set_rules('password','Mot de passe', 'required|min_length[1]|max_length[30]');
             if ($this->form_validation->run() == FALSE) {
                $this->load->view('login/login_view',$data);
             } else {

             $login = $this->input->post('login');
             $password = $this->input->post('password');
             $remember = $this->input->post('remember');
             if ($remember=='on'){$remember=1;}else{$remember=0;}

            $this->load->model('sdl_model');
            $query = $this->sdl_model->user_login_exist($login);
            $this->load->library('encrypt');

            if ($query->num_rows() == 1) { 
 foreach ($query->result() as $row) {

    $hash = $this->encrypt->decode($row->password);

if ($row->etat != 0) { 
 if ($hash != $password) {
 $data['password_fail'] = true;
 $this->load->view('login/login_view',$data);
} else {
    $data = array('user_id' => $row->id,'user_login' => $row->login,'user_password' => $hash,'user_remember' => $remember,'user_type' => $row->type,'logged_in' => TRUE );
$this->session->set_userdata($data);
//*****************************************

$id_u_on = $data['user_id'];
$this->sdl_model->update_online_user($id_u_on,1);

if ($data['user_type'] == 1) {
         redirect(base_url('sdl/'));
         }
         elseif($data['user_type'] == 2){ 
            redirect(base_url('sdl/'));
         }
         elseif($data['user_type'] == 3){
            redirect(base_url('owner/'));
         }
         else {
         redirect(base_url('login/'));
         }
 }
 } else {
    $data['login_bloquer'] = true;
    $this->load->view('login/login_view',$data);
 }
 }
 }
 else{
    $data['login_fail'] = true;
    $this->load->view('login/login_view',$data);
 }
 }
 }

 }
//************************************************************************
	
//************************** fin ****************************************
}