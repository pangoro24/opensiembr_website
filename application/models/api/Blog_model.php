<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model
{

	protected $table = 'blog';

	public function _get()
	{
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result();
	}

}
