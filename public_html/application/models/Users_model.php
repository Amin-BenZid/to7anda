<?php
class Users_model extends CI_Model {

 function __construct() {
 parent::__construct();
//************************************** data base *************************************
    $ses_val = $this->session->userdata('annee_affiche');
    if($ses_val=="0"){$this->db = $this->load->database('default', true);}
    else if($ses_val=="1"){$this->db = $this->load->database('hist_1', true);}
    else {} 
//************************************** data base *************************************
}   
//********************************************
function login_user($login, $password) {
	 $query = "SELECT COUNT(*) AS `count`
	 FROM `users_login`
	 WHERE `login` = ?
	 AND `password` = ? ";
	 $res = $this->db->query($query, array($login, $password));
	 foreach ($res->result() as $row) {
	 $count = $row->count;
	 }
	 if ($count == 1) {
	 return true;
	 } else {
	 return false;
	 }
 }
//******************************************
 public function users_login_exist($login) {
 	
 	$this->db->where('login', $login);
	return $this->db->get('users_login');
 }
//*****************************************
 //******************************************

//*****************************************
 	//$data = ['password' => $password];
//********************************************
function update_users_login($login, $data) {

	$this->db->where('login', $login);
	 if ($this->db->update('users_login', $data)) {
	 return true;
	 } else {
	 return false;
	 }
 }

//********************************************
 function delete_users_login($login) {
 if($this->db->delete('users_login', array('login' => $login))) {
 return true;
 } else {
 return false;
 }
 }
//********************************************

        
}
?>