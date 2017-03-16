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

    function get_data() { //Untuk datatables serverside
        $params = $this->input->post();
        //field yang akan ditampilkan
        // $columns = array( 'nama', 'sku', 'kode_barang', 'stok', 'date_add');
        $columns = array( 
            0 => 'nama',
            1 => 'sku', 
            2 => 'kode_barang',
            3 => 'stok',
            4 => 'date_add'
        );

        // check search value exist
        $where = $sqlTot = $sqlRec = "";
        if( !empty($params['search']['value']) ) {   
            $where .=" WHERE ";
            $where .=" ( nama LIKE '".$params['search']['value']."%' ";    
            $where .=" OR sku LIKE '".$params['search']['value']."%' ";
            $where .=" OR kode_barang LIKE '".$params['search']['value']."%' )";
            $where .=" OR date_add LIKE '".$params['search']['value']."%' )";
        }

        // getting total number records without any search
        $sql = "SELECT * FROM `m_produk` ";
        $sqlTot .= $sql;
        $sqlRec .= $sql;
        //concatenate search sql if value exist
        if(isset($where) && $where != '') {
            $sqlTot .= $where;
            $sqlRec .= $where;
        }

        $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

        $queryTot = $this->Produkmodel->rawQuery($sqlRec);

        $totalRecords = $queryTot->num_rows();

        // $queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");

        //iterate on results row and create new index array of data
        $data = $queryTot->row_array();

        $json_data = array(
                "draw"            => intval( $params['draw'] ),   
                "recordsTotal"    => intval( $totalRecords ),  
                "recordsFiltered" => intval($totalRecords),
                "data"            => $data   // total data array
                );

        echo json_encode($json_data);  // send data as json format

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