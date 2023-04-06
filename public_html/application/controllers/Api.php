<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

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
 date_default_timezone_set("Africa/Tunis");

 }

//*****************************************************************
  public function apartments_update()
 {

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->apartments_update_api();
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $id = $l->id;
        $id_app = $l->id_app;
        $sdl_id = $l->sdl_id;
        $etat_update = $l->etat_update;
        $updated_at = $l->updated_at;
        $outp .= '{"id":"'.$id.'","id_app":"'.$id_app.'","sdl_id":"'.$sdl_id.'","etat_update":"'.$etat_update.'","updated_at":"'.$updated_at.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
 }

   public function apartments_access($sdl='')
 {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->apartments_access_api($sdl);
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $uid = $l->uid;
        $etat = $l->etat;
        $sdl_id = $l->sdl_id;
        $id_a = $l->id;
        $outp .= '{"uid":"'.$uid.'","id_a":"'.$id_a.'","sdl_id":"'.$sdl_id.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
 }


 public function access_store($id_a,$uid,$type,$etat)
 {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $this->sdl_model->access_store_api($id_a,$uid,$type,$etat);
    $outp = '[';
    $outp .= '{"store":"true}';
    $outp .= ']';
    echo $outp;
 }
  public function service_alert_store($id_a,$type)
 {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $this->sdl_model->service_alert_store_api($id_a,$type);
    $outp = '[';
    $outp .= '{"store":"true}';
    $outp .= ']';
    echo $outp;
 }
   public function sport_access ()
 {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->sport_access_api();
    $outp = '[';
    $today = date("Y-m-d");
    $time = date("H:i:s");
    foreach($query1 as $l)
    {
    //********************************************************************************
        $uid = $l->uid;
        $etat = $l->etat;
        $id_a = $l->id_a;
        $d_deut = $l->d_deut;
        $d_fin = $l->d_fin;
        $t_debut = $l->t_debut;
        $t_fin = $l->t_fin;
        
        if((Date($today) >= Date($d_deut)) && (Date($today) <= Date($d_fin))) {
            if ((strtotime($time) > strtotime($t_debut)) && (strtotime($time) < strtotime($t_fin))) {
            $outp .= '{"uid":"'.$uid.'","id_a":"'.$id_a.'"}';
            $outp .= ','; 
        }
        }


    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
 }
   public function all_tags()
 {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->all_tags_api();
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $uid = $l->uid;
        $etat = $l->etat;
        $sdl_id = $l->sdl_id;
        $id_a = $l->id;
        $outp .= '{"uid":"'.$uid.'","sdl_id":"'.$sdl_id.'","id_a":"'.$id_a.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
 }

//************************************************************************
    public function all_sdl()
 {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->list_of_apartments();
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $sdl_id = $l->sdl_id;
        if($sdl_id!=""){
        $outp .= '{"sdl_id":"'.$sdl_id.'"}';
        $outp .= ',';
    }
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
 }
//************************************************************************
//*************************** Mobile App API *****************************
//************************************************************************

public function stat_count($login='')
{
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $this->load->model('sdl_model');
        $query = $this->sdl_model->get_user_by_login($login);
        $nb_appartement =0;$nb_tags =0;$nb_demandeservice =0;$nb_demandeautorisation =0;
        
        if($query){
        $id = $query[0]->id;
        $query2 = $this->sdl_model->stat_count_appartement_user($id);
        $nb_appartement = $query2[0]->nb_appartement; 
        $query3 = $this->sdl_model->stat_count_tags_user($id);
        $nb_tags = $query3[0]->nb_tags;
        $query6 = $this->sdl_model->stat_count_demandeservice_user($id);
        $nb_demandeservice = $query6[0]->nb_demandeservice;
        $query8 = $this->sdl_model->stat_count_demandeautorisation_user($id);
        $nb_demandeautorisation = $query8[0]->nb_demandeautorisation;
        }
        $outp = '[';
        //********************************************************************************
            $outp .= '{"nb_appartement":"'.$nb_appartement.'","nb_tags":"'.$nb_tags.'","nb_demandeservice":"'.$nb_demandeservice.'","nb_demandeautorisation":"'.$nb_demandeautorisation.'"}';
        //*********************************************************************************
        $outp .= ']';
        echo $outp;
}
//************************************************************************
public function list_of_services()
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->list_of_services();
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************

        $id = $l->id;
        $nom = $l->nom;
        $desc = $l->desc;
        $outp .= '{"id":"'.$id.'","nom":"'.$nom.'","desc":"'.$desc.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;

}
//************************************************************************

public function blocage_deblocage_tag($id='',$type='')
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $outp="";
    if($id!=''){
        if($type==1){
            $this->sdl_model->deblocage_tag($id);
            $outp .= '[{"change":"true}]';
        }elseif ($type==0) {
            $this->sdl_model->blocage_tag($id);
            $outp .= '[{"change":"true}]';
        }else{
           $outp .= '[{"change":"false}]'; 
        }
    }else{
        $outp .= '[{"change":"false}]';
    }
    echo $outp;
}
//***********************************************************************************
public function tag_pass()
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $outp = '[';
    $query001 = $this->sdl_model->get_tag_pass();
    //********************************************************************************
        foreach ($query001 as $tag){
            
                $uid_t = $tag->uid;
                $etat_t = $tag->etat;
                $id_t = $tag->id;
                if($etat_t == 1 && $uid_t!=""){
                        $outp .= '{"uid_tag":"'.$uid_t.'","etat_tag":"'.$etat_t.'","id_tag":"'.$id_t.'"}';
                        $outp .= ',';
                }
        }
    //*********************************************************************************
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
}
//***********************************************************************************
public function porte_tags()
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $outp = '[';
    $query7 = $this->sdl_model->list_of_tags();

    //********************************************************************************
        
        foreach ($query7 as $tag){
            
                $uid_t = $tag->uid;
                $etat_t = $tag->etat;
                $id_t = $tag->id;
                if($etat_t == 1){
                        $outp .= '{"uid_tag":"'.$uid_t.'","etat_tag":"'.$etat_t.'","id_tag":"'.$id_t.'"}';
                        $outp .= ',';
                }
        }
    //*********************************************************************************
      
            if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
}
//************************************************************************

//************************************************************************
public function appartements_tags($login='')
{
    # code...
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query = $this->sdl_model->get_user_by_login($login);
    $outp = '[';
    if ($query) {
    $id = $query[0]->id;
    $query5 = $this->sdl_model->list_of_apartments_user($id);
    $query7 = $this->sdl_model->list_of_tags();
    foreach ($query5 as $apart){
    //********************************************************************************
        $nom = $apart->nom;
        $floor = $apart->floor;
        $code = $apart->code;
        $desc = $apart->desc;
        $id = $apart->id;
        $tags = "";
        foreach ($query7 as $tag){
            if($apart->id == $tag->id_appartement ){
                $uid_t = $tag->uid;
                $etat_t = $tag->etat;
                $id_t = $tag->id;
                $tags .= $id_t."//////".$etat_t."//////".$uid_t.";;;;;;";
            }
        }
        if($tags!=""){$tags = substr($tags, 0, -6);}
        
        $outp .= '{"id":"'.$id.'","nom":"'.$nom.'","floor":"'.$floor.'","code":"'.$code.'","tags":"'.$tags.'"}';
        $outp .= ',';
    //*********************************************************************************
        }
          }
            if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;        


}
//************************************************************************
	
//************************** fin ****************************************
}