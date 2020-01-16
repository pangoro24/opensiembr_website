<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends Admin_Controller {

	public function new()
	{
		$data = [
			'title' => 'Dashboard',
			'section' => 'new',
			'data'	  => $this->user_model->info(),
		];
		$this->load->view('_layouts/admin', $data);
	}

	public function products()
	{
		$data = [
			'title' => 'Dashboard',
			'section' => 'products',
			'data'	  => $this->user_model->info(),
		];
		$this->load->view('_layouts/admin', $data);
	}

	public function orders()
	{
		$data = [
			'title' => 'Dashboard',
			'section' => 'orders',
			'data'	  => $this->user_model->info(),
		];
		$this->load->view('_layouts/admin', $data);
	}

	public function edit($id)
	{
		$data = [
			'title' => 'Editar Producto',
			'section' => 'edit',
			'data'	  => $this->user_model->info(),
			'blog'    => $this->shop_model->_getBy($id)
		];
		$this->load->view('_layouts/admin', $data);
	}

	public function config()
	{
		$data = [
			'title' => 'Configuración de la Tienda',
			'section' => 'config',
			'data'	  => $this->user_model->info(),
		];
		$this->load->view('_layouts/admin', $data);
	}

	// ORDERS
	public function view_orders($id)
	{
		$data = [
			'title' => 'Ver producto',
			'section' => 'view',
			'data'	  => $this->user_model->info(),
			'order' => $this->shop_model->_getBy_orders($id),
			'product' => $this->shop_model->_getBy($this->shop_model->_getBy_orders($id)->product),
		];
		$this->load->view('_layouts/admin', $data);
	}

}
