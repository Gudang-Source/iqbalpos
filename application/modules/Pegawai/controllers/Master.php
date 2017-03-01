<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends MX_Controller {
    function index(){
    	$this->load->view('base_html/sale');
    	// echo "MASTER INDEX";
    }
    function add(){
    	return "ADD PEGAWAI";
    }
    function edit($id){
    	return "ADD PEGAWAI";
    }
    function delete($id){
    	return "ADD PEGAWAI";
    }
}