<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends MX_Controller{

	//CONSTRUCTOR DE LA CLASE
	public function __construct()
	{
		parent::__construct();
		$this->load->model('request_model');
	}

	//RETORNA EL ERROR SEGUN EL CODIGO - MOVER A LENGUAGE
	function codeToMessage($code) 
    { 
    	$message = '';
        switch ($code) 
        { 
            case UPLOAD_ERR_INI_SIZE: 
                $message = "El archivo subido excede la directiva upload_max_filesize en php.ini"; 
                break; 
            case UPLOAD_ERR_FORM_SIZE: 
                $message = "El archivo subido excede la directiva MAX_FILE_SIZE que fue especificada en el formulario HTML."; 
                break; 
            case UPLOAD_ERR_PARTIAL: 
                $message = "El archivo subido fue sólo parcialmente cargado"; 
                break; 
            case UPLOAD_ERR_NO_FILE: 
                $message = "Ningún archivo fue subido"; 
                break; 
            case UPLOAD_ERR_NO_TMP_DIR: 
                $message = "Falta la carpeta temporal"; 
                break; 
            case UPLOAD_ERR_CANT_WRITE: 
                $message = "No se pudo escribir el archivo en el disco"; 
                break; 
            case UPLOAD_ERR_EXTENSION: 
                $message = "Una extensión de PHP detuvo la carga de archivos"; 
                break; 

            default: 
                $message = "Unknown upload error"; 
                break; 
        } 
        return $message; 
    } 

    //CREA UN NUEVO ATTACHMENT
	public function newAttachment($request_id, $name, $type = null)
	{
		$data = array(
			'request_id'	=> $request_id,
			'name' 			=> $name,
			'type' 			=> $type
		);
		pre($data);
		$this->request_model->newAttachment($data);
	}

	//CARGAMOS LOS ADJUNTOS
	public function upload_attachments($request_id)
	{
		//SI EXISTEN ADJUNTOS
		if(!empty($_FILES['attachment']))
		{
			foreach ($_FILES["attachment"]["error"] as $key => $error) 
			{
			    if ($error == UPLOAD_ERR_OK) 
			    {

			        $tmp_name = $_FILES["attachment"]["tmp_name"][$key];
			        $name = $_FILES["attachment"]["name"][$key];
			        $type = $_FILES["attachment"]["type"][$key];
			        move_uploaded_file($tmp_name, "assets/back/upload/file/$name");
			        echo $request_id." ".$name." ".$type;
			        $this->newAttachment($request_id, $name, $type);
			    }
			    else
			    {
			    	return $this->codeToMessage($error);
			    }
			}
		}
	}

	//DEVUELVE TODOS LOS ESTATUS DE UNA SOLICITUD
	public function getStatus()
	{
		$query = $this->request_model->getStatus();
		$query = objectSQL_to_array($query);
		return $query;
	}

	//CARGA UNA VISTA PARA CREAR UNA NUEVA SOLICITUD
	public function newRequest()
	{
		if(modules::run('user/isAdministrator'))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData',$user_id);
			$data['title'] = 'Backend - Nueva solicitud';
			$data['typeRequest'] = modules::run('type_request/getAllTypeRequests');
			$data['status'] = $this->getStatus();
			$data['typeApplicant'] = modules::run('applicant_role/getAllApplicantRoles');
			$data['dependences'] = modules::run('dependence/getAllDependences');
			$data['contenido_principal'] = $this->load->view('nueva-solicitud', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	//EXISTE CEDULA
	function existCedula($cedula)
	{
		return $this->request_model->existCedula($cedula);
	}

	function existNombre($nombre)
	{
		return $this->request_model->existNombre($nombre);
	}

	function getRequestIdByData($data)
	{
		return $this->request_model->getRequestIdByData($data);
	}

	//CREO UN NUEVO REQUEST
	public function createRequest()
	{
		if(!empty($_POST))
		{

			$this->form_validation->set_rules('cedula','Cedula','required|callback_existCedula');
			$this->form_validation->set_rules('nombre','Nombre','required|callback_existNombre');
			$this->form_validation->set_rules('type_request_id','Tipo de Solicitud', 'required');
			$this->form_validation->set_rules('description', 'Descripción', 'required');
			$this->form_validation->set_rules('status_id','Estatus','required');
			$this->form_validation->set_rules('type_applicant_id','Tipo solicitante','required');
			$this->form_validation->set_rules('dependence_id','Dependencia','required');

			$this->form_validation->set_message('required', '%s es requerido.');
			$this->form_validation->set_message('existCedula', '%s no existe.');
			$this->form_validation->set_message('existNombre', '%s no existe.');

			if($this->form_validation->run($this))
			{
				$aux = modules::run('applicant/getApplicantIdByCedula',$this->input->post('cedula'));
				$user_id = $aux['id'];
				
				$request = array(
					'applicant_id'		=> $user_id, 
					'status_id' 		=> $this->input->post('status_id'),
					'type_request_id' 	=> $this->input->post('type_request_id'),
					'description' 		=> $this->input->post('description'),
					'date' 				=> date("Y-m-d"),
					'type_applicant_id' => $this->input->post('type_applicant_id'),
					'dependence_id'		=> $this->input->post('dependence_id')
				);
				
				$this->request_model->createRequest($request);

				$request = $this->getRequestIdByData($request);
				
				$this->upload_attachments($request->id);
				
				redirect('backend');
			}
			else
			{
				$user_id = modules::run('user/getSessionId');
				$data['userData'] = modules::run('user/getUserData',$user_id);
				$data['title'] = 'Backend - Nueva solicitud';
				$data['typeRequest'] = modules::run('type_request/getAllTypeRequests');
				$data['status'] = $this->getStatus();
				$data['typeApplicant'] = modules::run('applicant_role/getAllApplicantRoles');
				$data['dependences'] = modules::run('dependence/getAllDependences');
				$data['contenido_principal'] = $this->load->view('nueva-solicitud', $data, true);
				$this->load->view('back/template', $data);
			}
		}
		else
		{
			redirect('backend');
		}
	}

	//OBTIENE TODAS LAS SOLICITUDES
	function getAllRequests()
	{
		$query = $this->request_model->getAllRequests();
		$query = objectSQL_to_array($query);
		foreach ($query as $key => $value) 
		{
			$query[$key]['type_request'] = modules::run('type_request/getNameByTypeRequestId', $query[$key]['type_request_id']);
			$query[$key]['cedula'] = modules::run('applicant/getCedulaApplicantById', $query[$key]['applicant_id']);
			$query[$key]['status'] = $this->getStatusNameById($query[$key]['status_id']);
			$query[$key]['nombre'] = modules::run('applicant/getNombreApplicantById', $query[$key]['applicant_id']);
 		}
		return $query;
	}

	//OBTENGO TODAS LAS SOLICITUDES QUE NO ESTAN RECIBIDAS
	public function getAllReceivedRequest()
	{
		$query = $this->request_model->getAllReceivedRequest();
		$query = objectSQL_to_array($query);
		foreach ($query as $key => $value) 
		{
			$query[$key]['type_request'] = modules::run('type_request/getNameByTypeRequestId', $query[$key]['type_request_id']);
			$query[$key]['cedula'] = modules::run('applicant/getCedulaApplicantById', $query[$key]['applicant_id']);
			$query[$key]['nombre'] = modules::run('applicant/getNombreApplicantById', $query[$key]['applicant_id']);
			$query[$key]['status'] = $this->getStatusNameById($query[$key]['status_id']);
		}
		return $query;
	}

	//CARGA UNA VISTA CON TODAS LAS SOLICITUDES
	public function showAllRequests()
	{
		if(modules::run('user/isAdministrator'))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Solicitudes';
			$data['requestsRecibidas'] = $this->getAllReceivedRequest();
			$data['requests'] = $this->getAllRequests();
			$data['status'] = $this->getStatus();
			$data['contenido_principal'] = $this->load->view('solicitudes', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	public function getStatusNameById($status_id)
	{
		return $this->request_model->getStatusNameById($status_id);
	}

	//OBTENGO TODAS LAS SOLICITUDES QUE NO ESTAN RECIBIDAS
	public function getAllNoReceivedRequest()
	{
		$query = $this->request_model->getAllNoReceivedRequest();
		$query = objectSQL_to_array($query);
		foreach ($query as $key => $value) 
		{
			$query[$key]['type_request'] = modules::run('type_request/getNameByTypeRequestId', $query[$key]['type_request_id']);
			$query[$key]['cedula'] = modules::run('user/getCedulaByUserId', $query[$key]['user_id']);
			$query[$key]['status'] = $this->getStatusNameById($query[$key]['status_id']);
		}
		return $query;
	}

	//DADO UN ID OBTENGO UNA SOLICITUD
	public function getRequest($request_id)
	{
		$query = $this->request_model->getRequest($request_id);
		$query = SQL_to_array($query);
		$query['name'] = modules::run('applicant/getNameByApplicantId',$query['applicant_id']);
		$query['cedula'] = modules::run('applicant/getCedulaByApplicantId',$query['applicant_id']);
		die_pre($query);
		$query['type_request'] = modules::run('type_request/getNameByTypeRequestId',$query['type_request_id']);
		return $query; 
	}

	//DADO UN VEREDICTO MUESTRO UN FORMULARIO CON TODOS SUS DATOS
	public function changeVeredict($request_id)
	{
		if(modules::run('user/isAdministrator'))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Solicitud';
			$data['status'] = $this->getStatus();
			$data['request'] = $this->getRequest($request_id);
			$data['contenido_principal'] = $this->load->view('ver-solicitud', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	public function veredict()
	{
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('request_id','Request','required');
			$this->form_validation->set_message('required', '%s es requerido.');

			if($this->form_validation->run($this))
			{	
				$data = array(
					'status_id' => $this->input->post('status_id')
 				);

				if($this->input->post('option') == 'rechazar')
				{
					$data['status_id'] = 2;
				}
				else
				{
					$data['agenda'] = 1;
					$data['status_id'] = 6;
				}

 				$this->request_model->updateRequest($this->input->post('request_id'), $data);

 				redirect('backend/solicitudes');

			}else{

				$user_id = modules::run('user/getSessionId');
				$data['userData'] = modules::run('user/getUserData', $user_id);
				$data['title'] = 'Backend - Solicitud';
				$data['status'] = $this->getStatus();
				$data['request'] = $this->getRequest($request_id);
				$aux = modules::run('applicant/getApplicantNameByApplicantId',$data['request']['applicant_id']);
				$data['name'] = $aux['name'];
				die_pre($data);
				$data['contenido_principal'] = $this->load->view('ver-solicitud', $data, true);
				$this->load->view('back/template', $data);
			}
		}else{

			redirect('backend');
		}
	}

	public function ajax_getRequestByStatusId()
	{
		$status_id = $_POST['status_id'];
		if($status_id == 0)
		{
			$query = $this->request_model->getAllRequests();
			$query = objectSQL_to_array($query);
		}
		else
		{
			$query = $this->request_model->getRequestByStatusId($status_id);
			$query = objectSQL_to_array($query); 	
		}
		
		foreach ($query as $key => $value) 
		{
			$query[$key]['type_request'] = modules::run('type_request/getNameByTypeRequestId', $query[$key]['type_request_id']);
			$query[$key]['cedula'] = modules::run('applicant/getCedulaApplicantById', $query[$key]['applicant_id']);
			$query[$key]['nombre'] = modules::run('applicant/getNombreApplicantById', $query[$key]['applicant_id']);
			$query[$key]['nameStatus'] = $this->getStatusNameById($query[$key]['status_id']);
		}
   		
   		//JSON
    	header('Content-Type: application/json');
		echo json_encode($query);
	}

	public function getRequestsForDairy()
	{
		$query = $this->request_model->getRequestsForDairy();
		$query = objectSQL_to_array($query);
		foreach ($query as $key => $value) 
		{
			$query[$key]['type_request'] = modules::run('type_request/getNameByTypeRequestId', $query[$key]['type_request_id']);
			$query[$key]['cedula'] = modules::run('user/getCedulaByUserId', $query[$key]['user_id']);
			$query[$key]['status'] = $this->getStatusNameById($query[$key]['status_id']);
			$query[$key]['isChecked'] = $this->request_model->noExistDairyAttachment($query[$key]['id']);
		}
		return $query;
	}


	public function getLastTenRequests()
	{
		$query = $this->request_model->getLastTenRequests();
		$query = objectSQL_to_array($query);
		foreach ($query as $key => $value) 
		{
			$query[$key]['type_request'] = modules::run('type_request/getNameByTypeRequestId', $query[$key]['type_request_id']);
			$query[$key]['cedula'] = modules::run('applicant/getCedulaApplicantById', $query[$key]['applicant_id']);
			$query[$key]['status'] = $this->getStatusNameById($query[$key]['status_id']);
			$query[$key]['nombre'] = modules::run('applicant/getNombreApplicantById', $query[$key]['applicant_id']);
		}
		return $query;
	}

}