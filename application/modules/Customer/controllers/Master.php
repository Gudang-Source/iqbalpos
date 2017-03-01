<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends MX_Controller {
    function index(){
    	// $this->load->view('base_html/sale');
    	// echo "MASTER INDEX";
        return "INDEX CUSTOMER";
    }
    function add(){
    	return "ADD CUSTOMER";
    }
    function edit($id = null){
    	return "EDIT CUSTOMER";
    }
    function delete($id = null){
    	return "DELETE CUSTOMER";
    }
}