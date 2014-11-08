<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends MX_Controller{

	//CONSTRUCTOR DE LA CLASE
	public function __construct()
	{
		parent::__construct();
	}

	//INICIO BACKEND
	public function index($message = '')
	{
		//SI HAY UNA SESION ACTIVA
		if(modules::run('user/isLoged'))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Panel';
			$data['solicitudes10'] = modules::run('request/getLastTenRequests'); 
			//die_pre($data);
			$data['contenido_principal'] = $this->load->view('home', $data, true);
			$this->load->view('back/template', $data);
		}
		else//SI NO HAY UNA SESION ACTIVA
		{
			//CONFIGURO EL TITULO A MOSTRAR EN EL NAVEGADOR
			$data['title'] = 'Backend - Iniciar Sesión';
			//CARGO LA VISTA CON EL INICIO DE SESION
			$this->load->view('login', $data);
 		}
	}

}