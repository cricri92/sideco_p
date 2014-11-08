<?php 
	class Counselor_type extends MX_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('counselortype_model');
		}

		//CARGA UNA VISTA PARA CREAR UNA NUEVA DEPENDENCIA
		public function newCounselorType()
		{
			//SI ES ADMINISTRADOR
			if(modules::run('user/isAdministrator'))
			{
				$user_id = modules::run('user/getSessionId');
				$data['userData'] = modules::run('user/getUserData', $user_id);
				$data['title'] = 'Backend - Nuevo tipo de Consejero';
				$data['contenido_principal'] = $this->load->view('nuevo-tipo-consejero', $data, true);
				$this->load->view('back/template', $data);
			}
			else
			{
				redirect('backend');
			}
		}

		function noExistCounselorType($name)
		{
			return $this->counselortype_model->noExistCounselorType($name);
		}

		public function createCounselorType()
		{
			if(!empty($_POST))
			{
				$this->form_validation->set_rules('name', 'Nombre', 'required|callback_noExistCounselorType');
				$this->form_validation->set_message('required', '%s es requerido.');
				$this->form_validation->set_message('noExistCounselorType', '%s existe.');

				if($this->form_validation->run($this))
				{
					$counselor_type = array(
						'name' => $this->input->post('name')
					);

					$this->counselortype_model->insertCounselorType($counselor_type);

					redirect('backend');
				}
				else
				{
					$user_id = modules::run('user/getSessionId');
					$data['userData'] = modules::run('user/getUserData', $user_id);
					$data['title'] = 'Backend - Nuevo tipo de Consejero';
					//$die_pre($data);
					$data['contenido_principal'] = $this->load->view('nuevo-tipo-consejero', $data, true);
					$this->load->view('back/template', $data);
				}
			}
			else
			{
				redirect('backend');
			}
		}

		//OBTENGO TODOS LOS TIPOS DE CONSEJERO
		function getAllCounselorType()
		{
			$query = $this->counselortype_model->getAllCounselorType();
			$query = objectSQL_to_array($query);
			return $query;
		}

		function getCounselorTypeNameById($id)
		{
			$query = $this->db->get_where('counselor_type', array('id' => $id));
			return $query->row()->name;
		}

		/*//DEVUELVE TODOS LOS TIPOS DE SOLICITUD
		public function getAllCounselorType()
		{
			$query = $this->counselortype_model->getAllCounselorType();
			$query = objectSQL_to_array($query);
			return $query;
		}

		public function getNameByCounselorTypeId($type_request_id)
		{
			return $this->counselortype_model->getNameByCounselorTypeId($type_request_id);
		}*/
	}
 ?>