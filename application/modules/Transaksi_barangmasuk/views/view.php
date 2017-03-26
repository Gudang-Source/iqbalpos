<!-- Page Content -->
<div class="container">
<div class="row" style='min-height:80px;'>
</div>
   <div class="row" style="margin-top:10px;">
      <table id="TableMain" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th class="text-center">SUPPLIER</th>
                  <th class="text-center">SATUAN</th>
                  <th class="text-center">GUDANG</th>
                  <th class="text-center">BAHAN</th>
                  <th class="text-center">NAMA</th>
                  <th class="text-center">SKU</th>
                  <th class="text-center">DESKRIPSI</th>
                  <th class="text-center">HARGA BELI</th>
                  <th class="text-center">STOK</th>
                  <th class="text-center">TERAKHIR UPDATE</th>
                  <th class="text-center" class="hidden-xs">DATE ADD</th>
                  <th class="text-center" class="hidden-xs">AKSI</th>
              </tr>
          </thead>

          <tbody id='bodytable'>
            
          </tbody>
      </table>
   </div>
</div>
<!-- /.container -->
<!-- Modal Ubah -->
<div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ubah Stok Produk</h4>
      </div>
      <form action="<?php echo base_url('Transaksi_barangmasuk/Transaksi/ubahStok') ?>" method="POST" id="myform">      
        <div class="modal-body">
           <div class="row">
             <div class="col-sm-12">
                <div class="form-group">
                 <label for="nama">Jumlah QTY</label>
                 <input type="text" name="qty" maxlength="50" Required class="form-control" id="qty" placeholder="Stok Produk">
                 <input type="hidden" name="state" maxlength="50" Required class="form-control" id="state">
                 <input type="hidden" name="idProduk" maxlength="50" Required class="form-control" id="idProduk">
               </div>
             </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-add" id="aSimpan">Simpan</button>
        </div>
      </form>
    </div>
 </div>
</div>
<!-- /.Modal Ubah-->
<script type="text/javascript" language="javascript" >
    function tambahStok(id){
      $("#myModalLabel").html("Tambah Stok Produk");
      $("#state").val("tambah");
      $("#qty").val("");
      $("#idProduk").val(id);
      $("#modalform").modal("show");
    }
    function kurangStok(id){
      $("#myModalLabel").val("Kurang Stok Produk");
      $("#state").val("kurang");
      $("#qty").val("");
      $("#idProduk").val(id);
      $("#modalform").modal("show");
    }
    $(document).ready(function() {
        var dataTable = $('#TableMain').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax":{
                url : "<?php echo base_url('Transaksi_barangmasuk/Transaksi/data'); ?>",
                type: "post",
                error: function(){
                    $("#TableMain").append('<tbody class="employee-grid-error"><tr><th colspan="12">No data found in the server</th></tr></tbody>');
                    // $("#employee-grid_processing").css("display","none");
                    // dataTable.ajax.reload( null, false );
                }
            }
        });
        $("#myform").on('submit', function(e){
          e.preventDefault();
          $.ajax({
            url : $("#myform").attr('action'),
            type : $("#myform").attr('method'),
            data : $("#myform").serialize(),
            dataType: 'json',
            beforeSend: function() { 
              $("#aSimpan").prop("disabled", true);
              $('#aSimpan').html('Sedang Menyimpan...');
            },            
            success : function(data){
              console.log(data);
              if(data.status == 1){
                new PNotify({
                            title: 'Berhasil',
                            text: "Berhasil Update Stok",
                            type: 'success',
                            hide: true,
                            delay: 5000,
                            styling: 'bootstrap3'
                          });          
              }else{
                new PNotify({
                            title: 'Gagal',
                            text: "Gagal Update Stok",
                            type: 'danger',
                            hide: true,
                            delay: 5000,
                            styling: 'bootstrap3'
                          });          

              }
              $('#aSimpan').html('Simpan');
              $("#aSimpan").prop("disabled", false);              
              dataTable.ajax.reload( null, false );
              $("#modalform").modal("hide");
            }
          });    
        });
    });
</script>
