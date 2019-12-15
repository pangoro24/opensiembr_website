<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		// LOAD DB & MODEL BLOG
		$this->load->database();
		$this->load->model('api/blog_model');
		$this->load->helper('text');

		$data = [
		    'title' => 'Open Siembro',
		    'description' => 'Sistema inteligente de bajo costo para control de riego y monitoreo de siembro.',
		    'section' => 'home',
			'blog' => $this->blog_model->_get_limit(3),
		];
		$this->load->view('_layouts/front', $data);
	}
}
