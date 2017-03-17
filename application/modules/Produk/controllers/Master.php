<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Produkmodel');
    }
    function index(){
    	$dataSelect['deleted'] = 1;
        $data['list_supplier'] = json_encode($this->Produkmodel->select($dataSelect, 'm_supplier_produk')->result());
        $data['list_satuan'] = json_encode($this->Produkmodel->select($dataSelect, 'm_satuan')->result());
        $data['list_gudang'] = json_encode($this->Produkmodel->select($dataSelect, 'm_gudang')->result());
        $data['list_kategori'] = json_encode($this->Produkmodel->select($dataSelect, 'm_produk_kategori')->result());
        $data['list_bahan'] = json_encode($this->Produkmodel->select($dataSelect, 'm_produk_bahan')->result());
        $data['list_katalog'] = json_encode($this->Produkmodel->select($dataSelect, 'm_produk_katalog')->result());
        
        $data['list_ukuran'] = json_encode($this->Produkmodel->select($dataSelect, 'm_produk_ukuran')->result());
        $data['list_warna'] = json_encode($this->Produkmodel->select($dataSelect, 'm_produk_warna')->result());

        $data['list_det_ukuran'] = json_encode($this->Produkmodel->get('m_produk_det_ukuran')->result());
        $data['list_det_warna'] = json_encode($this->Produkmodel->get('m_produk_det_warna')->result());

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
            $sql.=" AND ( nama LIKE '%".$requestData['search']['value']."%' "; 
            $sql.=" OR sku LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR kode_barang LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR stok LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR date_add LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR date_add LIKE '%".$requestData['search']['value']."%' )";
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
                .'<a id="group'.$row["id"].'" class="divpopover btn btn-sm btn-default" href="javascript:void(0)" data-toggle="popover" data-placement="top" onclick="confirmDelete(this)" data-html="true" title="Hapus Data?" ><i class="fa fa-times"></i></a>'
                .'<a class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Ubah Data" onclick="showUpdate('.$row["id"].')"><i class="fa fa-pencil"></i></a>'
                .'<a class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Lihat Detail" onclick="showDetail('.$row["id"].')"><i class="fa fa-eye"></i></a>'
                .'<a class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Lihat Harga" onclick="showHarga('.$row["id"].')"><i class="fa fa-money"></i></a>'
               .'</div>'
            .'</td>';
            
            $data[] = $nestedData; $i++;
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
        $id = (!empty($params['id'])) ? $params['id'] : $this->Produkmodel->get_last_id("m_produk") + 1;

        $dataInsert['nama']             = $params['nama'];
        $dataInsert['id_supplier']      = $params['id_supplier'];
        $dataInsert['id_satuan']        = $params['id_satuan'];
        $dataInsert['id_gudang']        = $params['id_gudang'];
        $dataInsert['id_kategori']      = $params['id_kategori'];
        $dataInsert['id_bahan']         = $params['id_bahan'];
        $dataInsert['id_katalog']       = $params['id_katalog'];
        $dataInsert['id_katalog']       = $params['id_katalog'];
        $dataInsert['sku']              = $params['sku'];
        $dataInsert['kode_barang']      = $params['kode_barang'];
        $dataInsert['berat']            = $params['berat'];
        $dataInsert['harga_beli']       = $params['harga_beli'];
        // $dataInsert['versi_foto']       = $params['versi_foto'];
        $dataInsert['deskripsi']        = $params['deskripsi'];
        $dataInsert['foto']             = $this->proses_foto($id);
        $dataInsert['last_edited']      = date("Y-m-d H:i:s");
        $dataInsert['add_by']           = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
        $dataInsert['edited_by']        = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
        $dataInsert['deleted']          = 1;

        $checkData = $this->Produkmodel->select($dataInsert, 'm_produk');
        if($checkData->num_rows() < 1){
            $insert = $this->Produkmodel->insert_id($dataInsert, 'm_produk');
            if($insert){
                $this->insert_detail($insert, $params['id_ukuran'], "ukuran");
                $this->insert_detail($insert, $params['id_warna'], "warna");
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
	
    function last_id() {
        echo "<script>console.log(".$this->Produkmodel->get_last_id("m_produk").");</script>";
    }
    function edit(){
		$params = $this->input->post();
        $id = (!empty($params['id'])) ? $params['id'] : $this->Produkmodel->get_last_id("m_produk") + 1;

		$dataCondition['id']			= $params['id'];
		$dataUpdate['nama'] 			= $params['nama'];
        $dataUpdate['id_supplier']      = $params['id_supplier'];
        $dataUpdate['id_satuan']        = $params['id_satuan'];
        $dataUpdate['id_gudang']        = $params['id_gudang'];
        $dataUpdate['id_kategori']      = $params['id_kategori'];
        $dataUpdate['id_bahan']         = $params['id_bahan'];
        $dataUpdate['id_katalog']       = $params['id_katalog'];
        $dataUpdate['id_katalog']       = $params['id_katalog'];
        $dataUpdate['sku']              = $params['sku'];
        $dataUpdate['kode_barang']      = $params['kode_barang'];
        $dataUpdate['berat']            = $params['berat'];
        $dataUpdate['harga_beli']       = $params['harga_beli'];
        // $dataUpdate['versi_foto']       = $params['versi_foto'];
        $dataUpdate['deskripsi']        = $params['deskripsi'];
        $dataUpdate['foto']             = $this->proses_foto($id);
        $dataUpdate['last_edited']      = date("Y-m-d H:i:s");
        $dataUpdate['edited_by']        = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
        
		$checkData = $this->Produkmodel->select($dataCondition, 'm_produk');
		if($checkData->num_rows() > 0){
			$update = $this->Produkmodel->update($dataCondition, $dataUpdate, 'm_produk');
            $this->insert_detail($params['id'], $params['id_ukuran'], "ukuran");
            $this->insert_detail($params['id'], $params['id_warna'], "warna");
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
    
    private function insert_detail($id_produk, $data, $table) {
        if(!empty($table) AND !empty($data)) {
            //check if id_produk exist in m_produk_det_ tables
            $dataInsert = array();
            $dataCondition['id_produk'] = $id_produk;
            $checkData = $this->Produkmodel->select($dataCondition, 'm_produk_det_'.$table);
            if($checkData->num_rows() > 0) {
                //Delete old data first
                $this->Produkmodel->delete($dataCondition, 'm_produk_det_'.$table);       
            }
            
            //Then insert new data       
            foreach ($data as $key=>$value) {
                $dataInsert[] = array(
                        'id_produk' => $id_produk,
                        'id_'.$table => $value
                    );
            } // print_r($dataInsert);
            $this->Produkmodel->insert_batch($dataInsert, 'm_produk_det_'.$table);
        }
    }
    private function proses_foto($id) {
        $date = date("dmY"); $time = date("His");
        $input_name = 'foto';

        $tipe = $this->cek_tipe($_FILES[$input_name]['type']);
        $img_path = URL_UPLOAD."produk/";
        $img_name = "productImage".$id.$tipe;

        $config['overwrite'] = true;
        $config['upload_path'] = $img_path;
        $config['allowed_types'] = "png|jpg";
        $config['file_name'] = $img_name;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($input_name)) 
        {
            $error = array('error' => $this->upload->display_errors());
            $this->upload->display_errors();
        }
        else {
            $file_data = $this->upload->data();
            $upload_data['file_name'] = $file_data['file_name'];
            $upload_data['created'] = date("Y-m-d H:i:s");
            $upload_data['modified'] = date("Y-m-d H:i:s");
            //echo $upload data if you want to see the file information
        }

        return $img_name;
    }
    private function cek_tipe($tipe)
    {
        if ($tipe == 'image/jpeg') 
            { return ".jpg"; }
        else if($tipe == 'image/png') 
            { return ".png"; }
        else 
            { return false; }
    }   
    
}