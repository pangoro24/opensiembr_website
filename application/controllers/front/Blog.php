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
}