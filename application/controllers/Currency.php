<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*----------------------------------------------------------
    Modul Name  : Currency 
    Desc        : Modul ini di gunakan untuk melakukan setup rate currency
                  
    Sub fungsi  : 
    - rate_currency     : Tampilan halaman datatables seluruh rate currency
    - list_allrate      : Prosess call API kebutuhan databales rate currency
    - add_ratecurrency  : Tampilan Input menambahkan rate currency 
    - addcurrency_process : Proses menyimpan data rate currency
    - edit_ratecurrency   : Tampilan mengupdate rate currency
    - editcurrency_process : Proses mengupdate data rate currency
------------------------------------------------------------*/ 

class Currency extends CI_Controller
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
            'title'             => NAMETITLE . ' - Rate Currency',
            'content'           => 'admin/promotion/index',
            'extra'             => 'admin/promotion/js/_js_index',
            'master_active'     => 'active',
            'master_in'         => 'in',
            'dropdown_promotion' => 'text-monex-blue'
        );
        $this->load->view('layout/wrapper', $data);

    }

    public function rate_currency()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Rate Currency',
            'content'           => 'admin/currency/index',
            'extra'             => 'admin/currency/js/_js_index',
            'master_active'     => 'active',
            'master_in'         => 'in',
            'dropdown_rate' => 'text-monex-blue'
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function list_allrate()
    {
        $url = URLAPI . "/v1/rate/get_allrate";
		$response = expatAPI($url)->result->messages;   
        echo json_encode($response);  
    }

    public function add_ratecurrency()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Rate Currency',
            'content'           => 'admin/currency/add_ratecurrency',
            'extra'             => 'admin/currency/js/_js_index',
            'master_active'     => 'active',
            'master_in'         => 'in',
            'dropdown_rate' => 'text-monex-blue'
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function addcurrency_process()
    {
        $prevrate = $this->input->post("rate");
        $rate = preg_replace('/,(?=[\d,]*\.\d{2}\b)/', '', $prevrate);
        $_POST["rate"]=$rate;

        $prevrate_j = $this->input->post("rate_j");
        $rate_j = preg_replace('/,(?=[\d,]*\.\d{2}\b)/', '', $prevrate_j);
        $_POST["rate_j"]=$rate_j;

		$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
		$this->form_validation->set_rules('rate', 'Buy Rate Currency', 'trim|required');
		$this->form_validation->set_rules('rate_j', 'Sell Rate Currency', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("currency/add_ratecurrency");
			return;
		}

        
        $input      = $this->input;
        $currency   = $this->security->xss_clean($this->input->post("currency"));
        $rate       = $this->security->xss_clean($this->input->post("rate"));
        $rate_j       = $this->security->xss_clean($this->input->post("rate_j"));

        $mdata = array(
            "currency"  => $currency,
            "rate"      => $rate,
            "rate_j"      => $rate_j,
        );

        $url = URLAPI . "/v1/rate/addRate";
		$response = expatAPI($url, json_encode($mdata));
        $result = $response->result;

        
        if($response->status == 200) {
            $this->session->set_flashdata('success', $result->messages);
			redirect('currency/rate_currency');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
			redirect('currency/add_ratecurrency');
			return;
        }

    }

    public function edit_ratecurrency($currency)
    {
        $prevcurrency	= urlencode(base64_decode($this->security->xss_clean($currency)));        
        $url = URLAPI . "/v1/rate/getrate_bycurrency?cur=".$prevcurrency;
		$result = expatAPI($url)->result->messages;

        $data = array(
            'title'             => NAMETITLE . ' - Edit Rate Currency',
            'content'           => 'admin/currency/edit_ratecurrency',
            'extra'             => 'admin/currency/js/_js_index',
            'result'            => $result,
            'master_active'     => 'active',
            'master_in'         => 'in',
            'dropdown_rate'     => 'text-monex-blue'
        );

        $this->load->view('layout/wrapper', $data);
    }

    public function editcurrency_process()
    {
        $prevrate = $this->input->post("rate");
        $rate = preg_replace('/,(?=[\d,]*\.\d{2}\b)/', '', $prevrate);
        $_POST["rate"]=$rate;

        
        $prevrate_j = $this->input->post("rate_j");
        $rate_j = preg_replace('/,(?=[\d,]*\.\d{2}\b)/', '', $prevrate_j);
        $_POST["rate_j"]=$rate_j;

        $input      = $this->input;
        $currency   = urlencode($this->security->xss_clean($this->input->post("currency")));

		$this->form_validation->set_rules('currency', 'Currency', 'trim');
		$this->form_validation->set_rules('rate', 'Buy Rate Currency', 'trim|required');
		$this->form_validation->set_rules('rate_j', 'Sell Rate Currency', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("currency/edit_ratecurrency/".base64_encode($currency));
			return;
		}

        $rate       = $this->security->xss_clean($this->input->post("rate"));
        $rate_j     = $this->security->xss_clean($this->input->post("rate_j"));

        $mdata = array(
            "rate"      => $rate,
            "rate_j"      => $rate_j,
        );

        $url = URLAPI . "/v1/rate/updateRate?cur=".$currency;
		$response = expatAPI($url, json_encode($mdata));
        $result = $response->result;


        if($response->status == 200) {
            $this->session->set_flashdata('success', $result->messages);
			redirect('currency/rate_currency');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
			redirect('currency/edit_ratecurrency/'.base64_encode($currency));
			return;
        }

    }


    
}