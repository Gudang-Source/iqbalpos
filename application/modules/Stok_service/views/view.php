<!-- Page Content -->
<div class="container">
  <div class="row">
    <h3><strong>List</strong> - Stok Service</h3>
  </div>
   <div class="row" style="margin-top:10px;">
      <table id="TableMain" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th class="text-center">NAMA SUPPLIER</th>
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
   <a type="button" class="btn btn-add btn-lg" href="<?php echo base_url('index/modul/Stok_service-Transaksi-transaksi'); ?>" target="_blank">
     Tambah Stok Services
   </a>
</div>
<!-- /.container -->
<!-- Modal Detail -->
<div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="<?php echo base_url('Stok_service/Transaksi/confirm')?>" method="POST" id="frm-detail">          
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Barang Service</h4>
      </div>
      <div class="modal-body">
         <div class="row">
           <div class="col-lg-12"  id="body-detail">
           </div>
         </div>
      </div>
      <div class="modal-footer">
          <div class="row">
           <div class="col-lg-10">
           *Barang yang statusnya sudah diubah, tidak akan bisa diubah lagi, <br>mohon periksa kembali sebelum klik tombol confirm
           </div>
           <div class="col-lg-1">
            <button type="submit" class="btn btn-success">Confirm</button>
           </div>
          </div>
      </div>
      </form>
    </div>
 </div>
</div>
<!-- /.Modal Detail-->
<script type="text/javascript" language="javascript" >
    function maskInputMoney(){
      $('.money').mask('#.##0', {reverse: true});
    }
    function unmaskInputMoney(){
      $('.money').unmask();
    }
    maskInputMoney();
    var dataTable = $('#TableMain').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax":{
            url : "<?php echo base_url('Stok_service/Transaksi/data'); ?>",
            type: "post",
            error: function(){
                $("#TableMain").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                // $("#employee-grid_processing").css("display","none");
                // dataTable.ajax.reload( null, false );
            }
        }
    });
    function detail(id){
      $.ajax({
        url :"<?php echo base_url('Stok_service/Transaksi/detail')?>/"+id,
        type : "GET",
        data :"",
        success : function(data){
          $("#body-detail").html(data);
        }
      });       
      $("#modaldetail").modal("show");
    }
    function testClick(){
      $("#frm-detail").submit();
    }
    $(document).ready(function(){
      $("#frm-detail").on('submit', function(e){
        e.preventDefault();
        unmaskInputMoney();
        $.ajax({
          url : $('#frm-detail').attr('action'),
          type : $('#frm-detail').attr('method'),
          data : $("#frm-detail").serialize(),
          dataType : 'json',
          success : function(data){
            if(data.status == 1){
              $("#modaldetail").modal('hide');
              dataTable.ajax.reload(null, false);
              maskInputMoney();
            }
          }
        });   
      });      
    });

</script>
