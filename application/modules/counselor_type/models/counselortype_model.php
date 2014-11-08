<?php 
	class Counselortype_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}

		function noExistCounselorType($name)
		{
			$query = $this->db->get_where('counselor_type',array('name'=>$name));
			return $query->num_rows()==0;
		}

		function insertCounselorType($data)
		{
			$this->db->insert('counselor_type',$data);
		}

		//OBTENGO TODOS LOS TIPOS DE CONSEJEROS
		function getAllCounselorType()
		{
			$query = $this->db->get('counselor_type');
			return $query->result();
		}

		function getCounselorTypeNameById()
		{
			$query = $this->db->get_where('counselor_type',array('id'=>$id));
			return $query->result();
		}

	}
 ?>