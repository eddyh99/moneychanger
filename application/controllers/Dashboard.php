<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

        // $nasionality = array();
        // $cabang = array();
        // foreach($resultNationality as $dt){
        //     $temp['cabang'] = $dt->cabang ;
        //     $temp['nasionality'] = $dt->nasionality ;
        //     if(!in_array($dt->nasionality, $nasionality)){
        //         array_push($nasionality, $temp['nasionality']);
        //     }
        //     array_push($cabang, $temp['cabang']);
        // }

        // foreach($resultNationality as $dt){
        //     echo $dt->nasionality . " FROM API ";
        //     echo "<br>";
        //     foreach($nasionality as $ns){
        //         echo $ns;
        //         echo "<br>";
        //     }
        //     echo "<br>";
        //     echo "<br>";
        // }


        // echo '<pre>'.print_r($nasionality,true).'</pre>';
        // die;

        $final = array();
        foreach(array_filter($resultNationality) as $i){
            $arrayTemp = array();
        
            $tempCabang = array();
            foreach($resultNationality as $j){
                echo '<pre>'.print_r($tempCabang,true).'</pre>';
                
                if(($i->nasionality == $j->nasionality) && ($j->total != 0)){
                    $temp2['cabang'] = $j->cabang;
                    $temp2['jumlah'] = $j->total;
                    array_push($arrayTemp, (object) $temp2);
                    array_push($tempCabang, $j->cabang);
                    
                }else{
                    if(!in_array($j->cabang, $tempCabang)){
                        $temp2['cabang'] = $j->cabang;
                        $temp2['jumlah'] = 0;
                        array_push($arrayTemp,  (object)$temp2);
                    }
                }
            }
            
            $final[$i->nasionality] = $arrayTemp;
            // echo '<pre>'.print_r($arrayTemp,true).'</pre>';
        
            
            // array_push($final[$i->nasionality], array($arrayTemp));
            // array_push($final, (object) array(
            //     $i->nasionality => $arrayTemp
            // ));


        }







        // print_r(json_encode($resultNationality));
        echo '<pre>'.print_r($final,true).'</pre>';
        // echo '<pre>'.print_r($nasionality,true).'</pre>';
        // echo '<pre>'.print_r($cabang,true).'</pre>';
        // die;

        $finall = array (
            'USA'     => array(
                (object) array(
                    'label'     => 'MONEX UBUD',
                    'y'         => 10
                ),
                (object) array(
                    'label'     => 'MONEX KUTA',
                    'y'         => 30
                ),
                (object) array(
                    'label'     => 'MONEX CANGGU',
                    'y'         => 0
                ),
            ),
            'Italy'     => array(
                (object) array(
                    'label'     => 'MONEX UBUD',
                    'y'         => 1
                ),
                (object) array(
                    'label'     => 'MONEX KUTA',
                    'y'         => 12
                ),
                (object) array(
                    'label'     => 'MONEX CANGGU',
                    'y'         => 32
                ),
            ),
            'United Kingdom'     => array(
                (object) array(
                    'label'     => 'MONEX UBUD',
                    'y'         => 12
                ),
                (object) array(
                    'label'     => 'MONEX KUTA',
                    'y'         => 40
                ),
                (object) array(
                    'label'     => 'MONEX CANGGU',
                    'y'         => 0
                ),
            )

        );

        // foreach($finall as $key=>$val){
        //     echo $key;
        //     echo "<br>";
        //     foreach($val as $dt){
        //         echo $dt->label;
        //         echo $dt->y;
        //         echo "<br>";
        //     }
        //     echo "<br>";
        //     echo "<br>";
        // }

        echo '<pre>'.print_r($finall,true).'</pre>';
        die;


        $data = array(
            'title'         => NAMETITLE . ' - Dashboard',
            'content'       => 'admin/dashboard/index',
            'extra'         => 'admin/dashboard/js/_js_index',
            'dash_active'   => 'active',
            'omzet'         => $resultOmzet,
            'final'         => $finall
        );
        $this->load->view('layout/wrapper', $data);

    }


}
