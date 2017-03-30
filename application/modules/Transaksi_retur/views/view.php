<!-- Page Content -->
<div class="container">
<div class="row" style='min-height:80px;'>
</div>
   <div class="row" style="margin-top:10px;">
      <table id="TableMain" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>         
              <tr>
                  <th class="text-center" class="hidden-xs">ID</th>
                  <th class="text-center" class="hidden-xs">ID ORDER</th>
                  <th class="text-center" class="hidden-xs">CUSTOMER</th>
                  <th class="text-center" class="hidden-xs">CATATAN</th>
                  <th class="text-center" class="hidden-xs">JUMLAH</th>
                  <th class="text-center" class="hidden-xs">HARGA</th>
                  <th class="text-center" class="hidden-xs">TANGGAL TRANSAKSI</th>
                  <th class="text-center" class="hidden-xs">STATUS RETUR</th>
                  <th class="text-center" class="hidden-xs">PROSES</th>
                  <th class="text-center" class="hidden-xs">AKSI</th>
              </tr>
          </thead>
          <tbody id='bodytable'>            
          </tbody>
      </table>
   </div>
   <!-- Button trigger modal -->
   <a type="button" class="btn btn-add btn-lg" href="<?php echo base_url('index/modul/Transaksi_penjualan-Transaksi-transaksi'); ?>" target="_blank">
     Tambah Transaksi Retur
   </a>
</div>
<!-- /.container -->
<!-- Modal Detail -->
<div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Barang Retur</h4>
      </div>
      <div class="modal-body">
         <div class="row">
           <div class="col-lg-12"  id="body-detail">
           </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" data-dismiss="modal">Ok</button>
      </div>
    </div>
 </div>
</div>
<!-- /.Modal Detail-->
<script type="text/javascript" language="javascript" >
    function detail(id){
      $.ajax({
        url :"<?php echo base_url('Transaksi_retur/Transaksi/detail')?>/"+id,
        type : "GET",
        data :"",
        success : function(data){
          $("#body-detail").html(data);
        }
      });       
      $("#modaldetail").modal("show");
    }
    var dataTable = $('#TableMain').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax":{
            url : "<?php echo base_url('Transaksi_retur/Transaksi/data'); ?>",
            type: "post",
            error: function(){
                $("#TableMain").append('<tbody class="employee-grid-error"><tr><th colspan="10">No data found in the server</th></tr></tbody>');
            }
        },
        "drawCallback": function( settings ) {
          $('.bootstrap-toggle').bootstrapToggle({
            size: 'small',
            off: '<i class="fa fa-calendar-check-o"></i> Belum Di Proses',
            on: '<i class="fa fa-check-square-o"></i> Proses',
            offstyle: 'default',
            onstyle: 'success'
          });
          $('.bootstrap-toggle').change(function(e) { 
            if($(e.currentTarget).is(':checked')) {
              confirmStatus(e);
            }
          });
        }
    });
  function confirmStatus(e){
    e.preventDefault();
    var i = $(e.currentTarget).prop("id");
    $.confirm({
    title: 'Konfirmasi!',
    content: 'Ubah status menjadi <i class="label label-success">Selesai</i>?',
    type: 'green',
    buttons: {
        confirm: {
          text: 'Ya',
          btnClass: 'btn-success',
          action: function() {
            $('#'+i).bootstrapToggle('disable'); 
            var id  = parseInt(i.replace('toggle_',''));
            updateProses(id);
          }
        },
        cancel: {
          text: 'Batal',
          action: function() {
            $('#'+i).bootstrapToggle('off'); 
          }
        }
      }
    });
  }
  function updateProses(id){
      $.ajax({
        url :"<?php echo base_url('Transaksi_retur/Transaksi/updateProses')?>/"+id,
        type : "GET",
        data :"",
        success : function(data){
          dataTable.ajax.reload(null, false);
        }
      });   
  }

</script>
