<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends Admin_Controller {

	public function new()
	{
		$data = [
			'title' => 'Blog',
			'section' => 'new',
			'data'	  => $this->user_model->info(),
		];
		$this->load->view('_layouts/admin', $data);
	}

	public function all()
	{
		$data = [
			'title' => 'Blog',
			'section' => 'all',
			'data'	  => $this->user_model->info(),
		];
		$this->load->view('_layouts/admin', $data);
	}

	public function edit($id)
	{
		$data = [
			'title' => 'Blog',
			'section' => 'edit',
			'data'	  => $this->user_model->info(),
			'blog'    => $this->blog_model->_getBy($id)
		];
		$this->load->view('_layouts/admin', $data);
	}

}
