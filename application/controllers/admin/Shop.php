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

}
