<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
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
