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
        $input      = $this->input;
        $customer       = $this->security->xss_clean($this->input->post("customer"));
        $alamat       = $this->security->xss_clean($this->input->post("alamat"));
        $country       = $this->security->xss_clean($this->input->post("country"));
        $passpor       = $this->security->xss_clean($this->input->post("passpor"));
        $currency       = $this->security->xss_clean($this->input->post("currency"));
        $lembar    = $this->security->xss_clean($this->input->post("lembar"));
        $rate       = $this->security->xss_clean($this->input->post("rate"));


        $final_transaksi = array();
        foreach($currency as $keycurr=>$valuecur){
            $temp['currency']   = $valuecur;  
            foreach($lembar as $keylembar=>$valuelembar){ 
                $temp['lembar']   = $valuelembar;  
                foreach($rate as $keyrate=>$valuerate){
                    $temp['rate']   = $valuerate;  
                    if(($keycurr == $keylembar) && ($keycurr == $keyrate) && ($keylembar == $keyrate)){
                        array_push($final_transaksi, $temp);
                    }
                } 
            }
            
        }

        $mdata = array(
            'cabang_id'         => $_SESSION['logged_user']['idcabang'],
            'nama'              => $customer,
            'alamat'            => $alamat,
            'passpor'           => $passpor,
            'nasionality'       => $country,
            "detail"            => $final_transaksi
        );


        echo '<pre>'.print_r($final_transaksi,true).'</pre>';
        die;
    }
}