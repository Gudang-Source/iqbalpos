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
		// $sql = "SELECT * ";
		$sql.=" WHERE deleted=1 ";
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
    function getOrder(){
    	$data = array();
    	foreach ($this->cart->contents() as $items){
    		$nestedData = array();
    		$nestedData['id'] = $items['id'];
    		$nestedData['qty'] = $items['qty'];
    		$nestedData['price'] = $items['price'];
    		$nestedData['produk'] = $items['name'];
    		$nestedData['rowid'] = $items['rowid'];
    		$nestedData['subtotal'] = $items['subtotal'];
    		$nestedData['options'] = $items['options']['stok'];
    		array_push($data, $nestedData);
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
    function getSupplier(){
    	$dataSelect['deleted'] = 1;
    	return json_encode($this->Transaksiservicemodel->select($dataSelect, 'm_supplier_produk')->result_array());
    }
    function filterProduk($supplier){
    	echo $this->getProduk($supplier);
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
    	$this->load->view('Transaksi_service/transaksi', $data);
    }
    function getTotal(){
    	echo json_encode(array("tax"=>0, "discount"=> 0, "total"=> $this->cart->total(), "total_items"=>$this->cart->total_items()));
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
    	$this->cart->destroy();
    	echo $this->getOrder();	
    }
	function tambahCart($id){
		$inCart = $this->in_cart($id);
		$dataSelect['deleted'] 	= 1;
		$dataSelect['id']		= $id;
		$selectData = $this->Transaksiservicemodel->select($dataSelect, 'm_produk');
		if($inCart != 'false'){
			if($this->in_cart($id, 'qty') < $selectData->row()->stok){			
				$qty = $this->in_cart($id, 'qty') + 1;
				$this->updateCart($inCart, $qty);
			}
		}else if($inCart == 'false'){		
			if($selectData->row()->stok > 1){			
				$datas = array(
			                'id'      => $selectData->row()->id,
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
    function data_transaksi(){
		$datas = array(
		        array(
		                'id'      => 'sku_123ABC',
		                'qty'     => 1,
		                'price'   => 39.95,
		                'name'    => 'T-Shirt',
		                'options' => array('Size' => 'L', 'Color' => 'Red')
		        ),
		        array(
		                'id'      => 'sku_567ZYX',
		                'qty'     => 1,
		                'price'   => 9.95,
		                'name'    => 'Coffee Mug'
		        ),
		        array(
		                'id'      => 'sku_965QRS',
		                'qty'     => 1,
		                'price'   => 29.95,
		                'name'    => 'Shot Glass'
		        )
		);

		$this->cart->insert($datas);    	
		$columns = array( 
			0 	=>	'produk', 
			1 	=>	'price', 
			2 	=> 	'quantity',
			3	=> 	'total'
		);
		$data = array();
		foreach ($this->cart->contents() as $items){
			$nestedData		=	array(); 

			$nestedData[] 	= 	"<div class=\'col-xs-2 nopadding\'>
				                   <a href=\'javascript:void(0)\'>
				                   <span class=\'fa-stack fa-sm productD\'>
				                     <i class=\'fa fa-circle fa-stack-2x delete-product\'></i>
				                     <i class=\'fa fa-times fa-stack-1x fa-fw fa-inverse\'></i>
				                   </span>
				                   </a>
				                 </div>
				                 <div class=\'col-xs-10 nopadding\'>                  
				                   <span class=\'textPD\'>".$items["name"]."</span>
				                 </div>";
			$nestedData[] 	= 	"<span class='textPD'>Rp. ".$items["price"]."</span>";
			$nestedData[] 	= 	"<a href='javascript:void(0)''>
									<span class='fa-stack fa-sm decbutton'>
									  <i class='fa fa-square fa-stack-2x light-grey'></i>
									  <i class='fa fa-minus fa-stack-1x fa-inverse white'></i>
									</span>
								</a>
								<input id='qt-3074' onchange='edit_posale(3074)' class='form-control' value='".$items['qty']."' placeholder='0' maxlength='2' type='text'>
								<a href='javascript:void(0)'>
									<span class='fa-stack fa-sm incbutton'>
										<i class='fa fa-square fa-stack-2x light-grey'></i>
										<i class='fa fa-plus fa-stack-1x fa-inverse white'></i>
									</span>
								</a>";
			$nestedData[] 	= 	"<span class='subtotal textPD'>Rp. ".$items["price"] * $items['qty']."</span>";

			$data[] = $nestedData;			
		}
		$json_data = array(
					"draw"            => 1,
					"recordsTotal"    => $this->cart->total_items(),
					"recordsFiltered" => $this->cart->total_items(),
					"data"            => $data
					);
		echo json_encode($json_data);
    }
    function doServices(){
    	$params = $this->input->post();
    	if($params != null){
    		$dataInsertPrimer['id_supplier'] 			= $params['supplier'];
    		$dataInsertPrimer['catatan']				= $params['catatan'];
    		$dataInsertPrimer['jumlah_barang_service']	= $this->cart->total_items();
    		$dataInsertPrimer['total_harga']			= $this->cart->total();
    		$dataInsertPrimer['jumlah_barang_kembali']	= 0;
    		$dataInsertPrimer['jumlah_uang_kembali']	= 0;
    		$dataInsertPrimer['status']					= 1;
    		$dataInsertPrimer['add_by']					= 1;
    		$dataInsertPrimer['edited_by']				= 0;
    		$insertPrimer = $this->Transaksiservicemodel->insert($dataInsertPrimer, 't_service');
    		if($insertPrimer){
    			$getId = $this->Transaksiservicemodel->select($dataInsertPrimer, 't_service');
    			$id = $getId->row()->id;
	    		$dataInsertSekunder['id_service'] = $id;
	    		$dataInsertHistori['id_service'] = $id;
		    	foreach ($this->cart->contents() as $items){
		    		$dataInsertSekunder['id_produk']				=	$items['id'];
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

			    			$dataInsertHistori['id_produk']			=	$items['id'];
			    			$dataInsertHistori['id_order_detail']	=	0;
			    			$dataInsertHistori['jumlah']			=	$items['qty'];
			    			$dataInsertHistori['stok_akhir']		=	$getDataLastStok->row()->stok - $items['qty'];
			    			$dataInsertHistori['keterangan']		=	$params['catatan'];
			    			$dataInsertHistori['status']			=	5;
			    			$dataInsertHistori['add_by']			=	0;
			    			$dataInsertHistori['edited_by']			=	0;
			    			$dataInsertHistori['deleted']			=	1;
			    			$insertHistori = $this->Transaksiservicemodel->insert($dataInsertHistori, 'h_stok_produk');
			    			if($insertHistori){
			    				$dataUpdate['stok']					=	$getDataLastStok->row()->stok - $items['qty'];
			    				$updateStok							=	$this->Transaksiservicemodel->update($dataUpdate, $dataSelectLastStok, 'm_produk');
			    				if($updateStok){
			    					$this->destroyCart();
			    				}
			    			}
		    			}
		    		}
		    	}    			
    		}
    	}
    	echo $this->getOrder();
    }
}