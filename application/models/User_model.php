<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

	public function _put($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data);

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
		$this->db->from('users');
		$this->db->where('email', $this->session->userdata('email_user'));
		$info = $this->db->get();
		$data['info'] = $info->row();

		# User Status
		$this->db->select('*');
		$this->db->from('roles');
		$this->db->where('id', $this->session->userdata('rol'));
		$status = $this->db->get();
		$data['rol'] = $status->row();

		return $data;
	}

}
