<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	

		$data = array(
			'title'     => NAMETITLE . ' - Login',
			'content'   => 'auth/login/index',
			'extra'		=> 'auth/login/js/_js_index',
		);
		$this->load->view('layout/wrapper', $data);
	}


	public function auth_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("/");
			return;
		}

		$input = $this->input;
		$username = $this->security->xss_clean($input->post('username'));
		$password = $this->security->xss_clean($input->post('password'));

		$mdata = array(
			'username'	=> $username,
			'passwd'	=> sha1($password),
		);

		$url = URLAPI . "/auth/signin";
		$response = expatAPI($url, json_encode($mdata));
		$result = $response->result->messages;

		if (@$response->status != 200) {
			$this->session->set_flashdata('error', $result->error);
			redirect("/");
			return;
		}

		$url = URLAPI . "/v1/user/get_byusername?username=".$result->username;
		$user = expatAPI($url)->result->messages;

		
		$temp_session = array(
			'username'  => $result->username,
			'role'      => $result->role,
			'kontak'	=> $user->kontak,
			'kecamatan'	=> $user->kecamatan,	
			'cabang'	=> $result->cabang,
			'idcabang'	=> $result->cabang_id,
			'is_login'  => true
		);

		$this->session->set_userdata('logged_user', $temp_session);
		$this->session->set_flashdata('success_login', "Selamat datang <b>".$result->username."</b>");
		redirect('dashboard');

	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
