<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function index()
	{
		$data = [
		    'title' => 'Blog',
		    'description' => 'Un pequeño informativo, de las mejores notas de cultivo y mas.',
		    'section' => 'blog'
		];
		$this->load->view('_layouts/front', $data);
	}

	public function view($id)
	{
		// LOAD DB & MODEL BLOG
		$this->load->database();
		$this->load->model('api/blog_model');

		$data = [
			'title' => 'Blog',
			'description' => 'Un pequeño informativo, de las mejores notas de cultivo y mas.',
			'section' => 'blog-view',
			'blog' => $this->blog_model->_getBy($id),
			'last_blog' => $this->blog_model->_get_limit(5),
		];
		$this->load->view('_layouts/front', $data);
	}
}
