<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends MX_Controller {
	function __construct() {
        parent::__construct();
        //check_auth()
        $this->checksession();
        $this->load->model('Pegawaimodel');
    }
    function checksession(){
        if($this->session->userdata("isLoggedin") != 1){
            //tampilkan logout. rdirect login
        }
    }
    function index(){
    	$dataSelect['deleted'] = 1;
        $data['list_prov'] = json_encode($this->Pegawaimodel->select($dataSelect, 'm_provinsi')->result());
    	$data['list_kota'] = json_encode($this->Pegawaimodel->select($dataSelect, 'm_kota')->result());
        $data['list_level'] = json_encode($this->Pegawaimodel->select($dataSelect, 'm_pegawai_level')->result());
    	$data['list'] = json_encode($this->Pegawaimodel->select($dataSelect, 'm_pegawai')->result());
		//echo $data;
		//print_r($data);
    	$this->load->view('Pegawai/view', $data);
    }
	
	function test(){
		header('Content-Type: application/json; charset=utf-8');
		$dataSelect['deleted'] = 1;
		$list = $this->Pegawaimodel->select($dataSelect, 'm_pegawai')->result();
		echo json_encode(array('status' => '3','list' => $list));
	}
	
    function add(){
		$params = $this->input->post();
		$dataInsert['nama'] 			= $params['nama'];
		$dataInsert['alamat'] 			= $params['alamat'];
		$dataInsert['no_telp'] 			= $params['no_telp'];
		$dataInsert['email'] 			= $params['email'];
		$dataInsert['password'] 		= hash('sha512',$params['password']);
		$dataInsert['kode_pos'] 		= $params['kodepos'];
		$dataInsert['id_provinsi'] 		= $params['id_provinsi'];
		$dataInsert['id_kota'] 			= $params['id_kota'];
		$dataInsert['id_pegawai_level'] = $params['id_pegawai_level'];
		$dataInsert['deleted'] 			= 1;
		$checkData = $this->Pegawaimodel->select($dataInsert, 'm_pegawai');
		if($checkData->num_rows() < 1){
			$insert = $this->Pegawaimodel->insert($dataInsert, 'm_pegawai');
			if($insert){
				$dataSelect['deleted'] = 1;
				$list = $this->Pegawaimodel->select($dataSelect, 'm_pegawai')->result();
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
    		$selectData = $this->Pegawaimodel->select($dataSelect, 'm_pegawai');
    		if($selectData->num_rows() > 0){
    			echo json_encode(
    				array(
    					'status'			=> 2,
    					'id'				=> $selectData->row()->id,
    					'nama'				=> $selectData->row()->nama,
    					'alamat'			=> $selectData->row()->alamat,
    					'no_telp'			=> $selectData->row()->no_telp,
    					'email'				=> $selectData->row()->email,
    					'kode_pos'			=> $selectData->row()->kode_pos,
    					'id_provinsi'		=> $selectData->row()->id_provinsi,
    					'id_kota'			=> $selectData->row()->id_kota,
    					'id_pegawai_level'	=> $selectData->row()->id_pegawai_level
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
		$dataUpdate['alamat'] 			= $params['alamat'];
		$dataUpdate['no_telp'] 			= $params['no_telp'];
		$dataUpdate['email'] 			= $params['email'];
		$dataUpdate['kode_pos'] 		= $params['kodepos'];
		$dataUpdate['id_provinsi'] 		= $params['id_provinsi'];
		$dataUpdate['id_kota'] 			= $params['id_kota'];
        $dataUpdate['id_pegawai_level'] = $params['id_pegawai_level'];
        if(isset($params['password'])) {
		  $dataUpdate['password'] = hash('sha512', $params['password']);
        }
		$checkData = $this->Pegawaimodel->select($dataCondition, 'm_pegawai');
		if($checkData->num_rows() > 0){
			$update = $this->Pegawaimodel->update($dataCondition, $dataUpdate, 'm_pegawai');
			if($update){
				$dataSelect['deleted'] = 1;
				$list = $this->Pegawaimodel->select($dataSelect, 'm_pegawai')->result();
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
    		$update = $this->Pegawaimodel->update($dataCondition, $dataUpdate, 'm_pegawai');
    		if($update){
    			$dataSelect['deleted'] = 1;
				$list = $this->Pegawaimodel->select($dataSelect, 'm_pegawai')->result();
				echo json_encode(array('status' => '3','list' => $list));
    		}else{
    			echo "1";
    		}
    	}else{
    		echo "0";
    	}
    }
    function reset_password(){
        $params = $this->input->post();
        $dataCondition['id']    = $params['id'];
        $dataUpdate['password'] = hash('sha512', 'admin'); //default password
        $checkData = $this->Pegawaimodel->select($dataCondition, 'm_pegawai');
        if($checkData->num_rows() > 0){
            $update = $this->Pegawaimodel->update($dataCondition, $dataUpdate, 'm_pegawai');
            if($update){
                $dataSelect['deleted'] = 1;
                $list = $this->Pegawaimodel->select($dataSelect, 'm_pegawai')->result();
                echo json_encode(array('status' => '3','list' => $list));
            }else{
                echo json_encode(array( 'status'=>'2' ));
            }
        }else{          
            echo json_encode(array( 'status'=>'1' ));
        }
    }
    function buttonDelete($id=null){
    	if($id!=null){
    		echo "<button class='btn btn-danger' onclick='delRow(".$id.")'>YA</button>";
    	}else{
    		echo "NOT FOUND";
    	}
    }
   
    function get_kota(){
        $dataSelect['id_provinsi'] = $this->input->get("id_prov");
        $dataSelect['deleted'] = 1;
        echo json_encode($this->Pegawaimodel->select($dataSelect, 'm_kota')->result());
    }

}