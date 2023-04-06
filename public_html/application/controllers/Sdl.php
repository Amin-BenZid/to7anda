<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdl extends CI_Controller
{

    function __construct()
    {
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
        //**************************************************
        $login218 = $this->session->userdata('user_login');
        $query218 = $this->sdl_model->get_user_by_login($login218);
        $type_ad = $query218[0]->type;
        $id_ad = $query218[0]->id;
        //**************************************************

        if (($this->session->userdata('logged_in') == FALSE) || ($this->session->userdata('user_type') != 1 && $this->session->userdata('user_type') != 2)) {
            redirect(base_url('login/'));
        }
    }


    //************************************************************************


    //*****************************************************************************************

    //*****************************************************************************************
    public function index()
    {
       


        $data['title'] = 'Tableau de bord';
        $data['message'] = 'Bienvenue dans le tableau de bord SDL';
        $data['menu'] = 1;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);

        
        $data['info'] = $query;
        $id = $query[0]->id;

        $this->sdl_model->update_online_user($id, 1);

        $query1 = $this->sdl_model->stat_count_bloc();
        $data['nb_bloc'] = $query1;
        $query2 = $this->sdl_model->stat_count_appartement();
        $data['nb_appartement'] = $query2;
        $query3 = $this->sdl_model->stat_count_tags();
        $data['nb_tags'] = $query3;
        $query4 = $this->sdl_model->stat_count_employe();
        $data['nb_employe'] = $query4;
        $query5 = $this->sdl_model->stat_count_service();
        $data['nb_service'] = $query5;
        $query6 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6;
        $query7 = $this->sdl_model->stat_count_prop();
        $data['nb_prop'] = $query7;
        $query8 = $this->sdl_model->stat_count_demandeautorisation();
        $data['nb_demandeautorisation'] = $query8;
        $tabjs = array('assets/js/sdl/index.js');
        $data['tabjs'] = $tabjs;


        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/index_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //*****************************************************************************************
    public function blocks()
    {
        $query6 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6;

        //**************************************************
        $login218 = $this->session->userdata('user_login');
        $query218 = $this->sdl_model->get_user_by_login($login218);
        $type_ad = $query218[0]->type;
        $id_ad = $query218[0]->id;
        //**************************************************
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $nom_ajout_bloc  = $this->input->post('nom_ajout_bloc');
            $etage_ajout_bloc  = $this->input->post('etage_ajout_bloc');
            $desc_ajout_bloc  = $this->input->post('desc_ajout_bloc');


            $id_modif_bloc = $this->input->post('id_modif_bloc');
            $nom_modif_bloc = $this->input->post('nom_modif_bloc');
            $etage_modif_bloc = $this->input->post('etage_modif_bloc');
            $desc_modif_bloc = $this->input->post('desc_modif_bloc');


            $id_suppression_bloc = $this->input->post('id_suppression_bloc');


            if (isset($id_suppression_bloc)) {
                $this->load->model('sdl_model');
                $this->sdl_model->delete_bloc($id_suppression_bloc);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Suppression bloc ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************

            } else if (isset($id_modif_bloc)) {
                //**************************************************************************************

                $data_up = array(
                    'nom' => $nom_modif_bloc,
                    'floors' => $etage_modif_bloc,
                    'desc' => $desc_modif_bloc
                );
                $this->load->model('sdl_model');
                $this->sdl_model->modifier_bloc($data_up, $id_modif_bloc);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Modification bloc ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
                //*****************************************************************************************
            } else if (isset($nom_ajout_bloc)) {
                //**********************************************************************************

                $data_add = array(
                    'nom' => $nom_ajout_bloc,
                    'floors' => $etage_ajout_bloc,
                    'desc' => $desc_ajout_bloc
                );
                $this->sdl_model->ajouter_bloc($data_add);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Ajout bloc ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
                //**********************************************************************************
            }
        }
        //********************************************************************
        $data['title'] = 'Gestion des appartements';
        $data['message'] = 'Les blocs';
        $data['menu'] = 21;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("11", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $tabjs = array('assets/js/sdl/blocks.js');
        $data['tabjs'] = $tabjs;
        $query2 = $this->sdl_model->list_of_blocks();
        $data['blocs'] = $query2;
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/blocks_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function apartments()
    {

        //**************************************************
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        $login218 = $this->session->userdata('user_login');
        $query218 = $this->sdl_model->get_user_by_login($login218);
        $type_ad = $query218[0]->type;
        $id_ad = $query218[0]->id;
        //**************************************************
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $bloc_ajout_apar  = $this->input->post('bloc_ajout_apar');
            $etage_ajout_apar  = $this->input->post('etage_ajout_apar');
            $code_ajout_apar  = $this->input->post('code_ajout_apar');
            $desc_ajout_apar  = $this->input->post('desc_ajout_apar');
            $sdl_id_ajout_apar  = $this->input->post('sdl_id_ajout_apar');

            $id_modif_apar = $this->input->post('id_modif_apar');
            $bloc_modif_apar = $this->input->post('bloc_modif_apar');
            $etage_modif_apar = $this->input->post('etage_modif_apar');
            $code_modif_apar = $this->input->post('code_modif_apar');
            $desc_modif_apar = $this->input->post('desc_modif_apar');
            $sdl_id_modif_apar = $this->input->post('sdl_id_modif_apar');


            $id_suppression_apar = $this->input->post('id_suppression_apar');

            if (isset($id_suppression_apar)) {
                $this->load->model('sdl_model');
                $this->sdl_model->delete_apartement($id_suppression_apar);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Suppression appartement ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************

            } else if (isset($id_modif_apar)) {
                //**************************************************************************************

                $data_up = array(
                    'id_bloc' => $bloc_modif_apar,
                    'floor' => $etage_modif_apar,
                    'code' => $code_modif_apar,
                    'desc' => $desc_modif_apar,
                    'sdl_id' => $sdl_id_modif_apar
                );
                $this->load->model('sdl_model');
                $this->sdl_model->modifier_apartement($data_up, $id_modif_apar);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Modification appartement ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
                //*****************************************************************************************
            } else if (isset($bloc_ajout_apar)) {
                //**********************************************************************************

                $data_add = array(
                    'id_bloc' => $bloc_ajout_apar,
                    'floor' => $etage_ajout_apar,
                    'code' => $code_ajout_apar,
                    'desc' => $desc_ajout_apar,
                    'id_proprietaire' => 0,
                    'sdl_id' => $sdl_id_ajout_apar
                );
                $this->sdl_model->ajouter_apartement($data_add);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Ajout appartement ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
                //**********************************************************************************
            }
        }
        //********************************************************************
        $data['title'] = 'Gestion des appartements';
        $data['message'] = 'Les appartements';
        $data['menu'] = 22;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("12", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $tabjs = array('assets/js/sdl/apartments.js');
        $data['tabjs'] = $tabjs;
        $query2 = $this->sdl_model->list_of_apartments();
        $data['apartments'] = $query2;
        $query3 = $this->sdl_model->list_of_blocks();
        $data['blocs'] = $query3;
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/apartments_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function tags()
    {

        //**************************************************
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        $login218 = $this->session->userdata('user_login');
        $query218 = $this->sdl_model->get_user_by_login($login218);
        $type_ad = $query218[0]->type;
        $id_ad = $query218[0]->id;
        //**************************************************
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $uid_ajout_tag  = $this->input->post('uid_ajout_tag');
            $type_ajout_tag  = $this->input->post('type_ajout_tag');
            $appar_ajout_tag  = $this->input->post('appar_ajout_tag');

            $id_modif_tag = $this->input->post('id_modif_tag');
            $uid_modif_tag = $this->input->post('uid_modif_tag');
            $type_modif_tag = $this->input->post('type_modif_tag');
            $appar_modif_tag = $this->input->post('appar_modif_tag');



            $id_suppression_tag = $this->input->post('id_suppression_tag');
            $id_blocage_tag = $this->input->post('id_blocage_tag');
            $id_deblocage_tag = $this->input->post('id_deblocage_tag');

            $uid_up_tag_pass = $this->input->post('uid_up_tag_pass');

            if (isset($uid_up_tag_pass)) {
                //*****************************************************
                $query111 = $this->sdl_model->get_tag_pass();
                $ok = false;
                foreach ($query111 as $q111) {
                    $ok = true;
                }
                $today = date("Y-m-d H:i:s");
                if ($ok) {
                    //update
                    $id_modif_tagpass = $query111[0]->id;
                    $data_up = array(
                        'uid' => $uid_up_tag_pass,
                        'updated_at' => $today
                    );

                    $this->load->model('sdl_model');
                    $this->sdl_model->modifier_tag($data_up, $id_modif_tagpass);
                } else {
                    //insert   
                    $data_add = array(
                        'uid' => $uid_up_tag_pass,
                        'type' => 2,
                        'etat' => 1,
                        'id_appartement' => 0,
                        'created_at' => $today,
                        'updated_at' => $today
                    );
                    $this->load->model('sdl_model');
                    $this->sdl_model->ajouter_tag($data_add);
                }
                //*****************************************************    
            } else if (isset($id_suppression_tag)) {
                $this->load->model('sdl_model');
                $this->sdl_model->delete_tag($id_suppression_tag);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Suppression tag ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************

            } else if (isset($id_blocage_tag)) {
                $this->load->model('sdl_model');
                $this->sdl_model->blocage_tag($id_blocage_tag);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Blocage tag ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //******************************************************* 
            } else if (isset($id_deblocage_tag)) {
                $this->load->model('sdl_model');
                $this->sdl_model->deblocage_tag($id_deblocage_tag);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Déblocage tag ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************

            } else if (isset($id_modif_tag)) {
                //**************************************************************************************
                $today = date("Y-m-d H:i:s");
                if ($appar_modif_tag == "") {
                    $appar_modif_tag = 0;
                }
                $data_up = array(
                    'uid' => $uid_modif_tag,
                    'type' => $type_modif_tag,
                    'id_appartement' => $appar_modif_tag,
                    'updated_at' => $today
                );

                $this->load->model('sdl_model');
                $this->sdl_model->modifier_tag($data_up, $id_modif_tag);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Modification tag ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
                //*****************************************************************************************
            } else if (isset($uid_ajout_tag)) {
                //**********************************************************************************
                $today = date("Y-m-d H:i:s");
                if ($appar_ajout_tag == "") {
                    $appar_ajout_tag = 0;
                }
                $data_add = array(
                    'uid' => $uid_ajout_tag,
                    'type' => $type_ajout_tag,
                    'etat' => 1,
                    'id_appartement' => $appar_ajout_tag,
                    'created_at' => $today,
                    'updated_at' => $today
                );

                $this->sdl_model->ajouter_tag($data_add);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Ajout tag ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
                //**********************************************************************************
            }
        }
        //********************************************************************
        $data['title'] = 'Gestion des appartements';
        $data['message'] = 'Les tags';
        $data['menu'] = 23;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("13", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $tabjs = array('assets/js/sdl/tags.js');
        $data['tabjs'] = $tabjs;
        $query1 = $this->sdl_model->list_of_tags();
        $data['tags'] = $query1;

        $query11 = $this->sdl_model->get_tag_pass();
        if ($query11) {
            $data['t_pass'] = $query11[0]->uid;
        } else {
            $data['t_pass'] = "";
        }
        $query2 = $this->sdl_model->list_of_apartments();
        $data['apartments'] = $query2;
        $query3 = $this->sdl_model->list_of_blocks();
        $data['blocs'] = $query3;
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/tags_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function owners()
    {

        //**************************************************
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        $login218 = $this->session->userdata('user_login');
        $query218 = $this->sdl_model->get_user_by_login($login218);
        $type_ad = $query218[0]->type;
        $id_ad = $query218[0]->id;
        //**************************************************
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {



            $cin_ajout_owner  = $this->input->post('cin_ajout_owner');
            $nom_ajout_owner  = $this->input->post('nom_ajout_owner');
            $prenom_ajout_owner  = $this->input->post('prenom_ajout_owner');
            $sexe_ajout_owner  = $this->input->post('sexe_ajout_owner');
            if ($sexe_ajout_owner == '') {
                $sexe_ajout_owner = 1;
            }
            $tel_ajout_owner  = $this->input->post('tel_ajout_owner');
            $email_ajout_owner  = $this->input->post('email_ajout_owner');
            $desc_ajout_owner  = $this->input->post('desc_ajout_owner');
            $photo_ajout_owner  = $this->input->post('photo_ajout_owner');


            $id_modif_owner = $this->input->post('id_modif_owner');
            $nom_modif_owner = $this->input->post('nom_modif_owner');
            $prenom_modif_owner = $this->input->post('prenom_modif_owner');
            $cin_modif_owner = $this->input->post('cin_modif_owner');
            $sexe_modif_owner = $this->input->post('sexe_modif_owner');
            $tel_modif_owner = $this->input->post('tel_modif_owner');
            $email_modif_owner = $this->input->post('email_modif_owner');
            $desc_modif_owner = $this->input->post('desc_modif_owner');
            $photo_modif_owner = $this->input->post('photo_modif_owner');

            $id_blocage_owner = $this->input->post('id_blocage_owner');

            $id_deblocage_owner = $this->input->post('id_deblocage_owner');



            $id_reinitialisation_owner = $this->input->post('id_reinitialisation_owner');

            $id_suppression_owner = $this->input->post('id_suppression_owner');


            if (isset($id_suppression_owner)) {
                $this->load->model('sdl_model');
                $this->sdl_model->delete_owner($id_suppression_owner);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Suppression propriétaire ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
            } else if (isset($id_reinitialisation_owner)) {
                $this->load->model('sdl_model');
                $this->sdl_model->reinit_owner($id_reinitialisation_owner);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Réinitialisation mot de passe propriétaire ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
            } else if (isset($id_deblocage_owner)) {
                $this->load->model('sdl_model');
                $this->sdl_model->deblocage_owner($id_deblocage_owner);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Déblocage propriétaire ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //******************************************************* 
            } else if (isset($id_blocage_owner)) {
                $this->load->model('sdl_model');
                $this->sdl_model->blocage_owner($id_blocage_owner);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Blocage propriétaire ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //******************************************************* 
            } else if (isset($id_modif_owner)) {
                //**************************************************************************************

                $new_name = "";
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']             = '';
                $config['max_width']            = '';
                $config['max_height']           = '';

                if ($_FILES["photo_modif_owner"]['name'] != "") {
                    $new_name = time() . "123654789";
                }
                $config['file_name'] = $new_name;
                $ext = pathinfo($_FILES["photo_modif_owner"]['name'], PATHINFO_EXTENSION);
                if ($new_name != "") {
                    $new_name = $new_name . "." . $ext;
                }

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo_modif_owner')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('photo_modif_admin' => $this->upload->data());
                }
                //**************************************************************************
                $today = date("Y-m-d");
                $data_up = array(
                    'nom' => $nom_modif_owner,
                    'prenom' => $prenom_modif_owner,
                    'cin' => $cin_modif_owner,
                    'sexe' => $sexe_modif_owner,
                    'email' => $email_modif_owner,
                    'tel' => $tel_modif_owner,
                    'desc' => $desc_modif_owner,
                    'photo' => $new_name,
                    'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->modifier_owner($data_up, $id_modif_owner);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Modification propriétaire ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //******************************************************* 
                //*****************************************************************************************
            } else if (isset($nom_ajout_owner)) {
                //**********************************************************************************
                $new_name = "";
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']             = '';
                $config['max_width']            = '';
                $config['max_height']           = '';
                if ($_FILES["photo_ajout_owner"]['name'] != "") {
                    $new_name = time() . "123654789";
                }
                $config['file_name'] = $new_name;
                $ext = pathinfo($_FILES["photo_ajout_owner"]['name'], PATHINFO_EXTENSION);
                if ($new_name != "") {
                    $new_name = $new_name . "." . $ext;
                }

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo_ajout_owner')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }


                //**************************************************************************
                $today = date("Y-m-d");
                $this->load->model('sdl_model');
                //$nb= $this->sdl_model->count_owners()[0]->nb+1;
                $nb = $this->sdl_model->getLastOwnerId()[0]->id + 1;

                $login = "own_0" . $nb . "";
                $password = $this->sdl_model->random_password();
                $this->load->library('encrypt');
                $password = $this->encrypt->encode($password);
                $data_add = array(
                    'login' => $login,
                    'password' => $password,
                    'nom' => $nom_ajout_owner,
                    'prenom' => $prenom_ajout_owner,
                    'cin' => $cin_ajout_owner,
                    'sexe' => $sexe_ajout_owner,
                    'email' => $email_ajout_owner,
                    'tel' => $tel_ajout_owner,
                    'desc' => $desc_ajout_owner,
                    'photo' => $new_name,
                    'type' => 3,
                    'roles' => '',
                    'etat' => 1,
                    'online' => 0,
                    'sup' => 0,
                    'created_at' => $today,
                    'updated_at' => $today
                );
                $this->sdl_model->ajouter_owner($data_add);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Ajout propriétaire ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //******************************************************* 
                //**********************************************************************************
            }
        }
        //********************************************************************
        $data['title'] = 'Gestion des utilisateurs';
        $data['message'] = 'Les propriétaires';
        $data['menu'] = 31;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("21", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $tabjs = array('assets/js/sdl/owners.js');
        $data['tabjs'] = $tabjs;
        $query2 = $this->sdl_model->list_of_owners();
        $data['owners'] = $query2;
        $query3 = $this->sdl_model->list_of_blocks();
        $data['blocs'] = $query3;
        $query4 = $this->sdl_model->list_apartements_not_affected();
        $data['appar'] = $query4;
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/owners_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function administrators()
    {

        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;

        //********************************************************************
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $nom_ajout_admin  = $this->input->post('nom_ajout_admin');
            $prenom_ajout_admin  = $this->input->post('prenom_ajout_admin');
            $cin_ajout_admin = $this->input->post('cin_ajout_admin');
            $sexe_ajout_admin  = $this->input->post('sexe_ajout_admin');
            if ($sexe_ajout_admin == '') {
                $sexe_ajout_admin = 1;
            }
            $tel_ajout_admin  = $this->input->post('tel_ajout_admin');
            $email_ajout_admin  = $this->input->post('email_ajout_admin');
            $desc_ajout_admin  = $this->input->post('desc_ajout_admin');
            $photo_ajout_admin  = $this->input->post('photo_ajout_admin');


            $id_modif_admin = $this->input->post('id_modif_admin');
            $nom_modif_admin = $this->input->post('nom_modif_admin');
            $prenom_modif_admin = $this->input->post('prenom_modif_admin');
            $cin_modif_admin = $this->input->post('cin_modif_admin');
            $sexe_modif_admin = $this->input->post('sexe_modif_admin');
            $tel_modif_admin = $this->input->post('tel_modif_admin');
            $email_modif_admin = $this->input->post('email_modif_admin');
            $desc_modif_admin = $this->input->post('desc_modif_admin');
            $photo_modif_admin = $this->input->post('photo_modif_admin');

            $id_blocage_admin = $this->input->post('id_blocage_admin');

            $id_deblocage_admin = $this->input->post('id_deblocage_admin');

            $id_roles_admin = $this->input->post('id_roles_admin');
            $roles_admin = $this->input->post('roles_admin');

            $id_reinitialisation_admin = $this->input->post('id_reinitialisation_admin');

            $id_suppression_admin = $this->input->post('id_suppression_admin');


            if (isset($id_suppression_admin)) {
                $this->load->model('sdl_model');
                $this->sdl_model->delete_admin($id_suppression_admin);
            } else if (isset($id_reinitialisation_admin)) {
                $this->load->model('sdl_model');
                $this->sdl_model->reinit_admin($id_reinitialisation_admin);
            } else if (isset($id_roles_admin)) {
                $this->load->model('sdl_model');
                $this->sdl_model->edit_roles_admin($id_roles_admin, $roles_admin);
            } else if (isset($id_deblocage_admin)) {
                $this->load->model('sdl_model');
                $this->sdl_model->deblocage_admin($id_deblocage_admin);
            } else if (isset($id_blocage_admin)) {
                $this->load->model('sdl_model');
                $this->sdl_model->blocage_admin($id_blocage_admin);
            } else if (isset($id_modif_admin)) {
                //**************************************************************************************

                $new_name = "";
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']             = '';
                $config['max_width']            = '';
                $config['max_height']           = '';

                if ($_FILES["photo_modif_admin"]['name'] != "") {
                    $new_name = time() . "123654789";
                }
                $config['file_name'] = $new_name;
                $ext = pathinfo($_FILES["photo_modif_admin"]['name'], PATHINFO_EXTENSION);
                if ($new_name != "") {
                    $new_name = $new_name . "." . $ext;
                }

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo_modif_admin')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('photo_modif_admin' => $this->upload->data());
                }
                //**************************************************************************
                $today = date("Y-m-d");
                $data_up = array(
                    'nom' => $nom_modif_admin,
                    'prenom' => $prenom_modif_admin,
                    'cin' => $cin_modif_admin,
                    'sexe' => $sexe_modif_admin,
                    'email' => $email_modif_admin,
                    'tel' => $tel_modif_admin,
                    'desc' => $desc_modif_admin,
                    'photo' => $new_name,
                    'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->modifier_admin($data_up, $id_modif_admin);
                //*****************************************************************************************
            } else if (isset($nom_ajout_admin)) {
                //**********************************************************************************
                $new_name = "";
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']             = '';
                $config['max_width']            = '';
                $config['max_height']           = '';
                if ($_FILES["photo_ajout_admin"]['name'] != "") {
                    $new_name = time() . "123654789";
                }
                $config['file_name'] = $new_name;
                $ext = pathinfo($_FILES["photo_ajout_admin"]['name'], PATHINFO_EXTENSION);
                if ($new_name != "") {
                    $new_name = $new_name . "." . $ext;
                }

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo_ajout_admin')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }

                $login = $this->session->userdata('user_login');
                $user_query = $this->sdl_model->get_user_by_login($login);
                $user =  $user_query[0];
                //**************************************************************************
                $today = date("Y-m-d");
                $this->load->model('sdl_model');
                $nb = $this->sdl_model->count_sousadmin()[0]->nb + 1;

                $login = "admin_0".$user->residence_id."_" . $nb . "";
                $password = $this->sdl_model->random_password();
                $this->load->library('encrypt');
                $password = $this->encrypt->encode($password);
                $data_add = array(
                    'login' => $login,
                    'password' => $password,
                    'nom' => $nom_ajout_admin,
                    'prenom' => $prenom_ajout_admin,
                    'cin' => $cin_ajout_admin,
                    'sexe' => $sexe_ajout_admin,
                    'email' => $email_ajout_admin,
                    'tel' => $tel_ajout_admin,
                    'desc' => $desc_ajout_admin,
                    'photo' => $new_name,
                    'type' => 2,
                    'roles' => '11,12,13,21,31,32,41,42,51,52,53',
                    'etat' => 1,
                    'online' => 0,
                    'sup' => 0,
                    'created_at' => $today,
                    'updated_at' => $today
                );
                $this->sdl_model->ajouter_admin($data_add);
                //**********************************************************************************
            }
        }
        //********************************************************************
        $data['title'] = 'Gestion des utilisateurs';
        $data['message'] = 'Les administrateurs';
        $data['menu'] = 32;
        $tabjs = array('assets/js/sdl/administrators.js');
        $data['tabjs'] = $tabjs;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("22", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }

       
        $query2 = $this->sdl_model->list_of_admin();
        $data['admins'] = $query2;
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/administrators_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }

    //******************************************************************************************
    public function reclamations()
    {
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        $data['title'] = 'Gestion des utilisateurs';
        $data['message'] = 'Les réclamations';
        $data['menu'] = 33;
        $tabjs = array('assets/js/sdl/reclamations.js');
        $data['tabjs'] = $tabjs;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;



        $query5 = $this->sdl_model->list_of_apartments();
        $data['apartments'] = $query5;

        $query6 = $this->sdl_model->list_of_reclamations();
        $data['reclamations'] = $query6;

        $query6 = $this->sdl_model->list_of_blocks();
        $data['blocs'] = $query6;
        $query8 = $this->sdl_model->list_of_owners();
        $data['owners'] = $query8;


        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/reclamations_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function services()
    {
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        //**************************************************
        $login218 = $this->session->userdata('user_login');
        $query218 = $this->sdl_model->get_user_by_login($login218);
        $type_ad = $query218[0]->type;
        $id_ad = $query218[0]->id;
        //**************************************************
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $nom_ajout_service  = $this->input->post('nom_ajout_service');
            $desc_ajout_service  = $this->input->post('desc_ajout_service');


            $id_modif_service = $this->input->post('id_modif_service');
            $nom_modif_service = $this->input->post('nom_modif_service');
            $desc_modif_service = $this->input->post('desc_modif_service');


            $id_suppression_service = $this->input->post('id_suppression_service');


            if (isset($id_suppression_service)) {
                $this->load->model('sdl_model');
                $this->sdl_model->delete_service($id_suppression_service);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Suppression service ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************

            } else if (isset($id_modif_service)) {
                //**************************************************************************************

                $data_up = array(
                    'nom' => $nom_modif_service,
                    'desc' => $desc_modif_service
                );
                $this->load->model('sdl_model');
                $this->sdl_model->modifier_service($data_up, $id_modif_service);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Modification service ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
                //*****************************************************************************************
            } else if (isset($nom_ajout_service)) {
                //**********************************************************************************

                $data_add = array(
                    'nom' => $nom_ajout_service,
                    'desc' => $desc_ajout_service
                );
                $this->sdl_model->ajouter_service($data_add);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Ajout service ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
                //**********************************************************************************
            }
        }
        //********************************************************************
        $data['title'] = 'Gestion des services';
        $data['message'] = 'Les services';
        $data['menu'] = 41;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("31", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $tabjs = array('assets/js/sdl/services.js');
        $data['tabjs'] = $tabjs;
        $query2 = $this->sdl_model->list_of_services();
        $data['services'] = $query2;
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/services_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function employees()
    {

        //**************************************************
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        $login218 = $this->session->userdata('user_login');
        $query218 = $this->sdl_model->get_user_by_login($login218);
        $type_ad = $query218[0]->type;
        $id_ad = $query218[0]->id;
        //**************************************************
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $nom_ajout_empl  = $this->input->post('nom_ajout_empl');
            $cin_ajout_empl  = $this->input->post('cin_ajout_empl');
            $prenom_ajout_empl  = $this->input->post('prenom_ajout_empl');
            $sexe_ajout_empl  = $this->input->post('sexe_ajout_empl');
            if ($sexe_ajout_empl == '') {
                $sexe_ajout_empl = 1;
            }
            $tel_ajout_empl  = $this->input->post('tel_ajout_empl');
            $email_ajout_empl  = $this->input->post('email_ajout_empl');
            $desc_ajout_empl  = $this->input->post('desc_ajout_empl');
            $photo_ajout_empl  = $this->input->post('photo_ajout_empl');
            $services_tab  = $this->input->post('services');



            $id_modif_empl = $this->input->post('id_modif_empl');
            $cin_modif_empl = $this->input->post('cin_modif_empl');
            $nom_modif_empl = $this->input->post('nom_modif_empl');
            $prenom_modif_empl = $this->input->post('prenom_modif_empl');
            $sexe_modif_empl = $this->input->post('sexe_modif_empl');
            $tel_modif_empl = $this->input->post('tel_modif_empl');
            $email_modif_empl = $this->input->post('email_modif_empl');
            $desc_modif_empl = $this->input->post('desc_modif_empl');
            $photo_modif_empl = $this->input->post('photo_modif_empl');
            $upservices_tab  = $this->input->post('upservices');


            $id_hors_empl = $this->input->post('id_hors_empl');

            $id_en_empl = $this->input->post('id_en_empl');

            $id_suppression_empl = $this->input->post('id_suppression_empl');



            if (isset($id_suppression_empl)) {
                $this->load->model('sdl_model');
                $this->sdl_model->delete_empl($id_suppression_empl);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Suppression employé ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************

            } else if (isset($id_hors_empl)) {
                $this->load->model('sdl_model');
                $this->sdl_model->hors_empl($id_hors_empl);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Changement état employé ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //****************************************************** 
            } else if (isset($id_en_empl)) {
                $this->load->model('sdl_model');
                $this->sdl_model->en_empl($id_en_empl);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Changement état employé ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //******************************************************  
            } else if (isset($id_modif_empl)) {
                $service_modif_empl = "";
                if (count($upservices_tab) != 0) {
                    $service_modif_empl = implode(",", $upservices_tab);
                }

                //**********************************************************************************

                $new_name = "";
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']             = '';
                $config['max_width']            = '';
                $config['max_height']           = '';

                if ($_FILES["photo_modif_empl"]['name'] != "") {
                    $new_name = time() . "123654789";
                }
                $config['file_name'] = $new_name;
                $ext = pathinfo($_FILES["photo_modif_empl"]['name'], PATHINFO_EXTENSION);
                if ($new_name != "") {
                    $new_name = $new_name . "." . $ext;
                }

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo_modif_empl')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
                //**************************************************************************
                $today = date("Y-m-d");
                $data_up = array(
                    'nom' => $nom_modif_empl,
                    'prenom' => $prenom_modif_empl,
                    'cin' => $cin_modif_empl,
                    'sexe' => $sexe_modif_empl,
                    'tel' => $tel_modif_empl,
                    'email' => $email_modif_empl,
                    'desc' => $desc_modif_empl,
                    'photo' => $new_name,
                    'id_service' => $service_modif_empl
                );

                $this->load->model('sdl_model');
                $this->sdl_model->modifier_empl($data_up, $id_modif_empl);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Modification employé ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //****************************************************** 
                //*****************************************************************************************
            } else if (isset($nom_ajout_empl)) {

                $service_ajout_empl = "";
                if (count($services_tab) != 0) {
                    $service_ajout_empl = implode(",", $services_tab);
                }
                //**********************************************************************************
                $new_name = "";
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']             = '';
                $config['max_width']            = '';
                $config['max_height']           = '';
                if ($_FILES["photo_ajout_empl"]['name'] != "") {
                    $new_name = time() . "123654789";
                }
                $config['file_name'] = $new_name;
                $ext = pathinfo($_FILES["photo_ajout_empl"]['name'], PATHINFO_EXTENSION);
                if ($new_name != "") {
                    $new_name = $new_name . "." . $ext;
                }

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo_ajout_empl')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }


                //**************************************************************************
                $this->load->model('sdl_model');
                $data_add = array(
                    'nom' => $nom_ajout_empl,
                    'prenom' => $prenom_ajout_empl,
                    'cin' => $cin_ajout_empl,
                    'sexe' => $sexe_ajout_empl,
                    'tel' => $tel_ajout_empl,
                    'email' => $email_ajout_empl,
                    'desc' => $desc_ajout_empl,
                    'photo' => $new_name,
                    'etat' => 1,
                    'id_service' => $service_ajout_empl
                );
                $this->sdl_model->ajouter_empl($data_add);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Ajout employé ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //****************************************************** 
                //**********************************************************************************
            }
        }
        //********************************************************************
        $data['title'] = 'Gestion des services';
        $data['message'] = 'Les employés';
        $data['menu'] = 42;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("32", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $tabjs = array('assets/js/sdl/employees.js');
        $data['tabjs'] = $tabjs;
        $query2 = $this->sdl_model->list_of_services();
        $data['services'] = $query2;
        $query3 = $this->sdl_model->list_of_employees();
        $data['employees'] = $query3;
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/employees_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }

    public function sport()
    {
        //**************************************************
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        $login218 = $this->session->userdata('user_login');
        $query218 = $this->sdl_model->get_user_by_login($login218);
        $type_ad = $query218[0]->type;
        $id_ad = $query218[0]->id;
        //**************************************************
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $id_a  = $this->input->post('id_app');
            $id_p  = $this->input->post('id_p');
            $date_d  = $this->input->post('date_d');
            $date_f  = $this->input->post('date_f');
            $temps_d  = $this->input->post('temps_d');
            $temps_f  = $this->input->post('temps_f');
            $id_suppression_ac  = $this->input->post('id_suppression_ac');
            if (isset($id_a)) {
                //  id ,id_p,id_a,tags,d_deut,d_fin,t_debut,t_fin,sup                
                $this->load->model('sdl_model');
                $q = $this->sdl_model->get_sport_by_id_app($id_a);
                if (!empty($q)) {
                    //update_sport
                    $data_up = array(
                        'id_p' => $id_p,
                        'id_a' => $id_a,
                        'tags' => '',
                        'd_deut' => $date_d,
                        'd_fin' => $date_f,
                        't_debut' => $temps_d,
                        't_fin' => $temps_f,
                        'sup' => 0
                    );
                    $this->load->model('sdl_model');
                    $this->sdl_model->update_sport($data_up, $id_a);
                    //******************************************************
                    if ($type_ad == 2) {

                        $action = " Modification d'accès au salle de sport ";
                        $date_ac = date("Y-m-d H:i:s");
                        $data_add = array(
                            'id_ad' => $id_ad,
                            'action' => $action,
                            'date_ac' => $date_ac
                        );
                        $this->sdl_model->add_action($data_add);
                    }
                    //*******************************************************

                } else {
                    //insert_sport
                    $data_in = array(
                        'id_p' => $id_p,
                        'id_a' => $id_a,
                        'tags' => '',
                        'd_deut' => $date_d,
                        'd_fin' => $date_f,
                        't_debut' => $temps_d,
                        't_fin' => $temps_f,
                        'sup' => 0
                    );
                    $this->load->model('sdl_model');
                    $this->sdl_model->insert_sport($data_in);
                    //******************************************************
                    if ($type_ad == 2) {

                        $action = " Modification d'accès au salle de sport ";
                        $date_ac = date("Y-m-d H:i:s");
                        $data_add = array(
                            'id_ad' => $id_ad,
                            'action' => $action,
                            'date_ac' => $date_ac
                        );
                        $this->sdl_model->add_action($data_add);
                    }
                    //*******************************************************
                }
            } else if (isset($id_suppression_ac)) {
                //update_sport
                $data_up = array(
                    'sup' => 1
                );
                $this->load->model('sdl_model');
                $this->sdl_model->update_sport($data_up, $id_suppression_ac);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Suppression d'accès au salle de sport ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
            }
        }
        //********************************************************************
        $data['title'] = 'Gestion des services';
        $data['message'] = "Gestion d'accès au salle de sport";
        $data['menu'] = 43;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("33", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $tabjs = array('assets/js/sdl/sport.js');
        $data['tabjs'] = $tabjs;
        $query2 = $this->sdl_model->list_of_owners();
        $data['owners'] = $query2;
        $query3 = $this->sdl_model->list_of_blocks();
        $data['blocs'] = $query3;
        $query4 = $this->sdl_model->list_of_apartments();
        $data['apartments'] = $query4;
        $query5 = $this->sdl_model->list_of_sports();
        $data['sports'] = $query5;


        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/sport_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }

    public function service_r()
    {

        //********************************************************************
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        //**************************************************
        $login218 = $this->session->userdata('user_login');
        $query218 = $this->sdl_model->get_user_by_login($login218);
        $type_ad = $query218[0]->type;
        $id_ad = $query218[0]->id;
        //**************************************************
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $id_suppression_d  = $this->input->post('id_suppression_d');

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

            $user_id = $this->session->userdata('user_id');
            $today = date("Y-m-d H:i:s");
            //id, id_appa, id_prop, id_serv, date_debut, date_fin, heur_debut,  heur_fin,description,   etat,id_emp,    id_tag,created_at,updated_at,id_add,    type_add
            if (isset($id_suppression_d)) {
                $this->load->model('sdl_model');
                $this->sdl_model->delete_demandeservice($id_suppression_d);
                $this->sdl_model->delete_etatdemande($id_suppression_d, 1);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Suppression demande service ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************

            } else if (isset($add_date_d)) {
                $data_in = array(
                    'id_appa' => $add_id_app,
                    'id_prop' => $add_id_p,
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
                    'type_add' => 1
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
                $this->sdl_model->insert_etatdemande($data_e);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Ajout demande service ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
            } else if (isset($date_d)) {
                $data_up = array(
                    'id_appa' => $id_app,
                    'id_prop' => $id_p,
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
                $this->sdl_model->update_demandeservice($data_up, $id_d);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Modification demande service ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************

            }
        }
        //********************************************************************
        $data['title'] = 'Gestion des services';
        $data['message'] = "Demande service";
        $data['menu'] = 44;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("34", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $tabjs = array('assets/js/sdl/service_r.js');
        $data['tabjs'] = $tabjs;
        $query2 = $this->sdl_model->list_of_services();
        $data['services'] = $query2;
        $query3 = $this->sdl_model->list_of_employees();
        $data['employees'] = $query3;

        $query4 = $this->sdl_model->list_of_owners();
        $data['owners'] = $query4;
        $query5 = $this->sdl_model->list_of_blocks();
        $data['blocs'] = $query5;
        $query6 = $this->sdl_model->list_of_apartments();
        $data['apartments'] = $query6;
        $query7 = $this->sdl_model->list_of_s_requests();
        $data['s_requests'] = $query7;

        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/service_r_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }

    //******************************************************************************************
    public function appels()
    {
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        //**************************************************
        redirect(base_url('login/'));
        $login218 = $this->session->userdata('user_login');
        $query218 = $this->sdl_model->get_user_by_login($login218);
        $type_ad = $query218[0]->type;
        $id_ad = $query218[0]->id;
        //**************************************************
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {


            $add_date_d = $this->input->post('add_date_d');
            $add_date_f = $this->input->post('add_date_f');
            $add_temps_d = $this->input->post('add_temps_d');
            $add_temps_f = $this->input->post('add_temps_f');
            $add_id_app = $this->input->post('add_id_app');
            $add_id_p = $this->input->post('add_id_p');
            $add_desc = $this->input->post('add_desc');
            $add_serv = $this->input->post('add_serv');
            $add_id_appel = $this->input->post('add_id_appel');
            $add_remar_sat = $this->input->post('add_remar_sat');

            $id_appel  = $this->input->post('id_appel');
            $remar_sat  = $this->input->post('remar_sat');

            $user_id = $this->session->userdata('user_id');
            $today = date("Y-m-d H:i:s");

            if (isset($add_id_appel)) {
                $data_in = array(
                    'id_appa' => $add_id_app,
                    'id_prop' => $add_id_p,
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
                    'type_add' => 1
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
                $this->sdl_model->insert_etatdemande($data_e);

                $data_up = array(
                    'vu' => 1,
                    'd_vu' => $today,
                    'remarque_vu' => $add_remar_sat,
                    'service' => 1
                );
                $this->sdl_model->update_vu_appel($data_up, $add_id_appel);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Ajout demande service ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************


            } else if (isset($id_appel)) {
                $data_up = array(
                    'vu' => 1,
                    'd_vu' => $today,
                    'remarque_vu' => $remar_sat,
                    'service' => 0
                );
                $this->load->model('sdl_model');
                $this->sdl_model->update_vu_appel($data_up, $id_appel);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Réponse demande ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************


            } else {
            }
        }
        //********************************************************************************
        $data['title'] = 'Les appels';
        $data['message'] = "Les appels des appartements";
        $data['menu'] = 45;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("35", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $tabjs = array('assets/js/sdl/appels.js');
        $data['tabjs'] = $tabjs;
        $query2 = $this->sdl_model->list_of_services();
        $data['services'] = $query2;
        $query3 = $this->sdl_model->liste_appels();
        $data['appels'] = $query3;
        $query3 = $this->sdl_model->list_of_apartments();
        $data['apartments'] = $query3;
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/appels_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function s_requests()
    {
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        //**************************************************
        $login218 = $this->session->userdata('user_login');
        $query218 = $this->sdl_model->get_user_by_login($login218);
        $type_ad = $query218[0]->type;
        $id_ad = $query218[0]->id;
        //**************************************************
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $id_dem_ser_acc = $this->input->post('id_dem_ser_acc');
            $id_dem_ser_ann = $this->input->post('id_dem_ser_ann');
            $id_dem_ser_ter = $this->input->post('id_dem_ser_ter');
            $id_dem_ser_emp = $this->input->post('id_dem_ser_emp');
            $s_id_dem_ser_emp = $this->input->post('s_id_dem_ser_emp');
            $id_dem_ser_tag = $this->input->post('id_dem_ser_tag');
            $s_id_dem_ser_tag = $this->input->post('s_id_dem_ser_tag');
            $id_app_tag = $this->input->post('id_app_tag');
            $message = $this->input->post('message');
            $id_dem_ser_mess = $this->input->post('id_dem_ser_mess');


            $user_id = $this->session->userdata('user_id');
            $today = date("Y-m-d H:i:s");
            //id,id_appa,id_prop,id_serv,date_debut,date_fin,heur_debut,heur_fin,description,etat,  id_emp,id_tag,created_at,updated_at,id_add,type_add
            if (isset($id_dem_ser_acc)) {
                $data_up = array(
                    'etat' => 3,
                    'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->update_demandeservice($data_up, $id_dem_ser_acc);
                $data_e = array(
                    'id_demande' => $id_dem_ser_acc,
                    'type_demande' => 1,
                    'etat' => 3,
                    'date' => $today
                );
                $this->sdl_model->insert_etatdemande($data_e);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Acceptation demande service  ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************

            } else if (isset($id_dem_ser_mess)) {
                $data_up = array(
                    'message' => $message
                );
                $this->load->model('sdl_model');
                $this->sdl_model->update_demandeservice($data_up, $id_dem_ser_mess);
            } else if (isset($id_dem_ser_ann)) {
                $data_up = array(
                    'etat' => 6,
                    'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->update_demandeservice($data_up, $id_dem_ser_ann);
                $data_e = array(
                    'id_demande' => $id_dem_ser_ann,
                    'type_demande' => 1,
                    'etat' => 6,
                    'date' => $today
                );
                $this->sdl_model->insert_etatdemande($data_e);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Annulation demande service  ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
            } else if (isset($id_dem_ser_ter)) {
                $data_up = array(
                    'etat' => 5,
                    'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->update_demandeservice($data_up, $id_dem_ser_ter);
                $data_e = array(
                    'id_demande' => $id_dem_ser_ter,
                    'type_demande' => 1,
                    'etat' => 5,
                    'date' => $today
                );
                $this->sdl_model->insert_etatdemande($data_e);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Termination demande service  ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************           
            } else if (isset($id_dem_ser_emp)) {
                $data_up = array(
                    'id_emp' => $s_id_dem_ser_emp,
                    'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->update_demandeservice($data_up, $id_dem_ser_emp);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Affectation employé service  ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************              
            } else if (isset($id_dem_ser_tag)) {
                //tag
                //$id_app_tag
                if ($s_id_dem_ser_tag == 0) {
                }

                $data_up_t = array(
                    'id_appartement' => $id_app_tag,
                    'updated_at' => $today
                );

                $data_up = array(
                    'id_tag' => $s_id_dem_ser_tag,
                    'etat' => 4,
                    'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->update_demandeservice($data_up, $id_dem_ser_tag);
                $data_e = array(
                    'id_demande' => $id_dem_ser_tag,
                    'type_demande' => 1,
                    'etat' => 4,
                    'date' => $today
                );
                $this->sdl_model->insert_etatdemande($data_e);
                //$this->sdl_model->modifier_tag($data_up_t,$s_id_dem_ser_tag);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Affectation tag service ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************

            }
        }
        //********************************************************************
        $data['title'] = 'Gestion des demandes';
        $data['message'] = 'Les services';
        $data['menu'] = 51;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("41", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $query2 = $this->sdl_model->list_of_s_requests();
        $data['s_requests'] = $query2;
        $query3 = $this->sdl_model->list_of_services();
        $data['services'] = $query3;
        $query4 = $this->sdl_model->list_of_employees();
        $data['employees'] = $query4;
        $query5 = $this->sdl_model->list_of_apartments();
        $data['apartments'] = $query5;
        $query6 = $this->sdl_model->list_of_blocks();
        $data['blocs'] = $query6;
        $query7 = $this->sdl_model->list_of_tags();
        $data['tags'] = $query7;
        $query8 = $this->sdl_model->list_of_owners();
        $data['owners'] = $query8;
        $tabjs = array('assets/js/sdl/s_requests.js');
        $data['tabjs'] = $tabjs;
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/s_requests_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function a_requests()
    {
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        //**************************************************
        $login218 = $this->session->userdata('user_login');
        $query218 = $this->sdl_model->get_user_by_login($login218);
        $type_ad = $query218[0]->type;
        $id_ad = $query218[0]->id;
        //**************************************************   
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $id_dem_auto_acc = $this->input->post('id_dem_auto_acc');
            $id_dem_auto_ann = $this->input->post('id_dem_auto_ann');
            $id_dem_auto_ter = $this->input->post('id_dem_auto_ter');
            $id_dem_auto_tag = $this->input->post('id_dem_auto_tag');
            $s_id_dem_auto_tag = $this->input->post('s_id_dem_auto_tag');
            $id_app_tag = $this->input->post('id_app_tag');


            $today = date("Y-m-d H:i:s");

            // id, id_appa, id_prop, id_tag,date_debut, date_fin, heur_debut, heur_fin , nom, prenom , cin_pass, descption, etat, created_at, updated_at

            if (isset($id_dem_auto_acc)) {
                $data_up = array(
                    'etat' => 3,
                    'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->update_demandeauto($data_up, $id_dem_auto_acc);
                $data_e = array(
                    'id_demande' => $id_dem_auto_acc,
                    'type_demande' => 2,
                    'etat' => 3,
                    'date' => $today
                );
                $this->sdl_model->insert_etatdemande($data_e);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Acceptation demande d'autorisation ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************

            } else if (isset($id_dem_auto_ann)) {
                $data_up = array(
                    'etat' => 6,
                    'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->update_demandeauto($data_up, $id_dem_auto_ann);
                $data_e = array(
                    'id_demande' => $id_dem_auto_ann,
                    'type_demande' => 2,
                    'etat' => 6,
                    'date' => $today
                );
                $this->sdl_model->insert_etatdemande($data_e);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Annulation demande d'autorisation ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************
            } else if (isset($id_dem_auto_ter)) {
                $data_up = array(
                    'etat' => 5,
                    'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->update_demandeauto($data_up, $id_dem_auto_ter);
                $data_e = array(
                    'id_demande' => $id_dem_auto_ter,
                    'type_demande' => 2,
                    'etat' => 5,
                    'date' => $today
                );
                $this->sdl_model->insert_etatdemande($data_e);

                //******************************************************
                if ($type_ad == 2) {

                    $action = " Termination demande d'autorisation ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************            
            } else if (isset($id_dem_auto_tag)) {
                //tag
                //$id_app_tag
                if ($s_id_dem_auto_tag == 0) {
                }

                $data_up = array(
                    'id_tag' => $s_id_dem_auto_tag,
                    'etat' => 4,
                    'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->update_demandeauto($data_up, $id_dem_auto_tag);
                $data_e = array(
                    'id_demande' => $id_dem_auto_tag,
                    'type_demande' => 2,
                    'etat' => 4,
                    'date' => $today
                );
                $this->sdl_model->insert_etatdemande($data_e);
                //******************************************************
                if ($type_ad == 2) {

                    $action = " Affectation tag autorisation ";
                    $date_ac = date("Y-m-d H:i:s");
                    $data_add = array(
                        'id_ad' => $id_ad,
                        'action' => $action,
                        'date_ac' => $date_ac
                    );
                    $this->sdl_model->add_action($data_add);
                }
                //*******************************************************

            }
        }
        //********************************************************************
        $data['title'] = 'Gestion des demandes';
        $data['message'] = 'Les autorisations';
        $data['menu'] = 52;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("42", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $query2 = $this->sdl_model->list_of_a_requests();
        $data['a_requests'] = $query2;
        $query4 = $this->sdl_model->list_of_employees();
        $data['employees'] = $query4;
        $query5 = $this->sdl_model->list_of_apartments();
        $data['apartments'] = $query5;
        $query6 = $this->sdl_model->list_of_blocks();
        $data['blocs'] = $query6;
        $query7 = $this->sdl_model->list_of_tags();
        $data['tags'] = $query7;
        $query8 = $this->sdl_model->list_of_owners();
        $data['owners'] = $query8;
        $tabjs = array('assets/js/sdl/a_requests.js');
        $data['tabjs'] = $tabjs;
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/a_requests_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function s_histories()
    {

        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        $data['title'] = 'Les historiques';
        $data['message'] = 'Les services';
        $data['menu'] = 61;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("51", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $query2 = $this->sdl_model->list_of_s_requests();
        $data['s_requests'] = $query2;
        $query3 = $this->sdl_model->list_of_services();
        $data['services'] = $query3;
        $query4 = $this->sdl_model->list_of_employees();
        $data['employees'] = $query4;
        $query5 = $this->sdl_model->list_of_apartments();
        $data['apartments'] = $query5;
        $query6 = $this->sdl_model->list_of_blocks();
        $data['blocs'] = $query6;
        $query7 = $this->sdl_model->list_of_tags();
        $data['tags'] = $query7;
        $query8 = $this->sdl_model->list_of_owners();
        $data['owners'] = $query8;
        $query9 = $this->sdl_model->etatdemande_list_by_type(1);
        $data['etatdemande'] = $query9;
        $tabjs = array('assets/js/sdl/s_histories.js');
        $data['tabjs'] = $tabjs;

        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/s_histories_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function a_histories()
    {

        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        $data['title'] = 'Les historiques';
        $data['message'] = 'Les autorisations';
        $data['menu'] = 62;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("52", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }

        $query2 = $this->sdl_model->list_of_a_requests();
        $data['a_requests'] = $query2;
        $query4 = $this->sdl_model->list_of_employees();
        $data['employees'] = $query4;
        $query5 = $this->sdl_model->list_of_apartments();
        $data['apartments'] = $query5;
        $query6 = $this->sdl_model->list_of_blocks();
        $data['blocs'] = $query6;
        $query7 = $this->sdl_model->list_of_tags();
        $data['tags'] = $query7;
        $query8 = $this->sdl_model->list_of_owners();
        $data['owners'] = $query8;
        $query9 = $this->sdl_model->etatdemande_list_by_type(2);
        $data['etatdemande'] = $query9;
        $tabjs = array('assets/js/sdl/a_histories.js');
        $data['tabjs'] = $tabjs;

        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/a_histories_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function ac_histories()
    {

        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        $data['title'] = 'Les historiques';
        $data['message'] = 'Les actions';
        $data['menu'] = 63;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;

        //actions
        $query8 = $this->sdl_model->list_of_actions();
        $data['actions'] = $query8;
        $query88 = $this->sdl_model->list_of_admins();
        $data['admins'] = $query88;

        $tabjs = array('assets/js/sdl/ac_histories.js');
        $data['tabjs'] = $tabjs;

        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1) {
        } else {
            redirect(base_url('login/'));
        }
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/ac_histories_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }

    //******************************************************************************************
    public function s_statistiques()
    {
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        $data['title'] = 'Les statistiques';
        $data['message'] = 'Les services';
        $data['menu'] = 71;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tabjs = array('assets/js/sdl/s_statistiques.js');
        $data['tabjs'] = $tabjs;
        $query2 = $this->sdl_model->list_of_services();
        $data['services'] = $query2;
        $query3 = $this->sdl_model->list_of_employees();
        $data['employees'] = $query3;
        // employe : id,nom,prenom,cin,sexe,tel,email,desc,photo,etat,id_service,sup

        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("61", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/s_statistiques_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function a_statistiques()
    {
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        $data['title'] = 'Les statistiques';
        $data['message'] = 'Les autorisations';
        $data['menu'] = 72;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $tabjs = array('assets/js/sdl/a_statistiques.js');
        $data['tabjs'] = $tabjs;
        $tab_roles = explode(",", $query[0]->roles);
        if ($query[0]->type == 1 || in_array("62", $tab_roles)) {
        } else {
            redirect(base_url('login/'));
        }
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        //$this->load->view('sdl/a_statistiques_view',$data);
        $this->load->view('sdl/construction_view', $data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************
    public function notifications()
    {
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        $data['title'] = 'Les notifications';
        $data['message'] = 'Toutes les notifications';
        $data['menu'] = 0;
        $login = $this->session->userdata('user_login');
        $query = $this->sdl_model->get_user_by_login($login);
        $data['info'] = $query;
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        //$this->load->view('sdl/index_view',$data);
        $this->load->view('sdl/construction_view', $data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //******************************************************************************************

    //******************************************************************************************
    public function profil()
    {

        //********************************************************************
        $query6111 = $this->sdl_model->stat_count_demandeservice();
        $data['nb_demandeservice'] = $query6111;
        //*******************************************************************************
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $id_modif_user = $this->input->post('id_modif_user');
            $nom_modif_user = $this->input->post('nom_modif_user');
            $prenom_modif_user = $this->input->post('prenom_modif_user');
            $sexe_modif_user = $this->input->post('sexe_modif_user');
            if ($sexe_modif_user == '') {
                $sexe_modif_user = 1;
            }
            $tel_modif_user = $this->input->post('tel_modif_user');
            $email_modif_user = $this->input->post('email_modif_user');
            $desc_modif_user = $this->input->post('desc_modif_user');
            $photo_modif_user = $this->input->post('photo_modif_user');

            $id_modif_pass_user = $this->input->post('id_modif_pass_user');
            $nmp_modif_pass_user = $this->input->post('nmp_modif_pass_user');


            if (isset($id_modif_pass_user)) {
                $today = date("Y-m-d");
                $this->load->library('encrypt');
                $password = $this->encrypt->encode($nmp_modif_pass_user);
                $data_up = array(
                    'password' => $password,
                    'updated_at' => $today
                );
                $this->load->model('sdl_model');
                $this->sdl_model->modifier_admin($data_up, $id_modif_pass_user);
            } else if (isset($id_modif_user)) {
                //**************************************************************************************

                $new_name = "";
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']             = '';
                $config['max_width']            = '';
                $config['max_height']           = '';

                if ($_FILES["photo_modif_user"]['name'] != "") {
                    $new_name = time() . "123654789";
                }

                $config['file_name'] = $new_name;
                $ext = pathinfo($_FILES["photo_modif_user"]['name'], PATHINFO_EXTENSION);
                if ($new_name != "") {
                    $new_name = $new_name . "." . $ext;
                }

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo_modif_user')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('photo_modif_admin' => $this->upload->data());
                }
                //**************************************************************************
                $today = date("Y-m-d");
                if ($new_name == "") {
                    $data_up = array(
                        'nom' => $nom_modif_user,
                        'prenom' => $prenom_modif_user,
                        'sexe' => $sexe_modif_user,
                        'email' => $email_modif_user,
                        'tel' => $tel_modif_user,
                        'desc' => $desc_modif_user,
                        'updated_at' => $today
                    );
                } else {
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
                $this->sdl_model->modifier_admin($data_up, $id_modif_user);
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
        $tabjs = array('assets/js/sdl/profil.js');
        $data['tabjs'] = $tabjs;
        $this->load->view('sdl/common/header_view', $data);
        $this->load->view('sdl/common/title_page_view', $data);
        $this->load->view('sdl/profil_view', $data);
        //$this->load->view('sdl/construction_view',$data);
        $this->load->view('sdl/common/footer_view', $data);
    }
    //********************************************************************************************

    //************************** fin ****************************************




    /* ************************ NACHD START WORK ***************** */
    /* *************** Home page for super admin *********** */

    public function residences()
    {
       // var_dump('test home');
      /*  $query6111 = $this->sdl_model->stat_count_demandeservice();
       $data['nb_demandeservice'] = $query6111; */
       //**************************************************
       $user = $this->session->userdata('user_login');
       $user_query = $this->sdl_model->get_user_by_login($user);
       $type_ad = $user_query[0]->type;
       $id_ad = $user_query[0]->id;
       //**************************************************
       //*******************************************************************************
       if ($this->input->server('REQUEST_METHOD') == 'POST') {

           $nom_ajout  = $this->input->post('nom_ajout_residence');
         


           $id_modif = $this->input->post('id_modif_residence');
           $nom_modif = $this->input->post('nom_modif_residence');
            $id_suppression = $this->input->post('id_suppression_residence');

            $nom_ajout_admin  = $this->input->post('nom_ajout_admin');
            $prenom_ajout_admin  = $this->input->post('prenom_ajout_admin');
            $cin_ajout_admin = $this->input->post('cin_ajout_admin');
            $sexe_ajout_admin  = $this->input->post('sexe_ajout_admin');
            if ($sexe_ajout_admin == '') {
                $sexe_ajout_admin = 1;
            }
            $tel_ajout_admin  = $this->input->post('tel_ajout_admin');
            $email_ajout_admin  = $this->input->post('email_ajout_admin');
            $desc_ajout_admin  = $this->input->post('desc_ajout_admin');
            $photo_ajout_admin  = $this->input->post('photo_ajout_admin');


           if (isset($id_suppression)) {
               $this->load->model('sdl_model');
               $this->sdl_model->delete_residence($id_suppression);
               //******************************************************
               if ($type_ad == 2) {

                   $action = " Suppression résidence ";
                   $date_ac = date("Y-m-d H:i:s");
                   $data_add = array(
                       'id_ad' => $id_ad,
                       'action' => $action,
                       'date_ac' => $date_ac
                   );
                   $this->sdl_model->add_action($data_add);
               }
               //*******************************************************

           } else if (isset($id_modif)) {
               //**************************************************************************************

               $data_up = array(
                   'nom' => $nom_modif
               );
               $this->load->model('sdl_model');
               $this->sdl_model->modifier_residence($data_up, $id_modif);
               //******************************************************
               if ($type_ad == 2) {

                   $action = " Modification résidence ";
                   $date_ac = date("Y-m-d H:i:s");
                   $data_add = array(
                       'id_ad' => $id_ad,
                       'action' => $action,
                       'date_ac' => $date_ac
                   );
                   $this->sdl_model->add_action($data_add);
               }
               //*******************************************************
               //*****************************************************************************************
           } else if (isset($nom_ajout)) {
               //**********************************************************************************

               $data_add = array(
                   'nom' => $nom_ajout
               );
              $residence =  $this->sdl_model->ajouter_residence($data_add);
             
              $new_name = "";
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']             = '';
                $config['max_width']            = '';
                $config['max_height']           = '';
                if ($_FILES["photo_ajout_admin"]['name'] != "") {
                    $new_name = time() . "123654789";
                }
                $config['file_name'] = $new_name;
                $ext = pathinfo($_FILES["photo_ajout_admin"]['name'], PATHINFO_EXTENSION);
                if ($new_name != "") {
                    $new_name = $new_name . "." . $ext;
                }

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo_ajout_admin')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }


                //**************************************************************************
                $today = date("Y-m-d");
                $this->load->model('sdl_model');
                $nb = $this->sdl_model->count_sousadmin()[0]->nb + 1;

                $login = "admin_0" . $residence->id."_".$nb . "";
                $password = $this->sdl_model->random_password();
                $this->load->library('encrypt');
                $password = $this->encrypt->encode($password);
                $data_add = array(
                    'login' => $login,
                    'password' => $password,
                    'nom' => $nom_ajout_admin,
                    'prenom' => $prenom_ajout_admin,
                    'cin' => $cin_ajout_admin,
                    'sexe' => $sexe_ajout_admin,
                    'email' => $email_ajout_admin,
                    'tel' => $tel_ajout_admin,
                    'desc' => $desc_ajout_admin,
                    'photo' => $new_name,
                    'type' => 2,
                    'roles' => '11,12,13,21,31,32,41,42,51,52,53',
                    'etat' => 1,
                    'online' => 0,
                    'sup' => 0,
                    'created_at' => $today,
                    'residence_id'=>$residence->id,
                    'updated_at' => $today
                );
                $this->sdl_model->ajouter_admin_auto($data_add);
               //******************************************************
               if ($type_ad == 2) {

                   $action = " Ajout résidence ";
                   $date_ac = date("Y-m-d H:i:s");
                   $data_add = array(
                       'id_ad' => $id_ad,
                       'action' => $action,
                       'date_ac' => $date_ac
                   );
                   $this->sdl_model->add_action($data_add);
               }
               //*******************************************************
               //**********************************************************************************
           }
       }
       //********************************************************************
       $data['title'] = 'Gestion des résidences';
       $data['message'] = 'Les Résidences';
       $data['menu'] = 1111;
       $login = $this->session->userdata('user_login');
       $query = $this->sdl_model->get_user_by_login($login);
       $data['info'] = $query;
       $tab_roles = explode(",", $query[0]->roles);
       /* ISSUE */
       if ($query[0]->type == 1 || in_array("31", $tab_roles)) {
       } else {
           redirect(base_url('login/'));
       }
       $tabjs = array('assets/js/sdl/residences.js');
       $data['tabjs'] = $tabjs;
       $query2 = $this->sdl_model->list_of_residences();
       $data['residences'] = $query2;
       $this->load->view('sdl/common/header_view', $data);
       $this->load->view('sdl/common/title_page_view', $data);
       $this->load->view('sdl/residences_view', $data);
       //$this->load->view('sdl/construction_view',$data);
       $this->load->view('sdl/common/footer_view', $data);

    }
}

/*












 */
