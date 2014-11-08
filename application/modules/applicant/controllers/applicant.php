<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Applicant extends MX_Controller
{

	//CONSTRUCTOR DE LA CLASE
	public function __construct()
	{
		parent::__construct();
		$this->load->model('applicant_model');
	}

	function getApplicantType()
	{
		$query = $this->applicant_model->getApplicantType();
		$query = objectSQL_to_array($query);
		return $query;
	}

	public function newApplicant()
	{
		if(modules::run('user/isAdministrator'))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Nuevo solicitante';
			//die_pre($data);
			$data['contenido_principal'] = $this->load->view('nuevo-solicitante',$data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	function noExistCedula($cedula)
	{
		return $this->applicant_model->noExistCedula($cedula);
	}

	function noExistEmail($email)
	{
		return $this->applicant_model->noExistEmail($email);
	}

	public function createApplicant()
	{
		if(!empty($_POST))
		{
			//DEFINIMOS LAS REGLAS
			$this->form_validation->set_rules('name','Nombre','required|trim');
			$this->form_validation->set_rules('cedula','Cedula', 'required|callback_noExistCedula');
			$this->form_validation->set_rules('email','Correo electronico', 'required|callback_noExistEmail');
			$this->form_validation->set_rules('password', 'Contraseña','required');
			$this->form_validation->set_rules('repassword','Repita la contraseña','required|match[password]');
			
			//DEFINIMOS LOS MENSAJES PARA LAS REGLAS
			$this->form_validation->set_message('required','%s es requerido.');
			$this->form_validation->set_message('noExistName','%s existe.');
			$this->form_validation->set_message('match','Las contraseñas no coinciden.');
			$this->form_validation->set_message('noExistCedula', '%s existe.');
			$this->form_validation->set_message('noExistEmail', '%s existe.');

			//SI LAS VALIDACIONES PASAN
			if($this->form_validation->run($this))
			{
				$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'cedula' => $this->input->post('cedula'),
					'slug' => modules::run('operations/createSlug', $this->input->post('name'))
				);

				$this->applicant_model->insertApplicant($data);

				redirect('backend/solicitantes');
			}
			else
			{
			
				$user_id = modules::run('user/getSessionId');
				$data['userData'] = modules::run('user/getUserData', $user_id);
				$data['title'] = 'Backend - Nuevo solicitante';
				//die_pre($data);
				$data['contenido_principal'] = $this->load->view('nuevo-solicitante',$data, true);
				$this->load->view('back/template', $data);
			}
		}
		else
		{
			redirect('backend');
		}
	}


	public function existApplicant($slug)
	{
		return $this->applicant_model->existApplicant($slug);
	}

	//OBTIENE UN SOLICITANTE POR SU SLUG
	public function getApplicantBySlug($slug)
	{
		$query = $this->applicant_model->getApplicantBySlug($slug);
		$query = SQL_to_array($query);
		return $query;
	}

	function getAllApplicants()
	{
		$query = $this->applicant_model->getAllApplicants();
		$query = objectSQL_to_array($query);
		return $query;
	}

	//DADO UN SLUG ACTUALIZA UN SOLICITANTE
	public function updateApplicant($slug)
	{
		if(modules::run('user/isAdministrator') && $this->existApplicant($slug))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Actualizar solicitante';
			$data['typeApplicant'] = $this->getApplicantType();
			$data['dependences'] = modules::run('dependence/getAllDependences');
			$data['applicant'] = $this->getApplicantBySlug($slug);
			$data['contenido_principal'] = $this->load->view('actualizar-solicitante',$data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend/solicitantes');
		}
	}

	public function showApplicants()
	{
		//SI EL USUARIO EN SESION ES ADMINISTRADOR
		if(modules::run('user/isAdministrator'))
		{
			//CREO UN TITULO
			$data['title'] = 'Backend - Solicitantes';
			//OBTENGO EL ID DE SESION
			$user_id = modules::run('user/getSessionId');
			//DATOS DEL USUARIO
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['applicants'] = $this->getAllApplicants();
			//die_pre($data);
			$data['contenido_principal'] = $this->load->view('ver-solicitantes', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend/solicitantes');
		}
	}	

	//VERIFICA QUE LA CEDULA NO ESTE DUPLICADA
	function isNotDupplicateCedula($cedula)
	{
		$applicant_id = $this->input->post('applicant_id');
		return $this->applicant_model->isNotDupplicateCedula($applicant_id, $cedula);
	}

	//VERIFICA QUE UN EMAIL NO ESTE DUPLICADO
	function isNotDupplicateEmail($email)
	{
		$applicant_id = $this->input->post('applicant_id');
		return $this->applicant_model->isNotDupplicateEmail($applicant_id, $email);
	}

	//OBTENGO UN SOLICITANTE POR SU ID
	function getApplicantbyId($applicant_id)
	{
		$query = $this->applicant_model->getApplicantbyId($applicant_id);
		$query = SQL_to_array($query);
		return $query;
	}

	//ACTUALIZA UN SOLICITANTE
	public function applicantUpdate()
	{
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('type_applicant_id','Tipo de solicitante', 'required');
			$this->form_validation->set_rules('dependence_id','Dependencia','required');
			$this->form_validation->set_rules('name', 'Nombre', 'required|trim');
			$this->form_validation->set_rules('cedula', 'Cedula', 'required|callback_isNotDupplicateCedula');
			$this->form_validation->set_rules('email', 'Correo electrónico','required|callback_isNotDupplicateEmail');

			$this->form_validation->set_message('required', '%s es requerido.');
			$this->form_validation->set_message('isNotDupplicateCedula', '%s esta duplicada.');
			$this->form_validation->set_message('isNotDupplicateEmail', '%s esta duplicado.');
			$this->form_validation->set_message('match', 'Las contraseñas no coinciden.');

			if(!empty($this->input->post('password')))
			{
				$this->form_validation->set_rules('password', 'Contraseña', 'required|match');
				$this->form_validation->set_rules('repassword', 'Repita la contraseña', 'required|match[password]');
			}

			if($this->form_validation->run($this))
			{
				$data = array(
					'type_applicant_id' => $this->input->post('applicant_id'),
					'dependence_id'	=> $this->input->post('dependence_id'),
					'name' => $this->input->post('name'),
					'cedula' => $this->input->post('cedula'),
					'email' => $this->input->post('email'),
					'slug' => modules::run('operations/createSlug', $this->input->post('name'))
				);

				$applicant_id = $this->input->post('applicant_id');

				$this->applicant_model->updateApplicant($applicant_id, $data);

				redirect('backend/solicitudes');
			}
			else
			{
				$user_id = modules::run('user/getSessionId');
				$data['userData'] = modules::run('user/getUserData', $user_id);
				$data['title'] = 'Backend - Actualizar solicitante';
				$data['typeApplicant'] = $this->getApplicantType();
				$data['dependences'] = modules::run('dependence/getAllDependences');
				$data['applicant'] = $this->getApplicantBySlug($slug);
				$data['contenido_principal'] = $this->load->view('actualizar-solicitante',$data, true);
				$this->load->view('back/template', $data);
			}
		}
		else
		{
			redirect('backend');
		}
	}

	//OBTENGO LA CEDULA DE UN SOLICITANTE POR SU ID
	public function getCedulaApplicantById($applicant_id)
	{
		$query = $this->applicant_model->getCedulaApplicantById($applicant_id);
		$query = SQL_to_array($query);
		return $query['cedula'];
	}

	//OBTENGO LA CEDULA DE UN SOLICITANTE POR SU ID
	public function getApplicantIdByCedula($cedula)
	{
		$query = $this->applicant_model->getApplicantIdByCedula($cedula);
		$query = SQL_to_array($query);
		return $query;
	}

	public function getNombreApplicantById($applicant_id)
	{
		return $this->applicant_model->getNombreApplicantById($applicant_id);
	}

	//ELIMINA UN SOLICITANTE
	public function deleteApplicant($slug)
	{
		if(modules::run('user/isAdministrator') && $this->existApplicant($slug))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Eliminar solicitante';
			$data['applicant'] = $this->getApplicantBySlug($slug);
			$data['contenido_principal'] = $this->load->view('eliminar-solicitante', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend/solicitantes');
		}
	}

	public function applicantDelete($slug)
	{
		if(modules::run('user/isAdministrator') && $this->existApplicant($slug))
		{
			$this->applicant_model->deleteApplicantBySlug($slug);
		}

		redirect('backend/solicitantes');
	}

	public function getNameByApplicantId($id)
	{
		$query = $this->applicant_model->getNameByApplicantId($id);
		$query = SQL_to_array($query);
		return $query['name'];
	}
}