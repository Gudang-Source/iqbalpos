<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends MX_Controller {
    private $modul = "Produk_ukuran/";
    private $fungsi = "";    
	function __construct() {
        parent::__construct();
        $this->load->model('Produkukuranmodel');
        $this->modul .= $this->router->fetch_class();
        $this->fungsi = $this->router->fetch_method();
        $this->_insertLog();
    }
    function _insertLog($fungsi = null){
        $id_user = $this->session->userdata('id_user');
        $dataInsert['id_user'] = $id_user;
        $dataInsert['modul'] = $this->modul;
        $dataInsert['fungsi'] = $this->fungsi;
        $insertLog = $this->Produkukuranmodel->insert($dataInsert, 't_log');        
    }  
    function index(){
    	$dataSelect['deleted'] = 1;
    	$data['list'] = json_encode($this->Produkukuranmodel->select($dataSelect, 'm_produk_ukuran', 'date_add', 'DESC')->result());
		//echo $data;
		//print_r($data);
    	$this->load->view('Produk_ukuran/view', $data);
    }
	
	function test(){
		header('Content-Type: application/json; charset=utf-8');
		$dataSelect['deleted'] = 1;
		$list = $this->Produkukuranmodel->select($dataSelect, 'm_produk_ukuran', 'date_add', 'DESC')->result();
		echo json_encode(array('status' => '3','list' => $list));
	}
	
    function add(){
		$params = $this->input->post();
		$dataInsert['nama'] 			= $params['nama'];
        $dataInsert['last_edited']      = date("Y-m-d H:i:s");
        $dataInsert['add_by']           = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
        $dataInsert['edited_by']        = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
		$dataInsert['deleted'] 			= 1;

		$checkData = $this->Produkukuranmodel->select($dataInsert, 'm_produk_ukuran');
		if($checkData->num_rows() < 1){
			$insert = $this->Produkukuranmodel->insert($dataInsert, 'm_produk_ukuran');
			if($insert){
				$dataSelect['deleted'] = 1;
				$list = $this->Produkukuranmodel->select($dataSelect, 'm_produk_ukuran', 'date_add', 'DESC')->result();
				echo json_encode(array('status' => 3,'list' => $list));
			}else{
				echo json_encode(array('status' => 1));
			}
			
		}else{			
    		echo json_encode(array( 'status'=>1 ));
		}
    }
   
	
	function get($id = null){   	
    	if($id != null){
    		$dataSelect['id'] = $id;
    		$selectData = $this->Produkukuranmodel->select($dataSelect, 'm_produk_ukuran');
    		if($selectData->num_rows() > 0){
    			echo json_encode(
    				array(
    					'status'			=> 2,
    					'id'				=> $selectData->row()->id,
    					'nama'				=> $selectData->row()->nama,
    				));
    		}else{
    			echo json_encode(array('status' => 1));
    		}
    	}else{
    		echo json_encode(array('status' => 0));
    	}
    }
	
    function edit(){
		$params = $this->input->post();
		$dataCondition['id']			= $params['id'];
		$dataUpdate['nama'] 			= $params['nama'];
        $dataUpdate['last_edited']      = date("Y-m-d H:i:s");
        $dataUpdate['edited_by']        = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
        
		$checkData = $this->Produkukuranmodel->select($dataCondition, 'm_produk_ukuran');
		if($checkData->num_rows() > 0){
			$update = $this->Produkukuranmodel->update($dataCondition, $dataUpdate, 'm_produk_ukuran');
			if($update){
				$dataSelect['deleted'] = 1;
				$list = $this->Produkukuranmodel->select($dataSelect, 'm_produk_ukuran', 'date_add', 'DESC')->result();
				echo json_encode(array('status' => '3','list' => $list));
			}else{
				echo json_encode(array( 'status'=>'2' ));
			}
		}else{			
    		echo json_encode(array( 'status'=>'1' ));
		}
    }
    function delete(){
		$id = $this->input->post("id");
    	if($id != null){
    		$dataCondition['id'] = $id;
    		$dataUpdate['deleted'] = 0;
    		$update = $this->Produkukuranmodel->update($dataCondition, $dataUpdate, 'm_produk_ukuran');
    		if($update){
    			$dataSelect['deleted'] = 1;
				$list = $this->Produkukuranmodel->select($dataSelect, 'm_produk_ukuran', 'date_add', 'DESC')->result();
				echo json_encode(array('status' => '3','list' => $list));
    		}else{
    			echo "1";
    		}
    	}else{
    		echo "0";
    	}
    }
    function buttonDelete($id=null){
    	if($id!=null){
    		echo "<button class='btn btn-danger' onclick='delRow(".$id.")'>YA</button>";
    	}else{
    		echo "NOT FOUND";
    	}
    }
    
    
}