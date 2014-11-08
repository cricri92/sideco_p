<?php

class Applicant_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function getApplicantType()
	{
		$query = $this->db->get('type_applicant');
		return $query->result();
	}

	function noExistName($name)
	{
		$query = $this->db->get_where('applicant',array('name'=>$name));
		return $query->num_rows() == 0;
	}

	function noExistCedula($cedula)
	{
		$query = $this->db->get_where('applicant',array('cedula'=>$cedula));
		return $query->num_rows() == 0;
	}

	function noExistEmail($email)
	{
		$query = $this->db->get_where('applicant',array('email'=>$email));
		return $query->num_rows() == 0;
	}

	function insertApplicant($data)
	{
		$this->db->insert('applicant',$data);
	}

	//VERIFICA SI EXISTE UN SOLICITANTE
	function existApplicant($slug)
	{
		$query = $this->db->get_where('applicant', array('slug'=>$slug));
		return $query->num_rows() !=0;
	}

	//DADO UN SLUG OBTENGO UN SOLICITANTE
	function getApplicantBySlug($slug)
	{
		$query = $this->db->get_where('applicant', array('slug'=>$slug));
		return $query->row();
	}

	//VERIFICA QUE NO EXISTA UNA CEDULA
	function isNotDupplicateCedula($applicant_id, $cedula)
	{
		$query = $this->db->get_where('applicant', array('cedula'=>$cedula, 'id !='=> $applicant_id));
		return $query->num_rows() == 0;
	}

	//VERIFICA QUE NO ESTE DUPLICADO UN EMAIL
	function isNotDupplicateEmail($applicant_id, $email)
	{
		$query = $this->db->get_where('applicant', array('email'=>$email, 'id !='=> $applicant_id));
		return $query->num_rows() == 0;
	}

	function getAllApplicants()
	{
		$query = $this->db->get('applicant');
		return $query->result();
	}

	function getCedulaApplicantById($applicant_id)
	{
		$query = $this->db->get_where('applicant', array('id'=>$applicant_id));
		return $query->row()->cedula;
	}

	function getNombreApplicantById($applicant_id)
	{
		$query = $this->db->get_where('applicant', array('id'=>$applicant_id));
		return $query->row()->name;
	}

	//DADO UN SOLICITANTE_ID OBTENGO SUS DATOS
	function getApplicantbyId($applicant_id)
	{
		$query = $this->db->get_where('applicant', array('id'=>$applicant_id));
		return $query->row();
	}

	//ACTUALIZAR UN SOLICITANTE
	function updateApplicant($applicant_id, $data)
	{
		$this->db->where('id', $applicant_id);
		$this->db->update('applicant', $data);
	}

	//ELIMINA UN SOLICITANTE POR SU SLUG
	function deleteApplicantBySlug($slug)
	{
		$this->db->delete('applicant', array('slug'=>$slug));
	}

	function getApplicantIdByCedula($cedula)
	{
		$query = $this->db->get_where('applicant',array('cedula'=>$cedula));
		return $query->row();
	}

	function getNameByApplicantId($id)
	{
		$query = $this->db->get_where('applicant',array('id'=>$id));
		return $query->row();
	}

}  

?>