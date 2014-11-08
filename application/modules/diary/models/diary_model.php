<?php

class Diary_model extends CI_Model
{
	//CONSTRUCTOR DEL MODEL
	function __construct()
	{
		parent::__construct();
	}

	function noExistDiaryNumber($num_acta)
	{
		$query = $this->db->get_where('diary',array('num_acta'=>$num_acta));
		return $query->num_rows() == 0;
	}

	function insertDairy($data)
	{
		$this->db->insert('diary', $data);	
	}

	function noExistDairyAttachment($request_id)
	{
		$query = $this->db->get_where('diary_attachment', array('request_id'=>$request_id));
		return $query->num_rows() == 0;
	}

	function insertRequest($request_id)
	{
		$this->db->insert('diary_attachment', array('request_id'=>$request_id));
	}
	
	function getDairyRequest()
	{
		$query = $this->db->get('diary_attachment');
		return $query->result();
	}

	function getRequestsForDairy()
	{
		$this->db->order_by("date", "desc"); 
		$this->db->where('status_id', 6);
		$query = $this->db->get('request');
		return $query->result();
	}

	function deleteRequest($request_id)
	{
		$this->db->delete('diary_attachment', array('request_id'=>$request_id));
	}
	
}  

?>