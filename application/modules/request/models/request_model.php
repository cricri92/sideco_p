<?php

class Request_model extends CI_Model
{
	//CONSTRUCTOR DEL MODEL
	function __construct()
	{
		parent::__construct();
	}

	//DEVUELVE TODOS LOS ESTATUS
	function getStatus()
	{
		$query = $this->db->get('status');
		return $query->result();
	}

	//VERIFICA QUE UNA CEDULA NO EXISTA
	function existCedula($cedula)
	{
		$query = $this->db->get_where('applicant', array('cedula'=>$cedula));
		return $query->num_rows() != 0;
	}	

	function existNombre($nombre)
	{
		$query = $this->db->get_where('applicant',array('name'=>$nombre));
		return $query->num_rows() != 0;
	}

	//CREA UNA NUEVA SOLICITUD
	function createRequest($data)
	{
		$this->db->insert('request', $data);
	}

	//OBTENGO TODAS LAS REQUEST CON ESTATUS RECIBIDAS
	function getAllReceivedRequest()
	{
		$this->db->order_by("date", "desc"); 
		$this->db->where('status_id', 5);
		$query = $this->db->get('request');
		return $query->result();
	}

	//OBTENGO EL NOMBRE DE UN STATUS POR SU ID
	function getStatusNameById($status_id)
	{
		$query = $this->db->get_where('status',array('id'=>$status_id));
		return $query->row()->name;
	}

	//OBTIENE TODOS LAS SOLICITUDES QUE NO ESTAN RECIBIDAS
	function getAllNoReceivedRequest()
	{
		$this->db->order_by("date", "desc"); 
		$this->db->where('status_id !=', 5);
		$query = $this->db->get('request');
		return $query->result();
	}

	function getRequest($request_id)
	{
		$query = $this->db->get_where('request',array('id'=>$request_id));
		return $query->row();
	}

	function updateRequest($request_id, $data)
	{
		$this->db->where('id',$request_id);
		$this->db->update('request', $data);
	}

	//OBTENGO LAS SOLICITUDES POR STATUS_ID
	function getRequestByStatusId($status_id)
	{
		$this->db->order_by("date", "desc"); 
		$this->db->where('status_id', $status_id);
		$query = $this->db->get('request');
		return $query->result();
	}

	function newAttachment($data)
	{
		$this->db->insert('request_attachment', $data);
	}

	function getRequestIdByData($data)
	{
		$query = $this->db->get_where('request', $data);
		return $query->row();
	}

	//OBTIENE TODOS LAS SOLICITUDES QUE NO ESTAN RECIBIDAS
	function getRequestsForDairy()
	{
		$this->db->order_by("date", "desc"); 
		$this->db->where('status_id', 6);
		$query = $this->db->get('request');
		return $query->result();
	}

	function noExistDairyAttachment($request_id)
	{
		$query = $this->db->get_where('diary_attachment', array('request_id'=>$request_id));
		return $query->num_rows() == 0;
	}
	function getLastTenRequests()
	{
		$this->db->order_by("date", "desc");
		$this->db->where('status_id', 5);
		$query = $this->db->get('request',10);
		return $query->result();
	}
	
	function getAllRequests()
	{
		$this->db->order_by("date", "desc"); 
		$query = $this->db->get('request');
		return $query->result();
	}

	
}  

?>