<?php

class TypeRequest_model extends CI_Model
{
	//CONSTRUCTOR DEL MODEL
	function __construct()
	{
		parent::__construct();
	}

	//OBTIENE TODOS LOS TIPOS DE SOLICITUD
	function getAllTypeRequests()
	{
		$query = $this->db->get('type_request');
		return $query->result();
	}

	//VERIFICA QUE NO EXISTA ESE TIPO DE REQUEST
	function noExistTypeRequest($name)
	{
		$query = $this->db->get_where('type_request', array('name'=>$name));
		return $query->num_rows() == 0;
	}

	function createTypeRequest($data)
	{
		$this->db->insert('type_request', $data);
	}

	function getNameByTypeRequestId($type_request_id)
	{
		$query = $this->db->get_where('type_request', array('id'=>$type_request_id));
		return $query->row()->name;
	}
} 

?>