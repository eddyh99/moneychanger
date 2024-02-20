<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
            'dropdown_promotion' => 'text-expat-green'
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
            'dropdown_currency' => 'text-expat-green'
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
            'dropdown_currency' => 'text-expat-green'
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function addcurrency_process()
    {
        $prevrate = $this->input->post("rate");
        $rate = preg_replace('/,(?=[\d,]*\.\d{2}\b)/', '', $prevrate);
        $_POST["rate"]=$rate;

		$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
		$this->form_validation->set_rules('rate', 'Rate Currency', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("currency/add_ratecurrency");
			return;
		}

        
        $input      = $this->input;
        $currency   = $this->security->xss_clean($this->input->post("currency"));
        $rate       = $this->security->xss_clean($this->input->post("rate"));

        $mdata = array(
            "currency"  => $currency,
            "rate"      => $rate,
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
        $prevcurrency	= base64_decode($this->security->xss_clean($currency));

        $url = URLAPI . "/v1/rate/getrate_bycurrency?cur=".$prevcurrency;
		$result = expatAPI($url)->result->messages;


        $data = array(
            'title'             => NAMETITLE . ' - Edit Rate Currency',
            'content'           => 'admin/currency/edit_ratecurrency',
            'extra'             => 'admin/currency/js/_js_index',
            'result'          => $result,
            'master_active'     => 'active',
            'master_in'         => 'in',
            'dropdown_currency' => 'text-monex-blue'
        );

        $this->load->view('layout/wrapper', $data);
    }

    public function editcurrency_process()
    {
        $prevrate = $this->input->post("rate");
        $rate = preg_replace('/,(?=[\d,]*\.\d{2}\b)/', '', $prevrate);
        $_POST["rate"]=$rate;

		$this->form_validation->set_rules('currency', 'Currency', 'trim|required');
		$this->form_validation->set_rules('rate', 'Rate Currency', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("currency/add_ratecurrency");
			return;
		}

        
        $input      = $this->input;
        $currency   = $this->security->xss_clean($this->input->post("currency"));
        $rate       = $this->security->xss_clean($this->input->post("rate"));

        $mdata = array(
            "rate"      => $rate,
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
			redirect('currency/edit_ratecurrency');
			return;
        }

    }
}