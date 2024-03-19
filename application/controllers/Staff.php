<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*----------------------------------------------------------
    Modul Name  : Assign User
    Desc        : Modul ini di gunakan untuk melakukan assign user ke cabang
                  
    Sub fungsi  : 
    - index             : Tampilan halaman datatables seluruh assign user
    - list_all_assignstaff    : Prosess call API kebutuhan databales assign user
    - add_add_assignstaff        : Tampilan Input menambahkan assign user
    - add_assignstaff_process : Proses menyimpan data assign user
    - delete            : Proses hapus assign user
------------------------------------------------------------*/ 

class Staff extends CI_Controller
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
            'title'             => NAMETITLE . ' - staff',
            'content'           => 'admin/staff/index',
            'extra'             => 'admin/staff/js/_js_index',
            'master_active'     => 'active',
            'master_in'         => 'in',
            'dropdown_staff'  => 'text-monex-blue'
        );

        $this->load->view('layout/wrapper', $data);

    }

    
    public function list_all_assignstaff()
    {
        // $status     = $this->security->xss_clean($this->input->post('status'));
		$url = URLAPI . "/v1/user/getall_staff";
		$response = expatAPI($url)->result->messages;   
        echo json_encode($response);  

    }

    public function add_assignstaff()
    {

        $urlUser = URLAPI . "/v1/user/get_alluser";
		$resultUser = expatAPI($urlUser)->result->messages;
       
        $urlCabang = URLAPI . "/v1/cabang/get_allcabang";
		$resultCabang = expatAPI($urlCabang)->result->messages;


        $data = array(
            'title'             => NAMETITLE . ' - Assign Staff',
            'content'           => 'admin/staff/add_assignstaff',
            'extra'             => 'admin/staff/js/_js_index',
            'user'              => $resultUser,
            'cabang'            => $resultCabang,
            'master_active'     => 'active',
            'master_in'         => 'in',
            'dropdown_staff'    => 'text-monex-blue'
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function add_assignstaff_process()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('cabang', 'Cabang', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("staff/add_assignstaff");
			return;
		}

        $input      = $this->input;
        $username      = $this->security->xss_clean($input->post('username'));
        $cabang     = $this->security->xss_clean($input->post('cabang'));

        $mdata = array(
            "username"  => $username,
            "cabangid"    => $cabang,

        );

        // echo '<pre>'.print_r($mdata,true).'</pre>';

        
		$url = URLAPI . "/v1/user/addStaff";
		$response = expatAPI($url, json_encode($mdata));
        $result = $response->result;

        // echo '<pre>'.print_r($response,true).'</pre>';
        // die;

        if($response->status == 200) {
            $this->session->set_flashdata('success', $result->messages);
			redirect('staff');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
			redirect('staff/add_assignstaff');
			return;
        }
    } 

    public function delete()
    {
        $username = base64_decode($this->security->xss_clean($_GET['username']));
        $idcabang = base64_decode($this->security->xss_clean($_GET['idcabang']));

        $url = URLAPI . "/v1/user/deleteStaff?username=".$username."&cabang=".$idcabang ;
		$response = expatAPI($url);
        $result = $response->result;


        if($response->status == 200){
            $this->session->set_flashdata('success', $result->messages);
			redirect('staff');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
            redirect('staff');
            return;
        }
    }


}