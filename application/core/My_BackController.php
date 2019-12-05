<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_BackController extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		// Load DB
        $this->load->database();

        // Load Library
        $this->load->library('menu');

		// Load Model
		$this->load->model('api/auth_model');
        $this->load->model('user_model');
		$this->load->model('global_model');

        #Dinamic menu logic
        $uri1 = $this->uri->segment(1);
        $uri2 = $this->uri->segment(2);
        $uri3 = $this->uri->segment(3);
        if ($uri3) {
            $uri3 = '/' . $uri3;
        }
        $uriSegment = $uri1 . '/' . $uri2 . $uri3; // slug/slug/slug
        $menu_uri['menu_active_id'] = $this->global_model->select_menu_by_uri($uriSegment);
        $menu_uri['menu_active_id'] == false || $this->session->set_userdata($menu_uri);

		// Verify User Session
        $this->auth_model->verifyUserSession();
	}

}
