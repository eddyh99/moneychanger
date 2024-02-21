<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas extends CI_Controller
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
        $data = array(
            'title'             => NAMETITLE . ' - Kas',
            'content'           => 'admin/kas/index',
            'extra'             => 'admin/kas/js/_js_index',
            'kas_active'        => 'active',
        );
        $this->load->view('layout/wrapper', $data);

    }

    public function list_allkastoday()
    {
        $url = URLAPI . "/v1/kas/get_allkas?cabang=1";
		$result = expatAPI($url)->result->messages;
        echo json_encode($result);  
    }

    public function add_kas()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Tambah Kas',
            'content'           => 'admin/kas/add_kas',
            'extra'             => 'admin/kas/js/_js_index',
            'kas_active'     => 'active',
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function addkas_process()
    {
        $nominal = $this->input->post("nominal");
        $newnominal = preg_replace('/,(?=[\d,]*\.\d{2}\b)/', '', $nominal);
        $_POST["nominal"]=$newnominal;

		$this->form_validation->set_rules('nominal', 'Nominal', 'trim|required');
		$this->form_validation->set_rules('jenis', 'Jenis Kas', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("kas/add_kas");
			return;
		}

               
        $input      = $this->input;
        $nominal   = $this->security->xss_clean($this->input->post("nominal"));
        $jenis       = $this->security->xss_clean($this->input->post("jenis"));
        $keterangan       = $this->security->xss_clean($this->input->post("keterangan"));

        $mdata = array(
            "nominal"       => $nominal,
            "jenis"         => $jenis,
            "keterangan"    => $keterangan,
        );
        echo '<pre>'.print_r($mdata,true).'</pre>';
        die;

    }
}
