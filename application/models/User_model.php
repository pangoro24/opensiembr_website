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

	// CUSTOM MODEL
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

	public function by_month($date = null)
	{
		$year = date('Y');

		$this->db->from($this->tableUser);
		$this->db->where('created_at >=', ''.$year.'-'.$date.'-01 00:00:00');
		$this->db->where('created_at <=', ''.$year.'-'.$date.'-30 23:59:59');
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function user_by_month()
	{
		$data['enero'] = $this->by_month('01');
		$data['febrero'] = $this->by_month('02');
		$data['marzo'] = $this->by_month('03');
		$data['abril'] = $this->by_month('04');
		$data['mayo'] = $this->by_month('05');
		$data['junio'] = $this->by_month('06');
		$data['julio'] = $this->by_month('07');
		$data['agosto'] = $this->by_month('08');
		$data['septiembre'] = $this->by_month('09');
		$data['octubre'] = $this->by_month('10');
		$data['noviembre'] = $this->by_month('11');
		$data['diciembre'] = $this->by_month('12');

		return $data;
	}
}
