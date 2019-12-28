<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// LOAD DB & MODEL BLOG
		$this->load->database();
		$this->load->model('api/blog_model');
	}

	public function index()
	{
		$tags = explode(',', $this->blog_model->_get_tag());

		$data = [
		    'title' => 'Blog',
		    'description' => 'Un pequeño informativo, de las mejores notas de cultivo y mas.',
		    'section' => 'blog',
			'all_blog' => $this->blog_model->_get_limit(5),
			'all_tag' => $tags,
		];
		$this->load->view('_layouts/front', $data);
	}

	public function view($id)
	{
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
