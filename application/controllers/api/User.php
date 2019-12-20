<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Api_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('user_model');
	}

	public function get()
	{
		$this->rest_api->_apiConfig([
            'methods' => ['GET'],
            'requireAuthorization' => false,
        ]);

		$data = [
			'error'   => false,
			'data' => $this->user_model->_get(),
		];
		json_output($data);
	}

	// CUSTOM API
	public function put_info($id)
	{
		$this->form_validation->set_rules('fullname', 'Nombre Completo', 'trim|required');
		$this->form_validation->set_rules('email', 'Correo Electronico', 'trim|required|valid_email');
		$this->form_validation->set_rules('birth', 'Fecha de Nacimiento', 'trim|required');
		$this->form_validation->set_rules('phone', 'Teléfono', 'trim|required');
		$this->form_validation->set_rules('address', 'Dirección', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data = [
				'error'   => true,
				'message' => validation_errors(' ',' '),
			];
			json_output($data);
		} else {
			$data = array(
				'fullname' => $this->input->post('fullname'),
				'email'    => $this->input->post('email'),
				'birth_date'   => $this->input->post('birth'),
				'phone'    => $this->input->post('phone'),
				'address'  => $this->input->post('address'),
			);
			$this->user_model->_put($id, $data);
		}
	}

	public function put_pw($id)
	{
		$this->form_validation->set_rules('password', 'Nueva contraseña', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('repeatPassword', 'Contraseña repetida', 'trim|required|matches[password]|min_length[8]');

		if ($this->form_validation->run() == FALSE)
		{
			$data = [
				'error'   => true,
				'message' => validation_errors(' ',' '),
			];
			json_output($data);
		} else {
			$data = array(
				'password' => pwEncrypt($this->input->post('repeatPassword')),
			);
			$this->user_model->_put($id, $data);
		}
	}

}
