<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*----------------------------------------------------------
    Modul Name  : Laporan
    Desc        : Modul ini di gunakan untuk membuat laporan
                  
    Sub fungsi  : 
    - penukaran             : Tampilan halaman datatables seluruh penukaran
    - historypenukaran  	: Prosess call API kebutuhan datatables seluruh penukaran
    - kaskeluar             : Tampilan halaman datatables kas keluar
    - historykas  			: Prosess call API kebutuhan datatables kas keluar
    - harian  				: Tampilan dan Proses rekapan harian
------------------------------------------------------------*/ 

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

	public function harian()
	{

        $tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		$cabang_id	= $this->security->xss_clean($this->input->post('cabang'));
		$awal       = @date_format(date_create($tgl[0]),"Y-m-d");
		$akhir      = @date_format(date_create($tgl[1]),"Y-m-d");
		
		$urlPendapatanTransaksi = URLAPI . "/v1/laporan/getEarnToday?awal=".$awal."&akhir=".$akhir."&cabang_id=".$cabang_id;
		$resultPendapatan = expatAPI($urlPendapatanTransaksi)->result->messages;

		$urlKas = URLAPI . "/v1/laporan/get_kasbydate?awal=".$awal."&akhir=".$akhir."&cabang_id=".$cabang_id;
		$resultKas = expatAPI($urlKas)->result->messages;
		
		$urlSisaKasSebelumnya = URLAPI . "/v1/laporan/get_sisa?tanggal=".$akhir."&cabang_id=".$cabang_id;
		$resultSisaKasSebelumnya = expatAPI($urlSisaKasSebelumnya)->result->messages;

		$urlCabang = URLAPI . "/v1/cabang/get_allcabang";
		$resultCabang = expatAPI($urlCabang)->result->messages;


		$data = array(
			'title'             => NAMETITLE . ' - Rekapan Harian',
			'content'           => 'admin/laporan/rekap_harian',
			'extra'             => 'admin/laporan/js/_js_rekap_harian',
			'cabang'			=> $resultCabang,
			'pendapatan'		=> $resultPendapatan,
			'kas'				=> $resultKas,
			'sisakas_sebelumnya'=> $resultSisaKasSebelumnya,
			'tgl'				=> @$tgl,
			'rekapharian_active'  => 'active',
		);
		$this->load->view('layout/wrapper', $data);

	}


	public function penukaranrekap()
	{
		$urlCabang = URLAPI . "/v1/cabang/get_allcabang";
		$resultCabang = expatAPI($urlCabang)->result->messages;

		$data = array(
			'title'             => NAMETITLE . ' - Rekapan Penukaran Bank',
			'content'           => 'admin/laporan/rekap_penukaran',
			'extra'             => 'admin/laporan/js/_js_rekap_penukaran',
			'cabang'			=> $resultCabang,
			'rekappenukaran_active'  => 'active',
		);
		$this->load->view('layout/wrapper', $data);

	}
	
	public function addingrekapan()
	{
		$input      	= $this->input;
        $tgl     		= $this->security->xss_clean($this->input->post("tgl"));
        $cabang_id     	= $this->security->xss_clean($this->input->post("cabang_id"));
		
		$urlrekapanbank = URLAPI . "/v1/laporan/getrekapan?tanggal=".$tgl."&cabang_id=".$cabang_id;
		$resultrekapanbank = expatAPI($urlrekapanbank)->result->messages;
		
		$urlSaldoPenukaran = URLAPI . "/v1/laporan/getsaldoTukar?awal=".$tgl."&akhir=".$tgl."&cabang_id=".$cabang_id;
		$resultSaldoPenukaran = expatAPI($urlSaldoPenukaran)->result->messages;

		$temp_final = array();
		foreach($resultrekapanbank as $rkb){
			// HARIAN
			$urlPendapatanTransaksi = URLAPI . "/v1/laporan/getEarnToday?awal=".$rkb->tanggal."&akhir=".$rkb->tanggal."&cabang_id=".$cabang_id;
			$resultPendapatan = expatAPI($urlPendapatanTransaksi)->result->messages;
			$temp['pembelian']	= $resultPendapatan->beli;

			$mdata = array(
				"pembelian"	=> $resultPendapatan->beli,
				"tanggal"	=> $rkb->tanggal,
				"cabang_id"	=> $rkb->cabang_id
			);
			
			array_push($temp_final, $mdata);
		}

		$final_result = array(
			"saldo"		=> $resultSaldoPenukaran,
			"details"	=> $temp_final
		);

		echo json_encode($final_result);
	}


	public function add_penukaranrekap()
	{

		$urlCabang = URLAPI . "/v1/cabang/get_allcabang";
		$resultCabang = expatAPI($urlCabang)->result->messages;

		$data = array(
			'title'             => NAMETITLE . ' - Rekapan Penukaran Bank',
			'content'           => 'admin/laporan/add_rekap_penukaran',
			'extra'             => 'admin/laporan/js/_js_add_rekap_penukaran',
			'cabang'			=> $resultCabang,
			'rekappenukaran_active'  => 'active',
		);
		$this->load->view('layout/wrapper', $data);

	}

	public function get_pembelian()
	{
		$input      		= $this->input;
        $tgl     	= $this->security->xss_clean($this->input->post("tgl"));
        $cabang     	= $this->security->xss_clean($this->input->post("cabang"));


		$urlPendapatanTransaksi = URLAPI . "/v1/laporan/getEarnToday?awal=".$tgl."&akhir=".$tgl."&cabang_id=".$cabang;
		$resultPendapatan = expatAPI($urlPendapatanTransaksi)->result->messages;
		echo json_encode($resultPendapatan);
	}

	public function get_saldo_penukaran()
	{
		$input      	= $this->input;
        $tgl     		= $this->security->xss_clean($this->input->post("tgl"));
        $cabang     	= $this->security->xss_clean($this->input->post("cabang"));

		$urlSaldoPenukaran = URLAPI . "/v1/laporan/getsaldoTukar?awal=".$tgl."&akhir=".$tgl."&cabang_id=".$cabang;
		$resultSaldoPenukaran = expatAPI($urlSaldoPenukaran)->result->messages;
		echo json_encode($resultSaldoPenukaran);
	}

	public function add_penukaranrekap_process()
	{
		$this->form_validation->set_rules('cabang', 'Nama Cabang', 'trim|required');
		$this->form_validation->set_rules('penukaranbank', 'Penukaran', 'trim|required');
		$this->form_validation->set_rules('rekapharian', 'Rekap Harian', 'trim');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("laporan/penukaranrekap");
			return;
		}


		$input      		= $this->input;
        $cabang     		= $this->security->xss_clean($this->input->post("cabang"));
        $penukaranbank     	= $this->security->xss_clean($this->input->post("penukaranbank"));
        $rekapharian     	= $this->security->xss_clean($this->input->post("rekapharian"));
		

		$detail = array();
		foreach($rekapharian as $rh){
			$temp['tanggal']	= $rh;
			$temp['status']		= 'rekap';
			array_push($detail, $temp);
		}

		$mdata = array(
			"cabang_id"		=> $cabang,
			"detail"		=> $detail
		);

		    
        $url = URLAPI . "/v1/laporan/rekapan_add";
		$response = expatAPI($url, json_encode($mdata));
        $result = $response->result;


		if($response->messages == null) {
            $this->session->set_flashdata('success', "Success");
			redirect('laporan/penukaranrekap');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
			redirect('laporan/penukaranrekap');
			return;
        }
	}


}