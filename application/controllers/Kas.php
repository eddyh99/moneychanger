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

        $urlDetail=URLAPI."/v1/transaksi/getDetailPenukaran?id=5";
        $responseDetail = expatAPI($urlDetail)->result->messages; 
		
        // echo '<pre>'.print_r($responseDetail,true).'</pre>';
        // die;

		$data = array(
            'title'             => NAMETITLE . ' - Input Penukaran Bank',
            'content'           => 'admin/setoran/index',
            'extra'             => 'admin/setoran/js/_js_index',
			'cabang'			=> $result,
            'detail'            => $responseDetail,
            'penukaran_active'     	=> 'active',
        );
        $this->load->view('layout/wrapper', $data);
	}

    public function getall_penukaran()
    {
        $tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		$cabang_id	= $this->security->xss_clean($this->input->post('cabang'));
		$awal       = date_format(date_create($tgl[0]),"Y-m-d");
		$akhir      = date_format(date_create($tgl[1]),"Y-m-d");

		$url=URLAPI."/v1/transaksi/getListPenukaranbank?awal=".$awal."&akhir=".$akhir."&cabang_id=".$cabang_id;
        $response = expatAPI($url)->result->messages; 
        echo json_encode($response);
    }

    public function detail_penukaran($id)
    {
        $urlDetail = URLAPI."/v1/transaksi/getDetailPenukaran?id=".$id;
        $responseDetail = expatAPI($urlDetail)->result->messages; 

        $mdata = array(
            "detail"    => $responseDetail,
            "id"        => $id
        );
    
        $this->load->view('admin/setoran/component/_modal_update', $mdata);
    }

    public function update_penukaran_process()
    {


        $this->form_validation->set_rules('id[]', 'Id', 'trim|required');
        $this->form_validation->set_rules('currency[]', 'Currency', 'trim|required');
        // $this->form_validation->set_rules('rate[]', 'Rate', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("kas/penukaran");
			return;
		}


        $input      = $this->input;
        $id         = $this->security->xss_clean($this->input->post("id"));
        $currency   = $this->security->xss_clean($this->input->post("currency"));
        $prevrate   = $this->security->xss_clean($this->input->post("rate"));
        $ratenow    = preg_replace('/,(?=[\d,]*\.\d{2}\b)/', '', $prevrate);

        $final = array();
        foreach($id as $keyid=>$valueid){
            $temp['id']   = $valueid;  
            foreach($currency as $keycurr=>$valuecurr){ 
                $temp['currency']   = $valuecurr;  
                foreach($ratenow as $keyrate=>$valuerate){
                    $temp['rate']   = $valuerate;  
                    if(($keyid == $keycurr) && ($keycurr == $keyrate) && ($keyid == $keyrate)){
                        array_push($final, $temp);
                    }
                } 
            }
        }

        $mdata = array(
            'detail'  => $final,
        );

        // echo '<pre>'.print_r($ratenow,true).'</pre>';
        // die;
        $url = URLAPI . "/v1/transaksi/updatePenukaran";
		$response = expatAPI($url, json_encode($mdata));
        $result = $response->result;


        if($response->status == 200) {
            $this->session->set_flashdata('success', $result->messages);
			redirect('kas/penukaran');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
			redirect('kas/penukaran');
			return;
        }
    }

    public function getall_amount($id)
    {
        $urlJumlahAmount = URLAPI."/v1/laporan/getListPenukaran?awal=".date('Y-m-d')."&akhir=".date('Y-m-d')."&cabang_id=".$id;
        $resultJumlahAmount = expatAPI($urlJumlahAmount)->result->messages; 

        $mdata = array(
            "amount"    => $resultJumlahAmount,
        );
    
        $this->load->view('admin/setoran/component/_modal_jumlahamount', $mdata);
    }

    
    public function add_setoran()
    {
        $urlCurrency = URLAPI . "/v1/rate/get_allrate";
		$resultCurrency = expatAPI($urlCurrency)->result->messages;  
        

        $urlCabang = URLAPI . "/v1/cabang/get_allcabang";
		$resultCabang = expatAPI($urlCabang)->result->messages;


        $urlJumlahAmount = URLAPI . "/v1/laporan/getListPenukaran?awal=2024-03-01&akhir=2024-03-01&cabang_id=2";
		$resultJumlahAmount = expatAPI($urlJumlahAmount)->result->messages;

        $data = array(
            'title'             => NAMETITLE . ' - Input Penukaran Bank',
            'content'           => 'admin/setoran/add_setoran',
            'extra'             => 'admin/setoran/js/_js_index',
			'cabang'			=> $resultCabang,
            'currency'          => $resultCurrency,
            'amount'            => $resultJumlahAmount,
            'penukaran_active'  => 'active',
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function add_setoran_process()
    {
        $cabang     = $this->security->xss_clean($this->input->post("cabang"));
        $currency   = $this->security->xss_clean($this->input->post("currency"));
        $amount     = $this->security->xss_clean($this->input->post("amount"));

        $final = array();
        foreach($currency as $keycurrency=>$valuecurrency){
            $temp['currency']   = $valuecurrency;  
            foreach($amount as $keyamount=>$valueamount){ 
                $temp['jumlah']   = $valueamount;
                if(($keycurrency == $keyamount)){
                    array_push($final, $temp);
                }  
            }
        }

        $mdata = array(
            'cabang_id'     => $cabang,
            'detail'        => $final
        );

        $url = URLAPI . "/v1/transaksi/addPenukaran";
		$response = expatAPI($url, json_encode($mdata));
        $result = $response->result;


        if($response->status == 200) {
            $this->session->set_flashdata('success', $result->messages);
			redirect('kas/penukaran');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
			redirect('kas/penukaran');
			return;
        }

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
