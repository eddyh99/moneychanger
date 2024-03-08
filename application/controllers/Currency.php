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
            'dropdown_rate' => 'text-monex-blue'
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
        $currency   = $this->security->xss_clean($this->input->post("currency"));

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


    public function show_rate()
    {

        $url = URLAPI . "/v1/rate/get_allrate";
		$result = expatAPI($url)->result->messages;  

        // USD 

        $slide1 = array();
        $slide2 = array();
        $slide3 = array();

        // USD
        foreach($result as $dt){
            if(preg_match("/{$dt->currency}/i", 'USD 5, 10, 20 USD 1, 2 USD 50, 100')){
                $temp['flag'] = substr($dt->currency,0,3);
                $temp['currency'] = $dt->currency;
                $temp['rate'] = $dt->rate;
                $temp['rate_j'] = $dt->rate_j;
                array_push($slide1, (object)$temp);
            }
        }



        // foreach($result as $key=>$val){
            
        //     if($key < 6){

        //         $temp['flag'] = substr($val->currency,0,3);
        //         $temp['currency'] = $val->currency;
        //         $temp['rate'] = $val->rate;
        //         $temp['rate_j'] = $val->rate_j;
        //         array_push($slide1, (object)$temp);

        //     }else if($key > 5 && $key < 12){
        //         $temp['flag'] = substr($val->currency,0,3);
        //         $temp['currency'] = $val->currency;
        //         $temp['rate'] = $val->rate;
        //         $temp['rate_j'] = $val->rate_j;
        //         array_push($slide2, (object)$temp);
        //     }else if($key > 11 && $key < 16){
        //         $temp['flag'] = substr($val->currency,0,3);
        //         $temp['currency'] = $val->currency;
        //         $temp['rate'] = $val->rate;
        //         $temp['rate_j'] = $val->rate_j;
        //         array_push($slide3, (object)$temp);
        //     }
        // }
        // echo '<pre>'.print_r($result,true).'</pre>';
        // echo '<pre>'.print_r($slide1,true).'</pre>';
        // die;

        $mdata = array(
            'title'         => NAMETITLE . ' - Show Rate',
            'extra'         => 'admin/currency/js/_js_show_rate',
            'rate'          => $result,
            'slide1'        => $slide1,
            'slide2'        => $slide2,
            'liverate_active' => 'active',

        );

        $this->load->view('admin/currency/show_rate', $mdata);
    }
}