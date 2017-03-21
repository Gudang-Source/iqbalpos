<!-- Page Content -->
<div class="container">
<div class="row" style='min-height:80px;'>
  <div id='notif-top' style="margin-top:50px;display:none;" class="col-md-4 alert alert-success pull-right">
    <strong>Sukses!</strong> Data berhasil disimpan
  </div>
</div>

  <ul class="nav nav-tabs">
    <li class=""><a href="#tab_tabel" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> Tabel</a></li>
    <li class="active"><a href="#tab_grafik" data-toggle="tab"><i class="fa fa-users" aria-hidden="true"></i> Grafik</a></li>
  </ul>
   <div class="tab-content">
    
    <!-- TAB TABEL -->
    <div class="tab-pane fade in" id="tab_tabel">
       <div class="row">
          <form id="formTabel" method="post">
            <div class="col-sm-8">
              <label class="label-control">Range Tanggal</label>
              <div class="input-group input-daterange">
                <input type="text" id="start_date" class="form-control datepicker" placeholder="YYYY/MM/DD">
                <div class="input-group-addon">Sampai</div>
                <input type="text" id="end_date" class="form-control datepicker" placeholder="YYYY/MM/DD">
                <span class="input-group-btn">
                  <button id="fReset" class="btn btn-default" type="button" disabled=""><i class="fa fa-undo"></i> Reset</button>
                  <button id="fSubmit" class="btn btn-default" type="button"><i class="fa fa-filter"></i> Tampilkan</button>
                </span>
              </div>
            </div>
          </form>
       </div>
       <hr>

       <div class="row" style="margin-top:10px;">
          <table id="TableMainServer" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                    <th class="text-center no-sort">#</th>
                    <th class="text-center">Nama Customer</th>
                    <th class="text-center">Total Berat</th>
                    <th class="text-center">Total Qty</th>
                    <th class="text-center">Grand Total</th>
                    <th class="text-center">Jenis Order</th>
                    <th class="text-center">Metode Pembayaran</th>
                    <th class="text-center">Tanggal Order</th>
                    <!-- <th class="text-center no-sort">Aksi</th> -->
                  </tr>
              </thead>

              <tbody id='bodytable'>
                
              </tbody>
          </table>
       </div>
    </div>

    <!-- TAB GRAFIK -->
    <div class="tab-pane fade in active" id="tab_grafik">
      <div class="row">
          <form id="formGrafik" method="post">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="filter_grafik" class="label-control">Filter</label>
              <div class="input-group">
                <select name="filter_grafik" id="filter_grafik" class="form-control" required="">
                  <option value="hari">Per Hari</option>
                  <option value="bulan">Per Bulan</option>
                  <option value="tahun">Per Tahun</option>
                </select>
                <div class="input-group-btn">
                  <button id="gSubmit" class="btn btn-default"><i class="fa fa-filter"></i> Tampilkan</button>
                </div>
              </div>
            </div>
          </div>
          </form>
       </div>
       <hr>

       <div class="row">
          <div class="col-sm-12">
            <div id="chart1_container"></div>
          </div>
          <div class="col-sm-12">
            <div id="chart-area2"></div>
          </div>
       </div>
    </div>

   </div>
</div>
<!-- /.container -->


<script type="text/javascript">
  $(document).ready(function() {
    //initialize input money masking
    maskInputMoney();
    $('.datepicker').datepicker({
      todayBtn: 'linked',
      todayHighlight: true,
      autoclose: true,
      format: 'yyyy/mm/dd',
      endDate: '+0d'
    });
    $('#fSubmit').click(function(e){
      e.preventDefault();
      $("#fReset").attr("disabled", false);
      initDataTable.destroy();
      initDataTable = $('#TableMainServer').DataTable({
        "bProcessing": true,
        "bServerSide": true,
        "order": [[7, 'DESC']],
        "ajax":{
              url :"<?php echo base_url()?>Laporan_penjualan/Master/data",
              type: "post",  // type of method  , by default would be get
              "data": {
                  start_date: $("#start_date").val(),
                  end_date: $("#end_date").val()
              },
              error: function(){ /*error handling code*/ }
            },
        "columnDefs": [ {
          "targets"  : 'no-sort',
          "orderable": false,
        }]
      });
      initDataTable.ajax.reload();
    });
  });

  $('#fReset').click(function(){
      $("#fReset").attr("disabled", true);
      $('.input-daterange input').each(function() {
        $(this).datepicker('clearDates');
      });
      initDataTable.destroy();
      initDataTable = $('#TableMainServer').DataTable({
        "bProcessing": true,
        "bServerSide": true,
        "order": [[7, 'DESC']],
        "ajax":{
              url :"<?php echo base_url()?>Laporan_penjualan/Master/data",
              type: "post",  // type of method  , by default would be get
              "data": {
                  start_date: "", end_date: ""
              },
              error: function(){  // error handling code
                // $("#employee_grid_processing").css("display","none");
              }
            },
        "columnDefs": [ {
          "targets"  : 'no-sort',
          "orderable": false,
        }]
      });
      initDataTable.ajax.reload();
    });

  function maskInputMoney(){
    $('.money').mask('#.##0', {reverse: true});
  }
  function unmaskInputMoney(){
    $('.money').unmask();
  }

  var jsonlist = <?php echo $list; ?>;
  
  var awalLoad = true;
  var initDataTable = $('#TableMainServer').DataTable({
      "bProcessing": true,
      "bServerSide": true,
      "order": [[7, 'DESC']],
      "ajax":{
            url :"<?php echo base_url()?>Laporan_penjualan/Master/data",
            type: "post",  // type of method  , by default would be get
            "data": {
                start_date: $("#start_date").val(),
                end_date: $("#end_date").val()
            },
            error: function(){ /*error handling code*/ }
          },
      "columnDefs": [ {
        "targets"  : 'no-sort',
        "orderable": false,
      }]
    });
 
  // $("#myform").on('submit', function(e){
  //   e.preventDefault();
  //   var action = "<?php echo base_url('Laporan_penjualan/Master/add')?>/";

  //   unmaskInputMoney(); //clean input masking first
  //   var param = $('#myform').serialize();
  //   if ($("#id").val() != ""){
  //     param = $('#myform').serialize()+"&id="+$('#id').val();
  //   }
  //   maskInputMoney(); //re run masking
    
  //   $.ajax({
  //     url: action,
  //     type: 'post',
  //     data: param,
  //     dataType: 'json',
  //     beforeSend: function() { 
  //       // tambahkan loading
  //       $("#fSubmit").prop("disabled", true);
  //       $('#fSubmit').html('Sedang Mencari...');
  //     },
  //     success: function (data) {
  //       if (data.status == '3'){
  //         console.log("ojueojueokl"+data.status);
  //         jsonlist = data.list;
  //         // loadData(jsonlist);
  //         initDataTable.ajax.reload();

  //         $('#fSubmit').html('Simpan');
  //         $("#fSubmit").prop("disabled", false);
  //         $("#modalform").modal('hide');
  //         new PNotify({
  //                     title: 'Sukses',
  //                     text: 'Data ditemukan!',
  //                     type: 'success',
  //                     hide: true,
  //                     delay: 5000,
  //                     styling: 'bootstrap3'
  //                   });
  //       }
  //       else if (data.status == '2'){
  //         console.log("ojueojueokl"+data.status);
  //         jsonlist = data.list;
  //         // loadData(jsonlist);
  //         initDataTable.ajax.reload();

  //         $('#fSubmit').html('Simpan');
  //         $("#fSubmit").prop("disabled", false);
  //         $("#modalform").modal('hide');
  //         new PNotify({
  //                     title: 'Gagal',
  //                     text: 'Data tidak ditemukan!',
  //                     type: 'error',
  //                     hide: true,
  //                     delay: 5000,
  //                     styling: 'bootstrap3'
  //                   });
  //       }
  //     }
  //   });
  // });
 
</script>

<?php include "chart.php"; ?>

<script type="text/javascript">
  $("#gSubmit").click(function(e) {
    e.preventDefault();
    // chart1.scale.xLabels = ["100","200","100","20","40","50"];
    // chart1.update();

    var action = "<?php echo base_url('Laporan_penjualan/Master/chart_data')?>/";

    $.ajax({
      url: action,
      type: 'post',
      data: { filter: $("#filter_grafik").val() },
      dataType: 'json',
      beforeSend: function() { 
        // tambahkan loading
        $("#gSubmit").prop("disabled", true);
        $('#gSubmit').html('Sedang Mencari...');
      },
      success: function (response) {
          $('#gSubmit').html('<i class="fa fa-filter"></i> Tampilkan');
          $("#gSubmit").prop("disabled", false);
          console.log("new Dates: "+response.dates);
          console.log("new Values: "+response.values);
          var chart1 = $('#chart1_container').highcharts();
          chart1.xAxis[0].setCategories(response.dates);
          chart1.series[0].setData(response.values);

      }
    });
  })
</script>
