<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Satuanmodel');
    }
    function index(){
    	$dataSelect['deleted'] = 1;
    	$data['list'] = json_encode($this->Satuanmodel->select($dataSelect, 'm_satuan')->result());
		//echo $data;
		//print_r($data);
    	$this->load->view('Satuan/view', $data);
    }
	
	function test(){
		header('Content-Type: application/json; charset=utf-8');
		$dataSelect['deleted'] = 1;
		$list = $this->Satuanmodel->select($dataSelect, 'm_satuan')->result();
		echo json_encode(array('status' => '3','list' => $list));
	}
	
    function add(){
		$params = $this->input->post();
		$dataInsert['nama'] 			= $params['nama'];
		$dataInsert['deleted'] 			= 1;
		$checkData = $this->Satuanmodel->select($dataInsert, 'm_satuan');
		if($checkData->num_rows() < 1){
			$insert = $this->Satuanmodel->insert($dataInsert, 'm_satuan');
			if($insert){
				$dataSelect['deleted'] = 1;
				$list = $this->Satuanmodel->select($dataSelect, 'm_satuan')->result();
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
    		$selectData = $this->Satuanmodel->select($dataSelect, 'm_satuan');
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
		$checkData = $this->Satuanmodel->select($dataCondition, 'm_satuan');
		if($checkData->num_rows() > 0){
			$update = $this->Satuanmodel->update($dataCondition, $dataUpdate, 'm_satuan');
			if($update){
				$dataSelect['deleted'] = 1;
				$list = $this->Satuanmodel->select($dataSelect, 'm_satuan')->result();
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
    		$update = $this->Satuanmodel->update($dataCondition, $dataUpdate, 'm_satuan');
    		if($update){
    			$dataSelect['deleted'] = 1;
				$list = $this->Satuanmodel->select($dataSelect, 'm_satuan')->result();
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