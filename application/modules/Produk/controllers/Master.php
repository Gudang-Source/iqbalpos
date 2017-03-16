<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Produkmodel');
    }
    function index(){
    	$dataSelect['deleted'] = 1;
    	$data['list'] = json_encode($this->Produkmodel->select($dataSelect, 'm_produk')->result());
		//echo $data;
		//print_r($data);
    	$this->load->view('Produk/view', $data);
    }

    function data(){
        $requestData= $_REQUEST;
        $columns = array( 
            0   =>  'nama', 
            1   =>  'sku',
            2   =>  'kode_barang',
            3   =>  'stok',
            4   =>  'date_add',
            5   =>  'aksi'
        );
        $sql = "SELECT * ";
        $sql.=" FROM t_service";
        $query=$this->Produkmodel->rawQuery($sql);
        $totalData = $query->num_rows();
        $totalFiltered = $totalData;
        $sql = "SELECT * ";
        $sql.=" FROM m_produk WHERE deleted = 1";
        if( !empty($requestData['search']['value']) ) {
            $sql.=" AND ( nama LIKE '".$requestData['search']['value']."%' "; 
            $sql.=" OR sku LIKE '".$requestData['search']['value']."%' ";
            $sql.=" OR kode_barang LIKE '".$requestData['search']['value']."%' ";
            $sql.=" OR stok LIKE '".$requestData['search']['value']."%' ";
            $sql.=" OR date_add() LIKE '".$requestData['search']['value']."%' ";
            $sql.=" OR date_add LIKE '".$requestData['search']['value']."%' )";
        }
        $query=$this->Produkmodel->rawQuery($sql);
        $totalFiltered = $query->num_rows();

        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
        $query=$this->Produkmodel->rawQuery($sql);
        
        $data = array(); $i=0;
        foreach ($query->result_array() as $row) {
            $nestedData     =   array(); 
            $nestedData[]   =   $row["nama"];
            $nestedData[]   =   $row["sku"];
            $nestedData[]   =   $row["kode_barang"];
            $nestedData[]   =   $row["stok"];
            $nestedData[]   =   date("d-m-Y H:i", strtotime($row["date_add"]));
            $nestedData[]   .=   '<td class="text-center"><div class="btn-group" >'
                .'<a id="group'.$i.'" class="divpopover btn btn-sm btn-default" href="javascript:void(0)" data-toggle="popover" data-placement="top" onclick="confirmDelete(this)" data-html="true" title="Hapus Data?" ><i class="fa fa-times"></i></a>'
                .'<a class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Ubah Data" onclick="showUpdate('.$i.')"><i class="fa fa-pencil"></i></a>'
               .'</div>'
            .'</td>';
            
            $data[] = $nestedData;
        }
        $json_data = array(
                    "draw"            => intval( $requestData['draw'] ),
                    "recordsTotal"    => intval( $totalData ),
                    "recordsFiltered" => intval( $totalFiltered ),
                    "data"            => $data
                    );
        echo json_encode($json_data);
    }
	
	function test(){
		header('Content-Type: application/json; charset=utf-8');
		$dataSelect['deleted'] = 1;
		$list = $this->Produkmodel->select($dataSelect, 'm_produk')->result();
		echo json_encode(array('status' => '3','list' => $list));
	}
	
    function add(){
		$params = $this->input->post();
		$dataInsert['nama'] 			= $params['nama'];
        $dataInsert['last_edited']      = date("Y-m-d H:i:s");
        $dataInsert['add_by']           = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
        $dataInsert['edited_by']        = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
		$dataInsert['deleted'] 			= 1;

		$checkData = $this->Produkmodel->select($dataInsert, 'm_produk');
		if($checkData->num_rows() < 1){
			$insert = $this->Produkmodel->insert($dataInsert, 'm_produk');
			if($insert){
				$dataSelect['deleted'] = 1;
				$list = $this->Produkmodel->select($dataSelect, 'm_produk')->result();
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
    		$selectData = $this->Produkmodel->select($dataSelect, 'm_produk');
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
        
		$checkData = $this->Produkmodel->select($dataCondition, 'm_produk');
		if($checkData->num_rows() > 0){
			$update = $this->Produkmodel->update($dataCondition, $dataUpdate, 'm_produk');
			if($update){
				$dataSelect['deleted'] = 1;
				$list = $this->Produkmodel->select($dataSelect, 'm_produk')->result();
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
    		$update = $this->Produkmodel->update($dataCondition, $dataUpdate, 'm_produk');
    		if($update){
    			$dataSelect['deleted'] = 1;
				$list = $this->Produkmodel->select($dataSelect, 'm_produk')->result();
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