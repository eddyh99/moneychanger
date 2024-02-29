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
            "cabang"        => $_SESSION['logged_user']['idcabang'],
        );

            
        $url = URLAPI . "/v1/kas/addKas";
		$response = expatAPI($url, json_encode($mdata));
        $result = $response->result;


        if($response->status == 200) {
            $this->session->set_flashdata('success', $result->messages);
			redirect('kas');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
			redirect('kas/add_kas');
			return;
        }

    }
	
	public function penukaran(){
		$url = URLAPI . "/v1/cabang/get_allcabang";
		$result = expatAPI($url)->result->messages;
		
		$data = array(
            'title'             => NAMETITLE . ' - Input Penukaran Bank',
            'content'           => 'admin/setoran/index',
            'extra'             => 'admin/setoran/js/_js_index',
			'cabang'			=> $result,
            'penukaran_active'     	=> 'active',
        );
        $this->load->view('layout/wrapper', $data);
	}
	
	public function setoranbank(){
		$tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		$cabang_id	= $this->security->xss_clean($this->input->post('cabang'));
		$awal       = date_format(date_create($tgl[0]),"Y-m-d");
		$akhir      = date_format(date_create($tgl[1]),"Y-m-d");
		
		$url=URLAPI."/v1/laporan/getListKas?awal=".$awal."&akhir=".$akhir."&cabang_id=".$cabang_id;
        $response = expatAPI($url)->result->messages; 
        echo json_encode($response);
	}
	
	public function setoranadd(){
		$url = URLAPI . "/v1/cabang/get_allcabang";
		$result = expatAPI($url)->result->messages;
		 $data = array(
            'title'             => NAMETITLE . ' - Tambah Kas',
            'content'           => 'admin/setoran/add_setoran',
            'extra'             => 'admin/setoran/js/_js_setoran',
			'cabang'			=> $result, 
            'kas_active'     	=> 'active',
        );
        $this->load->view('layout/wrapper', $data);
	}
}
