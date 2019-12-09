<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends Api_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('api/blog_model');
	}

	public function post()
	{
		$this->form_validation->set_rules('title', 'Titulo', 'trim|required');
		$this->form_validation->set_rules('body', 'Cuerpo del Blog', 'trim|required');
		$this->form_validation->set_rules('tag', 'Tags', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data = [
				'error'   => true,
				'message' => validation_errors(' ',' '),
			];
			json_output($data);
		} else {
			$this->blog_model->_post();
		}


	}

	public function upload_file()
	{
		$this->rest_api->_apiConfig([
			'methods' => ['POST'],
			'requireAuthorization' => false,
		]);
	}

	public function upload_images_editor()
	{
		$config['upload_path']          = './blog/editor';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 2048;
		$config['encrypt_name']         = true;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());

			return $error;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			return 'La imagen se ha subido correctamente.';
		}
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
