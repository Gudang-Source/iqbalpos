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
    		array_push($data, $nestedData);
    	}
    	return json_encode($data);
    }
    function transaksi(){
    	$dataSelect['deleted'] = 1;
    	$data['list_produk'] = json_encode($this->Transaksiservicemodel->select($dataSelect, 'm_produk')->result());
        $data['list_order'] = $this->getOrder();
        $data['total'] = $this->cart->total();
        $data['total_items'] = $this->cart->total_items();
        $data['tax'] = 0;
        $data['discount'] = 0;
    	$this->load->view('Transaksi_service/transaksi', $data);
    }
    function getTotal(){
    	echo json_encode(array("tax"=>0, "discount"=> 0, "total"=> $this->cart->total(), "total_items"=>$this->cart->total_items()));
    }
    function updateCart($id, $qty){
		$data = array(
		        'rowid'  => $id,
		        'qty'    => $qty,
		);
		$this->cart->update($data);
		echo $this->getOrder();   	
    }
    function deleteCart($id){
    	$this->cart->remove($id);
    	echo $this->getOrder();
    }
    function destroyCart(){
    	$this->cart->destroy();
    	echo $this->getOrder();	
    }
	function tambahCart(){
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
}