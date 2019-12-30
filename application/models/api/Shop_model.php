<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_model extends CI_Model
{

	protected $table_products = 'products';
	protected $table_taxes = 'tax';
	protected $table_orders = 'orders';

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

	// CUSTOM MODEL
	public function by_month($date = null)
	{
		$year = date('Y');

		$this->db->from($this->table_orders);
		$this->db->where('created_at >=', ''.$year.'-'.$date.'-01 00:00:00');
		$this->db->where('created_at <=', ''.$year.'-'.$date.'-30 23:59:59');
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function order_by_month()
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

/* End of file .php */
