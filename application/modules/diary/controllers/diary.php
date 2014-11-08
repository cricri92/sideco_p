<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diary extends MX_Controller{

	//CONSTRUCTOR DE LA CLASE
	public function __construct()
	{
		parent::__construct();
		$this->load->model('diary_model');
	}

	public function newDiary()
	{
		if(modules::run('user/isAdministrator'))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Nueva agenda';
			$data['contenido_principal'] = $this->load->view('nueva-agenda', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	function noExistDiaryNumber($num_acta)
	{
		return $this->diary_model->noExistDiaryNumber($num_acta);
	}

	public function createDiary()
	{
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('num_acta','Numero de acta', 'required|trim|callback_noExistDiaryNumber');
			$this->form_validation->set_rules('date', 'Fecha', 'required');
			$this->form_validation->set_rules('consideration','Consideracion','required');

			$this->form_validation->set_message('required', '%s es requerido.');
			$this->form_validation->set_message('noExistDiaryNumber', '%s existe');

			if($this->form_validation->run($this))
			{
				$data = array(
					'num_acta' 	=> $this->input->post('num_acta'),
					'date'		=> date('Y-m-d'),
					'consideration' => $this->input->post('consideration')
				);

				$this->diary_model->insertDairy($data);

				redirect('backend');
			}
			else
			{
				$user_id = modules::run('user/getSessionId');
				$data['userData'] = modules::run('user/getUserData', $user_id);
				$data['title'] = 'Backend - Nueva agenda';
				$data['contenido_principal'] = $this->load->view('nueva-agenda', $data, true);
				$this->load->view('back/template', $data);
			}
		}
		else
		{
			redirect('redirect');
		}
	}

	public function getDairyRequest()
	{
		$query = $this->diary_model->getDairyRequest();
		$query = objectSQL_to_array($query);
		foreach ($query as $key => $value) 
		{
			$query[$key]['isChecked'] = $this->noExistDairyAttachment($query[$key]['id']);
		}
		return $query;
	}


	public function addRequests()
	{
		if(modules::run('user/isAdministrator'))
		{
			$user_id = modules::run('user/getSessionId');
			$data['userData'] = modules::run('user/getUserData', $user_id);
			$data['title'] = 'Backend - Agragar solicitudes';
			$data['requests'] = modules::run('request/getRequestsForDairy');
			$data['dairyRequests'] = $this->getDairyRequest();
			foreach($data['requests'] as $key => $value)
			{
				foreach ($data['dairyRequests'] as $k => $v) 
				{
					if($data['requests'][$key]['id'] == $data['dairyRequests'][$k]['request_id'])
					{
						$data['requests'][$key]['isChecked'] = 1;
					}
				}
			}
			$data['contenido_principal'] = $this->load->view('agregar-solicitudes', $data, true);
			$this->load->view('back/template', $data);
		}
		else
		{
			redirect('backend');
		}
	}

	public function noExistDairyAttachment($request_id)
	{
		return $this->diary_model->noExistDairyAttachment($request_id);
	}

	public function addRequest()
	{
		if(!empty($_POST))
		{
			if(isset($_POST['agregar']) && !empty($_POST['agregar']))
			{
				foreach($_POST['agregar'] as $key => $value)
				{
					$request_id = $_POST['agregar'][$key];
					if($this->noExistDairyAttachment($request_id))
					{
						$this->diary_model->insertRequest($request_id);
					}
				}
			}
			else if(isset($_POST['eliminar']) && !empty($_POST['eliminar']))
			{
				foreach($_POST['eliminar'] as $key => $value)
				{
					$request_id = $_POST['eliminar'][$key];
					if(!$this->noExistDairyAttachment($request_id))
					{
						$this->diary_model->deleteRequest($request_id);
					}
				}
			}
			

		 
		}
			redirect('backend');
	}
}