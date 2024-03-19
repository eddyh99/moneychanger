<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*----------------------------------------------------------
    Modul Name  : Auth
    Desc        : Modul ini di gunakan untuk Mengautentikasi 
				  user Login 

    Sub fungsi  : 
	- index    			: Menampilkan halaman Login 
	- auth_login        : Proses autentikasi user login
	- show_rate         : Menampilkan rate currency untuk customer
	- logout 			: Logout user
------------------------------------------------------------*/ 

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	

		$data = array(
			'title'     => NAMETITLE . ' - Login',
			'content'   => 'auth/login/index',
			'extra'		=> 'auth/login/js/_js_index',
		);
		$this->load->view('layout/wrapper', $data);
	}


	public function auth_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("/");
			return;
		}

		$input = $this->input;
		$username = $this->security->xss_clean($input->post('username'));
		$password = $this->security->xss_clean($input->post('password'));

		$mdata = array(
			'username'	=> $username,
			'passwd'	=> sha1($password),
		);

		$url = URLAPI . "/auth/signin";
		$response = expatAPI($url, json_encode($mdata));
		$result = $response->result->messages;


		if (@$response->status != 200) {
			$this->session->set_flashdata('error', $result->error);
			redirect("/");
			return;
		}

		if($result->cabang_id == null && $result->username != 'admin'){
			$this->session->set_flashdata('error', 'Please assign user first');
			redirect("/");
			return;
		}

	
		$temp_session = array(
			'username'  => $result->username,
			'role'      => $result->role,
			'cabang'	=> $result->cabang,
			'idcabang'	=> $result->cabang_id,
			'is_login'  => true,
			"passwd"	=> sha1($password)
		);
		
		$this->session->set_userdata('logged_user', $temp_session);

        // User after login

		$url = URLAPI . "/v1/user/get_byusername?username=".$result->username;
		$user = expatAPI($url)->result->messages;

		$user_session = array(
			'username'  => $result->username,
			'role'      => $result->role,
			'nama'		=> $user->nama,
			'kontak'	=> $user->kontak,
			'kecamatan'	=> $user->kecamatan,	
			'cabang'	=> $result->cabang,
			'idcabang'	=> $result->cabang_id,
			'is_login'  => true,
			"passwd"	=> sha1($password)
		);
		
		$this->session->set_userdata('logged_user', $user_session);

		$this->session->set_flashdata('success_login', "Selamat datang <b>".$result->username."</b>");
		redirect('dashboard');

	}
  
  	public function show_rate()
    {

        $url = URLAPI . "/auth/publishrate";
		$result = expatAPI($url)->result->messages;  

        $slide1 = array();
        $slide2 = array();
        $slide3 = array();
        $slide4 = array();
        $slide_last = array();

        // USD
        foreach($result as $dt){
            if(preg_match("/{$dt->currency}/i", 'USD 5, 10, 20 USD 1, 2 USD 50, 100')){
                $temp['flag'] = substr($dt->currency,0,3);
                $temp['currency'] = $dt->currency;
                $temp['rate'] = $dt->rate;
                $temp['rate_j'] = $dt->rate_j;
                $temp['class_cur'] = str_replace(
                    array(" ",","),
                    array("", "-"), 
                    $dt->currency);
                array_push($slide1, (object)$temp);
            }
        }
  
        // AUD EUR GBP
        foreach($result as $dt){
            if(preg_match("/{$dt->currency}/i", 'AUD EUR GBP')){
                $temp['flag'] = substr($dt->currency,0,3);
                $temp['currency'] = $dt->currency;
                $temp['rate'] = $dt->rate;
                $temp['rate_j'] = $dt->rate_j;
                $temp['class_cur'] = $dt->currency;
                array_push($slide1, (object)$temp);
            }
        }

        // CHF JPY
        foreach($result as $dt){
            if(preg_match("/{$dt->currency}/i", 'CHF JPY ')){
                $temp['flag'] = substr($dt->currency,0,3);
                $temp['currency'] = $dt->currency;
                $temp['rate'] = $dt->rate;
                $temp['rate_j'] = $dt->rate_j;
                $temp['class_cur'] = $dt->currency;
                array_push($slide2, (object)$temp);
            }
        }

        // CAD MYR NZD SGD
        foreach($result as $dt){
            if(preg_match("/{$dt->currency}/i", 'CAD MYR  NZD SGD ')){
                $temp['flag'] = substr($dt->currency,0,3);
                $temp['currency'] = $dt->currency;
                $temp['rate'] = $dt->rate;
                $temp['rate_j'] = $dt->rate_j;
                $temp['class_cur'] = $dt->currency;
                array_push($slide2, (object)$temp);
            }
        }

        // HKD KRW AED SAR CNY THB
        foreach($result as $dt){
            if(preg_match("/{$dt->currency}/i", 'HKD KRW AED SAR CNY THB')){
                $temp['flag'] = substr($dt->currency,0,3);
                $temp['currency'] = $dt->currency;
                $temp['rate'] = $dt->rate;
                $temp['rate_j'] = $dt->rate_j;
                $temp['class_cur'] = $dt->currency;
                array_push($slide3, (object)$temp);
            }
        }

        // HKD KRW AED SAR CNY THB
        foreach($result as $dt){
            if(preg_match("/{$dt->currency}/i", 'PHP INR ARS')){
                $temp['flag'] = substr($dt->currency,0,3);
                $temp['currency'] = $dt->currency;
                $temp['rate'] = $dt->rate;
                $temp['rate_j'] = $dt->rate_j;
                $temp['class_cur'] = $dt->currency;
                array_push($slide4, (object)$temp);
            } else if(!preg_match("/{$dt->currency}/i", 'USD 5, 10, 20 USD 1, 2 USD 50, 100 AUD EUR GBP CHF JPY CAD MYR  NZD SGD HKD KRW AED SAR CNY THB PHP INR ARS')){
                $temp['flag'] = substr($dt->currency,0,3);
                $temp['currency'] = $dt->currency;
                $temp['rate'] = $dt->rate;
                $temp['rate_j'] = $dt->rate_j;
                $temp['class_cur'] = $dt->currency;
                array_push($slide_last, (object)$temp);
            }
        }

        $final_curr = array_merge(@$slide1, @$slide2, @$slide3, @$slide4);

        $mdata = array(
            'title'         => NAMETITLE . ' - Show Rate',
            'extra'         => 'admin/currency/js/_js_show_rate',
            'rate'          => $result,
            'final'         => $final_curr,
            'final_last'    => $slide_last,
            'liverate_active' => 'active',

        );

        $this->load->view('admin/currency/show_rate', $mdata);
    }

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
