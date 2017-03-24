<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends MX_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Laporanpembelianmodel');
    }
    function index(){
    	$dataSelect['deleted'] = 1;
        $sql = "SELECT A.*, B.nama AS nama_supplier FROM t_beli A LEFT JOIN m_supplier_produk B ON A.id_supplier = B.id WHERE A.deleted = 1 ORDER BY A.date_add DESC";
        $data['list'] = json_encode($this->Laporanpembelianmodel->rawQuery($sql)->result());
        $data['data_grafik'] = json_encode($this->data_per_hari());
    	$this->load->view('Laporan_pembelian/view', $data);
    }

    function data(){
        $requestData= $_REQUEST;
        $columns = array( 
            0   =>  '#', 
            1   =>  'nama_supplier', 
            2   =>  'total_berat',
            3   =>  'total_qty',
            4   =>  'total_harga_beli',
            5   =>  'date_add',
            // 6   =>  'aksi'
        );
        $sql = "SELECT A.*, B.nama AS nama_supplier FROM t_beli A LEFT JOIN m_supplier_produk B ON A.id_supplier = B.id WHERE A.deleted = 1";
        $query=$this->Laporanpembelianmodel->rawQuery($sql);
        $totalData = $query->num_rows();
        $totalFiltered = $totalData;
        
        if( !empty($requestData['search']['value']) ) {
            $sql.=" AND ( B.nama LIKE '%".$requestData['search']['value']."%' "; 
            $sql.=" OR A.total_berat LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR A.total_qty LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR A.total_harga_beli LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR A.date_add LIKE '%".$requestData['search']['value']."%' )";
        }

        //Date range filtering
        if(!empty($requestData['start_date']) AND !empty($requestData['end_date'])) {
            $sql.=" AND ( DATE(A.date_add) >= '".date("Y-m-d", strtotime($requestData['start_date']))."' "
                ."AND DATE(A.date_add) <= '".date("Y-m-d", strtotime($requestData['end_date']))."')";
        }
        // echo $sql;
        // die();

        $query=$this->Laporanpembelianmodel->rawQuery($sql);
        $totalFiltered = $query->num_rows();

        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
        $query=$this->Laporanpembelianmodel->rawQuery($sql);
        
        $data = array(); $i=0;
        foreach ($query->result_array() as $row) {
            $nestedData     =   array(); 
            $nestedData[]   =   "<span style='display:block' class='text-center'>".($i+1)."</span>";
            $nestedData[]   =   $row["nama_supplier"];
            $nestedData[]   =   "<span class='money'>".$row["total_berat"]."</span>";
            $nestedData[]   =   "<span style='display:block' class='text-center'>".$row["total_qty"]."</span>";
            $nestedData[]   =   "<span class='pull-right money'>".$row['total_harga_beli']."</span>";
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
        $response = array();
        $params = $this->input->post();

        switch ($params['filter']) {
            case 'hari': //per hari
                $response = $this->data_per_hari();
                break;
            case 'bulan': //per bulan
                $response = $this->data_per_bulan();
                break;
            case 'tahun': //per tahun
                $response = $this->data_per_tahun();
                break;
            default:
                $response = $this->data_per_hari();
                break;
        }
        echo json_encode($response);
    }
	
    private function data_per_hari() {
        $cur_month = date("m"); $cur_year = date("Y");
        $num_of_days = date("t"); //get number of days in current month
        $days = array(); $dates = array(); $jumlah_pembelian = array(); $total_pembelian = array();
        
        $sql = "SELECT DATE(date_add) AS date, COUNT(id) AS jumlah_pembelian, SUM(total_harga_beli) AS total_pembelian FROM t_beli WHERE deleted = 1 AND (MONTH(date_add) = '".$cur_month."' AND YEAR(date_add) = '".$cur_year."') GROUP BY DATE(date_add)";
        $result = $this->Laporanpembelianmodel->rawQuery($sql)->result();

        for ($i = 1; $i <= $num_of_days; $i++) {
            $days[] =  "$i";
            $dates[] = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        for ($i = 0; $i < sizeof($dates); $i++) {
            $jumlah_pembelian[$i] = (int) 0;
            $total_pembelian[$i] = (int) 0;
            foreach ($result as $res) {
                if($dates[$i] == $res->date) {
                    $jumlah_pembelian[$i] = (int)$res->jumlah_pembelian;
                    $total_pembelian[$i] = (int)$res->total_pembelian;
                }
            }
        }
        // echo "<pre>";
        // echo "---RESULT---"; print_r($result);
        // echo "---DATES---"; print_r($dates);
        // echo "---jumlah_pembelian---"; print_r($jumlah_pembelian);
        // echo "---total_pembelian---"; print_r($total_pembelian);
        // echo "</pre>"; die();
        $response = array( 'data_per' => $days, 'dates' => $dates, 'jumlah_pembelian' => $jumlah_pembelian, 'total_pembelian' => $total_pembelian );
        return $response;
    }

    private function data_per_bulan() {
        $cur_month = date("m"); $cur_year = date("Y");
        $num_of_months = 12;
        $months = array(); $dates = array(); $jumlah_pembelian = array(); $total_pembelian = array();
        
        $sql = "SELECT MONTH(date_add) AS month, COUNT(id) AS jumlah_pembelian, SUM(total_harga_beli) AS total_pembelian FROM t_beli WHERE deleted = 1 AND (YEAR(date_add) = '".$cur_year."') GROUP BY MONTH(date_add)";
        $result = $this->Laporanpembelianmodel->rawQuery($sql)->result();

        for ($m = 1; $m <= $num_of_months; $m++) {
            $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
            $months[] = $month;
        }

        for ($i = 0; $i < $num_of_months; $i++) {
            $jumlah_pembelian[$i] = (int) 0;
            $total_pembelian[$i] = (int) 0;
            foreach ($result as $res) {
                if(($i+1) == $res->month) {
                    $jumlah_pembelian[$i] = (int)$res->jumlah_pembelian;
                    $total_pembelian[$i] = (int)$res->total_pembelian;
                }
            }
        }
        // echo "<pre>";
        // echo "---RESULT---"; print_r($result);
        // echo "---months---"; print_r($months);
        // echo "---jumlah_pembelian---"; print_r($jumlah_pembelian);
        // echo "---total_pembelian---"; print_r($total_pembelian);
        // echo "</pre>"; die();
        $response = array( 'data_per' => $months, 'dates' => $dates, 'jumlah_pembelian' => $jumlah_pembelian, 'total_pembelian' => $total_pembelian );
        return $response;
    }

    private function data_per_tahun() {
        $cur_year = date("Y");
        $num_of_years = 6;
        $years = array(); $dates = array(); $jumlah_pembelian = array(); $total_pembelian = array();
        
        $sql = "SELECT YEAR(date_add) AS year, COUNT(id) AS jumlah_pembelian, SUM(total_harga_beli) AS total_pembelian FROM t_beli WHERE deleted = 1 AND (YEAR(date_add) = '".$cur_year."' OR YEAR(date_add) = '".($cur_year-1)."' OR YEAR(date_add) = '".($cur_year-2)."' OR YEAR(date_add) = '".($cur_year-3)."' OR YEAR(date_add) = '".($cur_year-4)."' OR YEAR(date_add) = '".($cur_year-5)."') GROUP BY YEAR(date_add)";
        $result = $this->Laporanpembelianmodel->rawQuery($sql)->result();

        for ($y = $num_of_years; $y > 0; $y--) {
            $years[] = ($cur_year+1) - $y;
        }

        $i = 0;
        foreach ($years as $year) {
            $jumlah_pembelian[$i] = (int) 0;
            $total_pembelian[$i] = (int) 0;
            foreach ($result as $res) {
                if($year == $res->year) {
                    $jumlah_pembelian[$i] = (int)$res->jumlah_pembelian;
                    $total_pembelian[$i] = (int)$res->total_pembelian;
                }
            } $i++;
        }
        // echo "<pre>";
        // echo "---RESULT---"; print_r($result);
        // echo "---years---"; print_r($years);
        // echo "---jumlah_pembelian---"; print_r($jumlah_pembelian);
        // echo "---total_pembelian---"; print_r($total_pembelian);
        // echo "</pre>"; die();
        $response = array( 'data_per' => $years, 'dates' => $dates, 'jumlah_pembelian' => $jumlah_pembelian, 'total_pembelian' => $total_pembelian );
        return $response;
    }
   
    
}