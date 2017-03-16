<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Transaksiservicemodel');
    }
    function index(){
    	$this->load->view('Transaksi_service/view');
    }
    function data(){
		$requestData= $_REQUEST;
		$columns = array( 
			0 	=>	'id_supplier', 
			1 	=> 	'catatan',
			2	=> 	'jumlah_barang_service',
			3	=> 	'total_harga',
			4	=> 	'jumlah_barang_kembali',
			5	=> 	'jumlah_uang_kembali',
			6	=> 	'status',
			7	=> 	'date_add',
			7	=> 	'aksi'
		);
		$sql = "SELECT * ";
		$sql.=" FROM t_service";
		$query=$this->Transaksiservicemodel->rawQuery($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;
		$sql = "SELECT * ";
		$sql.=" FROM t_service WHERE 1=1";
		if( !empty($requestData['search']['value']) ) {
			$sql.=" AND ( id_supplier LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR catatan LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR jumlah_barang_service LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR total_harga LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR jumlah_barang_kembali LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR jumlah_uang_kembali LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR status LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR date_add LIKE '".$requestData['search']['value']."%' )";
		}
		$query=$this->Transaksiservicemodel->rawQuery($sql);
		$totalFiltered = $query->num_rows();
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
		$query=$this->Transaksiservicemodel->rawQuery($sql);
		$data = array();
		foreach ($query->result_array() as $row) {
			$nestedData		=	array(); 

			$nestedData[] 	= 	$row["id_supplier"];
			$nestedData[] 	= 	$row["catatan"];
			$nestedData[] 	= 	$row["jumlah_barang_service"];
			$nestedData[] 	= 	$row["total_harga"];
			$nestedData[] 	= 	$row["jumlah_barang_kembali"];
			$nestedData[] 	= 	$row["jumlah_uang_kembali"];
			$nestedData[] 	= 	$row["status"];
			$nestedData[] 	= 	$row["date_add"];
			$nestedData[] 	= 	"<button>CONFIRM</button>";
			
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
}