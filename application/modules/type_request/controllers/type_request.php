<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Type_request extends MX_Controller{

	//CONSTRUCTOR DE LA CLASE
	public function __construct()
	{
		parent::__construct();
		$this->load->model('typerequest_model');
	}

	//CREA UN NUEVO TIPO REQUEST
	public function newTypeRequest()
	{	
		//SI ES ADMINISTRADOR
		if(modules::run('user/isAdministrator'))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Nuevo tipo de solicitud';
			$data['contenido_principal'] = $this->load->view('nuevo-tipo-solicitud', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	function noExistTypeRequest($name)
	{
		return $this->typerequest_model->noExistTypeRequest($name);
	}

	public function createTypeRequest()
	{
		if(!empty($_POST))
		{	
			$this->form_validation->set_rules('name','Tipo de solicitud', 'required|callback_noExistTypeRequest');

			$this->form_validation->set_message('required','%s es requerido.');
			$this->form_validation->set_message('noExistTypeRequest','%s existe.');

			if($this->form_validation->run($this))
			{
				$data = array(
					'name' => $this->input->post('name'),
					'slug' => modules::run('operations/createSlug', $this->input->post('name'))
				);

				$this->typerequest_model->createTypeRequest($data);

				redirect('backend');
			}
			else
			{
				$user_id = modules::run('user/getSessionId');
				$data['userData'] = modules::run('user/getUserData', $user_id);
				$data['title'] = 'Backend - Nuevo tipo de solicitud';
				$data['contenido_principal'] = $this->load->view('nuevo-tipo-solicitud', $data, true);
				$this->load->view('back/template', $data);
			}
		}
		else
		{
			redirect('backend');
		}
	}

	//DEVUELVE TODOS LOS TIPOS DE SOLICITUD
	public function getAllTypeRequests()
	{
		$query = $this->typerequest_model->getAllTypeRequests();
		$query = objectSQL_to_array($query);
		return $query;
	}

	public function getNameByTypeRequestId($type_request_id)
	{
		return $this->typerequest_model->getNameByTypeRequestId($type_request_id);
	}
}