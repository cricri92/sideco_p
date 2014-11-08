<?php

class Counselor_model extends CI_Model
{
	//CONSTRUCTOR DEL MODEL
	function __construct()
	{
		parent::__construct();
	}

	function noExistName($name)
	{
		$query = $this->db->get_where('counselor',array('name'=>$name));
		return $query->num_rows() == 0;
	}

	function insertCounselor($data)
	{
		$this->db->insert('counselor',$data);
	}

	function getAllCounselors()
	{
		$query = $this->db->get('counselor');
		return $query->result();
	}

}

?>