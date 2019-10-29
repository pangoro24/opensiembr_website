<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class How_to_work extends CI_Controller {

	public function index()
	{
		$data = [
		    'title' => 'Como Funciona',
		    'description' => 'Te mostramos como funciona nuestro dispositivo para sus cultivos',
		    'section' => 'how-to-work'
		];
		$this->load->view('_layouts/front', $data);
	}
}