<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

	public function all()
	{
		$data = [
			'title' => 'Dashboard',
			'section' => 'all',
			'data'	  => $this->user_model->info(),
		];
		$this->load->view('_layouts/admin', $data);
	}

}
