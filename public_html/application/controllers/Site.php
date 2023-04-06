<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

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
 class="alert alert-danger" align="center" role="alert"><i class="fa fa-exclamation-triangle fa-2x"></i><b>&nbsp;', '</b></div>');
 //$this->lang->load('en_admin', 'english');
  $this->session->set_userdata(array('annee_affiche' => "0"));
  $this->session->set_userdata(array('annee_aff_mess' => ''));
  $this->load->model('administration_model');
 }

	public function index()
	{
		$query_config = $this->administration_model->info_configuration();
		$data['query_config'] = $query_config;
		$data['titre'] = 'Accueil';
		$data['menu'] = 1;
		$this->load->view('site/common/header_view',$data);
		$this->load->view('site/accueil_view',$data);
		$this->load->view('site/common/footer_view',$data);
	}
	public function contact()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			//*****************************************************************
			$nom = $this->input->post('nom');
			$email = $this->input->post('email');
			$message = $this->input->post('message');
			date_default_timezone_set('Africa/Tunis');
			$date = date('Y-m-d');
			$time = date('H:i:s');
			//echo " ".$nom." ".$email." ".$message."<br/>";
			$data = array(
			'nom' => $nom,
			'email' => $email,
			'message' => $message,
			'date' => $date,
			'time' => $time
			);
			$this->administration_model->ajouter_contact_site($data);
			//*****************************************************************
		}
		$query_config = $this->administration_model->info_configuration();
		$data['query_config'] = $query_config;
		$tabjs = array('assets/scripts/site/js_contact.js');
		$data['tabjs'] = $tabjs;
		$data['titre'] = 'Contact';
		$data['menu'] = 6;
		$this->load->view('site/common/header_view',$data);
		$this->load->view('site/common/titre_page_view',$data);
		$this->load->view('site/contact_view',$data);
		$this->load->view('site/common/footer_view',$data);
	}
	public function mot_du_directeur()
	{
		$query_config = $this->administration_model->info_configuration();
		$data['query_config'] = $query_config;
		$data['titre'] = 'Mot du directeur';
		$data['menu'] = 3;

				
		$this->load->view('site/common/header_view',$data);
		$this->load->view('site/common/titre_page_view',$data);
		$this->load->view('site/mot_du_directeur_view',$data);
		//$this->load->view('site/construction_view',$data);
		$this->load->view('site/common/footer_view',$data);
	}

		public function fondateur()
	{
		$query_config = $this->administration_model->info_configuration();
		$data['query_config'] = $query_config;
		$data['titre'] = 'Fondateur de l’établissement';
		$data['menu'] = 2;

				
		$this->load->view('site/common/header_view',$data);
		$this->load->view('site/common/titre_page_view',$data);
		$this->load->view('site/fondateur_view',$data);
		//$this->load->view('site/construction_view',$data);
		$this->load->view('site/common/footer_view',$data);
	}
	
	public function login()
	{
		$query_config = $this->administration_model->info_configuration();
		$data['query_config'] = $query_config;
		$data['titre'] = 'Connectez-vous à votre compte';
		$data['menu'] = 7;

		if ($this->session->userdata('logged_in') == TRUE) {
		 if ($this->session->userdata('user_type') == 1) {
		 redirect(base_url('administration/'));
		 }
		 elseif($this->session->userdata('user_type') == 11){
		 	redirect(base_url('administration/'));
		 }
		 elseif($this->session->userdata('user_type') == 2){redirect(base_url('responsable/'));}
		 elseif($this->session->userdata('user_type') == 3){redirect(base_url('enseignant/'));}
		 else {
		 redirect(base_url('site/login/'));
		 }
		 } else {
		 	// Set validation rules for view filters
		 	$this->form_validation->set_message('min_length', 'Le champ {field} doit comporter au moins {param} caractères.');
		 	$this->form_validation->set_message('max_length', 'Le champ {field} ne peut pas dépasser {param} caractères.');
			 $this->form_validation->set_rules('login','Utilisateur', 'required|min_length[1]|max_length[125]');
			 $this->form_validation->set_rules('password','Mot de passe', 'required|min_length[1]|max_length[30]');
			 if ($this->form_validation->run() == FALSE) {
			    $this->load->view('site/common/header_view',$data);
				$this->load->view('site/common/titre_page_view',$data);
				$this->load->view('site/login_view',$data);
				$this->load->view('site/common/footer_view',$data);
			 } else {

			 $login = $this->input->post('login');
			 $password = $this->input->post('password');
			 $remember = $this->input->post('remember');
			 if ($remember=='on'){$remember=1;}else{$remember=0;}

			 //echo $config['encryption_key'];

			

			$this->load->model('users_model');
			$query = $this->users_model->users_login_exist($login);
			$this->load->library('encrypt');




			if ($query->num_rows() == 1) { // One matching row found
 foreach ($query->result() as $row) {

 	$hash = $this->encrypt->decode($row->password);

if ($row->etat != 0) { // See if the user is active or not
 // Compare the generated hash with that in the database
 if ($hash != $password) {
 // Didn't match so send back to login
 $data['password_fail'] = true;
 	$this->load->view('site/common/header_view',$data);
 	$this->load->view('site/common/titre_page_view',$data);
	$this->load->view('site/login_view',$data);
	$this->load->view('site/common/footer_view',$data);
} else {
	$data = array('user_login' => $row->login,'user_password' => $hash,'user_remember' => $remember,'user_type' => $row->type,'logged_in' => TRUE );
$this->session->set_userdata($data);

if ($data['user_type'] == 1) {
		 redirect(base_url('administration/'));
		 }
		 elseif($data['user_type'] == 11){
		 	redirect(base_url('administration/'));
		 }
		 elseif($data['user_type'] == 2){redirect(base_url('responsable/'));}
		 elseif($data['user_type'] == 3){redirect(base_url('enseignant/'));}
		 else {
		 redirect(base_url('site/login/'));
		 }


 }
 } else {
 // User currently inactive
 	$data['login_bloquer'] = true;
 	$this->load->view('site/common/header_view',$data);
 	$this->load->view('site/common/titre_page_view',$data);
	$this->load->view('site/login_view',$data);
	$this->load->view('site/common/footer_view',$data);
 }
 }
 }
 else{
 	$data['login_fail'] = true;
 	$this->load->view('site/common/header_view',$data);
 	$this->load->view('site/common/titre_page_view',$data);
	$this->load->view('site/login_view',$data);
	$this->load->view('site/common/footer_view',$data);
 }
 }
 }


	}

	public function logout()
	{
		if ($this->session->userdata('user_remember') == 1) {
			$this->session->set_userdata('logged_in', FALSE);
		}
			else{
			$this->session->sess_destroy();
			}
		echo $this->session->userdata('user_remember');
 		redirect (base_url('site/login/'));
 		
	}


	public function equipe()
	{
		$query_config = $this->administration_model->info_configuration();
		$data['query_config'] = $query_config;
		$data['titre'] = 'Equipe pédagogique';
		$data['menu'] = 4;
		$this->load->view('site/common/header_view',$data);
		$this->load->view('site/common/titre_page_view',$data);
		$this->load->view('site/equipe_view',$data);
		//$this->load->view('site/construction_view',$data);
		$this->load->view('site/common/footer_view',$data);
	}

	public function galerie()
	{
		$query_config = $this->administration_model->info_configuration();
		$data['query_config'] = $query_config;
		$query_galerie = $this->administration_model->get_galerie_site();
		$data['query_galerie'] = $query_galerie;
		
		$data['titre'] = 'Galerie';
		$data['menu'] = 5;
		$this->load->view('site/common/header_view',$data);
		$this->load->view('site/common/titre_page_view',$data);
		$this->load->view('site/galerie_view',$data);
		//$this->load->view('site/construction_view',$data);
		$this->load->view('site/common/footer_view',$data);
	}
	//******************************************
}
