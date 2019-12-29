<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// LOAD DB & MODEL BLOG
		$this->load->database();
		$this->load->model('api/shop_model');
	}

	public function index()
	{
		$data = [
			'title' => 'Tienda ',
			'description' => 'Separa tu equipo para que la producción agricola rinda lo mejor.',
			'section' => 'shop',
			'products' => $this->shop_model->_get()
		];
		$this->load->view('_layouts/front', $data);
	}

}
