<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Channel_model extends MY_Model
{
	protected $table = 'zones';

	public function _get()
	{
		$this->db->select('zones.*, users.id as id_user, users.fullname, users.email');
		$this->db->from($this->table);
		$this->db->join('users', 'users.id = zones.user_id', 'left');
		$this->db->order_by('zones.id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function _getBy($id)
	{
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

}

/* End of file .php */
