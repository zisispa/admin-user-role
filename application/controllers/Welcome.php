<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->load->model('user_model');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function insert()
	{

		if ($this->input->is_ajax_request()) {

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('reset_password', 'ResetPassword', 'required|matches[password]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			if ($this->form_validation->run() == FALSE) {
				$data = array('response' => 'error', 'message' => validation_errors());
			} else {

				$data['name'] 		= $this->input->post('name');
				$data['username'] 	= $this->input->post('username');
				$data['password'] 	= $this->input->post('password');
				$data['email'] 		= $this->input->post('email');
				$data['is_active'] 	= $this->input->post('is_active');

				if ($this->user_model->insert_entry($data)) {

					$data = array('response' => 'success', 'message' => 'Record added successfully');
				} else {
					$data = array('response' => 'error', 'message' => 'Failed to add record');
				}

				$has_roles_id = $this->input->post('user_has_role');

				//Kanw insert sto pinaka dv_users_roles_has_dv_users ta roles ids pou exei o kathe xristis
				$this->user_model->insert_role_id_to_has_role(
					$has_roles_id, //Roles ids
					$this->user_model->select_max_user_id() //User max id
				);

				echo json_encode($data);
			}
		} else {
			echo 'No direct script access allowed';
		}
	}

	public function fetch()
	{
		if ($this->input->is_ajax_request()) {

			//Get all users fields
			$users = $this->user_model->get_entries();

			//Get all roles fields
			$roles = $this->user_model->get_roles();

			//Get all user ids gia na ta xrisimopoiisw wste na emfanisw to role name pou exei o kathenas
			$user_id = $this->user_model->select_user_id();

			//Pairnw mono tis grammes user_id kai tis vazw sto user_ids array gia na mporw na ta diaxeiristw
			$user_ids = array();
			foreach ($user_id as $value) {
				array_push($user_ids, $value->user_id);
			}

			//Pairnw ta roles names kai ola ta dedomena pou thelw gia na emfanisw sto pinaka
			$roles_id = $this->user_model->get_roles_name($user_ids);

			//Kanw merge ta dedomena pou exoun koina stoixa kai vazw se ena field ta roles names wste
			//na ta emfanisw 
			$result = array_reduce(
				$roles_id,
				function ($intermediateResult, $item) {
					if (!array_key_exists($item->user_id, $intermediateResult)) {
						// First time encountering an object with this user_id
						$intermediateResult[$item->user_id] = $item;
					} else {
						// We have an object with this user_id already so just add the roles_name
						$intermediateResult[$item->user_id]->roles_name .= ' ' . '<br/>' . $item->roles_name;
					}
					return $intermediateResult;
				},
				[]
			);

			$data = array('response' => 'success', 'users' => $users, 'roles' => $roles, 'result' => array_values($result));
			echo json_encode($data);
		} else {
			echo 'No direct script access allowed';
		}
	}

	//Diagrafei tou xristi patwntas to koumpi
	public function delete()
	{
		if ($this->input->is_ajax_request()) {
			$del_id = $this->input->post('del_id');

			if ($this->user_model->delete_entry($del_id)) {
				$data = array('response' => 'success');
			} else {
				$data = array('response' => 'error');
			}

			echo json_encode($data);
		} else {
			echo 'No direct script access allowed';
		}
	}

	public function edit()
	{
		if ($this->input->is_ajax_request()) {

			$edit_id = $this->input->post('edit_id');

			//Get all the roles
			$roles = $this->user_model->get_roles();

			//Epistefei ta roles ids kai names pou exei o xristis
			$edit_roles_details = $this->user_model->get_roles_details($edit_id);

			//Pairnw ola ta fields wste na ta emfanisw sta antistoixa fields
			if ($users = $this->user_model->edit_entry($edit_id)) {

				//Pairnw mono tis grammes dv_users_roles_id kai tis vazw sto edit array gia na mporw na ta diaxeiristw
				$edit = array();
				foreach ($edit_roles_details as $value) {
					array_push($edit, $value->dv_users_roles_id);
				}

				$data = array('response' => 'success', 'edit_user' => $users, 'roles' => $roles, 'edit_roles_details' => $edit);
			} else {
				$data = array('response' => 'error', 'message' => 'Failed to fetch record');
			}

			echo json_encode($data);
		} else {
			echo 'No direct script access allowed';
		}
	}

	public function update()
	{
		if ($this->input->is_ajax_request()) {

			$this->form_validation->set_rules('edit_name', 'Name', 'required');
			$this->form_validation->set_rules('edit_username', 'Username', 'required');
			$this->form_validation->set_rules('edit_password', 'Password', 'required');
			$this->form_validation->set_rules('edit_reset_password', 'ResetPassword', 'required|matches[edit_password]');
			$this->form_validation->set_rules('edit_email', 'Email', 'required|valid_email');

			if ($this->form_validation->run() == FALSE) {
				$data = array('response' => 'error', 'message' => validation_errors());
			} else {

				$data['user_id'] 	= $this->input->post('edit_record_id');
				$data['name'] 		= $this->input->post('edit_name');
				$data['username'] 	= $this->input->post('edit_username');
				$data['password'] 	= $this->input->post('edit_password');
				$data['email'] 		= $this->input->post('edit_email');
				$data['is_active'] 	= $this->input->post('edit_is_active');

				//Update the users fields
				if ($this->user_model->update_entry($data)) {
					$data = array('response' => 'success', 'message' => 'Record update successfully');
				} else {
					$data = array('response' => 'error', 'message' => 'Failed to update record');
				}

				//Role ids pou epilegei o xristis
				$has_roles_id = $this->input->post('user_has_edit_role');

				//To id tou xristi pou kanei update
				$user_update_id = $this->input->post('edit_record_id');

				//Ta roles ids pou exei idi o xristis
				$edit_roles_ids = $this->user_model->get_roles_id($user_update_id);
				$updated_role_ids = array();
				foreach ($edit_roles_ids as $value) {
					array_push($updated_role_ids, $value->roles_id);
				}

				//Role id gia na to xrisimopoisoume gia delete
				$filterd_roles_ids = array_diff($updated_role_ids, $has_roles_id);

				//Role id gia na xrisimopoisoume gia insert
				$filterd_add_roles_ids = array_diff($has_roles_id, $updated_role_ids);


				//Delete ta ids pou egine filter
				$this->user_model->delete_role_id($filterd_roles_ids, $user_update_id);

				//Insert ta ids pou eginan filter 
				$this->user_model->insert_role_id_to_has_role(
					$filterd_add_roles_ids, //Roles ids
					$user_update_id //User max id
				);

				echo json_encode($data);
			}
		} else {
			echo 'No direct script access allowed';
		}
	}
}
