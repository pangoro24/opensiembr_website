<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model
{
	protected $table = 'blogs';

	public function _get()
	{
		$this->db->from($this->table);
		$this->db->order_by('id', 'desc');
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

	public function _post()
	{
		$config['upload_path']          = './assets/blog/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = 2048;
		$config['encrypt_name']         = true;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());
			$data = [
				'error'   => true,
				'message' => 'Se requiere una imagen.',
			];
			json_output($data);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$dataDB = array(
				'title' => $this->input->post('title'),
				'body' => $this->input->post('body'),
				'tag' => $this->input->post('tag'),
				'user' => $this->session->userdata('id'),
				'images' => $this->upload->data('file_name'),
				'status' => true,
				'lang' => 'es',
			);
			$this->db->insert($this->table, $dataDB);

			$dataReturn = [
				'error'   => false,
				'message' => 'El Post se ha guardado correctamente.',
			];
			json_output($dataReturn);
		}
	}

	public function _put($id, $data)
	{
		$config['upload_path']          = './assets/blog/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = 2048;
		$config['encrypt_name']         = true;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);

			$dataReturn = [
				'error'   => false,
				'message' => 'El Post se ha editado correctamente.',
			];
			json_output($dataReturn);

		} else {
			$data = array('upload_data' => $this->upload->data());

			$dataDB = array(
				'title' => $this->input->post('title'),
				'body'  => $this->input->post('body'),
				'tag'   => $this->input->post('tag'),
				'images' => $this->upload->data('file_name'),
			);
			$this->db->where('id', $id);
			$this->db->update($this->table, $dataDB);

			$dataReturn = [
				'error'   => false,
				'message' => 'El Post se ha editado correctamente.',
			];
			json_output($dataReturn);
		}
	}

	// CUSTOM MODEL
	public function _get_limit($limit)
	{
		$this->db->from($this->table);
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result();
	}

}
