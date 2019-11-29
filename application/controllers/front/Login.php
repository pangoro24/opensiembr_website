<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$data = [
		    'title' => 'Iniciar Sesión | Open Siembro',
		    'description' => 'Sistema inteligente de bajo costo para control de riego y monitoreo de siembro.'
		];
		$this->load->view('front/login', $data);
	}

	public function register()
	{
		$data = [
		    'title' => 'Registro de usuario | Open Siembro',
		    'description' => 'Sistema inteligente de bajo costo para control de riego y monitoreo de siembro.'
		];
		$this->load->view('front/register', $data);
	}

	public function logout()
	{
		// Destroy session
		$this->session->sess_destroy();
		// Redirect to login
		redirect('/login','refresh');
	}
}
