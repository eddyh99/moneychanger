<?php
defined('BASEPATH') or exit('No direct script access allowed');


/*----------------------------------------------------------
    Modul Name  : Dashboard
    Desc        : Modul ini di gunakan untuk menampilkan sekilas grafik laporan
                  
    Sub fungsi  : 
    - index             : Tampilan halaman dashboard omzet bulanan dan 
                            top 3 nationality
------------------------------------------------------------*/ 

class Dashboard extends CI_Controller
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

        $urlOmzet = URLAPI . "/v1/laporan/omzetcabang";
		$resultOmzet = expatAPI($urlOmzet)->result->messages;


        $urlNationality = URLAPI . "/v1/laporan/nationality";
		$resultNationality = expatAPI($urlNationality)->result->messages;

        $final=array();
		$last="";
		foreach ($resultNationality as $dt){
			if ($last==$dt->nasionality){
				$temp["label"] = $dt->cabang;
				$temp["y"] = $dt->total;				
			}else{
				$final[$dt->nasionality]=array();				
				$temp["label"] = $dt->cabang;
				$temp["y"] = $dt->total;
			}
			array_push($final[$dt->nasionality],(object)$temp);
			$last=$dt->nasionality;
		}

        $data = array(
            'title'         => NAMETITLE . ' - Dashboard',
            'content'       => 'admin/dashboard/index',
            'extra'         => 'admin/dashboard/js/_js_index',
            'dash_active'   => 'active',
            'omzet'         => $resultOmzet,
            'final'         => $final
        );
        $this->load->view('layout/wrapper', $data);

    }


}
