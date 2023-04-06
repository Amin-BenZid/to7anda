<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner_WS extends CI_Controller {

		function __construct() {
 parent::__construct();

 $this->load->library('session');

 } 
//*************************************************************************************

 //*************************************************************************************
   public function password_user_existe() {

    $id = $_POST['id'];
    $pw = $_POST['pw']; 
    $this->load->library('encrypt');
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query = $this->sdl_model->password_user_existe($id);
    $outp = '[';
    if(count($query)>0){
        $password = $this->encrypt->decode($query[0]->password);
            if (strcmp($password, $pw) !== 0) {
                $outp .= '{"existe":"0"}';
            }else{
                $outp .= '{"existe":"1"}';
            }
        
        
    }else{
        $outp .= '{"existe":"0"}';
    }
    $outp .= ']';
    echo($outp);

 }
//*************************************************************************************

//*********************************************************************
//*********************************************************************
}