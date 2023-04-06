<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sdl_WS extends CI_Controller {

		function __construct() {
 parent::__construct();

 $this->load->library('session');

 } 
//**************************************************************************************
  public function sendsms()
{
   $message = $_POST['message'];
    $entete = $_POST['entete_sms'];
    $tel_sms = $_POST['tel_sms'];
       /*
$ent="GloulouK2";
$tel="21640256416";
$message = "Gloulou K2  Login : aaaaaa  Password : hhhhhh https://gloulouk2.tn/";
$message =   urlencode($message);
$tel_sms = $tel;
$message =$mes;
$entete =$ent;
*/
//$message = "Super%20Promo";
$ecole = "ELU";
$url = "http://41.226.169.210/API/sendsms.php?SPID=12&LOGIN=swatek&PASS=swatek2018&TEXT=".$message."&SC=".$entete."&MOBILE=".$tel_sms;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
// This is what solved the issue (Accepting gzip encoding)
curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");     
$response = curl_exec($ch);
curl_close($ch);
echo $response;
}
//**************************************************************************************
 public function satisfaction()
 {
    //demandeservice : id_serv, etat, id_emp, updated_at, eval
    $id_s = 't'; //2
    $id_e = 't'; //5
    $d_d = '2020-12-14';
    $d_f = '';//2022-05-01

    /*$id_s = $_POST['s'];
    $id_e = $_POST['e'];
    $d_d = $_POST['dd'];
    $d_f = $_POST['df'];*/
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->demandeservice_eval();
    $outp = '[';
    $nb_t = 0;//1
    $nb_s = 0;//1
    $nb_ns = 0;//2
    $nb_nd = 0;//0
    foreach($query1 as $l)
    {
    //********************************************************************************
        //demandeservice : id_serv, etat, id_emp, updated_at, eval
        $id_serv = $l->id_serv;
        $etat = $l->etat;
        $id_emp = $l->id_emp;
        $updated_at = $l->updated_at;
        $eval = $l->eval;
        $ok = false;
        $aff = false;
        $time = strtotime($updated_at);
        $up_d = date('Y-m-d',$time);
        //echo $up_d." up_d ".$d_d." dd ".$d_f." df<br/>";
        if($d_d =='' && $d_f ==''){$aff=true;}
        else if($d_d ==''){if ($d_f >= $up_d) { $aff=true; }}
        else if($d_f ==''){if ($d_d <= $up_d) { $aff=true; }}
        else{if ($d_d <= $up_d && $d_f >= $up_d) { $aff=true; }}
        
        if($id_s == 't' && $id_e == 't'){$ok = true;}
        else if($id_s == 't' && $id_e == $id_emp){$ok = true;}
        else if($id_s == $id_serv && $id_e == 't'){$ok = true;}
        else if($id_s == $id_serv && $id_e == $id_emp){$ok = true;}
if($ok== true && $aff== true){

    if($eval==0){$nb_t += 1; $nb_nd += 1;}
    else if($eval==1){$nb_t += 1; $nb_s += 1;}
    else if($eval==2){$nb_t += 1; $nb_ns += 1;};

}

    //*********************************************************************************
    }

    $outp = '[';
    $outp .= '{"nb_t":"'.$nb_t.'","nb_nd":"'.$nb_nd.'","nb_s":"'.$nb_s.'","nb_ns":"'.$nb_ns.'"}';
    $outp .= ']';
    echo $outp;
 }
//**************************************************************************************
 public function employees_by_service()
 {
    $s = $_POST['s'];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->list_of_employees();
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
// employe : id,nom,prenom,cin,sexe,tel,email,desc,photo,etat,id_service,sup
        $id = $l->id;
        $nom = $l->nom;
        $prenom = $l->prenom;
        $cin = $l->cin;
        $tel = $l->tel;
        $email = $l->email;
        $id_service = $l->id_service;
$tab_s = explode(",", $id_service );
if($s!=''){
if (in_array($s, $tab_s)) {
   $outp .= '{"id":"'.$id.'","nom":"'.$nom.'","prenom":"'.$prenom.'","cin":"'.$cin.'","tel":"'.$tel.'","id_service":"'.$id_service.'"}';
        $outp .= ',';
}else if($s=='t'){
    $outp .= '{"id":"'.$id.'","nom":"'.$nom.'","prenom":"'.$prenom.'","cin":"'.$cin.'","tel":"'.$tel.'","id_service":"'.$id_service.'"}';
        $outp .= ',';
}else{
    
}
}

    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
 }
//**************************************************************************************
    public function add_hist_sms()
 {
    //hist_sms : id, message, date, destinataire, nbr_sms, type
date_default_timezone_set('Africa/Tunis'); 
$date = date('Y-m-d H:i:s');
$message = $_POST['message'];
$destinataire = $_POST['id'];
$nbr_sms= $_POST['nbr_sms'];
$type= $_POST['type'];
$data = array(
                'message' => $message ,
                'date' => $date ,
                'destinataire' => $destinataire,
                'nbr_sms' => $nbr_sms,
                'type' => $type
                );
    $this->load->model('sdl_model');
    $this->sdl_model->add_hist_sms($data);
    $outp = '[{"msg":"ok"}]';
    echo($outp);
 }
//**************************************************************************************
 public function appels_notifications()
 {
     
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->liste_appels_notifications();
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        // service_alert_store: id,id_a,type,date,vu,d_vu
        $id = $l->id;
        $id_a = $l->id_a;
        $type = $l->type;
        $date = $l->date;
        $vu = $l->vu;
        $d_vu = $l->d_vu;

        $today = date("Y-m-d");
        $dd = date("Y-m-d",strtotime($date));
        if($today == $dd){
        $outp .= '{"id":"'.$id.'","id_a":"'.$id_a.'","type":"'.$type.'","date":"'.$date.'","vu":"'.$vu.'","d_vu":"'.$d_vu.'"}';
        $outp .= ',';
        } else {}
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;

 }
//**************************************************************************************
//*********************************** list_apartements_by_owner ************************

 public function list_apartements_by_owner()
 {
    $id = $_POST['id'];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->list_apartements_by_owner($id);
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $id_a = $l->id;
        $id_bloc = $l->id_bloc;
        $code = $l->code;
        $desc = $l->desc;
        $id_proprietaire = $l->id_proprietaire;
        $nom_b = $l->nom_b;
        $desc_b = $l->desc_b;
        $outp .= '{"id_a":"'.$id_a.'","id_bloc":"'.$id_bloc.'","code":"'.$code.'","desc":"'.$desc.'","id_proprietaire":"'.$id_proprietaire.'","nom_b":"'.$nom_b.'","desc_b":"'.$desc_b.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
 }
//*************************************************************************************
public function get_bloc_by_id()
{
    $id = $_POST['id'];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->get_bloc_by_id($id);
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $id_b = $l->id;

        $nom = $l->nom;
        $floors = $l->floors;
        $desc = $l->desc;
        $outp .= '{"id":"'.$id_b.'","nom":"'.$nom.'","floors":"'.$floors.'","desc":"'.$desc.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
}
//*************************************************************************************
//*********************************** list_apartements_by_bloc ************************
public function list_apartements_by_bloc()
{
    $id = $_POST['id'];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->list_apartements_by_bloc($id);
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $id_a = $l->id;

        $id_bloc = $l->id_bloc;
        $code = $l->code;
        $outp .= '{"id":"'.$id_a.'","code":"'.$code.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
}
//*************************************************************************************
//*********************************** list_apartements_by_bloc_etage ************************
public function list_apartements_by_bloc_etage()
{
    $id = $_POST['id'];
    $etage = $_POST['etage'];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->list_apartements_by_bloc_etage($id,$etage);
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $id_a = $l->id;

        $id_bloc = $l->id_bloc;
        $code = $l->code;
        $outp .= '{"id":"'.$id_a.'","code":"'.$code.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
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
//*************************************************************************************
 public function list_employe_by_service()
 {
    $id_s = $_POST['id'];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->list_employe();
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $id = $l->id;
        $nom = $l->nom;
        $prenom = $l->prenom;
        $sexe = $l->sexe;
        $tel = $l->tel;
        $email = $l->email;
        $desc = $l->desc;
        $photo = $l->photo;
        $etat = $l->etat;
        $id_service = $l->id_service;
        $tab_s = explode(',',$id_service);
        $sup = $l->sup;
        if ( in_array($id_s, $tab_s)) {
            # code...
        
        $outp .= '{"id":"'.$id.'","nom":"'.$nom.'","prenom":"'.$prenom.'","sexe":"'.$sexe.'","tel":"'.$tel.'","email":"'.$email.'","desc":"'.$desc.'","photo":"'.$photo.'","etat":"'.$etat.'","id_service":"'.$id_service.'","sup":"'.$sup.'"}';
        $outp .= ',';
        }
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
 }

//********************************** get_employe_by_id **********************************
 public function get_employe_by_id()
 {
    $id_e = $_POST['id'];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->get_employe_by_id($id_e);
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $id = $l->id;
        $nom = $l->nom;
        $prenom = $l->prenom;
        $sexe = $l->sexe;
        $tel = $l->tel;
        $email = $l->email;
        $desc = $l->desc;
        $photo = $l->photo;
        $etat = $l->etat;
        $id_service = $l->id_service;
        $sup = $l->sup;    
        $outp .= '{"id":"'.$id.'","nom":"'.$nom.'","prenom":"'.$prenom.'","sexe":"'.$sexe.'","tel":"'.$tel.'","email":"'.$email.'","desc":"'.$desc.'","photo":"'.$photo.'","etat":"'.$etat.'","id_service":"'.$id_service.'","sup":"'.$sup.'"}';
        $outp .= ',';
        
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
 }
//********************************** get_owner_by_id **********************************

public function get_owner_by_id()
{
    $id = $_POST['id'];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->get_owner_by_id($id);
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $id = $l->id;
        $login = $l->login;
        $nom = $l->nom;
        $prenom = $l->prenom;
        $sexe = $l->sexe;
        $email = $l->email;
        $tel  = $l->tel;
        $desc = $l->desc;
        $photo = $l->photo;
        $etat = $l->etat;
        $online = $l->online;
        $outp .= '{"id":"'.$id.'","login":"'.$login.'","nom":"'.$nom.'","prenom":"'.$prenom.'","sexe":"'.$sexe.'","email":"'.$email.'","tel":"'.$tel.'","desc":"'.$desc.'","photo":"'.$photo.'","etat":"'.$etat.'","online":"'.$online.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
}



//*************************************************************************************
 //*********************************************************************
    public function cin_owner_existe() {   

        $cin = $_POST['cin'];
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $this->load->model('sdl_model');
        
        $query = $this->sdl_model->cin_owner_existe($cin);
        $outp = '[{"existe":"0"}]';
        foreach($query as $l)
        {
            $outp = '[{"existe":"1"}]';
        }   
        echo($outp);
 }
//*********************************************************************
 //*********************************************************************
    public function cin_empl_existe() {   

        $cin = $_POST['cin'];
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $this->load->model('sdl_model');
        
        $query = $this->sdl_model->cin_empl_existe($cin);
        $outp = '[{"existe":"0"}]';
        foreach($query as $l)
        {
            $outp = '[{"existe":"1"}]';
        }   
        echo($outp);
 }
//*********************************************************************
 
//*********************************************************************
    public function cin_admin_existe() {   

        $cin = $_POST['cin'];
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $this->load->model('sdl_model');
        
        $query = $this->sdl_model->cin_admin_existe($cin);
        $outp = '[{"existe":"0"}]';
        foreach($query as $l)
        {
            $outp = '[{"existe":"1"}]';
        }   
        echo($outp);
 }
//*********************************************************************
public function list_tags_appar($id)
{
    # code...
}
//*************************************************************************************
//*************************************************************************************

public function list_apartements_not_affected()
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->list_apartements_not_affected();
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $id_a = $l->id;

        $id_bloc = $l->id_bloc;
        $code = $l->code;
        $outp .= '{"id":"'.$id_a.'","code":"'.$code.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
}
//*********************************************************************
public function list_cin_ouners()
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->list_cin_ouners();
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $cin = $l->cin;
        $outp .= '{"cin":"'.$cin.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
}
//*********************************************************************
public function list_apartements_by_bloc_id()
{
    $id_a = $_POST['id'];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $id_bloc=0;
    $floors=0;
    $floor=0;
    $query = $this->sdl_model->get_apartement_by_id($id_a);
    foreach($query as $l){ $id_bloc = $l->id_bloc; $floor = $l->floor;}
    $query0 = $this->sdl_model->get_bloc_by_id($id_bloc);
    foreach($query0 as $l0){ $floors = $l0->floors; }
    $query1 = $this->sdl_model->list_apartements_by_bloc_etage($id_bloc,$floor);
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $id_a = $l->id;

        $id_bloc = $l->id_bloc;
        $code = $l->code;
        $outp .= '{"id":"'.$id_a.'","id_bloc":"'.$id_bloc.'","floors":"'.$floors.'","code":"'.$code.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
    
}
//*********************************************************************
public function list_tags_admin_free()
{
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->list_tags_admin_free();
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $id = $l->id;

        $uid = $l->uid;
        $etat = $l->etat;
        $outp .= '{"id":"'.$id.'","uid":"'.$uid.'","code":"'.$etat.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
}
//*********************************************************************
public function list_of_appartement_tags()
{
    $id_a = $_POST['id'];
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $this->load->model('sdl_model');
    $query1 = $this->sdl_model->list_of_appartement_tags($id_a);
    $outp = '[';
    foreach($query1 as $l)
    {
    //********************************************************************************
        $id = $l->id;

        $uid = $l->uid;
        $etat = $l->etat;
        $outp .= '{"id":"'.$id.'","uid":"'.$uid.'","code":"'.$etat.'"}';
        $outp .= ',';
    //*********************************************************************************
    }
    if($outp!='['){$outp = substr($outp, 0, -1);}
    $outp .= ']';
    echo $outp;
}
//*********************************************************************
public function update_proprietaire_app()
{
        $id = $_POST['id'];
        $val = $_POST['val'];
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $this->load->model('sdl_model');
        $query = $this->sdl_model->update_proprietaire_app($id,$val);
        $outp = '[{"ok":"true"}]';  
        echo($outp);
}
//*********************************************************************
    public function uid_tag_existe() {   

        $uid = $_POST['uid'];
         //$uid = '29B9EDB35';
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $this->load->model('sdl_model');
        
        $query = $this->sdl_model->uid_tag_existe($uid);
        $outp = '[{"existe":"0"}]';
        foreach($query as $l)
        {
            $outp = '[{"existe":"1"}]';
        }   
        echo($outp);
 }
//*********************************************************************
 //*********************************************************************
    public function nom_bloc_existe() {   

        $nom = $_POST['nom'];
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $this->load->model('sdl_model');
        
        $query = $this->sdl_model->nom_bloc_existe($nom);
        $outp = '[{"existe":"0"}]';
        foreach($query as $l)
        {
            $outp = '[{"existe":"1"}]';
        }   
        echo($outp);
 }
//*********************************************************************
 public function code_apartement_existe()
 {
        $code = $_POST['code'];
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $this->load->model('sdl_model');
        
        $query = $this->sdl_model->code_apartement_existe($code);
        $outp = '[{"existe":"0"}]';
        foreach($query as $l)
        {
            $outp = '[{"existe":"1"}]';
        }   
        echo($outp);
 }
//*************************************************************************************
//*********************************************************************
 public function sdl_id_apartement_existe()
 {
        $sdl_id = $_POST['sdl_id'];
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $this->load->model('sdl_model');
        
        $query = $this->sdl_model->sdl_id_apartement_existe($sdl_id);
        $outp = '[{"existe":"0"}]';
        foreach($query as $l)
        {
            $outp = '[{"existe":"1"}]';
        }   
        echo($outp);
 }
//*************************************************************************************
 //*************************************************************************************
 //*************************************************************************************
 
//*********************************************************************
//*********************************************************************
}


