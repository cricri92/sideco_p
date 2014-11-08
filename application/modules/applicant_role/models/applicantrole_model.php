<?php

class Applicantrole_model extends CI_Model
{
	//CONSTRUCTOR DEL MODEL
	function __construct()
	{
		parent::__construct();
	}

	//INSERTAR UNA NUEVA DEPENDENCIA
	function insertApplicantRole($data)
	{
		$this->db->insert('type_applicant', $data);
	}

	//VERIFICA POR NOMBRE QUE UNA DEPENDENCIA NO EXISTA
	function noExistApplicantRole($applicant_role)
	{
		$query = $this->db->get_where('type_applicant', array('name'=>$applicant_role));
		return $query->num_rows() == 0;
	}

	//DEVUELVE TODAS LAS DEPENDENCIAS
	function getAllApplicantRoles()
	{
		$query = $this->db->get('type_applicant');
		return $query->result();
	}

	function getApplicantRoleById($id)
	{
		$query = $this->db->get_where('type_applicant',array('id'=>$id));
		return $query->row();
	}

	function getNameByApplicantId($id)
	{
		$query = $this->db->get_where('type_applicant',array('id'=>$id));
		return $query->row();
	}
}