<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Pegawailevelmodel');
    }
    function index(){
    	$dataSelect['deleted'] = 1;
    	$data['list'] = json_encode($this->Pegawailevelmodel->select($dataSelect, 'm_pegawai_level')->result());
		//echo $data;
		//print_r($data);
    	$this->load->view('Pegawai_level/view', $data);
    }
	
	function test(){
		header('Content-Type: application/json; charset=utf-8');
		$dataSelect['deleted'] = 1;
		$list = $this->Pegawailevelmodel->select($dataSelect, 'm_pegawai_level')->result();
		echo json_encode(array('status' => '3','list' => $list));
	}
	
    function add(){
		$params = $this->input->post();
		$dataInsert['nama'] 			= $params['nama'];
		$dataInsert['deleted'] 			= 1;
		$checkData = $this->Pegawailevelmodel->select($dataInsert, 'm_pegawai_level');
		if($checkData->num_rows() < 1){
			$insert = $this->Pegawailevelmodel->insert($dataInsert, 'm_pegawai_level');
			if($insert){
				$dataSelect['deleted'] = 1;
				$list = $this->Pegawailevelmodel->select($dataSelect, 'm_pegawai_level')->result();
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
    		$selectData = $this->Pegawailevelmodel->select($dataSelect, 'm_pegawai_level');
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
		$checkData = $this->Pegawailevelmodel->select($dataCondition, 'm_pegawai_level');
		if($checkData->num_rows() > 0){
			$update = $this->Pegawailevelmodel->update($dataCondition, $dataUpdate, 'm_pegawai_level');
			if($update){
				$dataSelect['deleted'] = 1;
				$list = $this->Pegawailevelmodel->select($dataSelect, 'm_pegawai_level')->result();
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
    		$update = $this->Pegawailevelmodel->update($dataCondition, $dataUpdate, 'm_pegawai_level');
    		if($update){
    			$dataSelect['deleted'] = 1;
				$list = $this->Pegawailevelmodel->select($dataSelect, 'm_pegawai_level')->result();
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