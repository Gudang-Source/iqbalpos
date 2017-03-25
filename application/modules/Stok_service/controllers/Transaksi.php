<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Transaksiservicemodel');
    }
    function index(){
    	$this->load->view('Stok_service/view');
    }
    function detail($id = 0){
    	$data['id'] = $id;
    	$this->load->view('Stok_service/detail', $data);
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
		$sql = "SELECT t_service.*, m_supplier_produk.nama as namasup ";
		$sql.=" FROM t_service";
		$sql.=" INNER JOIN m_supplier_produk ON t_service.id_supplier = m_supplier_produk.id";
		$query=$this->Transaksiservicemodel->rawQuery($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;
		// $sql = "SELECT * ";
		$sql.=" WHERE t_service.deleted=1 ";
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

			$nestedData[] 	= 	$row["namasup"];
			$nestedData[] 	= 	$row["catatan"];
			$nestedData[] 	= 	$row["jumlah_barang_service"];
			$nestedData[] 	= 	$row["total_harga"];
			$nestedData[] 	= 	$row["jumlah_barang_kembali"];
			$nestedData[] 	= 	$row["jumlah_uang_kembali"];
			$nestedData[] 	= 	$row["status"];
			$nestedData[] 	= 	$row["date_add"];
			$nestedData[] 	= 	"<button onclick=detail('".$row['id']."') class='btn btn-success'>CONFIRM</button>";
			
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
    function data_detail($id_service){
		$requestData= $_REQUEST;
		$columns = array( 
			0 	=>	'id_service', 
			1 	=> 	'produk',
			2	=> 	'sku',
			3	=> 	'barang_diservis',
			4	=> 	'barang_kembali',
			5	=> 	'uang_kembali',
			6	=> 	'status'
		);
		$sql = "SELECT 
					t_service.id as sid,
					t_service_detail.id as sdid, 
					t_service_detail.jumlah as sdjm,
					t_service_detail.jumlah_barang_kembali as sdjbk, 
					t_service_detail.uang_kembali as sdjuk, 
					t_service_detail.status as sdst, 
					m_produk.nama as nama,
					m_produk.sku as sku";
		$sql.=" FROM t_service";
		// $query=$this->Transaksiservicemodel->rawQuery($sql);
		// $sql = "SELECT * ";
		$sql.=" INNER JOIN t_service_detail ON t_service.id = t_service_detail.id_service";
		$sql.=" INNER JOIN m_produk on t_service_detail.id_produk = m_produk.id";
		$sql.=" WHERE t_service.deleted=1 ";
		$sql.=" AND t_service_detail.id_service=".$id_service;
		// if( !empty($requestData['search']['value']) ) {
		// 	$sql.=" AND (m_produk.nama LIKE '".$requestData['search']['value']."%' ";
		// 	$sql.=" OR m_produk.sku LIKE '".$requestData['search']['value']."%' ";
		// 	$sql.=" OR m_produk.kode_barang LIKE '".$requestData['search']['value']."%' ";
		// 	$sql.=" OR m_produk.deskripsi LIKE '".$requestData['search']['value']."%' ) ";
		// }
		$query=$this->Transaksiservicemodel->rawQuery($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;		
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
		$query=$this->Transaksiservicemodel->rawQuery($sql);
		$totalFiltered = $query->num_rows();
		$data = array();
		$i=1;
		foreach ($query->result_array() as $row) {
			$nestedData		=	array(); 

			$nestedData[] 	= 	$i;
			$nestedData[] 	= 	$row["nama"];
			$nestedData[] 	= 	$row["sku"];
			$nestedData[] 	= 	$row["sdjm"];
			$nestedData[] 	= 	$row['sdst']==1?"<input type='text' id='jbk-".$row['sdid']."' value='".$row["sdjbk"]."'  maxlength='2' class='form-control nopadding productNum' style='width: 50%' oninput=confirm('".$row['sdid']."') />":$row["sdjbk"];
			$nestedData[] 	= 	$row['sdst']==1?"<input maxlength='2' class='form-control nopadding productNum' type='text' id='juk-".$row['sdid']."' value='".$row["sdjuk"]."' style='width: 50%' oninput=confirm('".$row['sdid']."') />":$row["sdjuk"];
			$status = "";
			$enableButton	=	"";
			switch ($row['sdst']) {
				case 2:
					$status = "DIKEMBALIKAN BARANG";
					$enableButton = "disabled";
					break;
				case 3:
					$status = "DIKEMBALIKAN UANG";
					$enableButton = "disabled";
					break;
				case 4:
					$status = "DIKEMBALIKAN UANG DAN BARANG";
					$enableButton = "disabled";
					break;
				default:
					$status  = "<select class='form-control' name='sts' id='sts-".$row['sdid']."' style='width: 100%' onchange=confirm('".$row['sdid']."') >";
					$status .= "<option value='1'>DALAM PROSES</option>";
					$status .= "<option value='2'>BARANG</option>";
					$status .= "<option value='3'>UANG</option>";
					$status .= "<option value='4'>UANG DAN BARANG</option>";
					$status .= "</select>";
					$enableButton = "";
					break;
			}
			$nestedData[] 	= 	$status;		
			$aksi = $enableButton=="disabled"?"CONFIRMED":"<button onclick=confirm('".$row['sdid']."') class='btn btn-success'>CONFIRM</button>";
			$data[] = $nestedData;
			$i++;
		}
		$json_data = array(
					"draw"            => intval( $requestData['draw'] ),
					"recordsTotal"    => intval( $totalData ),
					"recordsFiltered" => intval( $totalFiltered ),
					"data"            => $data
					);
		echo json_encode($json_data);
    }
    function confirm(){
    	$params = $this->input->post();
    	if($params != null){
    		// update t_service_detail
    		// get status stok
    		// get status confirm
    		$dataSelects = explode("_", $params['id']);
    		$dataSelect['id'] = $dataSelects[0];
    		$selectData = $this->Transaksiservicemodel->select($dataSelect, 't_service_detail');

    		$statusStok = $selectData->row()->kurangi_stok;
    		if ($statusStok == 1) {
    			$idProduk = $selectData->row()->id_produk;
    			$dataSelectMaster['id'] = $idProduk;
    			$selectDataMaster = $this->Transaksiservicemodel->select($dataSelectMaster, 'm_produk');
    			
    			$stokKembali = $params['jbk'];
    			$stokGudang = $selectDataMaster->row()->stok;

    			$stokSekarang = $stokGudang + $stokKembali;

    			// update stok master
    			$dataConditionMaster['id'] = $idProduk;
    			$dataUpdateMaster['stok'] = $stokSekarang;
    			$updateDataMaster = $this->Transaksiservicemodel->update($dataConditionMaster, $dataUpdateMaster, 'm_produk');
    			if($updateDataMaster){
    				// insert ke h stok produk
    				$dataInsertHistori['id_produk'] 		= $idProduk;
    				$dataInsertHistori['id_order_detail'] 	= 0;
    				$dataInsertHistori['id_service'] 		= $params['id'];
    				$dataInsertHistori['jumlah']			= $stokKembali;
    				$dataInsertHistori['stok_akhir']		= $stokSekarang;
    				$dataInsertHistori['keterangan']		= "Barang Kembali";
    				$dataInsertHistori['status']			= 5;
    				$dataInsertHistori['add_by']			= 0;
    				$dataInsertHistori['edited_by']			= 0;
    				$dataInsertHistori['deleted']			= 1;
    				$insertHistori = $this->Transaksiservicemodel->insert($dataInsertHistori, 'h_stok_produk');
    				if($insertHistori){
    					// update service detail
    					$dataConditionService['id'] = $dataSelect['id'];
    					$dataUpdateService['uang_kembali']  		= $params['juk'];
    					$dataUpdateService['status']				= $params['sts'];
    					$dataUpdateService['jumlah_barang_kembali']	= $params['jbk'];
    					$updateService = $this->Transaksiservicemodel->update($dataConditionService, $dataUpdateService, 't_service_detail');
    					if($updateService){
    						// get last jumlah_uang_kembali
    						// get last jumlah_barang_kembali
    						$dataSelectTservice['id'] = $selectData->row()->id_service;
    						$selectlastJbk = $this->Transaksiservicemodel->rawQuery("SELECT SUM(jumlah_barang_kembali) as JBK FROM t_service_detail WHERE id_service = ".$selectData->row()->id_service);
    						$lastBarang = $selectlastJbk->row()->JBK;
    						$selectlastJuk = $this->Transaksiservicemodel->rawQuery("SELECT SUM(uang_kembali) as JUK FROM t_service_detail WHERE id_service = ".$selectData->row()->id_service);
    						$lastUang = $selectlastJuk->row()->JUK;

    						$dataConditionTservice['id'] = $selectData->row()->id_service;
    						$dataInsertTservice['jumlah_barang_kembali'] = $lastBarang;
    						$dataInsertTservice['jumlah_uang_kembali'] = $lastUang;
    						$dataInsertTservice['status'] = 2;
    						$updateTservice = $this->Transaksiservicemodel->update($dataConditionTservice, $dataInsertTservice, 't_service');
    						if($updateTservice){    						
	    						echo json_encode(array("status"=>1));
    						}else{
    							echo json_encode(array("status"=>0));
    						}
    					}else{
    						echo json_encode(array("status"=>0));
    					}
    				}
    			}
    		}else{
				$dataConditionService['id'] = $dataSelect['id'];
				$dataUpdateService['uang_kembali']  		= $params['juk'];
				$dataUpdateService['status']				= $params['sts'];
				$dataUpdateService['jumlah_barang_kembali']	= $params['jbk'];
				$updateService = $this->Transaksiservicemodel->update($dataConditionService, $dataUpdateService, 't_service_detail');
				if($updateService){
					// get last jumlah_uang_kembali
					// get last jumlah_barang_kembali
					$dataSelectTservice['id'] = $selectData->row()->id_service;
					$selectlastJbk = $this->Transaksiservicemodel->rawQuery("SELECT SUM(jumlah_barang_kembali) as JBK FROM t_service_detail WHERE id_service = ".$selectData->row()->id_service);
					$lastBarang = $selectlastJbk->row()->JBK;
					$selectlastJuk = $this->Transaksiservicemodel->rawQuery("SELECT SUM(uang_kembali) as JUK FROM t_service_detail WHERE id_service = ".$selectData->row()->id_service);
					$lastUang = $selectlastJuk->row()->JUK;

					$dataConditionTservice['id'] = $selectData->row()->id_service;
					$dataInsertTservice['jumlah_barang_kembali'] = $lastBarang;
					$dataInsertTservice['jumlah_uang_kembali'] = $lastUang;
					$dataInsertTservice['status'] = 2;
					$updateTservice = $this->Transaksiservicemodel->update($dataConditionTservice, $dataInsertTservice, 't_service');
					if($updateTservice){    						
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
    function getOrder(){
    	$data = array();
    	foreach ($this->cart->contents() as $items){
    		$idProduks = explode("_", $items['id']);
    		if(count($idProduks) > 1){			
	    		if($idProduks[1] == "STOKSERVICE"){
		    		$nestedData = array();
		    		$nestedData['id'] = $idProduks;
		    		$nestedData['qty'] = $items['qty'];
		    		$nestedData['price'] = $items['price'];
		    		$nestedData['produk'] = $items['name'];
		    		$nestedData['rowid'] = $items['rowid'];
		    		$nestedData['subtotal'] = $items['subtotal'];
		    		$nestedData['options'] = $items['options']['stok'];
		    		array_push($data, $nestedData);
	    		}
    		}
    	}
    	return json_encode($data);
    }
    function getProduk($supplier = null){
    	$list = null;
    	$dataSelect['deleted'] = 1;
    	// $query = "SELECT * FROM m_produk ";
    	// $query .= "INNER JOIN m_det"
    	if($supplier != null){
    		// $query .= " AND id_supplier = '".$supplier."'"
    		$dataSelect['id_supplier'] = $supplier;
    	}
    	$list = $this->Transaksiservicemodel->select($dataSelect, 'm_produk');
    	return json_encode($list->result_array());
    }
    function getProdukByName($keyword = null, $supplier = null){
    	$list = null;
    	$dataSelect['deleted'] = 1;
    	if($keyword != null && $supplier != null){
    		$dataLike['nama'] = $keyword;
    		$dataCondition['id_supplier'] = $supplier;
    	}
    	$list = $this->Transaksiservicemodel->like($dataCondition, $dataLike, 'm_produk');
    	return json_encode($list->result_array());
    }   
    function getProdukByKategori($supplier = null, $kategori = null, $keyword = null){
    	$list = null;
    	$dataSelect['deleted'] = 1;
    	$dataLike = array();
    	if($supplier != null && $kategori != null){
    		$dataCondition['id_supplier'] = $supplier;
    		$dataCondition['id_kategori'] = $kategori;
    	}
    	if($keyword != null){
    		$dataLike['nama'] = $keyword;
    	}
    	$list = $this->Transaksiservicemodel->like($dataCondition, $dataLike, 'm_produk');
    	return json_encode($list->result_array());
    }   
    function getSupplier(){
    	$dataSelect['deleted'] = 1;
    	return json_encode($this->Transaksiservicemodel->select($dataSelect, 'm_supplier_produk')->result_array());
    }
    function filterProduk($supplier){
    	echo $this->getProduk($supplier);
    }
    function getKategori($supplier){
    	$selectData = $this->Transaksiservicemodel->rawQuery("SELECT m_produk_kategori.id, m_produk_kategori.nama FROM m_produk
    															INNER JOIN m_produk_kategori ON m_produk.id_kategori = m_produk_kategori.id
    															WHERE m_produk.id_supplier=".$supplier."
    															GROUP BY m_produk.id_kategori");
    	echo json_encode($selectData->result_array());
    }
    function filterProdukByName(){
    	$params  = $this->input->post();
    	$keyword = $params['keyword'];
    	$supplier = $params['supplier'];
    	echo $this->getProdukByName($keyword, $supplier);
    }
    function filterProdukByKategori($supplier, $kategori, $keyword = null){
    	echo $this->getProdukByKategori($supplier, $kategori, $keyword);
    }
    function transaksi(){
    	$dataSelect['deleted'] = 1;
    	$data['list_produk'] = $this->getProduk();
        $data['list_order'] = $this->getOrder();
        $data['list_supplier'] = $this->getSupplier();
        $data['total'] = $this->cart->total();
        $data['total_items'] = $this->cart->total_items();
        $data['tax'] = 0;
        $data['discount'] = 0;
    	$this->load->view('Stok_service/transaksi', $data);
    }
    function getTotal(){
    	$total = 0;
    	$total_item = 0;
    	foreach ($this->cart->contents() as $items) {    		
    		$idProduks = explode("_", $items['id']);
    		if(count($idProduks) > 1){
    			if($idProduks[1] == "STOKSERVICE"){
    				$total += $items['price']*$items['qty'];
    				$total_item += $items['qty'];
    			}
    		}
    	}
    	echo json_encode(array("tax"=>0, "discount"=> 0, "total"=> $total, "total_items"=>$total_item));
    }
    function _getTotal(){
    	$total = 0;
    	$total_item = 0;
    	foreach ($this->cart->contents() as $items) {    		
    		$idProduks = explode("_", $items['id']);
    		if(count($idProduks) > 1){
    			if($idProduks[1] == "STOKSERVICE"){
    				$total += $items['price']*$items['qty'];
    				$total_item += $items['qty'];
    			}
    		}
    	}
    	return json_encode(array("tax"=>0, "discount"=> 0, "total"=> $total, "total_items"=>$total_item));
    }
    function updateCart($id, $qty, $state = 'tambah'){
    	$getid = $this->in_cart($id, 'id', 'rowid');
    	$dataSelect['deleted'] = 1;
    	$dataSelect['id'] = $getid;
    	$selectData = $this->Transaksiservicemodel->select($dataSelect, 'm_produk');
    	$lastQty = $this->in_cart($id, 'qty', 'rowid');
    	if($state == 'tambah'){		
	    	if($lastQty <= $selectData->row()->stok){
				$data = array(
				        'rowid'  => $id,
				        'qty'    => $qty
				);
				$this->cart->update($data);
				echo $this->getOrder();   	
	    	}
    	}else{
			$data = array(
			        'rowid'  => $id,
			        'qty'    => $qty
			);
			$this->cart->update($data);
			echo $this->getOrder();   	    		
    	}
    }
    function updateOption($id, $options){
		$data = array(
		        'rowid'  => $id,
		        'options'=> array('stok'=>$options)
		);
		$this->cart->update($data);
		echo $this->getOrder();  
    }
    function testLastQty($id){
    	$lastQty = $this->in_cart($id, 'qty', 'rowid');
    	echo $lastQty;    	
    }
    function deleteCart($id){
    	$this->cart->remove($id);
    	echo $this->getOrder();
    }
    function destroyCart(){
    	foreach ($this->cart->contents() as $items) {
    		$idProduks = explode("_", $items['id']);
    		if(count($idProduks) > 1){
    			if($idProduks[1] == "STOKSERVICE"){
    				$this->cart->remove($items['rowid']);
    			}
    		}
    	}
    	echo $this->getOrder();	
    }
	function tambahCart($id){
		$inCart = $this->in_cart($id."_STOKSERVICE");
		$dataSelect['deleted'] 	= 1;
		$dataSelect['id']		= $id;
		$selectData = $this->Transaksiservicemodel->select($dataSelect, 'm_produk');
		if($inCart != 'false'){
			if($this->in_cart($id."_STOKSERVICE", 'qty') < $selectData->row()->stok){			
				$qty = $this->in_cart($id."_STOKSERVICE", 'qty') + 1;
				$this->updateCart($inCart, $qty);
			}
		}else if($inCart == 'false'){		
			if($selectData->row()->stok > 1){			
				$datas = array(
			                'id'      => $selectData->row()->id."_STOKSERVICE",
			                'qty'     => 1,
			                'price'   => $selectData->row()->harga_beli,
			                'name'    => $selectData->row()->nama,
    				        'options' => array('stok'=>1)
				);
				$this->cart->insert($datas);
				echo $this->getOrder();
			}
		}
	}
	function in_cart($product_id = null, $type = 'rowid', $filter = 'id') {
	    if($this->cart->total_items() > 0){
	        $in_cart = array();
	        foreach ($this->cart->contents() AS $item){
	            $in_cart[$item[$filter]] = $item[$type];
	        }
	        if($product_id){
	            if (array_key_exists($product_id, $in_cart)){
	                return $in_cart[$product_id];
	            }else{            	
		            return "false";
	            }
	        }else{
	            return $in_cart;
	        }
	    }else{    	
		    return "false";
	    }
	}	
    function doServices(){
    	$params = $this->input->post();
    	if($params != null){
    		$getTotal  = json_decode($this->_getTotal(), true);
    		$dataInsertPrimer['id_supplier'] 			= $params['supplier'];
    		$dataInsertPrimer['catatan']				= $params['catatan'];
    		$dataInsertPrimer['jumlah_barang_service']	= $getTotal['total_items'];
    		$dataInsertPrimer['total_harga']			= $getTotal['total'];
    		$dataInsertPrimer['jumlah_barang_kembali']	= 0;
    		$dataInsertPrimer['jumlah_uang_kembali']	= 0;
    		$dataInsertPrimer['status']					= 1;
    		$dataInsertPrimer['add_by']					= 1;
    		$dataInsertPrimer['edited_by']				= 0;
    		$dataInsertPrimer['deleted']				= 1;
    		$insertPrimer = $this->Transaksiservicemodel->insert($dataInsertPrimer, 't_service');
    		if($insertPrimer){
    			$getId = $this->Transaksiservicemodel->select($dataInsertPrimer, 't_service');
    			$id = $getId->row()->id;
	    		$dataInsertSekunder['id_service'] = $id;
	    		$dataInsertHistori['id_service'] = $id;
		    	foreach ($this->cart->contents() as $items){
		    		$idProduks = explode("_", $items['id']);
		    		if (count($idProduks) > 1) {
			    		if ($idProduks[1] == "STOKSERVICE") {
				    		$dataInsertSekunder['id_produk']				=	$idProduks[0];
				    		$dataInsertSekunder['harga_beli']				=	$items['price'];
				    		$dataInsertSekunder['jumlah']					=	$items['qty'];
				    		$dataInsertSekunder['total_harga']				=	$items['subtotal'];
				    		$dataInsertSekunder['uang_kembali']				=	0;
				    		$dataInsertSekunder['kurangi_stok']				=	$items['options']['stok'];
				    		$dataInsertSekunder['status']					=	1;
				    		$dataInsertSekunder['jumlah_barang_kembali']	=	0;
				    		$dataInsertSekunder['stok_kembali']				=	0;
				    		$insertDataSekunder = $this->Transaksiservicemodel->insert($dataInsertSekunder, 't_service_detail');
				    		if($insertDataSekunder){
				    			if($items['options']['stok'] == 1){
				    				$dataSelectLastStok['id'] = $items['id'];
				    				$dataSelectLastStok['deleted'] = 1;
				    				$getDataLastStok = $this->Transaksiservicemodel->select($dataSelectLastStok, 'm_produk');

					    			$dataInsertHistori['id_produk']			=	$idProduks[0];
					    			$dataInsertHistori['id_order_detail']	=	0;
					    			$dataInsertHistori['jumlah']			=	$items['qty'];
					    			$dataInsertHistori['stok_akhir']		=	$getDataLastStok->row()->stok - $items['qty'];
					    			$dataInsertHistori['keterangan']		=	$params['catatan'];
					    			$dataInsertHistori['status']			=	2;
					    			$dataInsertHistori['add_by']			=	0;
					    			$dataInsertHistori['edited_by']			=	0;
					    			$dataInsertHistori['deleted']			=	1;
					    			$insertHistori = $this->Transaksiservicemodel->insert($dataInsertHistori, 'h_stok_produk');
					    			if($insertHistori){
					    				$dataUpdate['stok']					=	$getDataLastStok->row()->stok - $items['qty'];
					    				$updateStok							=	$this->Transaksiservicemodel->update($dataSelectLastStok, $dataUpdate, 'm_produk');
					    				if($updateStok){
					    					$this->cart->remove($items['rowid']);
					    				}
					    			}
				    			}
				    		}
			    		}
		    		}
		    	}    			
    		}
    	}
    	// $this->cart->destroy();
    	$this->destroyCart();
		// echo $this->getOrder();    	
    }
    function testCart(){
    	echo json_encode($this->cart->contents());
    }
}