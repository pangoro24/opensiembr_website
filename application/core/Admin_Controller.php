<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends My_BackController {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->auth_model->verifyRol(1);
	}

}
