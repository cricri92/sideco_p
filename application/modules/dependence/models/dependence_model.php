<?php

class Dependence_model extends CI_Model
{
	//CONSTRUCTOR DEL MODEL
	function __construct()
	{
		parent::__construct();
	}

	//INSERTAR UNA NUEVA DEPENDENCIA
	function insertDependence($data)
	{
		$this->db->insert('dependence', $data);
	}

	//ACTUALIZA UNA DEPENDENCIA
	function updateDependence($dependence_id, $data)
	{
		$this->db->where('id', $dependence_id);
		$this->db->update('dependence', $data);
	}

	//ELIMINA UNA DEPENDENCIA
	function deleteDependence($dependence_id)
	{
		$this->db->delete('dependence', array('id' => $dependence_id)); 
	}

	//OBTENGO EL NOMBRE DE UNA DEPENDENCIA POR SU ID
	function getDependenceNameById($dependence_id)
	{
		$query = $this->db->get_where('dependence', array('id'=>$dependence_id));
		return $query->row()->name;
	}

	//OBTENGO UNA DEPENDENCE POR SU ID
	function getDependenceById($dependence_id)
	{
		$query = $this->db->get_where('dependence', array('id'=>$dependence_id));
		return $query->row();
	}

	//VERIFICA POR NOMBRE QUE UNA DEPENDENCIA NO EXISTA
	function noExistDependence($dependence_name)
	{
		$query = $this->db->get_where('dependence', array('name'=>$dependence_name));
		return $query->num_rows() == 0;
	}

	//DEVUELVE TODAS LAS DEPENDENCIAS
	function getAllDependences()
	{
		$query = $this->db->get('dependence');
		return $query->result();
	}

	function existDependenceBySlug($slug)
	{
		$query = $this->db->get_where('dependence', array('slug'=>$slug));
		return $query->num_rows() != 0;
	}

	//DADO UN URL OBTENGO LA DEPENDENCIA
	function getDependenceBySlug($slug)
	{
		$query = $this->db->get_where('dependence', array('slug'=>$slug));
		return $query->row();
	}

	//VERIFICA QUE NO ESTE DUPLICADO UNA DEPENDENCIA
	function isNotDuplicateDependence($dependence_id, $name)
	{
		$query = $this->db->get_where('dependence', array('id !='=>$dependence_id, 'name =' => $name));
		return $query->num_rows() == 0;
	}

	function deleteDependenceBySlug($slug)
	{
		$this->db->delete('dependence', array('slug' => $slug)); 
	}
}
?>