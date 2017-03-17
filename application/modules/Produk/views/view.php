<!-- Page Content -->
<div class="container">
<div class="row" style='min-height:80px;'>
  <div id='notif-top' style="margin-top:50px;display:none;" class="col-md-4 alert alert-success pull-right">
    <strong>Sukses!</strong> Data berhasil disimpan
  </div>
</div>
   <div class="row" style="margin-top:10px;">
      <table id="TableMainServer" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th class="text-center">Nama Produk</th>
                  <th class="text-center">SKU</th>
                  <th class="text-center">Kode Barang</th>
                  <th class="text-center">Stok</th>
                  <th class="text-center" class="hidden-xs">Tanggal Buat</th>
                  <th class="text-center">Aksi</th>
              </tr>
          </thead>

          <tbody id='bodytable'>
            
          </tbody>
      </table>
   </div>
   <!-- Button trigger modal -->
   <button type="button" class="btn btn-add btn-lg"  onclick="showAdd()">
     Tambah Produk
   </button>
</div>
<!-- /.container -->

<!-- Modal Add -->
<div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Produk</h4>
      </div>
      <form action="" method="POST" id="myform" enctype="multipart/form-data"> <div class="modal-body">
           <div class="row">
             <div class="col-sm-12">
                <div class="form-group">
                 <label for="nama">Nama Produk</label>
                 <input type="text" name="nama" maxlength="50" Required class="form-control" id="nama" placeholder="Nama Produk">
                 <input type="hidden" name="id" maxlength="50" Required class="form-control" id="id" placeholder="ID Produk">
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="id_supplier">Supplier Produk</label>
                 <select name="id_supplier" class="form-control" id="id_supplier" required="">
                 </select>
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="id_satuan">Satuan</label>
                 <select name="id_satuan" class="form-control" id="id_satuan" required="">
                 </select>
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="id_ukuran">Ukuran</label>
                 <select name="id_ukuran[]" class="form-control" id="id_ukuran" multiple="">
                 </select>
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="id_warna">Warna</label>
                 <select name="id_warna[]" class="form-control" id="id_warna" multiple="">
                 </select>
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="id_gudang">Gudang</label>
                 <select name="id_gudang" class="form-control" id="id_gudang" required="">
                 </select>
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="id_kategori">Kategori Produk</label>
                 <select name="id_kategori" class="form-control" id="id_kategori" required="">
                 </select>
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="id_bahan">Bahan Produk</label>
                 <select name="id_bahan" class="form-control" id="id_bahan" required="">
                 </select>
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="id_katalog">Katalog</label>
                 <select name="id_katalog" class="form-control" id="id_katalog" required="">
                 </select>
               </div>
             </div>
             <div class="col-sm-6">
                <div class="form-group">
                 <label for="sku">SKU</label>
                 <input type="text" name="sku" maxlength="50" Required class="form-control" id="sku" placeholder="SKU">
               </div>
             </div>
             <div class="col-sm-6">
                <div class="form-group">
                 <label for="kode_barang">Kode Barang</label>
                 <input type="text" name="kode_barang" maxlength="50" Required class="form-control" id="kode_barang" placeholder="Kode Barang">
               </div>
             </div>
             <div class="col-sm-6">
                <div class="form-group">
                 <label for="berat">Berat (gram)</label>
                 <input type="number" name="berat" min="0" Required class="form-control" id="berat" placeholder="Berat (gram)">
               </div>
             </div>
             <div class="col-sm-6">
                <div class="form-group">
                 <label for="harga_beli">Harga Beli (IDR)</label>
                 <input type="number" name="harga_beli" min="0" Required class="form-control" id="harga_beli" placeholder="Harga Beli">
               </div>
             </div>
             <div class="col-sm-6">
                <div class="form-group">
                 <label for="foto">Foto</label>
                 <input type="file" name="foto" accept="image/png, image/jpeg" Required class="form-control" id="foto" placeholder="Foto">
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="versi_foto">Versi Foto</label>
                 <select name="versi_foto" class="form-control" id="versi_foto" >
                 </select>
               </div>
             </div>
             <div class="col-sm-12">
                <div class="form-group">
                 <label for="deskripsi">Deskripsi</label>
                 <textarea name="deskripsi" rows="2" Required class="form-control" id="deskripsi" placeholder="Deskripsi"></textarea>
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
<!-- /.Modal Add-->


<script type="text/javascript">
  //var table    = $("#TableMainServer").DataTable();
  // $(document).ready(function() {
  //   $('#TableMainServer').dataTable( {
  //     "bProcessing": true,
  //     "bServerSide": true,
  //     "ajax":{
  //           url :"<?php echo base_url()?>Produk/Master/data",
  //           type: "post",  // type of method  , by default would be get
  //           error: function(){  // error handling code
  //             $("#employee_grid_processing").css("display","none");
  //           }
  //         }
  //   });
  // });
  var jsonlist = <?php echo $list; ?>;
  var jsonSupplier = <?php echo $list_supplier; ?>;
  var jsonSatuan = <?php echo $list_satuan; ?>;
  var jsonGudang = <?php echo $list_gudang; ?>;
  var jsonKategori = <?php echo $list_kategori; ?>;
  var jsonBahan = <?php echo $list_bahan; ?>;
  var jsonKatalog = <?php echo $list_katalog; ?>;
  
  var jsonUkuran = <?php echo $list_ukuran; ?>;
  var jsonWarna = <?php echo $list_warna; ?>;
  var jsonDetUkuran = <?php echo $list_det_ukuran; ?>;
  var jsonDetWarna = <?php echo $list_det_warna; ?>;
  
  var awalLoad = true;
  var initDataTable = $('#TableMainServer').DataTable({
      "bProcessing": true,
      "bServerSide": true,
      "ajax":{
            url :"<?php echo base_url()?>Produk/Master/data",
            type: "post",  // type of method  , by default would be get
            error: function(){  // error handling code
              // $("#employee_grid_processing").css("display","none");
            }
          }
    });
  
  // loadData(jsonlist);

  /*function loadData(json){
	  //clear table
    table.clear().draw();
	  for(var i=0;i<json.length;i++){
      table.row.add( [
            json[i].nama,
            DateFormat.format.date(json[i].date_add, "dd-MM-yyyy HH:mm"),
            '<td class="text-center"><div class="btn-group" >'+
                '<a id="group'+i+'" class="divpopover btn btn-sm btn-default" href="javascript:void(0)" data-toggle="popover" data-placement="top" onclick="confirmDelete(this)" data-html="true" title="Hapus Data?" ><i class="fa fa-times"></i></a>'+
                '<a class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Ubah Data" onclick="showUpdate('+i+')"><i class="fa fa-pencil"></i></a>'+
               '</div>'+
            '</td>'
        ] ).draw( false );
	  }
	  if (!awalLoad){
		  $('.divpopover').attr("data-content","ok");
		  $('.divpopover').popover();
	  }
	  awalLoad = false;	 
  }*/
  function load_select_option(json, target_id, nama=""){
    var html = "";
    if(!nama == "") {
      html = "<option value='' selected disabled>Pilih "+nama+"</option>";
    }
    for (var i=0;i<json.length;i++){
         html = html+ "<option value='"+json[i].id+"'>"+json[i].nama+"</option>";
    } $(target_id).html(html);
  }
  function load_select() {
    load_select_option(jsonSupplier, "#id_supplier", "Supplier");
    load_select_option(jsonSatuan, "#id_satuan", "Satuan");
    load_select_option(jsonGudang, "#id_gudang", "Gudang");
    load_select_option(jsonKategori, "#id_kategori", "Kategori");
    load_select_option(jsonBahan, "#id_bahan", "Bahan");
    load_select_option(jsonKatalog, "#id_katalog", "Katalog");
    load_select_option(jsonUkuran, "#id_ukuran", "");
    load_select_option(jsonWarna, "#id_warna","");
    $("#id_ukuran").multiselect({
      buttonWidth: '100%',
      inheritClass: true,
      enableFiltering: true,
      includeSelectAllOption: true,
      nonSelectedText: "Pilih Ukuran"
    });
    $("#id_warna").multiselect({
      buttonWidth: '100%',
      inheritClass: true,
      enableFiltering: true,
      includeSelectAllOption: true,
      nonSelectedText: "Pilih Warna"
    });
  }
  function showAdd(){
    load_select();
    $("#myModalLabel").text("Tambah Produk");
    $("#id").val("");
    $("#nama").val("");
    $("#id_supplier").val("");
    $("#id_satuan").val("");
    $("#id_gudang").val("");
    $("#id_kategori").val("");
    $("#id_bahan").val("");
    $("#id_katalog").val("");
    $("#id_ukuran").multiselect('refresh');
    $("#id_warna").multiselect('refresh');
    $("#sku").val("");
    $("#kode_barang").val("");
    $("#berat").val("");
    $("#harga_beli").val("");
    $("#foto").val("");
    $("#versi_foto").val("");
    $("#deskripsi").val("");
    $("#modalform").modal("show");    
  }
  
  function showUpdate(i){
    load_select();
    //data ukuran & warna diambil dari tabel yang berbeda
    var dataUpdate = jsonlist.filter(function (index) { return index.id == i }); 
    console.log(dataUpdate);
    var getUkuran = jsonDetUkuran.filter(function (index) { return index.id_produk == i }); 
    var getWarna = jsonDetWarna.filter(function (index) { return index.id_produk == i });
    var id_ukuran = (getUkuran.length > 0) ? getUkuran[0].id_ukuran : "";
    var id_warna = (getUkuran.warna > 0) ? getWarna[0].id_warna : "";

    $("#myModalLabel").text("Ubah Produk");
    $("#id").val(dataUpdate[0].id);
    $("#nama").val(dataUpdate[0].nama);
    $("#id_supplier").val(dataUpdate[0].id_supplier);
    $("#id_satuan").val(dataUpdate[0].id_satuan);
    $("#id_gudang").val(dataUpdate[0].id_gudang);
    $("#id_kategori").val(dataUpdate[0].id_kategori);
    $("#id_bahan").val(dataUpdate[0].id_bahan);
    $("#id_katalog").val(dataUpdate[0].id_katalog);
    $("#id_ukuran").val(id_ukuran);
    $("#id_warna").val(id_warna);
    $("#sku").val(dataUpdate[0].sku);
    $("#kode_barang").val(dataUpdate[0].kode_barang);
    $("#berat").val(dataUpdate[0].berat);
    $("#harga_beli").val(dataUpdate[0].harga_beli);
    $("#foto").val("");
    $("#deskripsi").val(dataUpdate[0].deskripsi);
	  $("#modalform").modal("show");
  }
  
  $("#myform").on('submit', function(e){
    e.preventDefault();
    var notifText = 'Data berhasil ditambahkan!';
    var action = "<?php echo base_url('Produk/Master/add')?>/";
    if ($("#id").val() != ""){
      action = "<?php echo base_url('Produk/Master/edit')?>/";
      notifText = 'Data berhasil diubah!';
	  }
	  // var param = $('#myform').serialize();
    var paramImg = new FormData(jQuery('#myform')[0]);
    // if ($("#id").val() != ""){
    //   paramImg = new FormData(jQuery('#myform')[0])+"&id="+$('#id').val();
    //   // param = $('#myform').serialize()+"&id="+$('#id').val();
    // }
	  
    $.ajax({
      url: action,
      type: 'post',
      data: paramImg,
      cache: false,
      contentType: false,
      processData: false,
	    dataType: 'json',
      beforeSend: function() { 
        // tambahkan loading
        $("#aSimpan").prop("disabled", true);
        $('#aSimpan').html('Sedang Menyimpan...');
      },
      success: function (data) {
        if (data.status == '3'){
          console.log("ojueojueokl"+data.status);
          // jsonlist = data.list;
          // loadData(jsonlist);
          initDataTable.ajax.reload();

          $('#aSimpan').html('Simpan');
          $("#aSimpan").prop("disabled", false);
  				$("#modalform").modal('hide');
  				// $("#notif-top").fadeIn(500);
  				// $("#notif-top").fadeOut(2500);
          new PNotify({
                      title: 'Sukses',
                      text: notifText,
                      type: 'success',
                      hide: true,
                      delay: 5000,
                      styling: 'bootstrap3'
                    });
  			}
      }
    });
  });
	
	function deleteData(element){
		var el = $(element).attr("id");
		console.log(el);
		var id  = el.replace("aConfirm","");
		var i = parseInt(id);
		//console.log(jsonlist[i]);
		$.ajax({
          type: 'post',
          url: '<?php echo base_url('Produk/Master/delete'); ?>/',
          data: {"id":jsonlist[i].id},
		      dataType: 'json',
          beforeSend: function() { 
            // kasi loading
            $("#aConfirm"+i).html("Sedang Menghapus...");
            $("#aConfirm"+i).prop("disabled", true);
          },
          success: function (data) {
            if (data.status == '3'){
              $("#aConfirm"+i).prop("disabled", false);
              initDataTable.ajax.reload();
              // $("#notif-top").fadeIn(500);
              // $("#notif-top").fadeOut(2500);
              new PNotify({
                            title: 'Sukses',
                            text: 'Data berhasil dihapus!',
                            type: 'success',
                            hide: true,
                            delay: 5000,
                            styling: 'bootstrap3'
                          });
              // jsonlist = data.list;
              // loadData(jsonlist);
            }
          }    
        });
	}
	
	function confirmDelete(el){
		var element = $(el).attr("id");
		console.log(element);
		var id  = element.replace("group","");
		var i = parseInt(id);
    $(el).attr("data-content","<button class=\'btn btn-danger myconfirm\'  href=\'#\' onclick=\'deleteData(this)\' id=\'aConfirm"+i+"\' style=\'min-width:85px\'><i class=\'fa fa-trash\'></i> Ya</button>");
    $(el).popover("show");
	}
  
  //Hack untuk bootstrap popover (popover hilang jika diklik di luar)
  $(document).on('click', function (e) {
    $('[data-toggle="popover"],[data-original-title]').each(function () {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {                
            (($(this).popover('hide').data('bs.popover')||{}).inState||{}).click = false  // fix for BS 3.3.6
        }
    });
  });  
</script>
