<!-- Page Content -->
<div class="container">
   <div class="row" style="margin-top:10px;">
      <table id="TableMains" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Produk</th>
                  <th class="text-center">SKU</th>
                  <th class="text-center" class="hidden-xs">Barang Diservis</th>
                  <th class="text-center" class="hidden-xs">Barang Kembali</th>
                  <th class="text-center" class="hidden-xs">Uang Kembali</th>
                  <th class="text-center" class="hidden-xs">Status</th>
              </tr>
          </thead>

          <tbody id='bodytable'>
            
          </tbody>
      </table>
   </div>
</div>
<!-- /.container -->

<script type="text/javascript" language="javascript" >
    $(document).ready(function() {
        var dataTable = $('#TableMains').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax":{
                url : "<?php echo base_url('Transaksi_service/Transaksi/data_detail'); ?>",
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
