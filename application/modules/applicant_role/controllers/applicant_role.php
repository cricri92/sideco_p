<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Applicant_role extends MX_Controller{

	//CONSTRUCTOR DE LA CLASE
	public function __construct()
	{
		parent::__construct();
		$this->load->model('applicantrole_model');
	}

	//CARGA UNA VISTA PARA CREAR UNA NUEVA DEPENDENCIA
	public function newApplicantRole()
	{
		//SI ES ADMINISTRADOR
		if(modules::run('user/isAdministrator'))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Nuevo tipo de solicitante';
			$data['contenido_principal'] = $this->load->view('nuevo-rol-solicitante', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	//VERIFICA QUE NO EXISTA UNA DEPENDENCIA
	function noExistApplicantRole($name)
	{
		return $this->applicantrole_model->noExistApplicantRole($name);
	}

	//CREA UNA NUEVA DEPENDENCIA
	public function createApplicantRole()
	{
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('name', 'Nombre', 'required|callback_noExistApplicantRole');

			$this->form_validation->set_message('required', '%s es requerido.');
			$this->form_validation->set_message('noExistApplicantRole', '%s existe.');

			if($this->form_validation->run($this))
			{
				$applicant_role = array(
					'name' => $this->input->post('name'),
				);

				$this->applicantrole_model->insertApplicantRole($applicant_role);

				redirect('backend/solicitantes/roles-solicitantes');
			}
			else
			{
				$user_id = modules::run('user/getSessionId');
				$data['userData'] = modules::run('user/getUserData', $user_id);
				$data['title'] = 'Backend - Nuevo tipo de solicitante';
				$data['contenido_principal'] = $this->load->view('nuevo-rol-solicitante', $data, true);
				$this->load->view('back/template', $data);
			}
		}
		else
		{
			redirect('backend');
		}
	}

	public function getAllApplicantRoles()
	{
		$query = $this->applicantrole_model->getAllApplicantRoles();
		$query = objectSQL_to_array($query);
		return $query;
	}

	public function showApplicantRoles()
	{
		//SI ES ADMINISTRADOR
		if(modules::run('user/isAdministrator'))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['applicant_role'] = $this->getAllApplicantRoles();
			$data['title'] = 'Backend - Tipos de Solicitantes';
			$data['contenido_principal'] = $this->load->view('ver-roles-solicitantes', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	public function getApplicantRoleById($id)
	{
		$query = $this->applicantrole_model->getApplicantRoleById($id);
		$query = SQL_to_array($query);
		return $query;
	}


}


?>