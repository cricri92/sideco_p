<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dependence extends MX_Controller{

	//CONSTRUCTOR DE LA CLASE
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dependence_model');
	}

	//CARGA UNA VISTA PARA CREAR UNA NUEVA DEPENDENCIA
	public function newDependence()
	{
		//SI ES ADMINISTRADOR
		if(modules::run('user/isAdministrator'))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Nueva Dependencia';
			$data['contenido_principal'] = $this->load->view('nueva-dependencia', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	//VERIFICA QUE NO EXISTA UNA DEPENDENCIA
	function noExistDependence($name)
	{
		return $this->dependence_model->noExistDependence($name);
	}

	//CREA UNA NUEVA DEPENDENCIA
	public function createDependence()
	{
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('name', 'Nombre', 'required|callback_noExistDependence');

			$this->form_validation->set_message('required', '%s es requerido.');
			$this->form_validation->set_message('noExistDependence', '%s existe.');

			if($this->form_validation->run($this))
			{
				$dependence = array(
					'name' => $this->input->post('name'),
					'slug' => modules::run('operations/createSlug', $this->input->post('name'))
				);

				$this->dependence_model->insertDependence($dependence);

				redirect('backend/dependencias');
			}
			else
			{
				$user_id = modules::run('user/getSessionId');
				$data['userData'] = modules::run('user/getUserData', $user_id);
				$data['title'] = 'Backend - Nueva Dependencia';
				$data['contenido_principal'] = $this->load->view('nueva-dependencia', $data, true);
				$this->load->view('back/template', $data);
			}
		}
		else
		{
			redirect('backend');
		}
	}

	public function getAllDependences()
	{
		$query = $this->dependence_model->getAllDependences();
		$query = objectSQL_to_array($query);
		return $query;
	}

	public function showDependences()
	{
		//SI ES ADMINISTRADOR
		if(modules::run('user/isAdministrator'))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Dependencias';
			$data['dependences'] = $this->getAllDependences();
			$data['contenido_principal'] = $this->load->view('ver-dependencias', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	//VERIFICA QUE EXISTA UNA DEPENDENCIA
	function existDependenceBySlug($slug)
	{
		return $this->dependence_model->existDependenceBySlug($slug);
	}

	//OBTENGO UNA DEPENDENCIA POR SLUG
	function getDependenceBySlug($slug)
	{
		$query = $this->dependence_model->getDependenceBySlug($slug);
		$query = SQL_to_array($query);
		return $query;
	}

	//CARGA UNA VISTA PARA ACTUALIZAR UNA DEPENDENCIA
	public function updateDependence($slug)
	{
		//SI ES ADMINISTRADOR
		if(modules::run('user/isAdministrator') && $this->existDependenceBySlug($slug))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Dependencias';
			$data['dependence'] = $this->getDependenceBySlug($slug);
			$data['contenido_principal'] = $this->load->view('actualizar-dependencia', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	//VERIFICA QUE NO ESTE DUPLICADA UNA DEPENDENCIA
	function isNotDuplicateDependence($name)
	{
		$dependence_id = $this->input->post('dependence_id');
		return $this->dependence_model->isNotDuplicateDependence($dependence_id, $name);

	}

	function getDependenceById($dependence_id)
	{
		$query = $this->dependence_model->getDependenceById($dependence_id);
		$query = SQL_to_array($query);
		return $query;
	}

	//ACTUALIZAR UNA DEPENDENCIA
	public function dependenceUpdate()
	{
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('name', 'Dependencia', 'required|callback_isNotDuplicateDependence');

			$this->form_validation->set_message('required', '%s es requerido.');
			$this->form_validation->set_message('isNotDuplicateDependence', '%s existe.');

			if($this->form_validation->run($this))
			{
				$dependence_id = $this->input->post('dependence_id');
				$dependence = array(
					'name' => $this->input->post('name'),
					'slug' => modules::run('operations/createSlug', $this->input->post('name'))
				);

				$this->dependence_model->updateDependence($dependence_id, $dependence);

				redirect('backend/dependencias');
			}
			else
			{
				$user_id = modules::run('user/getSessionId');
				$data['userData'] = modules::run('user/getUserData', $user_id);
				$data['title'] = 'Backend - Actualizar dependencia';
				$data['dependence'] = $this->getDependenceById($this->input->post('dependence_id'));
				$data['contenido_principal'] = $this->load->view('actualizar-dependencia', $data, true);
				$this->load->view('back/template', $data);
			}
		}
		else
		{
			redirect('backend');
		}
	}

	public function deleteDependence($slug)
	{
		//SI ES ADMINISTRADOR
		if(modules::run('user/isAdministrator') && $this->existDependenceBySlug($slug))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Eliminar dependencia';
			$data['dependence'] = $this->getDependenceBySlug($slug);
			$data['contenido_principal'] = $this->load->view('eliminar-dependencia', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	public function dependenceDelete($slug)
	{
		if(modules::run('user/isAdministrator') && $this->existDependenceBySlug($slug))
		{
			$this->dependence_model->deleteDependenceBySlug($slug);
			redirect('backend/dependencias');
		}
		
		redirect('backend');
	}

	public function ajax_getDependences()
	{
		$query = $this->dependence_model->getAllDependences();
		$query = objectSQL_to_array($query);
		//JSON
    	header('Content-Type: application/json');
		echo json_encode($query);
	}

}

?>