<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('text');
		$this->load->model('api/blog_model');
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'section' => 'dashboard',
			'data'	  => $this->user_model->info(),
			'all_blogs' => $this->blog_model->_get_limit(4),
		];
		$this->load->view('_layouts/admin', $data);
	}

}
