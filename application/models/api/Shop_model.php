<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_model extends CI_Model
{

	protected $table_products = 'products';
	protected $table_taxes = 'tax';

	public function _get()
	{
		$this->db->from($this->table_products);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function _post()
	{
		$dataDB = array(
			'name' => $this->input->post('name'),
			'sort_description' 	=> $this->input->post('sort_description'),
			'description' 	=> $this->input->post('description'),
			'price' 	=> $this->input->post('price'),
			'images' => $this->input->post('images'),
			'method_pay' => $this->input->post('method_pay'),
			'tax' 	=> $this->input->post('tax'),
		);
		$this->db->insert($this->table_products, $dataDB);

		$dataReturn = [
			'error'   => false,
			'message' => 'El producto se ha guardado correctamente.',
		];
		json_output($dataReturn);
	}

}

/* End of file .php */
