<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_model extends MY_Model
{

	protected $db_web;
	public $_table_name;
    public $_order_by;
    public $_primary_key;

	protected $table_products = 'products';
	protected $table_taxes = 'tax';
	protected $table_shipping = 'shippings';
	protected $table_orders = 'orders';

	public function __construct()
    {
    	parent::__construct();
        $this->db_web = $this->load->database('website', TRUE);
    }

	// PRODUCTS
	public function _get()
	{
		$this->db_web->from($this->table_products);
		$this->db_web->order_by('id', 'desc');
		$query = $this->db_web->get();
		return $query->result();
	}

	public function _getBy($id)
	{
		$this->db_web->from($this->table_products);
		$this->db_web->where('id', $id);
		$query = $this->db_web->get();
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
			$this->db_web->insert($this->table_products, $dataDB);

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
			$this->db_web->where('id', $id);
			$this->db_web->update($this->table_products, $data);

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
			$this->db_web->where('id', $id);
			$this->db_web->update($this->table_products, $dataDB);

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

		$this->db_web->from($this->table_orders);
		$this->db_web->where('created_at >=', ''.$year.'-'.$date.'-01 00:00:00');
		$this->db_web->where('created_at <=', ''.$year.'-'.$date.'-28 23:59:59');
		$query = $this->db_web->get();

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

	// TAXES
	public function _get_taxes()
	{
		$this->db_web->from($this->table_taxes);
		$this->db_web->where('status', TRUE);
		$this->db_web->order_by('id', 'desc');
		$query = $this->db_web->get();
		return $query->result();
	}

	public function _post_tax()
	{
		$count = $this->count_rows($this->table_taxes, 'status = 1');

		if ($count > 0) {
			$dataReturn = [
				'error'   => true,
				'message' => 'Solo se puede agregar 1 impuesto.',
			];
			json_output($dataReturn);
		} else {
			$dataDB = array(
				'name' => $this->input->post('name'),
				'value'  => $this->input->post('qty'),
				'status' => true,
			);
			$this->db_web->insert($this->table_taxes, $dataDB);

			// RETURN
			$dataReturn = [
				'error'   => false,
				'message' => 'Se ha agregado el impuesto correctamente.',
			];
			json_output($dataReturn);
		}
	}

	public function _put_status_tax($id)
	{
		$dataDB = array(
			'status' => 0,
		);
		$this->db_web->where('id', $id);
		$this->db_web->update($this->table_taxes, $dataDB);
	}

	// SHIPPING METHOD
	public function _get_method_shipping()
	{
		$this->db_web->from($this->table_shipping);
		$this->db_web->where('status', TRUE);
		$this->db_web->order_by('id', 'desc');
		$query = $this->db_web->get();
		return $query->result();
	}

	public function _post_method_shipping()
	{
		$dataDB = array(
			'name' => $this->input->post('name'),
			'price'  => $this->input->post('price'),
			'status' => true,
		);
		$this->db_web->insert($this->table_shipping, $dataDB);
	}

	public function _put_status_shipping($id)
	{
		$dataDB = array(
			'status' => 0,
		);
		$this->db_web->where('id', $id);
		$this->db_web->update($this->table_shipping, $dataDB);
	}

	// ORDERS
	public function _post_orders()
	{
		$dataDB = array(
			'name' => $this->input->post('name'),
			'address' 	=> $this->input->post('address'),
			'phone' 	=> $this->input->post('phone'),
			'email' 	=> $this->input->post('email'),
			'shipping' 	=> $this->input->post('shipping'),
			'qty' => $this->input->post('qty'),
			'product' => $this->input->post('product'),
			'total' 	=> $this->input->post('total'),
		);
		$this->_table_name = $this->table_orders;
		$this->_primary_key = 'id';
		$id = $this->save($dataDB);

		$dataReturn = [
			'error'   => false,
			'message' => 'Su orden se ha guardado correctamente.',
			'order' => $id
		];
		json_output($dataReturn);
	}

	public function _get_orders()
	{
		$this->db_web->select('orders.id as id_order, orders.name as client_name, orders.email, orders.phone, orders.product, products.*');
		$this->db_web->from($this->table_orders);
		$this->db_web->join($this->table_products, 'products.id = orders.product', 'left');
		$this->db_web->order_by('orders.id', 'desc');
		$query = $this->db_web->get();
		return $query->result();
	}

	public function _getBy_orders($id)
	{
		$this->db_web->from($this->table_orders);
		$this->db_web->where('id', $id);
		$query = $this->db_web->get();
		return $query->row();
	}

	public function _put_order($id, $data)
	{
		$this->db_web->where('id', $id);
		$this->db_web->update($this->table_orders, $data);
	}

}

/* End of file .php */
