<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model
{

	protected $table = 'blog';

	public function _get()
	{
		$this->db->from($this->table);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function _post()
	{
		$config['upload_path']          = './blog/';
		$config['allowed_types']        = 'gif|jpg|png';
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
				'tag' => json_encode($this->input->post('tag')),
				'user' => $this->session->userdata('id'),
				'images' => $this->upload->data('file_name'),
				'status' => true,
				'lang' => 'es',
			);
			$this->db->insert('blog', $dataDB);

			$dataReturn = [
				'error'   => false,
				'message' => 'El Post se ha guardado correctamente.',
			];
			json_output($dataReturn);
		}
	}

}
