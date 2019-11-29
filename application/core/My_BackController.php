<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_BackController extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		// Load DB
        $this->load->database();
		$this->load->model('api/auth_model');
		// Load Model
        $this->load->model('user_model');

		// Verify User Session
        $this->auth_model->verifyUserSession();
	}

}
