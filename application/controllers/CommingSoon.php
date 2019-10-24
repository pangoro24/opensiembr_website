<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommingSoon extends CI_Controller {

	public function index()
	{
		$data = [
		    'title' => 'Open Siembro',
		    'description' => 'Sistema inteligente de bajo costo para control de riego y monitoreo de siembro.'
		];
		$this->load->view('comming-soon', $data);
	}
}