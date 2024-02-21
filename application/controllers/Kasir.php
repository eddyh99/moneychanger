<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_user'])) {
			redirect('/');
		}

    }

    public function index()
    {

        $url = URLAPI . "/v1/rate/get_allrate";
		$response = expatAPI($url)->result->messages;   


        $data = array(
            'title'             => NAMETITLE . ' - Kasir',
            'content'           => 'admin/kasir/index',
            'extra'             => 'admin/kasir/js/_js_index',
            'currency'          => $response,
            'kasir_active'      => 'active',
        );
        $this->load->view('layout/wrapper', $data);

    }
}