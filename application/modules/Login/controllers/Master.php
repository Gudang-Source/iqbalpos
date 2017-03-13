<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Loginmodel');
    }
    function index(){
    	$this->load->view('Login/view', $data);
    }
	
    function do_login(){
        $response['status'] = 0;

        $params = $this->input->post();
        if(isset($params['email']) && !empty($params['password'])) {
            $user = $this->check_userpass($params['email'], $params['password']);
            if($user) {
                $data_session = array(
                        "id_user" => $user->id,
                        "nama_user" => $user->nama,
                        "is_logged_in" => 1
                    );
                $this->session->set_userdata($data_session);
                $response['status'] = 1;
            }
        }
        
        echo json_encode($response);
    }
    function do_logout(){
        unset($_SESSION['id_user']);
        unset($_SESSION['nama_user']);
        $_SESSION['is_logged_in'] = 0;

        redirect('index/login');
    }

    private function check_userpass($email, $password){
        $condition = array(
                'deleted' => 1,
                'email' => $email,
                'password' => hash('sha512', $password),
                );
        $data = $this->Loginmodel->select($condition, 'm_pegawai')->row();
        return $data;
    }
    
}