<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Channel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('api/channel_model');
	}

	public function index()
	{
		$data = [
		    'title' => 'Proyectos',
		    'description' => 'Todos los proyectos publicados con nuestros dispositivos.',
		    'section' => 'channel',
			'zones' => $this->channel_model->_get()
		];
		$this->load->view('_layouts/front', $data);
	}

	public function view($id)
	{
		$data = [
		    'title' => 'Proyectos',
		    'description' => 'Todos los proyectos publicados con nuestros dispositivos.',
		    'section' => 'channel-view',
			'zone' => $this->channel_model->_getBy($id)
		];
		$this->load->view('_layouts/front', $data);
	}

}
