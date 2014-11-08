<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller{

	//CONSTRUCTOR DE LA CLASE
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	//DEVOLVER EL USUARIO EN SESION
	public function getSessionId()
	{
		return $this->session->userdata('userback_id');
	}

	//VERIFICA QUE EL USUARIO ESTE LOGUEADO
	public function isLoged()
	{	
		//USERBACK_ID ES EL NOMBRE DE ESE DATO EN LA COOKIE
		return $this->session->userdata('userback_id');
	}

	function existUsername($username)
	{
		return $this->user_model->existUsername($username);
	}

	function verifySession()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => sha1($this->input->post('password')),
			'privilege_id' => 1
		);

		return $this->user_model->verifySession($data);
	}

	//VERIFICA LOS DATOS E INICIA SESION
	public function login()
	{
		if(!empty($_POST))
		{
			//DEFINIENDO LAS REGLAS
			$this->form_validation->set_rules('username', 'Usuario', 'required|trim|callback_existUsername');
			$this->form_validation->set_rules('password', 'Contraseña', 'required|callback_verifySession');
			
			//DEFINIENDO MENSAJE DE ERROR
			$this->form_validation->set_message('required', '%s es requerido.');
			$this->form_validation->set_message('existUsername','%s no existe.');
			$this->form_validation->set_message('verifySession','Email o Password incorrecto.');

			//SI LAS VALIDACIONES SON CORRECTAS
			if($this->form_validation->run($this))
			{
				//OBTENGO EL EMAIL DEL USUARIO
				$username = $this->input->post('username');
				//BUSCO SUS DATOS POR EMAIL
				$userData = $this->user_model->getUserDataByUsername($username);
				//CREO LA COOKIE DE SESION CON ID
				$cookieData = array(
					'userback_id' 	=> $userData->id
				);
				$this->session->set_userdata($cookieData);

				//REDIRIJO AL HOME
				redirect('backend');
			}
			else
			{
				//SI HUBO ALGUN ERROR REGRESAR A LA VISTA LOGIN
				$data['title'] = 'Backend - Iniciar Sesión';
				$this->load->view('login',$data);
			}
		}
		else
		{
			redirect('backend');
		}
	}

	//CIERRA SESION Y REDIRECCIONA AL LOGIN
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('backend');
	}

	function getPrivilegeNameById($privilege_id)
	{
		return $this->user_model->getPrivilegeNameById($privilege_id);
	}

	public function getUserData($user_id)
	{
		$query = $this->user_model->getUserData($user_id);
		$query = SQL_to_array($query);
		$query['privilege'] = $this->getPrivilegeNameById($query['privilege_id']);
		return $query;
	}

	//VERIFICA SI UN USUARIO ES ADMINISTRADOR
	public function isAdministrator()
	{
		$user_id = $this->getSessionId();
		$userData = $this->getUserData($user_id);
		return $userData['privilege_id'] == 1;
	}

	public function getAllPrivileges()
	{
		$query = $this->user_model->getAllPrivileges();
		$query = objectSQL_to_array($query);
		return $query;
	}

	function getAllTypeApplicant()
	{
		$query = $this->user_model->getAllTypeApplicant();
		$query = objectSQL_to_array($query);
		return $query;
	}

	//CARGA UNA VISTA PARA CREAR UN NUEVO USUARIO
	public function newUser()
	{	
		//SI EL USUARIO EN SESION ES ADMINISTRADO
		if($this->isAdministrator())
		{
			//CREO UN TITULO
			$data['title'] = 'Backend - Nuevo usuario';
			//OBTENGO EL ID DE SESION
			$user_id = modules::run('user/getSessionId');
			//DATOS DEL USUARIO
			$data['typeApplicant'] = $this->getAllTypeApplicant();
			$data['privileges'] = $this->getAllPrivileges();
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['dependences'] = modules::run('dependence/getAllDependences');
			$data['contenido_principal'] = $this->load->view('nuevo-usuario', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	//VERIFICA QUE NO EXISTA UN NOMBRE
	function noExistName($name)
	{
		return $this->user_model->noExistName($name);
	}

	//VERIFICA QUE NO EXISTA UN USERNAME
	function noExistUsername($username)
	{
		return !$this->existUsername($username);
	}

	function noExistCedula($cedula)
	{
		return $this->user_model->noExistCedula($cedula);
	}

	function noExistEmail($email)
	{
		return $this->user_model->noExistEmail($email);
	}

	public function createUser()
	{
		if(!empty($_POST))
		{
			//DEFINIMOS LAS REGLAS
			$this->form_validation->set_rules('name','Nombre','required|trim|callback_noExistName');
			$this->form_validation->set_rules('username','Usuario','required|trim|callback_noExistUsername');
			$this->form_validation->set_rules('email','Correo electronico', 'required|valid_email|callback_noExistEmail');
			$this->form_validation->set_rules('password', 'Contraseña','required');
			$this->form_validation->set_rules('repassword','Repita la contraseña','required|match[password]');
			$this->form_validation->set_rules('privilege_id','Privilegio','required');

			//DEFINIMOS LOS MENSAJES PARA LAS REGLAS
			$this->form_validation->set_message('required','%s es requerido.');
			$this->form_validation->set_message('valid_email', '%s invalido.');
			$this->form_validation->set_message('noExistName','%s existe.');
			$this->form_validation->set_message('match','Las contraseñas no coinciden.');
			$this->form_validation->set_message('noExistUsername', '%s existe.');
			$this->form_validation->set_message('noExistEmail', '%s existe.');

			//SI LAS VALIDACIONES PASAN
			if($this->form_validation->run($this))
			{
				$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'username' => $this->input->post('username'),
					'password' => sha1($this->input->post('password')),
					'privilege_id' => $this->input->post('privilege_id'),
					'slug' => modules::run('operations/createSlug', $this->input->post('name'))
				);

				$this->user_model->insertUser($data);

				redirect('backend');
			}
			else
			{
				//CREO UN TITULO
				$data['title'] = 'Backend - Nuevo usuario';
				//OBTENGO EL ID DE SESION
				$user_id = modules::run('user/getSessionId');
				//DATOS DEL USUARIO
				$data['privileges'] = $this->getAllPrivileges();
				$data['userData'] = modules::run('user/getUserData', $user_id);
				$data['contenido_principal'] = $this->load->view('nuevo-usuario', $data, true);
				$this->load->view('back/template', $data);
			}
		}
		else
		{
			redirect('backend');
		}
	}

	//DEVUELVE TODOS LOS USUARIOS
	function getAllUsers()
	{
		$query = $this->user_model->getAllUsers();
		$query = objectSQL_to_array($query);
		foreach ($query as $key => $value) 
		{
			$query[$key]['privilege'] = $this->getPrivilegeNameById($query[$key]['privilege_id']);
		}

		return $query;
	}

	//OBTENGO LOS USUARIOS
	function getAllUsersExceptMe($user_id)
	{
		$query = $this->user_model->getAllUsersExceptMe($user_id);
		$query = objectSQL_to_array($query);
		foreach ($query as $key => $value) 
		{
			$query[$key]['privilege'] = $this->getPrivilegeNameById($query[$key]['privilege_id']);
		}

		return $query;
	}

	//MUESTRA TODOS LOS USUARIOS
	public function showUsers()
	{
		//SI EL USUARIO EN SESION ES ADMINISTRADO
		if($this->isAdministrator())
		{
			//CREO UN TITULO
			$data['title'] = 'Backend - Usuarios';
			//OBTENGO EL ID DE SESION
			$user_id = modules::run('user/getSessionId');
			//DATOS DEL USUARIO
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['users'] = $this->getAllUsersExceptMe($user_id);
			$data['contenido_principal'] = $this->load->view('ver-usuarios', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	function existSlug($slug)
	{
		return $this->user_model->existSlug($slug);
	}

	function getUserDataBySlug($slug)
	{
		$query = $this->user_model->getUserDataBySlug($slug);
		$query = SQL_to_array($query);
		$query['privilege'] = $this->getPrivilegeNameById($query['privilege_id']);
		return $query;
	}

	//VERIFICAR QUE EL SLUG SEA YO
	function itsMe($slug)
	{
		$user_id = $this->getSessionId();
		return $this->user_model->itsMe($user_id, $slug);
	}

	//MOSTRAR UN FORMULARIO DE ACTUALIZACION
	public function updateUser($slug)
	{

		//SI ES UN USUARIO ADMINISTRADOR Y EXISTE ESE USUARIO
		if( ($this->isAdministrator() || $this->itsMe($slug) ) && $this->existSlug($slug))
		{
			//OBTENGO EL ID DE USUARIO EN SESION
			$user_id = $this->getSessionId();
			//OBTENGO LOS DATOS DEL USUARIO EN SESION
			$data['userData'] = $this->getUserData($user_id);
			//TITULO PARA LA VISTA
			$data['title'] = 'Backend - Actualizar usuario';
			//DATOS DEL USUARIO A ACTUALIZAR
			$data['user'] = $this->getUserDataBySlug($slug);
			$data['typeApplicant'] = $this->getAllTypeApplicant();
			//PRIVILEGIOS
			$data['privileges'] = $this->getAllPrivileges();
			//CARGANDO LA VISTA PRINCIPAL EN UNA VARIABLE
			$data['contenido_principal'] = $this->load->view('actualizar-usuario', $data, true);
			//RENDERIZANDO LA PRINCIPAL A TRAVES DE UN TEMPLATE
			$this->load->view('back/template',$data);
		}
		else//SI NO EXISTE
		{
			//REGRESAR AL INICIO
			redirect('backend');
		}
	}

	//VERIFICA QUE NO EXISTA UN NOMBRE REPETIDO
	function isDuplicateName()
	{
		$user_id = $this->input->post('user_id');
		$name = $this->input->post('name');

		return $this->user_model->isDuplicateName($user_id, $name);
	}

	//VERIFICA QUE NO EXISTA UN USUARIO REPETIDO
	function isDuplicateUsername()
	{
		$user_id = $this->input->post('user_id');
		$username = $this->input->post('username');

		return $this->user_model->isDuplicateUsername($user_id, $username);
	}

	function isDuplicateCedula($cedula)
	{
		$user_id = $this->input->post('user_id');
		$cedula = $this->input->post('cedula');

		return $this->user_model->isDuplicateCedula($user_id, $cedula);
	}

	function isDuplicateEmail($email)
	{
		$user_id = $this->input->post('user_id');
		$email = $this->input->post('email');

		return $this->user_model->isDuplicateEmail($user_id, $email);
	}

	//ACTUALIZA LA INFORMACION DE UN USUARIO
	public function userUpdate()
	{
		if(!empty($_POST))
		{
			//DEFINIMOS LAS REGLAS
			$this->form_validation->set_rules('name','Nombre','required|trim|callback_isDuplicateName');
			$this->form_validation->set_rules('email', 'Correo electrónico', 'required|valid_email|callback_isDuplicateEmail');
			$this->form_validation->set_rules('username','Usuario','required|trim|callback_isDuplicateUsername');
			$this->form_validation->set_rules('privilege_id','Privilegio','required');

			if(!empty($this->input->post('password')))
			{
				$this->form_validation->set_rules('password', 'Contraseña','required');
				$this->form_validation->set_rules('repassword','Repita la contraseña','required|match[password]');
			}

			//DEFINIMOS LOS MENSAJES PARA LAS REGLAS
			$this->form_validation->set_message('required','%s es requerido.');
			$this->form_validation->set_message('isDuplicateName', '%s existe.');
			$this->form_validation->set_message('isDuplicateUsername', '%s existe.');
			$this->form_validation->set_message('isDuplicateEmail','%s ya existe.');
			$this->form_validation->set_message('match','Las contraseñas no coinciden.');

			if($this->form_validation->run($this))
			{
				$user_id = $this->input->post('user_id'); 

				$data = array(
					'name' 			=> $this->input->post('name'),
					'username' 		=> $this->input->post('username'),
					'email' 		=> $this->input->post('email'), 
					'privilege_id' 	=> $this->input->post('privilege_id'),
					'slug' 			=> modules::run('operations/createSlug', $this->input->post('name'))
				);

				if(!empty($this->input->post('password')))
				{
					$data['password'] = sha1($this->input->post('password'));
				}

				$this->user_model->updateUser($user_id, $data);

				redirect('backend/usuarios');
			}
			else
			{
				//OBTENGO EL ID DE USUARIO EN SESION
				$user_id = $this->getSessionId();
				//OBTENGO LOS DATOS DEL USUARIO EN SESION
				$data['userData'] = $this->getUserData($user_id);
				//TITULO PARA LA VISTA
				$data['title'] = 'Backend - Actualizar usuario';
				//DATOS DEL USUARIO A ACTUALIZAR
				$data['user'] = $this->getUserData($this->input->post('user_id'));
				//PRIVILEGIOS
				$data['privileges'] = $this->getAllPrivileges();
				//CARGANDO LA VISTA PRINCIPAL EN UNA VARIABLE
				$data['contenido_principal'] = $this->load->view('actualizar-usuario', $data, true);
				//RENDERIZANDO LA PRINCIPAL A TRAVES DE UN TEMPLATE
				$this->load->view('back/template',$data);
			}
		}
		else
		{
			redirect('backend');
		}
	}

	public function deleteUser($slug)
	{
		//SI ES ADMINISTRADOR
		if($this->isAdministrator())
		{
			$user_id = $this->getSessionId();
			$data['userData'] = $this->getUserData($user_id);
			$data['title'] = 'Backend - Eliminar usuario';
			$data['user'] = $this->getUserDataBySlug($slug);
			$data['contenido_principal'] = $this->load->view('eliminar-usuario', $data, true);
			$this->load->view('back/template',$data);

		}
		else 
		{
			redirect('backend');
		}
	}

	//ELIMINA UN USUARIO DE LA BD
	public function userDelete($slug)
	{
		if( $this->isAdministrator() && $this->existSlug($slug))
		{
			$this->user_model->deleteUserBySlug($slug);
			redirect('backend/usuarios');
		}
		else
		{
			redirect('backend');
		}
	}

	function getAllApplicant($user_id)
	{
		$query = $this->user_model->getAllApplicant($user_id);
		$query = objectSQL_to_array($query);
		foreach ($query as $key => $value) 
		{
			$query[$key]['privilege'] = $this->getPrivilegeNameById($query[$key]['privilege_id']);
		}

		return $query;
	}

	//MOSTRAR USUARIOS SOLICITANTES
	public function showApplicant()
	{
		//SI EL USUARIO EN SESION ES ADMINISTRADO
		if($this->isAdministrator())
		{
			//CREO UN TITULO
			$data['title'] = 'Backend - Usuarios';
			//OBTENGO EL ID DE SESION
			$user_id = modules::run('user/getSessionId');
			//DATOS DEL USUARIO
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['users'] = $this->getallApplicant($user_id);
			$data['contenido_principal'] = $this->load->view('ver-usuarios', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	public function getUserIdByCedula($cedula)
	{
		return $this->user_model->getUserIdByCedula($cedula);
	}

	public function getCedulaByUserId($user_id)
	{
		return $this->user_model->getCedulaByUserId($user_id);
		
	}
}