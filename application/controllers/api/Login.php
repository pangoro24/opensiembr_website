<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Api_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('api/auth_model');
	}

	public function index()
	{
		$this->rest_api->_apiConfig([
            'methods' => ['POST'],
            'requireAuthorization' => false,
        ]);

		$this->form_validation->set_rules('emailPhone', 'Correo electrónico o teléfono', 'trim|required');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
        	$data = [
				'error'   => true,
				'message' => validation_errors(' ',' '),
            ];
        } else {
        	$this->load->database();
        	$data = $this->auth_model->login();
        }
        json_output($data);
	}

	public function register()
	{
		$this->rest_api->_apiConfig([
            'methods' => ['POST'],
            'requireAuthorization' => false,
        ]);

		$this->form_validation->set_rules('name', 'Nombre completo', 'trim|required');
        $this->form_validation->set_rules('phone', 'Teléfono', 'trim|required|is_unique[users.phone]');
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|min_length[8]');

        if ($this->form_validation->run() == FALSE)
        {
        	$data = [
				'error'   => true,
				'message' => validation_errors(' ',' '),
            ];
        } else {
        	$this->load->database();
        	$data = [
                'error' => false,
				'data' => $this->auth_model->register()
            ];
        }
        json_output($data);
	}

}
