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

	public function _getBy($id)
	{
		$this->db->from($this->table_products);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function _post()
	{
		$config['upload_path']          = './assets/shop/';
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
				'name' => $this->input->post('name'),
				'sort_description' 	=> $this->input->post('sort_description'),
				'description' 	=> $this->input->post('description'),
				'price' 	=> $this->input->post('price'),
				'images' => $this->upload->data('file_name'),
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

	public function _put($id, $data)
	{
		$config['upload_path']          = './assets/shop/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = 2048;
		$config['encrypt_name']         = true;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			$this->db->where('id', $id);
			$this->db->update($this->table_products, $data);

			$dataReturn = [
				'error'   => false,
				'message' => 'El Post se ha editado correctamente.',
			];
			json_output($dataReturn);

		} else {
			$data = array('upload_data' => $this->upload->data());

			$dataDB = array(
				'name' => $this->input->post('name'),
				'sort_description'  => $this->input->post('sort_description'),
				'description'   => $this->input->post('description'),
				'price'   => $this->input->post('price'),
				'method_pay'   => $this->input->post('method_pay'),
				'tax'   => $this->input->post('tax'),
				'images' => $this->upload->data('file_name'),
			);
			$this->db->where('id', $id);
			$this->db->update($this->table_products, $dataDB);

			$dataReturn = [
				'error'   => false,
				'message' => 'El Post se ha editado correctamente.',
			];
			json_output($dataReturn);
		}
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
