<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends MX_Controller {
    private $modul = "Transaksi_barangmasuk/";
    private $fungsi = "";    
	function __construct() {
        parent::__construct();
        $this->load->model('Transaksibarangmasukmodel');
        $this->modul .= $this->router->fetch_class();
        $this->fungsi = $this->router->fetch_method();
        $this->_insertLog();
    }
    function _insertLog($fungsi = null){
        $id_user = $this->session->userdata('id_user');
        $dataInsert['id_user'] = $id_user;
        $dataInsert['modul'] = $this->modul;
        $dataInsert['fungsi'] = $this->fungsi;
        $insertLog = $this->Transaksibarangmasukmodel->insert($dataInsert, 't_log');        
    }  
    function index(){
    	$this->load->view('Transaksi_barangmasuk/view');
    }
    function data(){
		$requestData= $_REQUEST;
		$columns = array( 
			0 	=>	'id_supplier', 
			1 	=> 	'satuan',
			2 	=> 	'gudang',
			3 	=> 	'bahan',
			4 	=> 	'nama',
			5 	=> 	'sku',
			6 	=> 	'deskripsi',
			7 	=> 	'harga_beli',
			8 	=> 	'stok',
			9	=> 	'last_edited',
			10	=> 	'date_add',
			11	=> 	'aksi'
		);
		$sql = " SELECT m_produk.*, m_supplier_produk.nama as namasup, m_satuan.nama as namasat, m_gudang.nama as namagud, m_produk_bahan.nama as namabah";
		$sql.= " FROM m_produk ";
		$sql.= " LEFT JOIN m_supplier_produk ON m_produk.id_supplier = m_supplier_produk.id ";
		$sql.= " LEFT JOIN m_satuan ON m_produk.id_satuan = m_satuan.id ";
		$sql.= " LEFT JOIN m_gudang ON m_produk.id_gudang = m_gudang.id ";
		$sql.= " LEFT JOIN m_produk_bahan ON m_produk.id_bahan = m_produk_bahan.id ";
		$query=$this->Transaksibarangmasukmodel->rawQuery($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;
		// $sql = "SELECT * ";
		$sql.=" WHERE m_produk.deleted=1 ";
		if( !empty($requestData['search']['value']) ) {
			$sql.=" AND ( m_produk.id_supplier LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR m_produk.deskripsi LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.nama LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.harga_beli LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.stok LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.date_add LIKE '".$requestData['search']['value']."%' )";
		}
		$query=$this->Transaksibarangmasukmodel->rawQuery($sql);
		$totalFiltered = $query->num_rows();
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
		$query=$this->Transaksibarangmasukmodel->rawQuery($sql);
		$data = array();
		foreach ($query->result_array() as $row) {
			$nestedData		=	array(); 

			$nestedData[] 	= 	$row["namasup"];
			$nestedData[] 	= 	$row["namasat"];
			$nestedData[] 	= 	$row["namagud"];
			$nestedData[] 	= 	$row["namabah"];
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
    		$dataStok = $this->Transaksibarangmasukmodel->select($dataCondition, 'm_produk');
    		$lastStok = $dataStok->row()->stok;
    		$dateNow = date('Y-m-d H:i:s');

    		$dataUpdate['edited_by']	=	isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;

    		$dataInsert['id_produk']	=	$params['idProduk'];
    		$dataInsert['id_order_detail']	=	0;
    		$dataInsert['id_service']	=	0;
    		$dataInsert['last_edited']	=	$dateNow;
    		$dataInsert['edited_by']	=	isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
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
    		$updateProduk = $this->Transaksibarangmasukmodel->update($dataCondition, $dataUpdate, 'm_produk');
    		if($updateProduk){
    			$insertHistori = $this->Transaksibarangmasukmodel->insert($dataInsert, 'h_stok_produk');
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