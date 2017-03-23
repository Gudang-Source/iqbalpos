<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Transaksipomodel');
    }
    function index(){
    	$this->load->view('Purchase_order/view');
    }
    function detail($id = 0){
    	$data['id'] = $id;
    	$this->load->view('Purchase_order/detail', $data);
    }
    function data(){
		$requestData= $_REQUEST;
		$columns = array( 
			0 	=>	'id_supplier', 
			1 	=> 	'catatan',
			2	=> 	'total_berat',
			3	=> 	'total_qty',
			4	=> 	'total_harga_beli',
			5	=> 	'date_add',
			6	=> 	'aksi'
		);
		$sql = "SELECT * ";
		$sql.=" FROM t_purchase_order";
		$query=$this->Transaksipomodel->rawQuery($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;
		// $sql = "SELECT * ";
		$sql.=" WHERE deleted=1 ";
		if( !empty($requestData['search']['value']) ) {
			$sql.=" AND ( id_supplier LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR catatan LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR total_berat LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR total_qty LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR total_harga_beli LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR date_add LIKE '".$requestData['search']['value']."%' )";
		}
		$query=$this->Transaksipomodel->rawQuery($sql);
		$totalFiltered = $query->num_rows();
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
		$query=$this->Transaksipomodel->rawQuery($sql);
		$data = array();
		foreach ($query->result_array() as $row) {
			$nestedData		=	array(); 

			$nestedData[] 	= 	$row["id_supplier"];
			$nestedData[] 	= 	$row["catatan"];
			$nestedData[] 	= 	$row["total_berat"];
			$nestedData[] 	= 	$row["total_qty"];
			$nestedData[] 	= 	$row["total_harga_beli"];
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
    function data_detail($id_po){
		$requestData= $_REQUEST;
		$columns = array( 
			0 	=>	'id_purchase_order', 
			1 	=> 	'produk',
			2	=> 	'ukuran',
			3	=> 	'warna',
			4	=> 	'jumlah',
			5	=> 	'total_berat',
			6	=> 	'harga_beli',
			7	=> 	'total_harga',
			8	=> 	'aksi',
		);
		$sql = "SELECT 
					t_purchase_order.id as poid,
					t_purchase_order_detail.id as podid, 
					t_purchase_order_detail.jumlah as podjm,
					t_purchase_order_detail.total_berat as podtb, 
					t_purchase_order_detail.harga_beli as podhb, 
					t_purchase_order_detail.total_harga as podth, 
					m_produk_ukuran.nama as ukuran,
					m_produk_warna.nama as warna,
					m_produk.nama as nama,
					m_produk.sku as sku";
		$sql.=" FROM t_purchase_order";
		$sql.=" INNER JOIN t_purchase_order_detail ON t_purchase_order.id = t_purchase_order_detail.id_purchase_order";
		$sql.=" INNER JOIN m_produk on t_purchase_order_detail.id_produk = m_produk.id";
		$sql.=" INNER JOIN m_produk_ukuran on t_purchase_order_detail.id_ukuran = m_produk_ukuran.id";
		$sql.=" INNER JOIN m_produk_warna on t_purchase_order_detail.id_warna = m_produk_warna.id";
		$sql.=" WHERE t_purchase_order.deleted=1 ";
		$sql.=" AND t_purchase_order_detail.id_purchase_order=".$id_po;
		if( !empty($requestData['search']['value']) ) {
			$sql.=" AND ( m_produk.nama LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.sku LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.kode_barang LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.deskripsi LIKE '".$requestData['search']['value']."%' )";
		}
		$query=$this->Transaksipomodel->rawQuery($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;		
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
		$query=$this->Transaksipomodel->rawQuery($sql);
		$totalFiltered = $query->num_rows();
		$data = array();
		$i=1;
		foreach ($query->result_array() as $row) {
			$nestedData		=	array(); 

			$nestedData[] 	= 	$row['poid'];
			$nestedData[] 	= 	$row['nama'];
			$nestedData[] 	= 	$row['ukuran'];
			$nestedData[] 	= 	$row['warna'];
			$nestedData[] 	= 	$row['podjm'];
			$nestedData[] 	= 	$row['podtb'];
			$nestedData[] 	= 	$row['podhb'];
			$nestedData[] 	= 	$row['podth'];
			$nestedData[] 	= 	"&nbsp;";	
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
    		$dataSelect['id'] = $params['id'];
    		$selectData = $this->Transaksipomodel->select($dataSelect, 't_service_detail');

    		$statusStok = $selectData->row()->kurangi_stok;
    		if ($statusStok == 1) {
    			$idProduk = $selectData->row()->id_produk;
    			$dataSelectMaster['id'] = $idProduk;
    			$selectDataMaster = $this->Transaksipomodel->select($dataSelectMaster, 'm_produk');
    			
    			$stokKembali = $params['jbk'];
    			$stokGudang = $selectDataMaster->row()->stok;

    			$stokSekarang = $stokGudang + $stokKembali;

    			// update stok master
    			$dataConditionMaster['id'] = $idProduk;
    			$dataUpdateMaster['stok'] = $stokSekarang;
    			$updateDataMaster = $this->Transaksipomodel->update($dataConditionMaster, $dataUpdateMaster, 'm_produk');
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
    				$insertHistori = $this->Transaksipomodel->insert($dataInsertHistori, 'h_stok_produk');
    				if($insertHistori){
    					// update service detail
    					$dataConditionService['id'] = $params['id'];
    					$dataUpdateService['uang_kembali']  		= $params['juk'];
    					$dataUpdateService['status']				= $params['sts'];
    					$dataUpdateService['jumlah_barang_kembali']	= $params['jbk'];
    					$updateService = $this->Transaksipomodel->update($dataConditionService, $dataUpdateService, 't_service_detail');
    					if($updateService){
    						echo json_encode(array("status"=>1));
    					}else{
    						echo json_encode(array("status"=>0));
    					}
    				}
    			}
    		}else{
				$dataConditionService['id'] = $params['id'];
				$dataUpdateService['uang_kembali']  		= $params['juk'];
				$dataUpdateService['status']				= $params['sts'];
				$dataUpdateService['jumlah_barang_kembali']	= $params['jbk'];
				$updateService = $this->Transaksipomodel->update($dataConditionService, $dataUpdateService, 't_service_detail');
				if($updateService){
					echo json_encode(array("status"=>1));
				}else{
					echo json_encode(array("status"=>0));
				}
    		}
    	}
    }
    function getOrder(){
    	$data = array();
    	foreach ($this->cart->contents() as $items){
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
    	return json_encode($data);
    }
    function getProduk($supplier = null){
    	$list = null;
    	$dataSelect['deleted'] = 1;
    	if($supplier != null){
    		$dataSelect['id_supplier'] = $supplier;
    	}
    	$list = $this->Transaksipomodel->select($dataSelect, 'm_produk');
    	return json_encode($list->result_array());
    }
    function getSupplier(){
    	$dataSelect['deleted'] = 1;
    	return json_encode($this->Transaksipomodel->select($dataSelect, 'm_supplier_produk')->result_array());
    }
    function filterProduk($supplier){
    	echo $this->getProduk($supplier);
    }
    function getWarna(){
    	$dataSelect['deleted'] = 1;
    	$selectData = $this->Transaksipomodel->select($dataSelect, 'm_produk_warna');
    	return json_encode($selectData->result_array());
    }
    function getUkuran(){
    	$dataSelect['deleted'] = 1;
    	$selectData = $this->Transaksipomodel->select($dataSelect, 'm_produk_ukuran');
    	return json_encode($selectData->result_array());
    }
    function transaksi(){
    	$dataSelect['deleted'] = 1;
    	$data['list_produk'] = $this->getProduk();
        $data['list_order'] = $this->getOrder();
        $data['list_supplier'] = $this->getSupplier();
        
        $data['list_warna'] = $this->getWarna();
        $data['list_ukuran'] = $this->getUkuran();
        
        $data['total'] = $this->cart->total();
        $data['total_items'] = $this->cart->total_items();
        $data['tax'] = 0;
        $data['discount'] = 0;
    	$this->load->view('Purchase_order/transaksi', $data);
    }
    function getTotal(){
    	echo json_encode(array("tax"=>0, "discount"=> 0, "total"=> $this->cart->total(), "total_items"=>$this->cart->total_items()));
    }
    function updateCart($id, $qty, $state = 'tambah'){
    	$getid = $this->in_cart($id, 'id', 'rowid');
    	$dataSelect['deleted'] = 1;
    	$dataSelect['id'] = $getid;
    	$selectData = $this->Transaksipomodel->select($dataSelect, 'm_produk');
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
    	$this->cart->destroy();
    	echo $this->getOrder();	
    }
	function tambahCart($id){
		$inCart = $this->in_cart($id);
		$params	= $this->input->post();
		if($inCart != 'false'){
			$qty = $this->in_cart($id, 'qty') + 1;
			$this->updateCart($inCart, $qty);
		}else if($inCart == 'false'){
			$dataSelect['deleted']=1;
			$dataSelect['id']=$id;
			$selectData = $this->Transaksipomodel->select($dataSelect, 'm_produk');
			$datas = array(
		                'id'      => $id,
		                'qty'     => 1,
		                'price'   => 0,
		                'name'    => $selectData->row()->nama,
				        'options' => array(
				        				'ukuran'=>0,
				        				'warna'=>0,
				        				'total_berat'=>0
				        				)
			);
			$this->cart->insert($datas);
			echo $this->getOrder();
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
    function doSubmit(){
    	$params = $this->input->post();
    	if($params != null){
    		// id_supplier
    		// catatan
    		// total_berat
    		// total_qty
    		// total_harga_beli    		
    		// add_by
    		// edited_by
    		// deleted = 1
    		$dataInsert['id_supplier'] 	= $params['supplier'];
    		$dataInsert['catatan']		= $params['catatan'];
    		$dataInsert['total_berat'] = $this->getOption('total_berat');
    		$dataInsert['total_qty'] = $this->cart->total_items();
    		$dataInsert['total_harga_beli'] = $this->cart->total();
    		$dataInsert['add_by'] = 0;
    		$dataInsert['edited_by'] = 0;
    		$dataInsert['deleted'] = 1;
    		$insertDataMaster = $this->Transaksipomodel->insert($dataInsert, 't_purchase_order');
    		if($insertDataMaster){    		
	    		$getDataID = $this->Transaksipomodel->select($dataInsert, 't_purchase_order');
	    		// insert ke table child
	    		// id_purchase_order
	    		// id_produk
	    		// id_ukuran
	    		// id_warna
	    		// jumlah
	    		// total_berat
	    		// harga_beli
	    		// total_harga
	    		foreach ($this->cart->contents() as $items){
		    		$dataInsertDetail['id_purchase_order']		=	$getDataID->row()->id;
		    		$dataInsertDetail['id_produk']				=	$items['id'];	
		    		$dataInsertDetail['id_ukuran']				=	$items['options']['ukuran'];
		    		$dataInsertDetail['id_warna']				=	$items['options']['warna'];
		    		$dataInsertDetail['jumlah']					=	$items['qty'];
		    		$dataInsertDetail['total_berat']			=	$items['options']['total_berat'];
		    		$dataInsertDetail['harga_beli']				=	$items['price'];
		    		$dataInsertDetail['total_harga']			=	$items['price'] * $items['qty'];
		    		$insertDetail = $this->Transaksipomodel->insert($dataInsertDetail, 't_purchase_order_detail');
	    		}
    		}
    	}
    	$this->cart->destroy();
		echo $this->getOrder();    	
    }
    function getOption($option){
    	$total = 0;
    	foreach ($this->cart->contents() as $items){
    		$total += $items['options'][$option];
    	}
    	return $total;
    }

}