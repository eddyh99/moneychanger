<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_user'])) {
			redirect('/');
		}

    }
	
	public function penukaran(){
		$url = URLAPI . "/v1/cabang/get_allcabang";
		$result = expatAPI($url)->result->messages;
		
		$data = array(
            'title'             => NAMETITLE . ' - Laporan Penukaran',
            'content'           => 'admin/laporan/penukaran',
            'extra'             => 'admin/laporan/js/_js_penukaran',
			'cabang'			=> $result,
            'setoran_active'     => 'active',
        );
        $this->load->view('layout/wrapper', $data);
	}
	
	public function historypenukaran(){
		$tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		$cabang_id	= $this->security->xss_clean($this->input->post('cabang'));
		$awal       = date_format(date_create($tgl[0]),"Y-m-d");
		$akhir      = date_format(date_create($tgl[1]),"Y-m-d");
		
		$url=URLAPI."/v1/laporan/getListPenukaran?awal=".$awal."&akhir=".$akhir."&cabang_id=".$cabang_id;
        $response = expatAPI($url)->result->messages; 
        echo json_encode($response);

	}

	public function kaskeluar(){
		$url = URLAPI . "/v1/cabang/get_allcabang";
		$result = expatAPI($url)->result->messages;
		
		$data = array(
            'title'             => NAMETITLE . ' - Laporan Kas Keluar',
            'content'           => 'admin/laporan/kas',
            'extra'             => 'admin/laporan/js/_js_kas',
			'cabang'			=> $result,
            'lapkas_active'     	=> 'active',
        );
        $this->load->view('layout/wrapper', $data);
	}
	
	public function historykas(){
		$tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		$cabang_id	= $this->security->xss_clean($this->input->post('cabang'));
		$awal       = date_format(date_create($tgl[0]),"Y-m-d");
		$akhir      = date_format(date_create($tgl[1]),"Y-m-d");
		
		$url=URLAPI."/v1/laporan/getListKas?awal=".$awal."&akhir=".$akhir."&cabang_id=".$cabang_id;
        $response = expatAPI($url)->result->messages; 
        echo json_encode($response);

	}
}