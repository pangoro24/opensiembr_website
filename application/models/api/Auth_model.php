<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	public function login()
	{
		$emailPhone = $this->input->post('emailPhone');
		$password = $this->input->post('password');

		switch ($this->verifyEmailPhone($emailPhone)) {
			case 'email':
				return $this->createSession($this->verifyPasswordEmail($emailPhone, $password), $emailPhone, 'email');
				break;
			case 'phone':
				return $this->createSession($this->verifyPasswordPhone($emailPhone, $password), $emailPhone , 'phone');
				break;
			case false:
				$return = [
					'error' => true,
					'message' => 'El usuario ' .$emailPhone .' no se encuentra en nuestra base de datos o sus datos no son correctos.'
				];
				return $return;
				break;
			default:
				break;
		}
	}

	public function verifyEmailPhone($emailPhone)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $emailPhone);
		$query = $this->db->get();

		if ($query->data_seek()) {
			$returnEmail = ($query->data_seek())? 'email' : $queryPhone->data_seek() ;
			return $returnEmail;
		} else {
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('phone', $emailPhone);
			$queryPhone = $this->db->get();
			$returnPhone = ($queryPhone->data_seek())? 'phone' : $queryPhone->data_seek() ;
			return $returnPhone;
		}
	}

	public function verifyPasswordEmail($emailPhone, $password)
	{
		$this->db->from('users');
		$this->db->where('email', $emailPhone);
		$query = $this->db->get();
		$row = $query->row();

		return pwDecrypt($password, $row->password);
	}

	public function verifyPasswordPhone($emailPhone, $password)
	{
		$this->db->from('users');
		$this->db->where('phone', $emailPhone);
		$query = $this->db->get();
		$row = $query->row();

		return pwDecrypt($password, $row->password);
	}

	public function createSession($verify, $emailPhone, $type)
	{
		if ($verify) {
			// QUERY DATABASE
			$this->db->select('users.role_id, users.email, roles.*');
			$this->db->from('users');
			$this->db->join('roles', 'roles.id = users.role_id', 'left');
			$this->db->where('users.'.$type, $emailPhone);
			$query = $this->db->get();
			$row = $query->row();

			// CREAMOS SESION DATA
			$sessionData = array(
				'id' => $row->id,
				'email_user'   => $row->email,
				'rol'       => $row->role_id,
				'logged_in' => TRUE,
			);
			$this->session->set_userdata($sessionData);

			// RETURN DATA
			$return = [
				'error' => false,
				'message' => 'Login correcto',
				'data_user'  => $row,
			];
			return $return;
		} else {
			// Retorna Error.
			$return = [
				'error' => true,
				'message' => 'Las credenciales de ' .$emailPhone .' son incorrectas.'
			];
			return $return;
		}
	}

	//---------REGISTER---------//
	public function register()
	{
		// Save data Database
		$password = $this->input->post('password');
		$data = array(
			'role_id' => 2,
			'fullname' 	=> $this->input->post('name'),
			'phone' 	=> $this->input->post('phone'),
			'email' 	=> $this->input->post('email'),
			'password' 	=> pwEncrypt($password),
		);
		$this->db->insert('users', $data);

		// Send Mail Welcome and Confirm


		return 'El usuario ha sido registrado exitosamente, por favor verifique su correo electronico para verificar su cuenta.';
	}

	//---------VERIFY CORE---------//
	public function rolesSlug($rol)
	{
		$this->db->select('*');
		$this->db->from('roles');
		$this->db->where('id', $rol);
		$query = $this->db->get();

		return $query->row();
	}

	public function verifyUserSession()
	{
		$logged_in 	   = $this->session->userdata('logged_in');

		switch ($logged_in) {
			case TRUE:
				# code...
				return true;
				break;
			case FALSE:
				# code...
				redirect('/login','refresh');
				break;
			default:
				# code...
				break;
		}
	}

	public function verifyRol($rol = NULL)
	{
		$email = $this->session->userdata('email_user');
		$rol_session = $this->session->userdata('rol');

		// Query Database
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('roles', 'roles.id = users.role_id', 'left');
		$this->db->where('users.email', $email);
		$this->db->where('roles.id', $rol);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			# code...
		}else{
			$slug = $this->rolesSlug($rol_session);
			redirect($slug->slug .'/dashboard','refresh');
		}
	}

}
