<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Transaksipembelianmodel');
    }
    function index(){
    	$this->load->view('Transaksi_pembelian/view');
    }
    function detail($id = 0){
    	$data['id'] = $id;
    	$this->load->view('Transaksi_pembelian/detail', $data);
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
		$sql = " SELECT t_beli.* , m_supplier_produk.nama as namasup ";
		$sql.= " FROM t_beli ";
		$sql.= " INNER JOIN m_supplier_produk ON t_beli.id_supplier = m_supplier_produk.id ";
		$query=$this->Transaksipembelianmodel->rawQuery($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;
		// $sql = "SELECT * ";
		$sql.=" WHERE t_beli.deleted=1 ";
		if( !empty($requestData['search']['value']) ) {
			$sql.=" AND ( id_supplier LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR catatan LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR total_berat LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR total_qty LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR total_harga_beli LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR date_add LIKE '".$requestData['search']['value']."%' )";
		}
		$query=$this->Transaksipembelianmodel->rawQuery($sql);
		$totalFiltered = $query->num_rows();
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
		$query=$this->Transaksipembelianmodel->rawQuery($sql);
		$data = array();
		foreach ($query->result_array() as $row) {
			$nestedData		=	array(); 

			$nestedData[] 	= 	$row["namasup"];
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
			0 	=>	'id_beli', 
			1 	=> 	'produk',
			2	=> 	'ukuran',
			3	=> 	'warna',
			4	=> 	'jumlah',
			5	=> 	'total_berat',
			6	=> 	'harga_beli',
			7	=> 	'total_harga'
		);
		$sql = "SELECT 
					t_beli.id as poid,
					t_beli_detail.id as podid, 
					t_beli_detail.jumlah as podjm,
					t_beli_detail.total_berat as podtb, 
					t_beli_detail.harga_beli as podhb, 
					t_beli_detail.total_harga as podth, 
					m_produk_ukuran.nama as ukuran,
					m_produk_warna.nama as warna,
					m_produk.nama as nama,
					m_produk.sku as sku";
		$sql.=" FROM t_beli";
		$sql.=" LEFT JOIN t_beli_detail ON t_beli.id = t_beli_detail.id_beli";
		$sql.=" LEFT JOIN m_produk on t_beli_detail.id_produk = m_produk.id";
		$sql.=" LEFT JOIN m_produk_ukuran on t_beli_detail.id_ukuran = m_produk_ukuran.id";
		$sql.=" LEFT JOIN m_produk_warna on t_beli_detail.id_warna = m_produk_warna.id";
		$sql.=" WHERE t_beli.deleted=1 ";
		$sql.=" AND t_beli_detail.id_beli=".$id_po;
		if( !empty($requestData['search']['value']) ) {
			$sql.=" AND ( m_produk.nama LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.sku LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.kode_barang LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR m_produk.deskripsi LIKE '".$requestData['search']['value']."%' )";
		}
		$query=$this->Transaksipembelianmodel->rawQuery($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;		
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
		$query=$this->Transaksipembelianmodel->rawQuery($sql);
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
    function getOrder(){
    	$data = array();
    	foreach ($this->cart->contents() as $items){
    		$idProduks = explode("_", $items['id']);
    		if(count($idProduks) > 1){
    			if($idProduks[1] == "PEMBELIAN"){    				
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
    function getProduk($supplier = null){
    	$list = null;
    	$dataSelect['deleted'] = 1;
    	if($supplier != null){
    		$dataSelect['id_supplier'] = $supplier;
    	}
    	$list = $this->Transaksipembelianmodel->select($dataSelect, 'm_produk');
    	return json_encode($list->result_array());
    }
    function getProdukByName($keyword = null, $supplier = null){
    	$list = null;
    	$dataSelect['deleted'] = 1;
    	if($keyword != null && $supplier != null){
    		$dataLike['nama'] = $keyword;
    		$dataCondition['id_supplier'] = $supplier;
    	}
    	$list = $this->Transaksipembelianmodel->like($dataCondition, $dataLike, 'm_produk');
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
    	$list = $this->Transaksipembelianmodel->like($dataCondition, $dataLike, 'm_produk');
    	return json_encode($list->result_array());
    }    
    function getSupplier(){
    	$dataSelect['deleted'] = 1;
    	return json_encode($this->Transaksipembelianmodel->select($dataSelect, 'm_supplier_produk')->result_array());
    }
    function filterProduk($supplier){
    	echo $this->getProduk($supplier);
    }
    function getKategori($supplier){
    	$selectData = $this->Transaksipembelianmodel->rawQuery("SELECT m_produk_kategori.id, m_produk_kategori.nama FROM m_produk
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
    function getWarna(){
    	$dataSelect['deleted'] = 1;
    	$selectData = $this->Transaksipembelianmodel->select($dataSelect, 'm_produk_warna');
    	return json_encode($selectData->result_array());
    }
    function getUkuran(){
    	$dataSelect['deleted'] = 1;
    	$selectData = $this->Transaksipembelianmodel->select($dataSelect, 'm_produk_ukuran');
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
    	$this->load->view('Transaksi_pembelian/transaksi', $data);
    }
    function getTotal(){
    	$total = 0;
    	$total_item = 0;
    	foreach ($this->cart->contents() as $items) {    		
    		$idProduks = explode("_", $items['id']);
    		if(count($idProduks) > 1){
    			if($idProduks[1] == "PEMBELIAN"){
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
    	$selectData = $this->Transaksipembelianmodel->select($dataSelect, 'm_produk');
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
    			if($idProduks[1] == "PEMBELIAN"){
    				$this->cart->remove($items['rowid']);
    			}
    		}
    	}
    	echo $this->getOrder();	
    }
	function tambahCart($id){
		$inCart = $this->in_cart($id."_PEMBELIAN");
		$params	= $this->input->post();
		if($inCart != 'false'){
			$qty = $this->in_cart($id."_PEMBELIAN", 'qty') + 1;
			$this->updateCart($inCart, $qty);
		}else if($inCart == 'false'){
			$dataSelect['deleted']=1;
			$dataSelect['id']=$id;
			$selectData = $this->Transaksipembelianmodel->select($dataSelect, 'm_produk');
			$datas = array(
		                'id'      => $selectData->row()->id."_PEMBELIAN",
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
    function _getTotal(){
    	$total = 0;
    	$total_item = 0;
    	foreach ($this->cart->contents() as $items) {    		
    		$idProduks = explode("_", $items['id']);
    		if(count($idProduks) > 1){
    			if($idProduks[1] == "PEMBELIAN"){
    				$total += ($items['price']*$items['qty']);
    				$total_item += $items['qty'];
    			}
    		}
    	}
    	return json_encode(array("tax"=>0, "discount"=> 0, "total"=> $total, "total_items"=>$total_item));
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
    		$dataInsert['add_by'] = 0;
    		$dataInsert['edited_by'] = 0;
    		$dataInsert['deleted'] = 1;
    		$insertDataMaster = $this->Transaksipembelianmodel->insert($dataInsert, 't_beli');
    		if($insertDataMaster){    		
	    		$getDataID = $this->Transaksipembelianmodel->select($dataInsert, 't_beli');
	    		foreach ($this->cart->contents() as $items){
	    			$idProduks = explode("_", $items['id']);
	    			if(count($idProduks) > 1){
	    				if($idProduks[1]=="PEMBELIAN"){					
				    		$dataInsertDetail['id_beli']		        =	$getDataID->row()->id;
				    		$dataInsertDetail['id_produk']				=	$idProduks[0];	
				    		$dataInsertDetail['id_ukuran']				=	$items['options']['ukuran'];
				    		$dataInsertDetail['id_warna']				=	$items['options']['warna'];
				    		$dataInsertDetail['jumlah']					=	$items['qty'];
				    		$dataInsertDetail['total_berat']			=	$items['options']['total_berat'];
				    		$dataInsertDetail['harga_beli']				=	$items['price'];
				    		$dataInsertDetail['total_harga']			=	$items['price'] * $items['qty'];
				    		$insertDetail = $this->Transaksipembelianmodel->insert($dataInsertDetail, 't_beli_detail');
	    				}
	    			}
	    		}
    		}
    	}
    	$this->destroyCart();
    }
    function getOption($option){
    	$total = 0;
    	foreach ($this->cart->contents() as $items){
    		$idProduks = explode("_", $items['id']);
    		if (count($idProduks) > 1) {
    			if ($idProduks[1] == "PEMBELIAN") {
		    		$total += $items['options'][$option];
    			}
    		}
    	}
    	return $total;
    }
    function listPO(){
        $this->load->view('Transaksi_pembelian/listpo');
    }
    function dataPO(){
        $requestData= $_REQUEST;
        $columns = array( 
            0   =>  'id_supplier', 
            1   =>  'catatan',
            2   =>  'total_berat',
            3   =>  'total_qty',
            4   =>  'total_harga_beli',
            5   =>  'date_add',
            6   =>  'aksi'
        );
        $sql = " SELECT t_purchase_order.* , m_supplier_produk.nama as namasup ";
        $sql.= " FROM t_purchase_order ";
        $sql.= " INNER JOIN m_supplier_produk ON t_purchase_order.id_supplier = m_supplier_produk.id ";
        $query=$this->Transaksipembelianmodel->rawQuery($sql);
        $totalData = $query->num_rows();
        $totalFiltered = $totalData;
        // $sql = "SELECT * ";
        $sql.=" WHERE t_purchase_order.deleted=1 ";
        if( !empty($requestData['search']['value']) ) {
            $sql.=" AND ( id_supplier LIKE '".$requestData['search']['value']."%' ";    
            $sql.=" OR catatan LIKE '".$requestData['search']['value']."%' ";
            $sql.=" OR total_berat LIKE '".$requestData['search']['value']."%' ";
            $sql.=" OR total_qty LIKE '".$requestData['search']['value']."%' ";
            $sql.=" OR total_harga_beli LIKE '".$requestData['search']['value']."%' ";
            $sql.=" OR date_add LIKE '".$requestData['search']['value']."%' )";
        }
        $query=$this->Transaksipembelianmodel->rawQuery($sql);
        $totalFiltered = $query->num_rows();
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
        $query=$this->Transaksipembelianmodel->rawQuery($sql);
        $data = array();
        foreach ($query->result_array() as $row) {
            $nestedData     =   array(); 

            $nestedData[]   =   $row["namasup"];
            $nestedData[]   =   $row["catatan"];
            $nestedData[]   =   $row["total_berat"];
            $nestedData[]   =   $row["total_qty"];
            $nestedData[]   =   $row["total_harga_beli"];
            $nestedData[]   =   $row["date_add"];
            $nestedData[]   =   "<button onclick=choosePO('".$row['id']."') class='btn btn-success'>PILIH</button>";
            
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
    function getInfoPO($idPO){
        $dataSelect['deleted']  =   1;
        $dataSelect['id']       =   $idPO;
        $selectPOMaster = $this->Transaksipembelianmodel->select($dataSelect, 't_purchase_order');
        echo json_encode($selectPOMaster->result_array());
    }
    function addCartFromExistingPO($idPO){
        foreach ($this->cart->contents() as $items) {
            $idProduks = explode("_", $items['id']);
            if(count($idProduks) > 1){
                if($idProduks[1] == "PEMBELIAN"){
                    $this->cart->remove($items['rowid']);
                }
            }
        }
        $dataSelect['deleted']  =   1;
        $dataSelect['id']       =   $idPO;
        $selectPOMaster = $this->Transaksipembelianmodel->select($dataSelect, 't_purchase_order');
        if($selectPOMaster->num_rows() > 0){
            // $dataSelectDetail['id_purchase_order'] = $selectPOMaster->row()->id;
            $selectDataDetail = $this->Transaksipembelianmodel->rawQuery("SELECT * 
                                                                            FROM t_purchase_order_detail
                                                                            INNER JOIN m_produk ON t_purchase_order_detail.id_produk = m_produk.id
                                                                            WHERE t_purchase_order_detail.id_purchase_order =".$selectPOMaster->row()->id);
            if($selectDataDetail->num_rows() > 0){
                foreach ($selectDataDetail->result_array() as $row) {
                    $datax = array(
                                'id'      => $selectDataDetail->row()->id."_PEMBELIAN",
                                'qty'     => 1,
                                'price'   => 0,
                                'name'    => $selectDataDetail->row()->nama,
                                'options' => array(
                                                'ukuran'=>0,
                                                'warna'=>0,
                                                'total_berat'=>0
                                                )
                    );
                    $this->cart->insert($datax);                    
                }
            }
        }
        echo $this->getOrder();
    }
}