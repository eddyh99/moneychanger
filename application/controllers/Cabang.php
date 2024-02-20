<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cabang extends CI_Controller
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
            'title'             => NAMETITLE . ' - Cabang',
            'content'           => 'admin/cabang/index',
            'extra'             => 'admin/cabang/js/_js_index',
            'master_active'     => 'active',
            'master_in'         => 'in',
            'dropdown_cabang'   => 'text-monex-blue'
        );
        $this->load->view('layout/wrapper', $data);

    }

    public function list_allcabang()
    {
		$url = URLAPI . "/v1/cabang/get_allcabang";
		$result = expatAPI($url)->result->messages;
        echo json_encode($result);  
    }

    public function add_cabang()
    {
        $data = array(
            'title'         => NAMETITLE . ' - Add cabang',
            'content'       => 'admin/cabang/add_cabang',
            'extra'         => 'admin/cabang/js/_js_index',
            'master_active'     => 'active',
            'master_in'         => 'in',
            'dropdown_cabang'   => 'text-monex-blue'
        );
        $this->load->view('layout/wrapper', $data);
    }

    public function addcabang_process()
    {
		$this->form_validation->set_rules('name', 'Name Cabang', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat cabang', 'trim|required');
		$this->form_validation->set_rules('contact', 'Kontak', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("cabang/add_cabang");
			return;
		}

        $input      = $this->input;
        $name       = $this->security->xss_clean($this->input->post("name"));
        $address    = $this->security->xss_clean($this->input->post("address"));
        $contact    = $this->security->xss_clean($this->input->post("contact"));

        $mdata = array(
            "nama"        => $name,
            "alamat"      => $address,
            "kontak"      => $contact,
        );
    
        $url = URLAPI . "/v1/cabang/addCabang";
		$response = expatAPI($url, json_encode($mdata));
        $result = $response->result;


        if($response->status == 200) {
            $this->session->set_flashdata('success', $result->messages);
			redirect('cabang');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
			redirect('cabang/add_cabang');
			return;
        }
    }

    public function edit_cabang($id)
    {
        $id_cabang	= base64_decode($this->security->xss_clean($id));

        $url = URLAPI . "/v1/cabang/getcabang_byid?id=".$id_cabang;
		$result = expatAPI($url)->result->messages;

        $data = array(
            'title'             => NAMETITLE . ' - Edit Cabang',
            'content'           => 'admin/cabang/edit_cabang',
            'extra'             => 'admin/cabang/js/_js_index',
            'cabang'              => $result,
            'master_active'     => 'active',
            'master_in'         => 'in',
            'dropdown_cabang'   => 'text-monex-blue'
        );

        $this->load->view('layout/wrapper', $data);
    }

    public function editcabang_process()
    {
		$this->form_validation->set_rules('name', 'Name cabang', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat cabang', 'trim|required');
		$this->form_validation->set_rules('contact', 'Kontak', 'trim|required');

        $input      = $this->input;
        $urisegment   = $this->security->xss_clean($input->post('urisegment'));

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
            redirect('cabang/edit_cabang/'.$urisegment);
			return;
		}

        $id             = base64_decode($urisegment);
        $name           = $this->security->xss_clean($input->post('name'));
        $address       = $this->security->xss_clean($input->post('address'));
        $contact       = $this->security->xss_clean($input->post('contact'));

        
        $mdata = array(
            "nama"        => $name,
            "alamat"      => $address,
            "kontak"      => $contact,
        );
    
        $url = URLAPI . "/v1/cabang/updateCabang?id=".$id;
		$response = expatAPI($url, json_encode($mdata));
        $result = $response->result;

        if($response->status == 200){
            $this->session->set_flashdata('success', $result->messages);
			redirect('cabang');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
            redirect('cabang/edit_cabang/'.$urisegment);
            return;
        }
    }

    public function delete($id)
    {
        $id_member = base64_decode($this->security->xss_clean($id));

        $url = URLAPI . "/v1/cabang/deleteCabang?id=".$id_member;
		$response = expatAPI($url);
        $result = $response->result;
 

        if($response->status == 200){
            $this->session->set_flashdata('success', $result->messages);
			redirect('cabang');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
            redirect('cabang');
            return;
        }
    }


}