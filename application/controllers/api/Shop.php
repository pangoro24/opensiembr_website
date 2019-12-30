<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends Api_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('api/shop_model');
	}

	public function get()
	{
		$this->rest_api->_apiConfig([
            'methods' => ['GET'],
            'requireAuthorization' => false,
        ]);

		$data = [
			'error'   => false,
			'data' => $this->shop_model->_get(),
		];
		json_output($data);
	}

	public function getBy($id)
	{
		$this->rest_api->_apiConfig([
            'methods' => ['GET'],
            'requireAuthorization' => false,
        ]);

		$data = [
			'error'   => false,
			'data' => $this->shop_model->_getBy($id),
		];
		json_output($data);
	}

	public function post()
	{
		$this->form_validation->set_rules('name', 'Nombre del Producto', 'trim|required');
		$this->form_validation->set_rules('sort_description', 'Descripcion Corta', 'trim|required');
		$this->form_validation->set_rules('description', 'Descripcion', 'trim|required');
		$this->form_validation->set_rules('price', 'Precio', 'trim|required');
		// $this->form_validation->set_rules('images', 'Imagenes', 'trim|required');
		$this->form_validation->set_rules('method_pay', 'Método de Pago', 'trim|required');
		$this->form_validation->set_rules('tax', 'Impuesto', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data = [
				'error'   => true,
				'message' => validation_errors('*','<br>'),
			];
			json_output($data);
		} else {
			$this->shop_model->_post();
		}
	}

	public function put($id)
	{
		$this->form_validation->set_rules('name', 'Nombre del Producto', 'trim|required');
		$this->form_validation->set_rules('sort_description', 'Descripcion Corta', 'trim|required');
		$this->form_validation->set_rules('description', 'Descripcion', 'trim|required');
		$this->form_validation->set_rules('price', 'Precio', 'trim|required');
		$this->form_validation->set_rules('method_pay', 'Método de Pago', 'trim|required');
		$this->form_validation->set_rules('tax', 'Impuesto', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data = [
				'error'   => true,
				'message' => validation_errors(' ',' '),
			];
			json_output($data);
		} else {
			$data = array(
				'name' => $this->input->post('name'),
				'sort_description'  => $this->input->post('sort_description'),
				'description'   => $this->input->post('description'),
				'price'   => $this->input->post('price'),
				'method_pay'   => $this->input->post('method_pay'),
				'tax'   => $this->input->post('tax'),
			);
			$this->shop_model->_put($id, $data);
		}
	}

	// CUSTOM API
	public function put_status($id)
	{
		$this->form_validation->set_rules('status', 'Estado', 'trim|required|in_list[0,1]');

		if ($this->form_validation->run() == FALSE)
		{
			$data = [
				'error'   => true,
				'message' => validation_errors(' ',' '),
			];
			json_output($data);
		} else {
			$data = array(
				'status' => $this->input->post('status')
			);
			$this->shop_model->_put($id, $data);
		}
	}

	public function orders_by_month()
	{
		$this->rest_api->_apiConfig([
            'methods' => ['GET'],
            'requireAuthorization' => false,
        ]);

		$data = [
			'error'   => false,
			'data' => $this->shop_model->order_by_month(),
		];
		json_output($data);
	}

}
