<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends MX_Controller {
	function __construct() {
        parent::__construct();
    }
    function index(){
    	$data['view'] = 'base_html/sale';
    	$this->load->view('base_html/base', $data);
    }
    function sale(){
    	$data['view'] = 'base_html/sale';
    	$this->load->view('base_html/base', $data);    	
    }
}