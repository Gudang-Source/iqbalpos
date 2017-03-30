<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model("Gmodel");
        $this->checkLogin();
    }
    function checkLogin(){
        if($this->session->userdata('is_logged_in')!=1){
            $this->login();            
        }
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
    function testSession(){
        print_r($this->session->userdata());
    }
    function modul($modul = null){
        $sql = "SELECT B.id, B.nama, B.icon_class AS kategori_icon, (SELECT COUNT(A.id) FROM m_pegawai_permission A WHERE A.id_menu = B.id) AS jumlah_sub FROM m_pegawai_menu B";
        $data['nav_kategori'] = $this->Gmodel->rawQuery($sql)->result();
        $data['nav_menu'] = $this->Gmodel->get("m_pegawai_permission")->result();

        if($modul != null){
            $realmodul = $modul;
            $modul=str_replace("-", "/", $modul);
            $selectData['url'] = "index/modul/".$realmodul;
            $selectDataPermission = $this->Gmodel->select($selectData, 'm_pegawai_permission');
            if($selectDataPermission->num_rows() > 0){            
                $idPermission = $selectDataPermission->row()->id;
                if($idPermission!=null && $this->session->userdata('user_permission')!=null){                
                    if(in_array($idPermission, $this->session->userdata('user_permission'))){            
                        $data['view'] = $modul;
                    }else{
                        $data['view'] = "index/access_restricted";
                    }
                }else{
                    $data['view'] = "index/access_restricted";
                }
            }else{
                $data['view'] = "index/access_restricted";
            }
        }else{
            $data['view'] = 'index/base_sale';
        }
        $this->load->view('base_html/base', $data);
    }
    function access_restricted(){
        $this->load->view('base_html/access_restricted');
    }
    function login(){
    	$this->load->view('Login/view');
    }
}