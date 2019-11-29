<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'section' => 'dashboard',
			'data'	  => $this->user_model->info(),
		];
		$this->load->view('_layouts/admin', $data);
	}

}
