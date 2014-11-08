<?php

class User_model extends CI_Model
{
	//CONSTRUCTOR DEL MODEL
	function __construct()
	{
		parent::__construct();
	}

	//ESTA FUNCION VERIFICA QUE UN USUARIO EXISTA
	function existUsername($username)
	{
		$query = $this->db->get_where('userback', array('username'=>$username));
		return $query->num_rows() != 0;
	}

	//VERIFICA QUE LA RELACION USUARIO CONTRASEÑA EXISTA
	function verifySession($data)
	{
		$query = $this->db->get_where('userback', $data);
		return $query->num_rows() != 0;
	}

	//OBTENGO LOS DATOS DE UN USUARIO POR SU USERNAME
	function getUserDataByUsername($username)
	{
		$query = $this->db->get_where('userback', array('username'=> $username));
		return $query->row();
	}

	//DADO UN ID SE SESION OBTENGO LA DATA DE UN USUARIO
	function getUserData($user_id)
	{
		$query = $this->db->get_where('userback', array('id'=>$user_id));
		return $query->row();
	}

	//DEVUELVE EL NOMBRE DE UN PRIVILEGIO POR ID
	function getPrivilegeNameById($privilege_id)
	{
		$query = $this->db->get_where('privilege', array('id' => $privilege_id));
		return $query->row()->name;
	}

	//DEVUELVE LA DATA DE UN USUARIO POR ID
	function getUserDataById($user_id)
	{
		$query = $this->db->get_where('userback', array('id' => $user_id));
		return $query->row();
	}

	//DEVUELVE TODOS LOS PRIVILEGIOS
	function getAllPrivileges()
	{
		$query = $this->db->get('privilege');
		return $query->result();
	}

	//VERIFICA QUE UN NOMBRE NO EXISTA
	function noExistName($name)
	{
		$query = $this->db->get_where('userback', array('name'=>$name));
		return $query->num_rows() == 0;
	}

	//INSERTA UN USUARIO
	function insertUser($data)
	{
		$this->db->insert('userback', $data);
	}

	//DEVUELVE TODOS LOS USUARIOS
	function getAllUsers()
	{
		$query = $this->db->get('userback');
		return $query->result();
	}

	//DEVUELVE TODOS LOS USUARIOS
	function getAllUsersExceptMe($user_id)
	{
		$this->db->where('id !=', $user_id);
		$this->db->where('id !=', 1);
		$query = $this->db->get('userback');
		return $query->result();
	}

	//VERIFICA QUE EXISTA UN USUARIO POR SU SLUG
	function existSlug($slug)	
	{
		$query = $this->db->get_where('userback', array('slug'=>$slug));
		return $query->num_rows() != 0;
	}

	//OBTENGO LOS DATOS DE UN USUARIO POR UN SLUG
	function getUserDataBySlug($slug)
	{
		$query = $this->db->get_where('userback', array('slug'=>$slug));
		return $query->row();
	}

	function isDuplicateName($user_id, $name)
	{
		$this->db->where('name', $name);
		$this->db->where('id !=', $user_id);
		$query = $this->db->get('userback');
		return $query->num_rows() == 0;
	}

	function isDuplicateUsername($user_id, $username)
	{
		$this->db->where('username', $username);
		$this->db->where('id !=', $user_id);
		$query = $this->db->get('userback');
		return $query->num_rows() == 0;
	}

	function isDuplicateCedula($user_id, $cedula)
	{
		$this->db->where('cedula', $cedula);
		$this->db->where('id !=', $user_id);
		$query = $this->db->get('userback');
		return $query->num_rows() == 0;
	}

	function isDuplicateEmail($user_id, $email)
	{
		$this->db->where('email', $email);
		$this->db->where('id !=', $user_id);
		$query = $this->db->get('userback');
		return $query->num_rows() == 0;
	}

	//ACTUALIZA UN USUARIO
	function updateUser($user_id, $data)
	{
		$this->db->where('id',$user_id);
		$this->db->update('userback', $data);
	}	

	//VERIFICA QUE EL USUARIO EN SESION SEA EL MISMO QUE EL DE LA SLUG
	function itsMe($user_id, $slug)
	{
		$query = $this->db->get_where('userback', array('id'=>$user_id, 'slug'=> $slug));
		return $query->num_rows() != 0;
	}

	//ELIMINA UN USUARIO POR SU SLUG
	function deleteUserBySlug($slug)
	{
		$this->db->delete('userback', array('slug'=>$slug));
	}

	//VERIFICA QUE UNA CEDULA NO EXISTA
	function noExistCedula($cedula)
	{
		$query = $this->db->get_where('userback', array('cedula'=>$cedula));
		return $query->num_rows() == 0;
	}

	//VERIFICA QUE NO EXISTA UN EMAIL
	function noExistEmail($email)
	{
		$query = $this->db->get_where('userback', array('email'=>$email));
		return $query->num_rows() == 0;
	}

	function getUserIdByCedula($cedula)
	{
		$data = array(
			'cedula'=>$cedula
		);
		$query = $this->db->get_where('applicant', $data);
		return $query->row()->id;
	}

	function getCedulaByUserId($user_id)
	{
		$query = $this->db->get_where('userback', array('id'=>$user_id));
		return $query->row()->cedula;
	}

	function getAllTypeApplicant()
	{
		$query = $this->db->get('type_applicant');
		return $query->result();
	}
	
}  

?>