<!-- Page Content -->
<div class="container">
<div class="row" style='min-height:80px;'>
  <div id='notif-top' style="margin-top:50px;display:none;" class="col-md-4 alert alert-success pull-right">
    <strong>Sukses!</strong> Data berhasil disimpan
  </div>
</div>
   <div class="row" style="margin-top:10px;">
      <table id="TableMain" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th class="text-center">ID SUPPLIER</th>
                  <th class="text-center">CATATAN</th>
                  <th class="text-center">JUMLAH BARANG DISERVICE</th>
                  <th class="text-center" class="hidden-xs">TOTAL HARGA</th>
                  <th class="text-center" class="hidden-xs">JUMLAH BARANG KEMBALI</th>
                  <th class="text-center" class="hidden-xs">JUMLAH UANG KEMBALI</th>
                  <th class="text-center" class="hidden-xs">STATUS</th>
                  <th class="text-center">TANGGAL BUAT</th>
                  <th class="text-center">AKSI</th>
              </tr>
          </thead>

          <tbody id='bodytable'>
            
          </tbody>
      </table>
   </div>
   <!-- Button trigger modal -->
   <button type="button" class="btn btn-add btn-lg"  onclick="showAdd()">
     Tambah Supplier Produk
   </button>
</div>
<!-- /.container -->

<script type="text/javascript" language="javascript" >
    function detail(id){
      $.confirm({
          title: 'Title',
          content: 'url:<?php echo base_url('Transaksi_service/Transaksi/detail'); ?>/'+id,
          onContentReady: function () {
              var self = this;
          },
          columnClass: 'col-lg-12',
          alignMiddle: 'true',
          theme: 'material'
      });
    }



    $(document).ready(function() {
        var dataTable = $('#TableMain').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax":{
                url : "<?php echo base_url('Transaksi_service/Transaksi/data'); ?>",
                type: "post",
                error: function(){
                    $("#TableMain").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    // $("#employee-grid_processing").css("display","none");
                    // dataTable.ajax.reload( null, false );
                }
            }
        });
    });
</script>
