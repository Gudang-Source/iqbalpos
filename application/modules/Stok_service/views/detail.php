<!-- Page Content -->
      <table id="TableMains" class="table table-striped table-bordered" cellspacing="0" width="80%">
          <thead>
              <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Produk</th>
                  <th class="text-center">SKU</th>
                  <th class="text-center" class="hidden-xs">Barang Diservis</th>
                  <th class="text-center" class="hidden-xs">Barang Kembali</th>
                  <th class="text-center" class="hidden-xs">Uang Kembali</th>
                  <th class="text-center" class="hidden-xs">Status Kembali</th>
                  <th class="text-center" class="hidden-xs">Aksi</th>
              </tr>
          </thead>

          <tbody id='bodytable'>
            
          </tbody>
      </table>
<!-- /.container -->
<script type="text/javascript" language="javascript" >  
    // $(document).ready(function() {
    var dataTables = $('#TableMains').DataTable( {
        "searching": false,
        "processing": true,
        "serverSide": true,
        "ajax":{
            url : "<?php echo base_url('Stok_service/Transaksi/data_detail'); ?>/"+<?php echo $id; ?>,
            type: "get",
            dataType : "json",
            error: function(){
                $("#TableMains").append('<tbody class="employee-grid-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
                // dataTable.ajax.reload( null, false );
            }
        }
    });
    // });
    function confirm(id){
      var jbk = $('#jbk-'+id).val();
      var juk = $('#juk-'+id).val();
      var sts = $('#sts-'+id).val();
      /* alert('JBK'+jbk+' JUK'+juk); */
      $.ajax({
        url :"<?php echo base_url('Stok_service/Transaksi/confirm')?>/"+id,
        type : "POST",
        data : "jbk="+jbk+"&juk="+juk+"&sts="+sts+"&id="+id,
        success : function(data){
          dataTables.ajax.reload( null, false );
        }
      });      
    }

</script>
