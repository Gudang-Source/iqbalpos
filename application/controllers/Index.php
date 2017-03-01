<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends MX_Controller {
	function __construct() {
        parent::__construct();
    }
    function index(){
        // $Pegawai = new MasterPegawai();
    	// $data['view'] = $Pegawai->index();
    	$data['view'] = 'base_html/sale';
    	$this->load->view('base_html/base', $data);
    }
    function base_sale(){
    	$this->load->view('base_html/sale');
    }
    function testClass(){
     //    $Pegawai = new MasterPegawai();
    	// $data = $Pegawai->index();
    	// echo $data;
    	// var_dump($Pegawai);
    }
    function sale(){
    	$data['view'] = 'base_html/sale';
    	$this->load->view('base_html/base', $data);    	
    }
    function modul($modul = null){
    	if($modul != null){
    		$modul=str_replace("-", "/", $modul);
    		$data['view'] = $modul;
    	}else{
    		$data['view'] = 'index/base_sale';
    	}
    	$this->load->view('base_html/base', $data);
    }
}