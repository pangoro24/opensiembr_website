<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends My_BackController {

	public function edit()
	{
		$data = [
			'title' => 'Dashboard',
			'section' => 'edit',
			'data'	  => $this->user_model->info(),
		];
		$this->load->view('_layouts/admin', $data);
	}

}
