<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {

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

 if (($this->session->userdata('logged_in') == FALSE) || ($this->session->userdata('user_type') != 3 )){
        redirect(base_url('login/'));
         }

 }

//************************************************************************
public function index()
{
	    $data['title'] = 'Tableau de bord';
        $data['message'] = 'Bienvenue dans le tableau de bord SDL';
        $data['menu'] = 1;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $id = $query[0]->id;
        $this->sdl_model->update_online_user($id,1);

        
        $query2 = $this->sdl_model->stat_count_appartement_user($id);
        $data['nb_appartement'] = $query2;
        $query3 = $this->sdl_model->stat_count_tags_user($id);
        $data['nb_tags'] = $query3;
        $query6 = $this->sdl_model->stat_count_demandeservice_user($id);
        $data['nb_demandeservice'] = $query6;
        $query8 = $this->sdl_model->stat_count_demandeautorisation_user($id);
        $data['nb_demandeautorisation'] = $query8;
        

        $this->load->view('owner/common/header_view',$data);
        $this->load->view('owner/common/title_page_view',$data);
        $this->load->view('owner/index_view',$data);
        //$this->load->view('owner/construction_view',$data);
        $this->load->view('owner/common/footer_view',$data);
}
//******************************************************************************************
public function apartments()
{
	if ($this->input->server('REQUEST_METHOD') == 'POST'){
            
            $id_blocage_tag = $this->input->post('id_blocage_tag');
            $id_deblocage_tag = $this->input->post('id_deblocage_tag');
            if(isset($id_blocage_tag)){ 
                $this->load->model('sdl_model');
                $this->sdl_model->blocage_tag($id_blocage_tag);
            }
            else if (isset($id_deblocage_tag)){
            	$this->load->model('sdl_model');
            	$this->sdl_model->deblocage_tag($id_deblocage_tag);

            }


    }
	$data['title'] = 'Les appartements';
    $data['message'] = 'Gestion des appartements';
    $data['menu'] = 2;
    $login = $this->session->userdata('user_login');
    $query = $this->sdl_model->get_user_by_login($login);
    $data['info'] = $query;
    $id = $query[0]->id;
    $query5 = $this->sdl_model->list_of_apartments_user($id);
    $data['apartments'] = $query5;
	$query7 = $this->sdl_model->list_of_tags();
    $data['tags'] = $query7;
    $tabjs = array('assets/js/owner/apartments.js');
    $data['tabjs'] = $tabjs;
	$this->load->view('owner/common/header_view',$data);
    $this->load->view('owner/common/title_page_view',$data);
    $this->load->view('owner/apartments_view',$data);
    //$this->load->view('owner/construction_view',$data);
    $this->load->view('owner/common/footer_view',$data);
}
//******************************************************************************************
public function services()
{
    
    //*******************************************************************************
    if ($this->input->server('REQUEST_METHOD') == 'POST'){
        
        $id_suppression_d  = $this->input->post('id_suppression_d');

        $id_dem_ser_ann = $this->input->post('id_dem_ser_ann');
        
        $add_date_d  = $this->input->post('add_date_d');
        $add_date_f  = $this->input->post('add_date_f');
        $add_temps_d  = $this->input->post('add_temps_d');
        $add_temps_f  = $this->input->post('add_temps_f');
        $add_id_app  = $this->input->post('add_id_app');
        $add_id_p  = $this->input->post('add_id_p');
        $add_desc  = $this->input->post('add_desc');
        $add_serv  = $this->input->post('add_serv');

        $date_d  = $this->input->post('date_d');
        $date_f  = $this->input->post('date_f');
        $temps_d  = $this->input->post('temps_d');
        $temps_f  = $this->input->post('temps_f');
        $id_app  = $this->input->post('id_app');
        $id_p  = $this->input->post('id_p');
        $id_d  = $this->input->post('id_d');
        $desc  = $this->input->post('desc');
        $serv  = $this->input->post('serv');

        $id_eval_ser = $this->input->post('id_eval_ser'); 
        $radio_s = $this->input->post('radio_s');
        $remar_s = $this->input->post('remar_s');


        $user_id = $this->session->userdata('user_id');
        $today = date("Y-m-d H:i:s");
        //id, id_appa, id_prop, id_serv, date_debut, date_fin, heur_debut,  heur_fin,description,   etat,id_emp,    id_tag,created_at,updated_at,id_add,    type_add
        if(isset($id_suppression_d)){ 
            $this->load->model('sdl_model');
            $this->sdl_model->delete_demandeservice($id_suppression_d);
            $this->sdl_model->delete_etatdemande($id_suppression_d,1);
        }
        else if(isset($id_dem_ser_ann)){ 
            $this->load->model('sdl_model');
            $data_up = array(
                    'etat' => 2,
                    'updated_at' => $today
                    );
            $this->load->model('sdl_model');
            $this->sdl_model->update_demandeservice($data_up,$id_dem_ser_ann);
            $data_e = array(
                    'id_demande' => $id_dem_ser_ann,
                    'type_demande' => 1,
                    'etat' => 2,
                    'date' => $today
                    );
            $this->sdl_model->insert_etatdemande($data_e); 
        }
        else if (isset($id_eval_ser)){

                //echo $radio_s." ".$remar_s."<br/>"; 
                //$data['title'] = $radio_s." ".$remar_s."<br/>";
                //eval ,  r_eval ,  eval_date
                $data_up = array(
                    'eval' => $radio_s,
                    'r_eval' => $remar_s,
                    'eval_date' => $today
                    );
            $this->load->model('sdl_model');
            $this->sdl_model->update_demandeservice($data_up,$id_eval_ser);

        }
        else if (isset($add_date_d)){
                    $data_in = array(
                    'id_appa' => $add_id_app,
                    'id_prop' => $user_id,
                    'id_serv' => $add_serv,
                    'date_debut' => $add_date_d,
                    'date_fin' => $add_date_f,
                    'heur_debut' => $add_temps_d,
                    'heur_fin' => $add_temps_f,
                    'description' => $add_desc,
                    'etat' => 1,
                    'id_emp' => 0,
                    'id_tag' => 0,
                    'created_at' => $today,
                    'updated_at' => $today,
                    'id_add' => $user_id,
                    'type_add' => 2
                    );
                    

                    $this->load->model('sdl_model');
                    $this->sdl_model->insert_demandeservice($data_in);
                    $id_d = $this->sdl_model->get_id_demande_by_app_date(1, $add_id_app, $today);
                    $data_e = array(
                    'id_demande' => $id_d,
                    'type_demande' => 1,
                    'etat' => 1,
                    'date' => $today
                    );
          			//******************************** Send SMS *****************************************
          			$app = $this->sdl_model->get_apartement_by_id($add_id_app);
          			$app_code =$app[0]->code;
          			$message = "Demande Service ".$app_code." ".$today;
          			$message = urlencode($message);
                    $entete = "GloulouK2";
                    $tels = $this->sdl_model->get_admins_tels();
                     foreach ($tels as $req){
                      $tel = $req->tel;
                      $tel_sms = '216'.$tel;
                      $url = "http://41.226.169.210/API/sendsms.php?SPID=12&LOGIN=swatek&PASS=swatek2018&TEXT=".$message."&SC=".$entete."&MOBILE=".$tel_sms;
                      $ch = curl_init();
                      curl_setopt($ch, CURLOPT_URL, $url);
                      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
                      curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");     
                      $response = curl_exec($ch);
                      curl_close($ch);
                     }
          			
          			
                    
          			
          			//***********************************************************************************
                    $this->sdl_model->insert_etatdemande($data_e);
        }
        else if (isset($date_d)){
                    $data_up = array(
                    'id_appa' => $id_app,
                    'id_prop' => $user_id,
                    'id_serv' => $serv,
                    'date_debut' => $date_d,
                    'date_fin' => $date_f,
                    'heur_debut' => $temps_d,
                    'heur_fin' => $temps_f,
                    'description' => $desc,
                    'updated_at' => $today,
                    'id_add' => $user_id
                    );

                    $this->load->model('sdl_model');
                    $this->sdl_model->update_demandeservice($data_up,$id_d);
            
        }

    }
    //********************************************************************

	$data['title'] = 'Les services';
    $data['message'] = 'Gestion des services';
    $data['menu'] = 3;
    $login = $this->session->userdata('user_login');
    $query = $this->sdl_model->get_user_by_login($login);
    $data['info'] = $query;
    $id = $query[0]->id;
    $query2 = $this->sdl_model->list_of_s_requests_user($id);
    $data['s_requests'] = $query2;
    $query3 = $this->sdl_model->list_of_services();
    $data['services'] = $query3;
    $query4 = $this->sdl_model->list_of_employees();
    $data['employees'] = $query4;
    $query5 = $this->sdl_model->list_of_apartments_user($id);
    $data['apartments'] = $query5;
    $query6 = $this->sdl_model->list_of_blocks();
    $data['blocs'] = $query6;
    $query7 = $this->sdl_model->list_of_tags();
    $data['tags'] = $query7;
    $query8 = $this->sdl_model->list_of_owners();
    $data['owners'] = $query8;
    $tabjs = array('assets/js/owner/services.js');
    $data['tabjs'] = $tabjs;
	$this->load->view('owner/common/header_view',$data);
    $this->load->view('owner/common/title_page_view',$data);
    $this->load->view('owner/services_view',$data);
    //$this->load->view('owner/construction_view',$data);
    $this->load->view('owner/common/footer_view',$data);
}
//******************************************************************************************
public function authorizations()
{
        //*******************************************************************************
    if ($this->input->server('REQUEST_METHOD') == 'POST'){
        
        $id_suppression_d  = $this->input->post('id_suppression_d');
        
        $id_dem_aut_ann = $this->input->post('id_dem_aut_ann');
        
        $add_date_d  = $this->input->post('add_date_d');
        $add_date_f  = $this->input->post('add_date_f');
        $add_temps_d  = $this->input->post('add_temps_d');
        $add_temps_f  = $this->input->post('add_temps_f');
        $add_id_app  = $this->input->post('add_id_app');
        $add_id_p  = $this->input->post('add_id_p');
        $add_nom  = $this->input->post('add_nom');
        $add_prenom  = $this->input->post('add_prenom');
        $add_cin  = $this->input->post('add_cin');
        $add_desc  = $this->input->post('add_desc');


        $date_d  = $this->input->post('date_d');
        $date_f  = $this->input->post('date_f');
        $temps_d  = $this->input->post('temps_d');
        $temps_f  = $this->input->post('temps_f');
        $id_app  = $this->input->post('id_app');
        $id_p  = $this->input->post('id_p');
        $id_d  = $this->input->post('id_d');
        $nom  = $this->input->post('nom');
        $prenom  = $this->input->post('prenom');
        $cin  = $this->input->post('cin');
        $desc  = $this->input->post('desc');
        
        $user_id = $this->session->userdata('user_id');
        $today = date("Y-m-d H:i:s");
        
        if(isset($id_suppression_d)){ 
            $this->load->model('sdl_model');
            $this->sdl_model->delete_demandeautorisation($id_suppression_d);
            $this->sdl_model->delete_etatdemande($id_suppression_d,2);
        }
        else if(isset($id_dem_aut_ann)){ 
            $this->load->model('sdl_model');
            $data_up = array(
                    'etat' => 2,
                    'updated_at' => $today
                    );
            $this->load->model('sdl_model');
            $this->sdl_model->update_demandeautorisation($data_up,$id_dem_aut_ann);
            $data_e = array(
                    'id_demande' => $id_dem_aut_ann,
                    'type_demande' => 2,
                    'etat' => 2,
                    'date' => $today
                    );
            $this->sdl_model->insert_etatdemande($data_e); 
        }
        else if (isset($add_date_d)){
                    $data_in = array(
                    'id_appa' => $add_id_app,
                    'id_prop' => $user_id,
                    'id_tag' => '',
                    'date_debut' => $add_date_d,
                    'date_fin' => $add_date_f,
                    'heur_debut' => $add_temps_d,
                    'heur_fin' => $add_temps_f,
                    'nom' => $add_nom,
                    'prenom' => $add_prenom,
                    'cin_pass' => $add_cin,
                    'descption' => $add_desc,
                    'etat' => 1,
                    'created_at' => $today,
                    'updated_at' => $today
                    );


                    $this->load->model('sdl_model');
                    $this->sdl_model->insert_demandeautorisation($data_in);
                    $id_d = $this->sdl_model->get_id_demande_by_app_date(2, $add_id_app, $today);
                    $data_e = array(
                    'id_demande' => $id_d,
                    'type_demande' => 2,
                    'etat' => 1,
                    'date' => $today
                    );
                    $this->sdl_model->insert_etatdemande($data_e);
        }
        else if (isset($date_d)){
                    $data_up = array(
                    'id_appa' => $id_app,
                    'id_prop' => $user_id,
                    'date_debut' => $date_d,
                    'date_fin' => $date_f,
                    'heur_debut' => $temps_d,
                    'heur_fin' => $temps_f,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'cin_pass' => $cin,
                    'descption' => $desc,
                    'updated_at' => $today
                    );

                    /* id, id_appa, id_prop, id_tag, 
           date_debut, date_fin, heur_debut
            , heur_fin, nom,prenom,cin_pass
            , descption, etat, created_at, updated_at
         */
                    $this->load->model('sdl_model');
                    $this->sdl_model->update_demandeautorisation($data_up,$id_d);
            
        }

    }
    //********************************************************************
    
	$data['title'] = 'Les autorisations';
    $data['message'] = 'Gestion des autorisations';
    $data['menu'] = 4;
    $login = $this->session->userdata('user_login');
    $query = $this->sdl_model->get_user_by_login($login);
    $data['info'] = $query;
    $id = $query[0]->id;
    $query2 = $this->sdl_model->list_of_a_requests_user($id);
    $data['a_requests'] = $query2;
    $query3 = $this->sdl_model->list_of_services();
    $data['services'] = $query3;
    $query4 = $this->sdl_model->list_of_employees();
    $data['employees'] = $query4;
    $query5 = $this->sdl_model->list_of_apartments_user($id);
    $data['apartments'] = $query5;
    $query6 = $this->sdl_model->list_of_blocks();
    $data['blocs'] = $query6;
    $query7 = $this->sdl_model->list_of_tags();
    $data['tags'] = $query7;
    $query8 = $this->sdl_model->list_of_owners();
    $data['owners'] = $query8;
    $tabjs = array('assets/js/owner/authorizations.js');
    $data['tabjs'] = $tabjs;
	$this->load->view('owner/common/header_view',$data);
    $this->load->view('owner/common/title_page_view',$data);
    $this->load->view('owner/authorizations_view',$data);
    //$this->load->view('owner/construction_view',$data);
    $this->load->view('owner/common/footer_view',$data);
}
//******************************************************************************************
public function reclamations()
{
    $data['title'] = 'Les réclamations';
    $data['message'] = 'Gestion des réclamations';
    $data['menu'] = 5;
    $login = $this->session->userdata('user_login');
    $query = $this->sdl_model->get_user_by_login($login);
    $data['info'] = $query;
    $id = $query[0]->id;

if ($this->input->server('REQUEST_METHOD') == 'POST'){
        
        $id_app  = $this->input->post('d_id_app');
        $reclam = $this->input->post('reclam');
        $today = date("Y-m-d H:i:s");
        $data_rec = array(
                    'id_prop' => $id,
                    'id_app' => $id_app,
                    'reclam' => $reclam,
                    'date' => $today
                    );
        $this->sdl_model->add_reclamation($data_rec); 



}

    $query5 = $this->sdl_model->list_of_apartments_user($id);
    $data['apartments'] = $query5;

    $query6 = $this->sdl_model->list_of_reclamations_user($id);
    $data['reclamations'] = $query6;

    $query6 = $this->sdl_model->list_of_blocks();
    $data['blocs'] = $query6;
    $query8 = $this->sdl_model->list_of_owners();
    $data['owners'] = $query8;

    $tabjs = array('assets/js/owner/reclamations.js');
    $data['tabjs'] = $tabjs;
    $this->load->view('owner/common/header_view',$data);
    $this->load->view('owner/common/title_page_view',$data);
    $this->load->view('owner/reclamations_view',$data);
    //$this->load->view('owner/construction_view',$data);
    $this->load->view('owner/common/footer_view',$data);
}
//******************************************************************************************
public function profil()
{
        
          //********************************************************************
    //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST'){
            
            $id_modif_user = $this->input->post('id_modif_user');
            $nom_modif_user = $this->input->post('nom_modif_user');
            $prenom_modif_user = $this->input->post('prenom_modif_user');
            $sexe_modif_user = $this->input->post('sexe_modif_user');
            if($sexe_modif_user==''){$sexe_modif_user=1;}
            $tel_modif_user = $this->input->post('tel_modif_user');
            $email_modif_user = $this->input->post('email_modif_user');
            $desc_modif_user = $this->input->post('desc_modif_user');
            $photo_modif_user = $this->input->post('photo_modif_user');

            $id_modif_pass_user = $this->input->post('id_modif_pass_user');
            $nmp_modif_pass_user = $this->input->post('nmp_modif_pass_user');
           
            
            if(isset($id_modif_pass_user)){ 
                $today = date("Y-m-d");
                $this->load->library('encrypt');
                $password = $this->encrypt->encode($nmp_modif_pass_user);
                $data_up = array(
                'password' => $password,
                'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->modifier_admin($data_up,$id_modif_pass_user);
            }
            else if (isset($id_modif_user)){
            //**************************************************************************************

                $new_name ="";
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']             = '';
                $config['max_width']            = '';
                $config['max_height']           = '';

                if($_FILES["photo_modif_user"]['name']!=""){
                $new_name = time()."123654789";
                }

                $config['file_name'] = $new_name;
                $ext = pathinfo($_FILES["photo_modif_user"]['name'], PATHINFO_EXTENSION);
                if($new_name!=""){
                    $new_name = $new_name.".".$ext;
                }

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('photo_modif_user'))
                {
                        $error = array('error' => $this->upload->display_errors());     
                }
                else
                {
                        $data = array('photo_modif_admin' => $this->upload->data());     
                }
        //**************************************************************************
        $today = date("Y-m-d");
        if($new_name ==""){
        $data_up = array(
        'nom' => $nom_modif_user,
        'prenom' => $prenom_modif_user,
        'sexe' => $sexe_modif_user,
        'email' => $email_modif_user,
        'tel' => $tel_modif_user,
        'desc' => $desc_modif_user,
        'updated_at' => $today
        );
        }else{
        $data_up = array(
        'nom' => $nom_modif_user,
        'prenom' => $prenom_modif_user,
        'sexe' => $sexe_modif_user,
        'email' => $email_modif_user,
        'tel' => $tel_modif_user,
        'desc' => $desc_modif_user,
        'photo' => $new_name,
        'updated_at' => $today
        );
        }

        $this->load->model('sdl_model');
        $this->sdl_model->modifier_admin($data_up,$id_modif_user);
        //*****************************************************************************************
            }
            
        }
        //********************************************************************
        $data['title'] = 'Profil';
        $data['message'] = 'Gestion de profil';
        $data['menu'] = 0;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tabjs = array('assets/js/owner/profil.js');
        $data['tabjs'] = $tabjs;
        $this->load->view('owner/common/header_view',$data);
        $this->load->view('owner/common/title_page_view',$data);
        $this->load->view('owner/profil_view',$data);
        //$this->load->view('owner/construction_view',$data);
        $this->load->view('owner/common/footer_view',$data);
		
}
//********************************************************************************************
	
//************************** fin ****************************************
}