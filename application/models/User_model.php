<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	private $tableUser = 'users';
	private $tableRoles = 'roles';

	public function _get()
	{
		$this->db->from($this->tableUser);
		$query = $this->db->get();
		return $query->result();
	}

	public function _getBy($id)
	{
		$this->db->from($this->tableUser);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function _put($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tableUser, $data);

		$dataReturn = [
			'error'   => false,
			'message' => 'El usuario se ha actualizado correctamente.',
		];
		json_output($dataReturn);
	}

	public function info()
	{
		# User Info
		$this->db->select('*');
		$this->db->from($this->tableUser);
		$this->db->where('email', $this->session->userdata('email_user'));
		$info = $this->db->get();
		$data['info'] = $info->row();

		# User Status
		$this->db->select('*');
		$this->db->from($this->tableRoles);
		$this->db->where('id', $this->session->userdata('rol'));
		$status = $this->db->get();
		$data['rol'] = $status->row();

		return $data;
	}

}
