<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends MX_Controller {
    private $modul = "Transaksi_retur/";
    private $fungsi = "";    
	function __construct() {
        parent::__construct();
        $this->load->model('Transaksireturmodel');
        $this->modul .= $this->router->fetch_class();
        $this->fungsi = $this->router->fetch_method();
        $this->_insertLog();
    }
    function _insertLog($fungsi = null){
        $id_user = $this->session->userdata('id_user');
        $dataInsert['id_user'] = $id_user;
        $dataInsert['modul'] = $this->modul;
        $dataInsert['fungsi'] = $this->fungsi;
        $insertLog = $this->Transaksireturmodel->insert($dataInsert, 't_log');        
    }  
    function index(){
    	$this->load->view('Transaksi_retur/view');
    }
    function detail($id = 0){
    	$data['id'] = $id;
    	$this->load->view('Transaksi_retur/detail', $data);
    }
    function data(){
		$requestData= $_REQUEST;
		$columns = array( 
			0 	=>	'id', 
			1 	=>	'id_order', 
			2 	=> 	'customer',
			3	=> 	'catatan',
			4	=> 	'jumlah',
			5	=> 	'harga',
			6	=> 	'date_add',
			7	=> 	'status',
			8	=> 	'proses',
			9	=> 	'aksi'
		);
		$sql = " SELECT t_retur.* , m_customer.nama as namacus";
		$sql.= " FROM t_retur ";
		$sql.= " LEFT JOIN m_customer ON t_retur.id_customer = m_customer.id ";
		$query=$this->Transaksireturmodel->rawQuery($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;
		$sql.=" WHERE t_retur.deleted=1 ";
		if( !empty($requestData['search']['value']) ) {
			$sql.=" AND ( id_order LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR m_customer.nama LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR t_retur.date_add LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR catatan LIKE '".$requestData['search']['value']."%' )";
		}
		$query=$this->Transaksireturmodel->rawQuery($sql);
		$totalFiltered = $query->num_rows();
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
		$query=$this->Transaksireturmodel->rawQuery($sql);
		$data = array();
		foreach ($query->result_array() as $row) {
			$nestedData		=	array(); 

			$nestedData[] 	= 	$row["id"];
			$nestedData[] 	= 	$row["id_order"];
			$nestedData[] 	= 	$row["namacus"];
			$nestedData[] 	= 	$row["catatan"];
			$nestedData[] 	= 	$row["total_qty"];
			$nestedData[] 	= 	$row["total_harga"];
			$nestedData[] 	= 	$row["date_add"];
			$nestedData[] 	= 	$row["status"]==1?"BELUM DIPROSES":"SUDAH DIPROSES";
            $nestedData[]   =  $row["status"]==1?'<input type="checkbox" id="toggle_'.$row["id"].'" class="bootstrap-toggle">':'TELAH DIPROSES';
			$nestedData[] 	= 	"<button class='btn btn-success' onclick=detail('".$row["id"]."')>DETAIL</button>";			
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
    function updateProses($idRetur){
    	$dataCondition['deleted'] = 1;
    	$dataCondition['id'] = $idRetur;
    	$dataUpdate['status'] = 2;
    	$updateData = $this->Transaksireturmodel->update($dataCondition, $dataUpdate, 't_retur');
    	if($update){
    		echo json_encode(array("status"=>1));
    	}else{
    		echo json_encode(array("status"=>0));
    	}
    }
    function data_detail($id_po){
		$requestData= $_REQUEST;
		$columns = array( 
			0 	=>	'rid', 
			1 	=> 	'produk',
			2	=> 	'jumlah',
			3	=> 	'harga_beli',
			4	=> 	'harga_jual',
			5	=> 	'total_harga'
		);
		$sql = "SELECT 
					t_retur.id as rid,
					t_retur_detail.id as trid, 
					t_retur_detail.jumlah as trjm,
					t_retur_detail.harga_beli as trhb, 
					t_retur_detail.harga_jual as trhj, 
					t_retur_detail.total_harga as trth, 
					m_produk.nama as nama,
					m_produk.sku as sku";
		$sql.=" FROM t_retur";
		$sql.=" LEFT JOIN t_retur_detail ON t_retur.id = t_retur_detail.id_retur";
		$sql.=" LEFT JOIN m_produk on t_retur_detail.id_produk = m_produk.id";
		$sql.=" WHERE t_retur.deleted=1 ";
		$sql.=" AND t_retur_detail.id_retur=".$id_po;
		if( !empty($requestData['search']['value']) ) {
			$sql.=" AND ( m_produk.nama LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.sku LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.kode_barang LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.deskripsi LIKE '".$requestData['search']['value']."%' )";
		}
		$query=$this->Transaksireturmodel->rawQuery($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;		
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
		$query=$this->Transaksireturmodel->rawQuery($sql);
		$totalFiltered = $query->num_rows();
		$data = array();
		$i=1;
		foreach ($query->result_array() as $row) {
			$nestedData		=	array(); 
			$nestedData[] 	= 	$i;
			$nestedData[] 	= 	$row['nama'];
			$nestedData[] 	= 	$row['trjm'];
			$nestedData[] 	= 	$row['trhb'];
			$nestedData[] 	= 	$row['trhj'];
			$nestedData[] 	= 	$row['trth'];
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
    function getCustomer(){
    	$dataSelect['deleted'] = 1;
    	$selectData = $this->Transaksireturmodel->select($dataSelect, 'm_customer');
    	return json_encode($selectData->result_array());
    }
    function getKategori(){
    	$dataSelect['deleted'] = 1;
    	$selectData = $this->Transaksireturmodel->select($dataSelect, 'm_produk_kategori');
    	return json_encode($selectData->result_array());
    }
    function getAvailableOrder($idCustomer){
    	$data['id_customer'] 	= $idCustomer;
    	$data['deleted']		= 1;
    	$selectData = $this->Transaksireturmodel->select($data, 't_order');
    	echo json_encode($selectData->result_array());
    }
    function getOrder(){
    	$data = array();
    	foreach ($this->cart->contents() as $items){
    		$idProduks = explode("_", $items['id']);
    		if(count($idProduks) > 1){
    			if($idProduks[1] == "RETUR"){    				
		    		$nestedData = array();
		    		$nestedData['rowid'] = $items['rowid'];
		    		$nestedData['id'] = $items['id'];
		    		$nestedData['qty'] = $items['qty'];
		    		$nestedData['harga_beli'] = $items['price'];
		    		$nestedData['produk'] = $items['name'];
		    		$nestedData['rowid'] = $items['rowid'];
		    		$nestedData['subtotal'] = $items['price']*$items['qty'];

		    		$nestedData['ukuran'] = $items['options']['ukuran']!=null?$items['options']['ukuran']:0;
		    		$nestedData['warna'] = $items['options']['warna']!=null?$items['options']['warna']:0;
		    		$nestedData['total_berat'] = $items['options']['total_berat']!=null?$items['options']['total_berat']:0;
		    		array_push($data, $nestedData);
    			}
    		}
    	}
    	return json_encode($data);
    }
    function getAvailableProduk($idOrder){
    	$sql = "SELECT m_produk.* FROM t_order
				INNER JOIN t_order_detail ON t_order_detail.id_order = t_order.id
				INNER JOIN m_produk ON m_produk.id = t_order_detail.id_produk
				WHERE t_order.id = ".$idOrder;
		$exeQuery = $this->Transaksireturmodel->rawQuery($sql);
		echo json_encode($exeQuery->result_array());
    }
    function getProduk($supplier = null){
    	$list = null;
    	$dataSelect['deleted'] = 1;
    	if($supplier != null){
    		$dataSelect['id_supplier'] = $supplier;
    	}
    	$list = $this->Transaksireturmodel->select($dataSelect, 'm_produk');
    	return json_encode($list->result_array());
    }
    function getProdukByName($keyword = null, $supplier = null){
    	$list = null;
    	$dataSelect['deleted'] = 1;
    	if($keyword != null && $supplier != null){
    		$dataLike['nama'] = $keyword;
    		$dataCondition['id_supplier'] = $supplier;
    	}
    	$list = $this->Transaksireturmodel->like($dataCondition, $dataLike, 'm_produk');
    	return json_encode($list->result_array());
    }   
    function getProdukByKategori($kategori = null, $keyword = null){
    	$list = null;
    	$dataSelect['deleted'] = 1;
    	$dataLike = array();
    	if($kategori != null){
    		$dataCondition['id_kategori'] = $kategori;
    	}
    	if($keyword != null){
    		$dataLike['nama'] = $keyword;
    	}
    	$list = $this->Transaksireturmodel->like($dataCondition, $dataLike, 'm_produk');
    	return json_encode($list->result_array());
    }    
    function getSupplier(){
    	$dataSelect['deleted'] = 1;
    	return json_encode($this->Transaksireturmodel->select($dataSelect, 'm_supplier_produk')->result_array());
    }
    function filterProduk($supplier){
    	echo $this->getProduk($supplier);
    }
    function filterProdukByName(){
    	$params  = $this->input->post();
    	$keyword = $params['keyword'];
    	$supplier = $params['supplier'];
    	echo $this->getProdukByName($keyword, $supplier);
    }
    function filterProdukByKategori($kategori, $keyword = null){
    	echo $this->getProdukByKategori($kategori, $keyword);
    }
    function getWarna(){
    	$dataSelect['deleted'] = 1;
    	$selectData = $this->Transaksireturmodel->select($dataSelect, 'm_produk_warna');
    	return json_encode($selectData->result_array());
    }
    function getUkuran(){
    	$dataSelect['deleted'] = 1;
    	$selectData = $this->Transaksireturmodel->select($dataSelect, 'm_produk_ukuran');
    	return json_encode($selectData->result_array());
    }
    function transaksi(){
    	$dataSelect['deleted'] = 1;
    	$data['list_produk'] = $this->getProduk();
        $data['list_order'] = $this->getOrder();
        $data['list_customer'] = $this->getCustomer();
        $data['list_kategori'] = $this->getKategori();
        
        $data['list_warna'] = $this->getWarna();
        $data['list_ukuran'] = $this->getUkuran();
        
        $data['total'] = $this->cart->total();
        $data['total_items'] = $this->cart->total_items();
        $data['tax'] = 0;
        $data['discount'] = 0;
    	$this->load->view('Transaksi_retur/transaksi', $data);
    }
    function getTotal(){
    	$total = 0;
    	$total_item = 0;
    	foreach ($this->cart->contents() as $items) {    		
    		$idProduks = explode("_", $items['id']);
    		if(count($idProduks) > 1){
    			if($idProduks[1] == "RETUR"){
    				$total = $total + ($items['price'] * $items['qty']);
    				$total_item += $items['qty'];
    			}
    		}
    	}    	
    	echo json_encode(array("tax"=>0, "discount"=> 0, "total"=> $total, "total_items"=>$total_item));
    }
    function updateCart($id, $qty, $state = 'tambah'){
    	$getid = $this->in_cart($id, 'id', 'rowid');
    	$dataSelect['deleted'] = 1;
    	$dataSelect['id'] = $getid;
    	$selectData = $this->Transaksireturmodel->select($dataSelect, 'm_produk');
    	$lastQty = $this->in_cart($id, 'qty', 'rowid');
    	if($state == 'tambah'){		
			$data = array(
			        'rowid'  => $id,
			        'qty'    => $lastQty+1
			);
			$this->cart->update($data);
			echo $this->getOrder();   	
    	}else{
			$data = array(
			        'rowid'  => $id,
			        'qty'    => $qty
			);
			$this->cart->update($data);
			echo $this->getOrder();   	    		
    	}
    }
    function updateOption($id, $warna, $ukuran, $total_berat){
		$data = array(
		        'rowid'  => $id,
		        'options'=> array('warna'=>$warna,'ukuran'=>$ukuran,'total_berat'=>$total_berat)
		);
		$this->cart->update($data);
		echo $this->getOrder();  
    }
    function updateUkuran($id,  $warna, $ukuran, $total_berat){
		$data = array(
		        'rowid'  => $id,
		        'options'=> array('warna'=>$warna,'ukuran'=>$ukuran,'total_berat'=>$total_berat)
		);
		$this->cart->update($data);
		echo $this->getOrder();      	
    }
    function updateQty($id, $qty){
		$data = array(
		        'rowid'  => $id,
		        'qty'=> $qty
		);
		$this->cart->update($data);
		echo $this->getOrder();      	
    }
    function updateTotalBerat($id,  $warna, $ukuran, $total_berat){
		$data = array(
		        'rowid'  => $id,
		        'options'=> array('warna'=>$warna,'ukuran'=>$ukuran,'total_berat'=>$total_berat)
		);
		$this->cart->update($data);
		echo $this->getOrder();      	
    }
    function updateHargaBeli($id, $hargaBeli){
		$data = array(
		        'rowid'  => $id,
		        'price'	 => $hargaBeli
		);
		$this->cart->update($data);
		echo $this->getOrder();      	
    }
    function checkCart(){
    	echo json_encode($this->cart->contents());
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
    			if($idProduks[1] == "RETUR"){
    				$this->cart->remove($items['rowid']);
    			}
    		}
    	}
    	echo $this->getOrder();	
    }
	function tambahCart($id){
		$inCart = $this->in_cart($id."_RETUR");
		// echo $inCart;
		$params	= $this->input->post();
		$idCustomer = $params['idCustomer'];
		if($inCart == 'false'){
			$dataSelect['deleted']=1;
			$dataSelect['id']=$id;
			$selectData = $this->Transaksireturmodel->select($dataSelect, 'm_produk');
			$hargaCustomer = $this->getHargaCustomer($selectData->row()->id, $idCustomer);
			// echo $hargaCustomer;
			if($hargaCustomer != 0){
				$datas = array(
			                'id'      => $selectData->row()->id."_RETUR",
			                'qty'     => 1,
			                'price'   => $this->getHargaCustomer($selectData->row()->id, $idCustomer),
			                'name'    => $selectData->row()->nama,
					        'options' => array(
					        				'ukuran'=>0,
					        				'warna'=>0,
					        				'total_berat'=>$selectData->row()->berat*1
					        				)
				);
				$this->cart->insert($datas);
			}
			echo $this->getOrder();
		}else{
			$qty = $this->in_cart($id."_RETUR", 'qty') + 1;
			$this->updateCart($inCart, $qty);
		}
	}
	function getHargaCustomer($idProduk = null, $idCustomer = null){
		$getData = $this->Transaksireturmodel->rawQuery("SELECT m_produk_det_harga.harga as harga FROM m_produk
									INNER JOIN m_produk_det_harga ON m_produk_det_harga.id_produk = m_produk.id
									INNER JOIN m_customer ON m_produk_det_harga.id_customer_level = m_customer.id_customer_level
									WHERE m_produk.id = ".$idProduk." AND m_customer.id = ".$idCustomer);
		return $getData->num_rows()>0?$getData->row()->harga:0;
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
    function _getTotal(){
    	$total = 0;
    	$total_item = 0;
    	foreach ($this->cart->contents() as $items) {    		
    		$idProduks = explode("_", $items['id']);
    		if(count($idProduks) > 1){
    			if($idProduks[1] == "RETUR"){
    				$total += ($items['price']*$items['qty']);
    				$total_item += $items['qty'];
    			}
    		}
    	}
    	return json_encode(array("tax"=>0, "discount"=> 0, "total"=> $total, "total_items"=>$total_item));
    }
    function save(){
    	$params = $this->input->post();
    	if($params != null){
    		$dateNow = date('Y-m-d H:i:s');
    		$getTotal = json_decode($this->_getTotal(), true);
    		$returns = null;
    		$dataInsert['id_order'] = $params['idOrder'];
    		$dataInsert['id_customer'] = $params['idCustomer'];
    		$dataInsert['catatan'] = $params['catatan'];
    		$dataInsert['total_qty'] = $getTotal['total_items'];
    		$dataInsert['total_harga'] = $getTotal['total'];
    		$dataInsert['status'] = 1;
    		$dataInsert['date_add'] = $dateNow;
    		$dataInsert['add_by'] = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
    		$dataInsert['deleted'] = 1;
    		$insertRetur = $this->Transaksireturmodel->insert($dataInsert, 't_retur');
    		if($insertRetur){
    			$dataInsertT = array();
    			$getID = $this->Transaksireturmodel->select($dataInsert, 't_retur');
    			$dataInsertT['id_retur'] = $getID->row()->id;
    			foreach ($this->cart->contents() as $items) {
	    			$idProduks = explode("_", $items['id']);
	    			if(count($idProduks) > 1){
	    				if($idProduks[1]=="RETUR"){
	    					$dataSelectProduk['deleted'] = 1;
	    					$dataSelectProduk['id'] = $idProduks[0];
	    					$getDataProduk = $this->Transaksireturmodel->select($dataSelectProduk, 'm_produk');

				    		$dataInsertT['id_produk']				=	$getDataProduk->row()->id;
				    		$dataInsertT['harga_beli']				=	$getDataProduk->row()->harga_beli;
				    		$dataInsertT['harga_jual']				=	$items['price'];
				    		$dataInsertT['jumlah']					=	$items['qty'];
				    		$dataInsertT['total_harga']				=	$items['price'] * $items['qty'];
				    		$returns = $this->Transaksireturmodel->insert($dataInsertT, 't_retur_detail');
	    				}
	    			}
    			}
    			if($returns){
			    	foreach ($this->cart->contents() as $items) {
			    		$idProduks = explode("_", $items['id']);
			    		if(count($idProduks) > 1){
			    			if($idProduks[1] == "RETUR"){
			    				$this->cart->remove($items['rowid']);
			    			}
			    		}
			    	}
    				echo json_encode(array("status"=>1));
    			}else{
    				echo json_encode(array("status"=>0));
    			}
    		}else{
    			echo json_encode(array("status"=>0));
    		}
    	}else{
    		echo json_encode(array("status"=>0));
    	}
    }
    function doSubmit(){
    	$params = $this->input->post();
    	if($params != null){
    		$getTotal = json_decode($this->_getTotal(), true);
            $dataInsert['id_purchase_order'] = $params['idpo'];
    		$dataInsert['id_supplier'] 	= $params['supplier'];
    		$dataInsert['catatan']		= $params['catatan'];
    		$dataInsert['total_berat'] = $this->getOption('total_berat');
    		$dataInsert['total_qty'] = $getTotal['total_items'];
    		$dataInsert['total_harga_beli'] = $getTotal['total'];
    		$dataInsert['add_by'] = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
    		$dataInsert['edited_by'] = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
    		$dataInsert['deleted'] = 1;
    		$insertDataMaster = $this->Transaksireturmodel->insert($dataInsert, 't_beli');
    		if($insertDataMaster){    		
	    		$getDataID = $this->Transaksireturmodel->select($dataInsert, 't_beli');
	    		foreach ($this->cart->contents() as $items){
	    			$idProduks = explode("_", $items['id']);
	    			if(count($idProduks) > 1){
	    				if($idProduks[1]=="RETUR"){					
				    		$dataInsertDetail['id_beli']		        =	$getDataID->row()->id;
				    		$dataInsertDetail['id_produk']				=	$idProduks[0];	
				    		$dataInsertDetail['id_ukuran']				=	$items['options']['ukuran'];
				    		$dataInsertDetail['id_warna']				=	$items['options']['warna'];
				    		$dataInsertDetail['jumlah']					=	$items['qty'];
				    		$dataInsertDetail['total_berat']			=	$items['options']['total_berat'];
				    		$dataInsertDetail['harga_beli']				=	$items['price'];
				    		$dataInsertDetail['total_harga']			=	$items['price'] * $items['qty'];
				    		$insertDetail = $this->Transaksireturmodel->insert($dataInsertDetail, 't_beli_detail');
	    				}
	    			}
	    		}
    		}
    	}
    	$this->destroyCart();
    }
    function testtCart(){
    	echo json_encode($this->cart->contents());
    }
    function payment(){
    	$params = $this->input->post();
    	if($params != null){
    		$idOrder = 0;
    		$realIDORDER = 0;
    		$dateNow = date('Y-m-d H:i:s');
    		$getTotal = json_decode($this->_getTotal(), true);
    		$dataInsertTorder['id_customer'] 					= 	$params['id_customer'];
    		$dataInsertTorder['catatan']						=	$params['catatan'];
    		$dataInsertTorder['total_berat']					=	$this->getOption('total_berat');
    		$dataInsertTorder['total_qty']						=	$getTotal['total_items'];
    		$dataInsertTorder['total_harga_barang']				=	$getTotal['total'];
    		$dataInsertTorder['grand_total']					=	$getTotal['total'] + 0;
    		$dataInsertTorder['profit']							=	0;
    		$dataInsertTorder['jenis_order']					=	$params['jenisOrder'];
    		$dataInsertTorder['status']							=	1;
    		$dataInsertTorder['date_add']						=	$dateNow;
    		$dataInsertTorder['add_by']							=	isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
    		$dataInsertTorder['deleted']						=	1;
    		$dataInsertTorder['id_metode_pembayaran']			=	$params['paymentMethod'];
    		$insertTorder = $this->Transaksireturmodel->insert($dataInsertTorder, 't_order');
    		if($insertTorder){
    			// insert ke h_transaksi
    			$dataHtransaksi['jenis_transaksi'] 	= 4;
    			$dataHtransaksi['id_referensi']		= $params['chequenum'];
    			$dataHtransaksi['keterangan']		= $params['catatan'];
    			$dataHtransaksi['date_add']			= $dateNow;
    			$dataHtransaksi['add_by']			= isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
    			$dataHtransaksi['deleted']			= 1;
    			$insertHtransaksi = $this->Transaksireturmodel->insert($dataHtransaksi, 'h_transaksi');
    			if($insertHtransaksi){
    				// insert ke t_order_detail
		    		$getDataID = $this->Transaksireturmodel->select($dataInsertTorder, 't_order');
		    		$realIDORDER = $getDataID->row()->id;
		    		$insertDetail = false;
		    		foreach ($this->cart->contents() as $items){
		    			$idProduks = explode("_", $items['id']);
		    			if(count($idProduks) > 1){
		    				if($idProduks[1]=="RETUR"){
		    					$dataDetail['id'] = $idProduks[0];
		    					$getHargaBeli = $this->Transaksireturmodel->select($dataDetail, 'm_produk');
		    					$idOrder = $getHargaBeli->row()->id;
					    		$dataInsertDetail['id_order']		        =	$getDataID->row()->id;
					    		$dataInsertDetail['id_produk']				=	$idProduks[0];	
					    		$dataInsertDetail['id_ukuran']				=	$items['options']['ukuran'];
					    		$dataInsertDetail['id_warna']				=	$items['options']['warna'];
					    		$dataInsertDetail['jumlah']					=	$items['qty'];
					    		$dataInsertDetail['total_berat']			=	$items['options']['total_berat'];
					    		$dataInsertDetail['harga_beli']				=	$getHargaBeli->row()->harga_beli;
					    		$dataInsertDetail['harga_jual']				=	$items['price'];
					    		$dataInsertDetail['total_harga']			=	$items['price'] * $items['qty'];
					    		$dataInsertDetail['profit']					=	$items['price'] - $getHargaBeli->row()->harga_beli;
					    		$insertDetail = $this->Transaksireturmodel->insert($dataInsertDetail, 't_order_detail');
								if($insertDetail){
									//update stok
									$getIdDetail = $this->Transaksireturmodel->select($dataInsertDetail, 't_order_detail');
									$dataConditionStok['id'] 					= $idProduks[0];
									$dataUpdateStok['stok']	 					= $getHargaBeli->row()->stok - $items['qty'];
									$dataUpdateStok['last_edited']	 			= $dateNow;
									$dataUpdateStok['edited_by']	 			= isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
									$dataUpdateStok['tanggal_kurang_stok']	 	= $dateNow;
									$updateStokProduk = $this->Transaksireturmodel->update($dataConditionStok, $dataUpdateStok, 'm_produk');
									if($updateStokProduk){
										// insert ke h_stok_produk
										$dataHstok['id_produk'] 		= $idProduks[0];
										$dataHstok['id_order_detail']	= $getIdDetail->row()->id;
										$dataHstok['id_service']		= 0;
										$dataHstok['jumlah']	 		= $items['qty'];
										$dataHstok['stok_akhir'] 		= $getHargaBeli->row()->stok - $items['qty'];
										$dataHstok['keterangan'] 		= $params['catatan'];
										$dataHstok['status']			= 1;
										$dataHstok['date_add']			= $dateNow;
										$dataHstok['add_by']			= isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0;
										$dataHstok['deleted']			= 1;
										$insertHstok = $this->Transaksireturmodel->insert($dataHstok, 'h_stok_produk');
									}
								}
		    				}
		    			}
		    		}
		    		if($insertHstok){
				    	foreach ($this->cart->contents() as $items) {
				    		$idProduks = explode("_", $items['id']);
				    		if(count($idProduks) > 1){
				    			if($idProduks[1] == "RETUR"){
				    				$this->cart->remove($items['rowid']);
				    			}
				    		}
				    	}

		    			echo json_encode(array('idOrder'=>$realIDORDER));
		    		}else{
		    			echo json_encode(array('status'=>0));
		    		}
    			}else{
    				echo json_encode(array('status'=>0));
    			}
    		}else{
    			echo json_encode(array('status'=>0));
    		}
    	}else{
    		echo json_encode(array('status'=>0));
    	}
    }
    function getOption($option){
    	$total = 0;
    	foreach ($this->cart->contents() as $items){
    		$idProduks = explode("_", $items['id']);
    		if (count($idProduks) > 1) {
    			if ($idProduks[1] == "RETUR") {
		    		$total += $items['options'][$option];
    			}
    		}
    	}
    	return $total;
    }
    function invoices($idORder){
    	$sql = " SELECT 
					m_customer.nama as namacus,
					m_customer.alamat as alamatcus,
					m_customer.no_telp as notelpcus,
					t_order.id as orderinvoice,
					t_order.date_add as orderdate,
					t_order.grand_total as ordertotal,
					m_produk.nama as namaprod,
					m_produk.deskripsi as deskprod,
					t_order_detail.harga_jual as detailjual,
					t_order_detail.jumlah as jumlahjual,
					t_order_detail.total_harga as totaljual";
		$sql.= " FROM t_order";
		$sql.= " LEFT JOIN t_order_detail ON t_order.id = t_order_detail.id_order";
		$sql.= " LEFT JOIN m_produk on t_order_detail.id_produk = m_produk.id";
		$sql.= " LEFT JOIN m_customer ON t_order.id_customer = m_customer.id";
		$sql.= " LEFT JOIN m_produk_ukuran on t_order_detail.id_ukuran = m_produk_ukuran.id";
		$sql.= " LEFT JOIN m_produk_warna on t_order_detail.id_warna = m_produk_warna.id";
		$sql.= " WHERE t_order.id=".$idORder;
		$exeQuery = $this->Transaksireturmodel->rawQuery($sql);
		$data['data'] = $exeQuery;
		$this->load->view('Transaksi_retur/invoice', $data);
    }
    function testInvoices(){
    	$this->load->view('Transaksi_retur/invoice');
    }
}