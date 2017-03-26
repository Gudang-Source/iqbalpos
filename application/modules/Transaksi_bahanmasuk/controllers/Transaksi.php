<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Transaksibahanmasukmodel');
    }
    function index(){
    	$this->load->view('Transaksi_bahanmasuk/view');
    }
    function data(){
		$requestData= $_REQUEST;
		$columns = array( 
			0 	=>	'id_supplier_bahan', 
			1 	=> 	'satuan',
			2 	=> 	'gudang',
			3 	=> 	'nama',
			4 	=> 	'sku',
			5 	=> 	'deskripsi',
			6 	=> 	'harga_beli',
			7 	=> 	'stok',
			8	=> 	'last_edited',
			9	=> 	'date_add',
			10	=> 	'aksi'
		);
		$sql = " SELECT m_bahan.*, m_supplier_bahan.nama as namasup, m_satuan.nama as namasat, m_gudang.nama as namagud";
		$sql.= " FROM m_bahan ";
		$sql.= " LEFT JOIN m_supplier_bahan ON m_bahan.id_supplier_bahan = m_supplier_bahan.id ";
		$sql.= " LEFT JOIN m_satuan ON m_bahan.id_satuan = m_satuan.id ";
		$sql.= " LEFT JOIN m_gudang ON m_bahan.id_gudang = m_gudang.id ";
		$query=$this->Transaksibahanmasukmodel->rawQuery($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;
		$sql.=" WHERE m_bahan.deleted=1 ";
		if( !empty($requestData['search']['value']) ) {
			$sql.=" AND ( m_bahan.id_supplier LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR m_bahan.deskripsi LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_bahan.nama LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_bahan.harga_beli LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_bahan.stok LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_bahan.date_add LIKE '".$requestData['search']['value']."%' )";
		}
		$query=$this->Transaksibahanmasukmodel->rawQuery($sql);
		$totalFiltered = $query->num_rows();
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
		$query=$this->Transaksibahanmasukmodel->rawQuery($sql);
		$data = array();
		foreach ($query->result_array() as $row) {
			$nestedData		=	array(); 

			$nestedData[] 	= 	$row["namasup"];
			$nestedData[] 	= 	$row["namasat"];
			$nestedData[] 	= 	$row["namagud"];
			$nestedData[] 	= 	$row["nama"];
			$nestedData[] 	= 	$row["sku"];
			$nestedData[] 	= 	$row["deskripsi"];
			$nestedData[] 	= 	$row["harga_beli"];
			$nestedData[] 	= 	$row["stok"];
			$nestedData[] 	= 	$row["last_edited"];
			$nestedData[] 	= 	$row["date_add"];
			$nestedData[] 	= 	"<button onclick=tambahStok('".$row['id']."') class='btn btn-success'>TAMBAH STOK</button><button onclick=kurangStok('".$row['id']."') class='btn btn-success'>KURANGI STOK</button>";
			
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
    function ubahStok(){
    	$params = $this->input->post();
    	if($params != null){
    		$dataUpdate = array();
    		$dataInsert = array();
    		$dataCondition['id'] = $params['idProduk'];
    		$state 	= 	$params['state'];
    		$qty	=	$params['qty'];
    		$dataStok = $this->Transaksibahanmasukmodel->select($dataCondition, 'm_bahan');
    		$lastStok = $dataStok->row()->stok;
    		$dateNow = date('Y-m-d H:i:s');

    		$dataUpdate['edited_by']	=	0;

    		$dataInsert['id_bahan']	=	$params['idProduk'];
    		$dataInsert['last_edited']	=	$dateNow;
    		$dataInsert['edited_by']	=	0;
    		$dataInsert['jumlah']		=	$qty;
    		$dataInsert['deleted']		=	1;

    		if ($state == "kurang") {
    			if ($lastStok < $qty) {
    				echo json_encode(array("status"=>0));
    				exit();
    			}else{
    				$dataUpdate['tanggal_kurang_stok'] = $dateNow;
    				$dataUpdate['last_edited'] = $dateNow;
    				$dataUpdate['stok'] = $lastStok - $qty;
    				$dataInsert['status'] = 3;
    				$dataInsert['stok_akhir'] = $lastStok - $qty;
					$dataInsert['keterangan'] = "DIKURANG MANUAL";
    			}
    		}else if($state == "tambah"){
				$dataUpdate['tanggal_tambah_stok'] = $dateNow;
				$dataUpdate['last_edited'] = $dateNow;
				$dataUpdate['stok'] = $lastStok + $qty;
				$dataInsert['status'] = 4;
				$dataInsert['stok_akhir'] = $lastStok + $qty;
				$dataInsert['keterangan'] = "DITAMBAH MANUAL";
    		}
    		$updateProduk = $this->Transaksibahanmasukmodel->update($dataCondition, $dataUpdate, 'm_bahan');
    		if($updateProduk){
    			$insertHistori = $this->Transaksibahanmasukmodel->insert($dataInsert, 'h_stok_bahan');
    			if($insertHistori){
    				echo json_encode(array("status"=>1));
    			}else{
    				echo json_encode(array("status"=>0));
    			}
    		}else{
    			echo json_encode(array("status"=>0));
    		}
    	}
    }
}