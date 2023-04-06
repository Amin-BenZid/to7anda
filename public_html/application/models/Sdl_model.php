<?php
class Sdl_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();

		//************************************** data base *************************************
		//************************************** data base *************************************

	}
	//**************************************************************************************
	//***************************************************************
	public function random_password()
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$password = array();
		$alpha_length = strlen($alphabet) - 1;
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alpha_length);
			$password[] = $alphabet[$n];
		}
		return implode($password);
	}
	//******************************************
	public function password_user_existe($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('users')->result();
	}
	//********************************************************************************
	public function demandeservice_eval()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('demandeservice');
		$this->db->where('etat', 5);
		$this->db->where('residence_id', $user->residence_id);
		$this->db->order_by('id DESC');
		$query = $this->db->get();
		return $query->result();
	}
	//********************************************************************************
	public function update_vu_appel($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('service_alert_store', $data);
	}
	//********************************************************************************
	public function get_admins_tels()
	{
		$where = "(etat=1 AND (type=1 OR type=2))";
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($where);
		$query = $this->db->get()->result();
		return $query;
	}
	//********************************************************************************
	public function apartments_update_api()
	{
		$this->db->select('*');
		$this->db->from('update_appartement');
		$query = $this->db->get();
		return $query->result();
	}
	public function all_tags_api()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('tags.uid,tags.etat,appartement.sdl_id,appartement.id');
		$this->db->from('tags', 'appartement');
		$this->db->where('tags.etat', 1);
		$this->db->where('appartement.residence_id' , $user->residence_id);
		$this->db->order_by('appartement.sdl_id,tags.uid');
		$this->db->join('appartement', 'appartement.id = tags.id_appartement');
		$query = $this->db->get();
		return $query->result();
	}
	public function apartments_access_api($sdl)
	{
		$this->db->select('tags.uid,tags.etat,appartement.sdl_id,appartement.id');
		$this->db->from('tags', 'appartement');
		$this->db->where('appartement.sdl_id', $sdl);
		$this->db->where('tags.etat', 1);
		$this->db->join('appartement', 'appartement.id = tags.id_appartement');
		$query = $this->db->get();
		return $query->result();
	}
	public function access_store_api($id_a, $uid, $type, $etat)
	{
		# access_store(id,id_a,uid,type,etat,date)
		$today = date("Y-m-d H:i:s");
		$data = array(
			'id_a' => $id_a,
			'uid' => $uid,
			'type' => $type,
			'etat' => $etat,
			'date' => $today
		);
		$this->db->insert('access_store', $data);
	}

	public function add_hist_sms($data)
	{
		/* Nachd */
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id'] = $user->residence_id;
		$this->db->insert('hist_sms', $data);
	}


	public function liste_appels()
	{
		// service_alert_store: id,id_a,type,date,vu,d_vu
		$this->db->select('*');
		$this->db->from('service_alert_store');
		$this->db->where('type', 1);
		$this->db->order_by('date DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function liste_appels_notifications()
	{
		// service_alert_store: id,id_a,type,date,vu,d_vu
		$this->db->select('*');
		$this->db->from('service_alert_store');
		$this->db->where('type', 1);
		$this->db->where('vu', 0);
		$this->db->order_by('date DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function service_alert_store_api($id_a, $type)
	{
		# service_alert_store(id,id_a,type,date,vu)
		$today = date("Y-m-d H:i:s");
		$data = array(
			'id_a' => $id_a,
			'type' => $type,
			'date' => $today,
			'vu' => 0
		);
		$this->db->insert('service_alert_store', $data);
	}
	public function sport_access_api()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('tags.uid,tags.etat,sport.id_a,sport.d_deut,sport.d_fin,sport.t_debut,sport.t_fin');
		$this->db->from('tags', 'sport');
		$this->db->where('sport.sup', 0);
		$this->db->where('tags.etat', 1);
		$this->db->where('sport.residence_id' , $user->residence_id);
		$this->db->order_by('sport.id_a, tags.uid');
		$this->db->join('sport', 'sport.id_a = tags.id_appartement');
		$query = $this->db->get();
		return $query->result();
	}
	//********************************************************************************

	public function list_of_actions()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('actions');
		$this->db->where('residence_id' , $user->residence_id);

		$this->db->order_by('id DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function add_action($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id'] = $user->residence_id;
		$this->db->insert('actions', $data);
	}
	public function list_of_admins()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('residence_id' , $user->residence_id);
		$this->db->where('type', 2);
		$query = $this->db->get();
		return $query->result();
	}
	//********************************************************************************
	public function list_of_s_requests()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];


		$this->db->select('*');
		$this->db->from('demandeservice');
		$this->db->where('residence_id', $user->residence_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function list_of_s_requests_user($id)
	{
		$this->db->select('*');
		$this->db->from('demandeservice');
		$this->db->where('id_prop', $id);
		$this->db->order_by('id DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function list_of_a_requests()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('*');
		$this->db->from('demandeautorisation');
		$this->db->where('residence_id', $user->residence_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function list_of_a_requests_user($id)
	{
		$this->db->select('*');
		$this->db->from('demandeautorisation');
		$this->db->where('id_prop', $id);
		$this->db->order_by('id DESC');
		$query = $this->db->get();
		return $query->result();
	}
	//********************************************************************************
	public function config_val($val)
	{
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get()->result();
		foreach ($query as $l) {
			$id = $l->id;
			$etat = $l->etat;
			$statut = $l->statut;
			if ($val == 1) {

				$data = array('etat' => $statut);
				$this->db->where('id', $id);
				$this->db->update('users', $data);
			} else if ($val == 2) {
				if ($etat == 1) {
					$data = array('etat' => 0, 'statut' => $etat);
					$this->db->where('id', $id);
					$this->db->update('users', $data);
				}
			} else if ($val == 3) {
				$data = array('etat' => 1);
				$this->db->where('id', $id);
				$this->db->update('users', $data);
			} else {
			}
		}
	}
	//********************************************************************************
	public function get_bloc_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('bloc');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}
	//********************************************************************************
	public function list_of_sports()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('sport');
		$this->db->where('residence_id', $user->residence_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_sport_by_id_app($id_a)
	{
		$this->db->select('*');
		$this->db->from('sport');
		$this->db->where('id_a', $id_a);
		$query = $this->db->get();
		return $query->result();
	}
	public function insert_sport($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id'] = $user->residence_id;
		$this->db->insert('sport', $data);
	}
	public function update_sport($data, $id)
	{
		$this->db->where('id_a', $id);
		$this->db->update('sport', $data);
	}

	//********************************************************************************
	public function list_of_apartments()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('appartement.id,appartement.id_bloc,bloc.nom,appartement.floor,appartement.code,appartement.desc,appartement.id_proprietaire,appartement.sdl_id');
		$this->db->from('appartement', 'bloc');
		$this->db->where('appartement.residence_id', $user->residence_id);
		$this->db->join('bloc', 'bloc.id = appartement.id_bloc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_of_apartments_user($id)
	{
		$this->db->select('appartement.id,appartement.id_bloc,bloc.nom,appartement.floor,appartement.code,appartement.desc,appartement.id_proprietaire,appartement.sdl_id');
		$this->db->from('appartement', 'bloc');
		$this->db->where('appartement.id_proprietaire', $id);
		$this->db->join('bloc', 'bloc.id = appartement.id_bloc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_of_reclamations_user($id)
	{
		$this->db->select('*');
		$this->db->from('reclamations');
		$this->db->where('id_prop', $id);
		$this->db->order_by('date DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_of_reclamations()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('*');
		$this->db->from('reclamations');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->order_by('date DESC');
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************
	public function list_of_appartement_tags($id)
	{
		$this->db->select('*');
		$this->db->from('tags');
		$this->db->where('id_appartement', $id);
		$this->db->order_by('updated_at DESC');
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************
	public function get_owner_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$this->db->order_by('updated_at DESC');
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************
	public function cin_owner_existe($cin)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('cin', $cin);
		$this->db->where('type', 3);
		$this->db->order_by('updated_at DESC');
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************

	//***************************************************************
	public function cin_empl_existe($cin)
	{
		$this->db->select('*');
		$this->db->from('employe');
		$this->db->where('cin', $cin);
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************
	//***************************************************************
	public function cin_admin_existe($cin)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
	
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('cin', $cin);
		$this->db->where('residence_id',$user->residence_id);
		$this->db->where('type', 2);
		$this->db->order_by('updated_at DESC');
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************

	public function list_of_blocks()
	{

		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];


		$this->db->select('*');
		$this->db->from('bloc');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->order_by('id ASC');
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************
	public function ajouter_bloc($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id'] = $user->residence_id;
		$this->db->insert('bloc', $data);
	}
	public function modifier_bloc($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('bloc', $data);
	}
	public function delete_bloc($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('bloc');
	}

	public function add_reclamation($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id'] = $user->residence_id;
		$this->db->insert('reclamations', $data);
	}
	//***************************************************************
	//***************************************************************

	public function delete_demandeservice($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('demandeservice');
	}
	public function delete_demandeautorisation($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('demandeautorisation');
	}
	public function insert_demandeservice($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id'] = $user->residence_id;
		$this->db->insert('demandeservice', $data);
	}
	public function insert_demandeautorisation($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id'] = $user->residence_id;
		$this->db->insert('demandeautorisation', $data);
	}
	public function update_demandeservice($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('demandeservice', $data);
	}
	public function update_demandeautorisation($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('demandeautorisation', $data);
	}
	public function update_demandeauto($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('demandeautorisation', $data);
	}

	public function get_id_demande_by_app_date($type, $id_a, $d)
	{
		$id = 0;
		if ($type == 1) {
			$this->db->select('*');
			$this->db->from('demandeservice');
			$this->db->where('id_appa', $id_a);
			$this->db->where('created_at', $d);
			$query = $this->db->get()->result();
			$id = $query[0]->id;
			return $id;
		} else {
			$this->db->select('*');
			$this->db->from('demandeautorisation');
			$this->db->where('id_appa', $id_a);
			$this->db->where('created_at', $d);
			$query = $this->db->get()->result();
			$id = $query[0]->id;
			return $id;
		}
	}

	public function etatdemande_list_by_type($type)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('*');
		$this->db->from('historiqueetatdemande');
		$this->db->where('type_demande', $type);
		$this->db->where('residence_id', $user->residence_id);

		$this->db->order_by('etat ASC');
		$query = $this->db->get()->result();
		return $query;
	}
	public function delete_etatdemande($id, $type)
	{
		$this->db->where('id_demande', $id);
		$this->db->where('type_demande', $type);
		$this->db->delete('historiqueetatdemande');
	}
	public function insert_etatdemande($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id'] = $user->residence_id;
		$this->db->insert('historiqueetatdemande', $data);
	}
	//***************************************************************

	public function list_of_services()
	{

		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('*');
		$this->db->from('service');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('sup', 0);
		$this->db->order_by('id ASC');
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************
	public function ajouter_service($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id'] = $user->residence_id;
		$this->db->insert('service', $data);
	}
	public function modifier_service($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('service', $data);
	}
	public function delete_service($id)
	{

		$this->db->set('sup', 1);
		$this->db->where('id', $id);
		$this->db->update('service');
	}
	//***************************************************************
	//***************************************************************
	public function stat_count_bloc()
	{

		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		//$data['residence_id'] = $user->residence_id;

		$this->db->select('count(bloc.id) as nb_bloc');
		$this->db->from('bloc');
		$this->db->where('residence_id', $user->residence_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function stat_count_appartement()
	{

		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('count(appartement.id) as nb_appartement');
		$this->db->from('appartement');
		$this->db->where('residence_id', $user->residence_id);

		$query = $this->db->get();
		return $query->result();
	}
	public function stat_count_appartement_user($id)
	{


		$this->db->select('count(appartement.id) as nb_appartement');
		$this->db->from('appartement');
		$this->db->where('id_proprietaire', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function stat_count_tags()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('count(tags.id) as nb_tags');
		$this->db->from('tags');
		$this->db->where('residence_id', $user->residence_id);

		$query = $this->db->get();
		return $query->result();
	}
	public function stat_count_tags_user($id)
	{

		$this->db->select('count(tags.id) as nb_tags');
		$this->db->from('tags', 'appartement');
		$this->db->where('appartement.id_proprietaire', $id);
		$this->db->join('appartement', 'appartement.id = tags.id_appartement');
		$query = $this->db->get();
		return $query->result();
	}
	public function stat_count_employe()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('count(employe.id) as nb_employe');
		$this->db->from('employe');
		$this->db->where('residence_id', $user->residence_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function stat_count_service()
	{

		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('count(service.id) as nb_service');
		$this->db->from('service');
		$this->db->where('residence_id', $user->residence_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function stat_count_demandeservice()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('count(demandeservice.id) as nb_demandeservice');
		$this->db->from('demandeservice');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('demandeservice.etat < 5 ');
		$query = $this->db->get();
		return $query->result();
	}
	public function stat_count_demandeservice_user($id)
	{

		$this->db->select('count(demandeservice.id) as nb_demandeservice');
		$this->db->from('demandeservice');
		$this->db->where('demandeservice.id_prop', $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function stat_count_demandeautorisation()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('count(demandeautorisation.id) as nb_demandeautorisation');
		$this->db->from('demandeautorisation');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('demandeautorisation.etat < 5 ');
		$query = $this->db->get();
		return $query->result();
	}
	public function stat_count_demandeautorisation_user($id)
	{

		$this->db->select('count(demandeautorisation.id) as nb_demandeautorisation');
		$this->db->from('demandeautorisation');
		$this->db->where('demandeautorisation.id_prop', $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function stat_count_prop()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('count(users.id) as nb_prop');
		$this->db->from('users');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('type', 3);
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************
	public function list_of_employees()
	{

		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('employe.id,employe.nom,employe.prenom,employe.cin,employe.sexe,employe.tel,employe.email,employe.desc,employe.photo,employe.etat,employe.id_service');
		$this->db->from('employe');
		$this->db->where('sup', 0);
		$this->db->where('residence_id', $user->residence_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function delete_empl($id)
	{

		$this->db->set('sup', 1);
		$this->db->where('id', $id);
		$this->db->update('employe');
	}
	public function hors_empl($id)
	{
		$this->db->set('etat', 0);
		$this->db->where('id', $id);
		$this->db->update('employe');
	}
	public function en_empl($id)
	{
		$this->db->set('etat', 1);
		$this->db->where('id', $id);
		$this->db->update('employe');
	}
	public function modifier_empl($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('employe', $data);
	}
	public function ajouter_empl($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id'] = $user->residence_id;
		$this->db->insert('employe', $data);
	}
	//***************************************************************
	public function list_employe()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('employe');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->order_by('nom ASC, prenom ASC');
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************
	public function get_employe_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('employe');
		$this->db->where('id', $id);
		$this->db->order_by('nom ASC, prenom ASC');
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************

	public function list_of_tags()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('*');
		$this->db->from('tags');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->order_by('updated_at DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_tags_admin_free()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('tags');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('type', 0);
		$this->db->where('id_appartement', 0);
		$this->db->order_by('updated_at ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_tag_pass()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('tags');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('type', 2);
		$query = $this->db->get();
		return $query->result();
	}
	//****************************************************************
	public function list_tags_appar($id)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('tags');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('id_appartement', $id);
		$this->db->order_by('updated_at ASC');
		$query = $this->db->get();
		return $query->result();
	}
	//****************************************************************
	public function list_cin_ouners()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('cin');
		$this->db->from('users');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('type', 3);
		$query = $this->db->get();
		return $query->result();
	}
	//****************************************************************

	public function list_apartements_by_bloc($id)
	{
		$this->db->select('*');
		$this->db->from('appartement');
		$this->db->where('id_bloc', $id);
		$this->db->order_by('code DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function list_apartements_by_bloc_etage($id, $etage)
	{
		$this->db->select('*');
		$this->db->from('appartement');
		$this->db->where('id_bloc', $id);
		$this->db->where('floor', $etage);
		$this->db->order_by('code DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function uid_tag_existe($uid)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('tags');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('uid', $uid);
		$query = $this->db->get();
		return $query->result();
	}
	public function nom_bloc_existe($nom)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('bloc');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('nom', $nom);
		$query = $this->db->get();
		return $query->result();
	}
	public function code_apartement_existe($code)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('appartement');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('code', $code);
		$query = $this->db->get();
		return $query->result();
	}
	public function sdl_id_apartement_existe($sdl_id)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('appartement');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('sdl_id', $sdl_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_apartement_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('appartement');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************
	public function delete_apartement($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('appartement');
	}
	public function modifier_apartement($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('appartement', $data);
	}
	public function ajouter_apartement($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id']=$user->residence_id;
		$this->db->insert('appartement', $data);
	}
	//*******************************************************
	public function delete_tag($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tags');
	}
	public function blocage_tag($id)
	{
		$this->db->set('etat', 0);
		$today = date("Y-m-d H:i:s");
		$this->db->set('updated_at', $today);
		$this->db->where('id', $id);
		$this->db->update('tags');
	}
	public function deblocage_tag($id)
	{
		$this->db->set('etat', 1);
		$today = date("Y-m-d H:i:s");
		$this->db->set('updated_at', $today);
		$this->db->where('id', $id);
		$this->db->update('tags');
	}
	public function modifier_tag($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tags', $data);
	}
	public function ajouter_tag($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id']=$user->residence_id;
		$this->db->insert('tags', $data);
	}


	//******************************************************************************
	//******************************************************************************
	public function list_apartements_by_owner($id)
	{
		$this->db->select('appartement.id,appartement.id_bloc,appartement.code,appartement.desc,appartement.id_proprietaire,bloc.nom as  nom_b,bloc.desc as desc_b');
		$this->db->from('appartement', 'bloc');
		$this->db->where('appartement.id_proprietaire', $id);
		$this->db->join('bloc', 'bloc.id = appartement.id_bloc');
		$this->db->order_by('appartement.id_bloc DESC,appartement.id DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function list_apartements_not_affected()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('appartement');
		$this->db->where('id_proprietaire', 0);
		$this->db->where('residence_id', $user->residence_id);

		$query = $this->db->get();
		return $query->result();
	}
	public function update_proprietaire_app($id, $val)
	{
		$this->db->set('id_proprietaire', $val);
		$this->db->where('id', $id);
		$this->db->update('appartement');
	}
	//******************************************************************************

	public function list_of_owners()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('type', 3);
		$this->db->where('sup', 0);
		$this->db->where('residence_id', $user->residence_id);
		$this->db->order_by('updated_at DESC,id DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getLastOwnerId()
	{
		/* Check why , maybe needs to increment id  */
		/* $login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0]; */
		$this->db->select('*');
		$this->db->from('users');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function count_owners()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('COUNT(*) AS nb');
		$this->db->from('users');
		$this->db->where('residence_id', $user->residence_id);
		$this->db->where('type', 3);
		$query = $this->db->get();
		return $query->result();
	}
	public function ajouter_owner($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id']= $user->residence_id;
		$this->db->insert('users', $data);
	}
	public function modifier_owner($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}
	public function delete_owner($id)
	{
		$today = date("Y-m-d");
		$this->db->set('sup', 1);
		$this->db->set('updated_at', $today);
		$this->db->where('id', $id);
		$this->db->update('users');
	}
	public function reinit_owner($id)
	{
		$today = date("Y-m-d");
		$password = $this->random_password();
		$this->load->library('encrypt');
		$password = $this->encrypt->encode($password);
		$this->db->set('password', $password);
		$this->db->set('updated_at', $today);
		$this->db->where('id', $id);
		$this->db->update('users');
	}
	public function deblocage_owner($id)
	{
		$today = date("Y-m-d");
		$this->db->set('etat', 1);
		$this->db->set('updated_at', $today);
		$this->db->where('id', $id);
		$this->db->update('users');
	}
	public function blocage_owner($id)
	{
		$today = date("Y-m-d");
		$this->db->set('etat', 0);
		$this->db->set('updated_at', $today);
		$this->db->where('id', $id);
		$this->db->update('users');
	}



	//*******************************************************************************
	//*******************************************************************************


	//******************************************
	public function update_online_user($id, $etat)
	{
		$this->db->set('online', $etat);
		$this->db->where('id', $id);
		$this->db->update('users');
	}
	//******************************************
	public function user_login_exist($login)
	{

		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('login', $login);
		$query = $this->db->get();
		return $query;
	}
	//*****************************************
	public function get_user_by_login($login)
	{

		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('login', $login);
		$query = $this->db->get();
		return $query->result();
	}
	//*****************************************
	public function list_of_admin()
	{

	
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		//$data['residence_id']= $user->residence_id;

		if($user->residence_id == 0 || $user->residence_id == NULL){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('type', 2);
			$this->db->where('sup', 0);
			$this->db->order_by('updated_at DESC,id DESC');
			$query = $this->db->get();
			return $query->result();
		}else{
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('residence_id',$user->residence_id);
			$this->db->where('type', 2);
			$this->db->where('sup', 0);
			$this->db->order_by('updated_at DESC,id DESC');
			$query = $this->db->get();
			return $query->result();
		}
		
	}

	//***************************************************************
	public function count_sousadmin()
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];

		$this->db->select('COUNT(*) AS nb');
		$this->db->from('users');
		$this->db->where('type', 2);
		$this->db->where('residence_id',$user->residence_id);

		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************
	public function ajouter_admin($data)
	{
		$login = $this->session->userdata('user_login');
		$user_query = $this->sdl_model->get_user_by_login($login);
		$user =  $user_query[0];
		$data['residence_id']= $user->residence_id;
		$this->db->insert('users', $data);
	}
	public function ajouter_admin_auto($data)
	{
		
		
		$this->db->insert('users', $data);
	}
	public function modifier_admin($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}
	public function delete_admin($id)
	{
		$today = date("Y-m-d");
		$this->db->set('sup', 1);
		$this->db->set('updated_at', $today);
		$this->db->where('id', $id);
		$this->db->update('users');
	}
	public function reinit_admin($id)
	{
		$today = date("Y-m-d");
		$password =  $this->random_password();
		$this->load->library('encrypt');
		$password = $this->encrypt->encode($password);
		$this->db->set('password', $password);
		$this->db->set('updated_at', $today);
		$this->db->where('id', $id);
		$this->db->update('users');
	}
	public function edit_roles_admin($id, $roles)
	{
		$today = date("Y-m-d");
		$this->db->set('roles', $roles);
		$this->db->set('updated_at', $today);
		$this->db->where('id', $id);
		$this->db->update('users');
	}
	public function deblocage_admin($id)
	{
		$today = date("Y-m-d");
		$this->db->set('etat', 1);
		$this->db->set('updated_at', $today);
		$this->db->where('id', $id);
		$this->db->update('users');
	}
	public function blocage_admin($id)
	{
		$today = date("Y-m-d");
		$this->db->set('etat', 0);
		$this->db->set('updated_at', $today);
		$this->db->where('id', $id);
		$this->db->update('users');
	}


	//**************************************************************************************
	//**************************************************************************************
















	/* **************************************** NACHD UPDATES ********************* */
	public function list_of_residences()
	{

		$this->db->select('*');
		$this->db->from('residences');
		$this->db->where('sup', 0);
		$this->db->order_by('id ASC');
		$query = $this->db->get();
		return $query->result();
	}
	//***************************************************************
	public function ajouter_residence($data)
	{
		$query = $this->db->insert('residences', $data);

		$this->db->select('*');
		$this->db->from('residences');
		$this->db->order_by('id', 'DESC');
		$query2 = $this->db->get();
		
		return $query2->result()[0];

		
		
	}
	public function modifier_residence($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('residences', $data);
	}
	public function delete_residence($id)
	{

		$this->db->set('sup', 1);
		$this->db->where('id', $id);
		$this->db->update('residences');
	}
}
