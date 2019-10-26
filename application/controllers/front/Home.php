<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data = [
		    'title' => 'Open Siembro',
		    'description' => 'Sistema inteligente de bajo costo para control de riego y monitoreo de siembro.',
		    'section' => 'home'
		];
		$this->load->view('_layouts/front', $data);
	}
}