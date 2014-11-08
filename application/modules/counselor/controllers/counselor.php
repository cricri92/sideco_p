<?php 
	class Counselor extends MX_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('counselor_model');
		}

		public function newCounselor()
		{
			if(modules::run('user/isAdministrator'))
			{
				$user_id = modules::run('user/getSessionId');
				$data['userData'] = modules::run('user/getUserData', $user_id);
				$data['title'] = 'Backend - Nuevo consejero';
				$data['counselor_type'] = modules::run('counselor_type/getAllCounselorType');
				//die_pre($data);
				$data['contenido_principal'] = $this->load->view('nuevo-consejero',$data, true);
				$this->load->view('back/template', $data);
			}
			else
			{
				redirect('backend');
			}
		}

		public function createCounselor()
		{
			if(!empty($_POST))
			{
				//DEFINIMOS LAS REGLAS
				$this->form_validation->set_rules('name','Nombre','required|trim');
				$this->form_validation->set_rules('lastname','Apellido','required|trim');
				$this->form_validation->set_rules('counselor_type_id','Rol','required');
				
				//DEFINIMOS LOS MENSAJES PARA LAS REGLAS
				$this->form_validation->set_message('required','%s es requerido.');
			
				//SI LAS VALIDACIONES PASAN
				if($this->form_validation->run($this))
				{
					$data = array(
						'name' => $this->input->post('name'),
						'lastname' => $this->input->post('lastname'),
						'counselor_type_id' => $this->input->post('counselor_type_id'),
				);

					$this->counselor_model->insertCounselor($data);

					redirect('backend');
				}
				else
				{
				
					$user_id = modules::run('user/getSessionId');
					$data['userData'] = modules::run('user/getUserData', $user_id);
					$data['title'] = 'Backend - Nuevo consejero';
					$data['counselor_type'] = modules::run('counselor_type/getAllCounselorType');
					$data['contenido_principal'] = $this->load->view('nuevo-consejero',$data, true);
					$this->load->view('back/template', $data);
				}
			}
			else
			{
				redirect('backend');
			}
		}

		function getCounselorTypeNameById($id)
		{
			return modules::run('counselor_type/getCounselorTypeNameById',$id);
		}

		function getAllCounselors()
		{
			$query = $this->counselor_model->getAllCounselors();
			$query = objectSQL_to_array($query);
			foreach ($query as $key => $value) 
			{
				$query[$key]['counselor_type_id'] = modules::run('counselor_type/getCounselorTypeNameById',$query[$key]['counselor_type_id']);
			}
			return $query;
		}

		public function showCounselors()
		{
			//SI EL USUARIO EN SESION ES ADMINISTRADOR
			if(modules::run('user/isAdministrator'))
			{
				//CREO UN TITULO
				$data['title'] = 'Backend - Consejeros';
				//OBTENGO EL ID DE SESION
				$user_id = modules::run('user/getSessionId');
				//DATOS DEL USUARIO
				$data['userData'] = modules::run('user/getUserData', $user_id);
				$data['consejeros'] = $this->getAllCounselors();
				//die_pre($data);
				$data['contenido_principal'] = $this->load->view('ver-consejeros', $data, true);
				$this->load->view('back/template', $data);
			}
			else
			{
				redirect('backend');
			}
		}
	}
 ?>