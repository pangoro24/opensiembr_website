<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Controller extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('Rest_Api');
	}
}
