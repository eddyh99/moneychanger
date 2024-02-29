<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
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
        // print_r(json_encode($response));
        // die;
		$data = array(
            'title'             => NAMETITLE . ' - Kasir',
            'content'           => 'admin/kasir/index',
            'extra'             => 'admin/kasir/js/_js_index',
            'currency'          => $response,
            'transaksi_active'      => 'active',
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function transaksi_process()
    {

        $this->form_validation->set_rules('customer', 'Nama Customer', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat Customer', 'trim|required');
		$this->form_validation->set_rules('country', 'Negara Customer', 'trim|required');
		$this->form_validation->set_rules('passpor', 'Passpor Customer', 'trim|required');
		$this->form_validation->set_rules('jenistransaksi', 'Jenis Transaksi', 'trim|required');
		$this->form_validation->set_rules('currency[]', 'Currency', 'trim|required');
		$this->form_validation->set_rules('lembar[]', 'Lembar', 'trim|required');
		$this->form_validation->set_rules('rate[]', 'Rate', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("transaksi");
			return;
		}

        $input          = $this->input;
        $customer       = $this->security->xss_clean($this->input->post("customer"));
        $alamat         = $this->security->xss_clean($this->input->post("alamat"));
        $country        = $this->security->xss_clean($this->input->post("country"));
        $jenis          = $this->security->xss_clean($this->input->post("jenistransaksi"));
        $passpor        = $this->security->xss_clean($this->input->post("passpor"));
        $currency       = $this->security->xss_clean($this->input->post("currency"));
        $lembar         = $this->security->xss_clean($this->input->post("lembar"));
        $rate           = $this->security->xss_clean($this->input->post("rate"));

        // echo '<pre>'.print_r($currency,true).'</pre>';

        $newCurrency = array();
        foreach($currency as $dt){
            array_push($newCurrency, substr($dt, 0, 3));
        }

        $temp_transaksi = array();
        foreach($newCurrency as $keycurr=>$valuecur){
            $temp['currency']   = $valuecur;  
            foreach($lembar as $keylembar=>$valuelembar){ 
                $temp['jumlah']   = $valuelembar;  
                foreach($rate as $keyrate=>$valuerate){
                    $temp['rate']   = $valuerate;  
                    if(($keycurr == $keylembar) && ($keycurr == $keyrate) && ($keylembar == $keyrate)){
                        array_push($temp_transaksi, $temp);
                    }
                } 
            }
        }
		
		//merge jumlah untuk currency sama
		$final_transaksi = [];
		foreach ($temp_transaksi as $sa) {
		  if (!isset($final_transaksi[$sa['currency']])) {
			$final_transaksi[$sa['currency']] = 0;
		  }
		  $final_transaksi[$sa['currency']] += $sa['jumlah'];
		}
		
		//normalize array format
		$synth2 = [];
		foreach ($final_transaksi as $k => $v) {
		  $synth2[] = ['currency' => $k, 'jumlah' => $v];
		}
		
		//merge with rate
		$final=array();
		foreach ($synth2 as $sa){
			$temp["currency"]	=$sa["currency"];
			$temp["jumlah"]		=$sa["jumlah"];
			
			foreach ($temp_transaksi as $dt){
				if ($dt["currency"]==$sa["currency"]){
					$temp["rate"]=$dt["rate"];
					break;
				}
			}
			
			array_push($final,$temp);
		}

        $mdata = array(
            'cabang_id'         => $_SESSION['logged_user']['idcabang'],
            'nama'              => $customer,
            'alamat'            => $alamat,
            'passpor'           => $passpor,
            'nasionality'       => $country,
            'jenis'             => $jenis,
            "detail"            => $final
        );

            
        $url = URLAPI . "/v1/transaksi/addTransaksi";
		$response = expatAPI($url, json_encode($mdata));
        $result = $response->result;

        if($response->status == 200) {
            $this->session->set_userdata('print_transaksi', $mdata);
            $this->session->set_flashdata('success', $result->messages);
			redirect('transaksi/print_trasaksi');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
			redirect('transaksi');
			return;
        }
    }

    public function print_trasaksi()
    {
        // echo '<pre>'.print_r($_SESSION,true).'</pre>';
        $this->load->view('admin/kasir/print');
        // redirect('transaksi');
        // echo '<pre>'.print_r($_SESSION['print_transaksi'],true).'</pre>';
        // die;
    }
	
	public function harian(){
		$url = URLAPI . "/v1/cabang/get_allcabang";
		$result = expatAPI($url)->result->messages;
		
		$data = array(
            'title'             => NAMETITLE . ' - Laporan Harian',
            'content'           => 'admin/laporan/harian',
            'extra'             => 'admin/laporan/js/_js_harian',
			'cabang'			=> $result,
            'harian_active'     => 'active',
        );
        $this->load->view('layout/wrapper', $data);
	}
	
	public function historyharian(){
		$tgl		= explode("-",$this->security->xss_clean($this->input->post('tgl')));
		$cabang_id	= $this->security->xss_clean($this->input->post('cabang'));
		$awal       = date_format(date_create($tgl[0]),"Y-m-d");
		$akhir      = date_format(date_create($tgl[1]),"Y-m-d");
		
		$url=URLAPI."/v1/laporan/getListTransaction?awal=".$awal."&akhir=".$akhir."&cabang_id=".$cabang_id;
        $response = expatAPI($url)->result->messages; 
        echo json_encode($response);

	}
}