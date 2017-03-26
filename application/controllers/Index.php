<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model("Gmodel");
    }
    function index(){
    	$data['view'] = 'base_html/sale';
    	$this->load->view('base_html/base', $data);
    }
    function base_sale(){
    	$this->load->view('base_html/sale');
    }
    function sale(){
        $data['view'] = 'base_html/sale';
        $this->load->view('base_html/base', $data);     
    }
    function modul($modul = null){
        $sql = "SELECT B.id, B.nama, B.icon_class AS kategori_icon, (SELECT COUNT(A.id) FROM m_pegawai_permission A WHERE A.id_menu = B.id) AS jumlah_sub FROM m_pegawai_menu B";
        $data['nav_kategori'] = $this->Gmodel->rawQuery($sql)->result();
        $data['nav_menu'] = $this->Gmodel->get("m_pegawai_permission")->result();

        if($modul != null){
            $modul=str_replace("-", "/", $modul);
            $data['view'] = $modul;
        }else{
            $data['view'] = 'index/base_sale';
        }
        $this->load->view('base_html/base', $data);
    }
    function login(){
    	$this->load->view('Login/view');
    }
}