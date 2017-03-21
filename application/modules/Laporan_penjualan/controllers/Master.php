<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Laporanpenjualanmodel');
    }
    function index(){
    	$dataSelect['deleted'] = 1;
        $sql = "SELECT A.*, B.nama AS nama_customer, C.nama AS metode_pembayaran FROM t_order A LEFT JOIN m_customer B ON A.id_customer = B.id LEFT JOIN m_metode_pembayaran C ON A.id_metode_pembayaran = C.id WHERE A.deleted = 1 ORDER BY A.date_add DESC";
        $data['list'] = json_encode($this->Laporanpenjualanmodel->rawQuery($sql)->result());
    	$this->load->view('Laporan_penjualan/view', $data);
    }

    function data(){
        $requestData= $_REQUEST;
        $columns = array( 
            0   =>  '#', 
            1   =>  'nama_customer', 
            2   =>  'total_berat',
            3   =>  'total_qty',
            4   =>  'grand_total',
            5   =>  'jenis_order',
            6   =>  'metode_pembayaran',
            7   =>  'date_add',
            // 6   =>  'aksi'
        );
        $sql = "SELECT A.*, B.nama AS nama_customer, C.nama AS metode_pembayaran FROM t_order A LEFT JOIN m_customer B ON A.id_customer = B.id LEFT JOIN m_metode_pembayaran C ON A.id_metode_pembayaran = C.id WHERE A.deleted = 1 ";
        $query=$this->Laporanpenjualanmodel->rawQuery($sql);
        $totalData = $query->num_rows();
        $totalFiltered = $totalData;
        
        if( !empty($requestData['search']['value']) ) {
            $sql.=" AND ( B.nama LIKE '%".$requestData['search']['value']."%' "; 
            $sql.=" OR A.total_berat LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR A.total_qty LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR A.grand_total LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR A.jenis_order LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR C.nama LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR A.date_add LIKE '%".$requestData['search']['value']."%' )";
        }

        //Date range filtering
        if(!empty($requestData['start_date']) AND !empty($requestData['end_date'])) {
            $sql.=" AND ( DATE(A.date_add) >= '".date("Y-m-d", strtotime($requestData['start_date']))."' "
                ."AND DATE(A.date_add) <= '".date("Y-m-d", strtotime($requestData['end_date']))."')";
        }
        // echo $sql;
        // die();

        $query=$this->Laporanpenjualanmodel->rawQuery($sql);
        $totalFiltered = $query->num_rows();

        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
        $query=$this->Laporanpenjualanmodel->rawQuery($sql);
        
        $data = array(); $i=0;
        foreach ($query->result_array() as $row) {
            $nestedData     =   array(); 
            $nestedData[]   =   $i+1;
            $nestedData[]   =   $row["nama_customer"];
            $nestedData[]   =   $row["total_berat"];
            $nestedData[]   =   $row["total_qty"];
            $nestedData[]   =   "<span class='pull-right money'>".$row['grand_total']."</span>";
            $nestedData[]   =   $row["jenis_order"];
            $nestedData[]   =   $row["metode_pembayaran"];
            $nestedData[]   =   date("d F Y", strtotime($row["date_add"]));
            // $nestedData[]   .=   '<td class="text-center"><div class="btn-group" >'
            //     .'<a id="group'.$row["id"].'" class="divpopover btn btn-sm btn-default" href="javascript:void(0)" data-toggle="popover" data-placement="top" onclick="confirmDelete(this)" data-html="true" title="Hapus Data?" ><i class="fa fa-times"></i></a>'
            //     .'<a class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Ubah Data" onclick="showUpdate('.$row["id"].')"><i class="fa fa-pencil"></i></a>'
            //    .'</div>'
            // .'</td>';
            
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

    function chart_data() {
        $cur_date = date("Y-m-d");
        $cur_month = date("m"); $cur_year = date("Y");
        $num_of_days = date("t"); //get number of days in current month
        $dates = array(); $values = array();
        /* Notes to developer 
        1. Result akan dibagi 2, yakni untuk grafik jumlah dan grafik total
        2. 
        */
        $sql = "SELECT DATE(date_add) AS date, COUNT(id) AS jumlah_penjualan FROM t_order WHERE deleted = 1 AND (MONTH(date_add) = '".$cur_month."' AND YEAR(date_add) = '".$cur_year."') GROUP BY DATE(date_add)";
        $result = $this->Laporanpenjualanmodel->rawQuery($sql)->result();

        for ($i = 1; $i <= $num_of_days; $i++) {
            $dates[] = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        for ($i = 0; $i < sizeof($dates); $i++) {
            $values[$i] = 5;
            foreach ($result as $res) {
                if($dates[$i] == $res->date) {
                    $values[$i] = $res->jumlah_penjualan;
                }
            }
        }
        echo "<pre>";
        echo "---RESULT---";
        print_r($result);
        echo "---DATES---";
        print_r($dates);
        echo "---VALUES---";
        print_r($values);
        echo "</pre>";
        $response = array( 'dates' => $dates, 'values' => $values );
        echo json_encode($response);
    }
	
	function test(){
		header('Content-Type: application/json; charset=utf-8');
		$dataSelect['deleted'] = 1;
		$list = $this->Laporanpenjualanmodel->select($dataSelect, 'fin_transfer_harian')->result();
		echo json_encode(array('status' => '3','list' => $list));
	}
	
	function get($id = null){   	
    	if($id != null){
    		$dataSelect['id'] = $id;
    		$selectData = $this->Laporanpenjualanmodel->select($dataSelect, 'fin_transfer_harian');
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
	
   
    
}