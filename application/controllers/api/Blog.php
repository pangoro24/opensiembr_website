<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends Api_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('api/blog_model');
	}

	public function get()
	{
		$this->rest_api->_apiConfig([
            'methods' => ['GET'],
            'requireAuthorization' => false,
        ]);

		$data = [
			'error'   => false,
			'data' => $this->blog_model->_get(),
		];
		json_output($data);
	}

}
