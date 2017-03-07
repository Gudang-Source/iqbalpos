<!-- Page Content -->
<div class="container">
<div class="row" style='min-height:80px;'>
  <div id='notif-top' style="margin-top:50px;display:none;" class="col-md-4 alert alert-success pull-right">
    <strong>Sukses!</strong> Data berhasil disimpan
  </div>
</div>
   <div class="row" style="margin-top:10px;">
      <table id="Table" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th>Nama Pegawai</th>
                  <th>Alamat</th>
                  <th>HP Pegawai</th>
                  <th class="hidden-xs">Pegawai Email</th>
                  <th class="hidden-xs">Tanggal Buat</th>
                  <th>Aksi</th>
              </tr>
          </thead>

          <tbody id='bodytable'>
            
          </tbody>
      </table>
   </div>
   <!-- Button trigger modal -->
   <button type="button" class="btn btn-add btn-lg"  onclick="showAdd()">
     Tambah Pegawai
   </button>
</div>
<!-- /.container -->

<!-- Modal Add -->
<div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Pegawai</h4>
      </div>
      <form action="" method="POST" id="myform">      
        <div class="modal-body">
           <div class="row">
             <div class="col-sm-12">
                <div class="form-group">
                 <label for="nama">Nama Pegawai</label>
                 <input type="text" name="nama" maxlength="50" Required class="form-control" id="nama" placeholder="Nama Pegawai">
                 <input type="hidden" name="id" maxlength="50" Required class="form-control" id="id" placeholder="Nama Pegawai">
               </div>
             </div>
             <div class="col-sm-12">
               <div class="form-group">
                 <label for="alamat">Alamat Pegawai</label>
                 <input type="text" name="alamat" maxlength="30" class="form-control" id="alamat" placeholder="Alamat Pegawai">
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="no_telp">No Telp Pegawai</label>
                 <input type="text" maxlength="50" name="no_telp" class="form-control" id="no_telp" placeholder="No Telp Pegawai">
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="email">Email Pegawai</label>
                 <input type="email" maxlength="50" name="email" class="form-control" id="email" placeholder="Email Pegawai">
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="id_provinsi">Provinsi</label>
                 <select  onchange='get_kota()' name="id_provinsi" class="form-control" id="id_provinsi" >
                 </select>
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="id_kota">Kota</label>
                 <select name="id_kota" class="form-control" id="id_kota">
                 </select>
                
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="kodepos">Kode Pos</label>
                 <input type="text" maxlength="10" name="kodepos" class="form-control" id="kodepos" placeholder="Kode Pos">
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="id_pegawai_level">Level</label>
                 <input type="text" maxlength="50" name="id_pegawai_level" class="form-control" id="id_pegawai_level" placeholder="Level">
               </div>
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                 <label for="password">Password</label>
                 <input type="password" maxlength="50" name="password" class="form-control" id="password" placeholder="Password">
               </div>
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

  var jsonlist = <?php echo $list; ?>;
  var jsonprov = <?php echo $list_prov; ?>;
  var jsonKota = <?php echo $list_kota; ?>
 
  var awalLoad = true;
  
  loadData(jsonlist);
  load_prov(jsonprov);
  
  function load_prov(json){
  	var html = "<option value=''>Pilih Provinsi</option>";
  	for (var i=0;i<json.length;i++){
  	     html = html+ "<option value='"+json[i].id+"'>"+json[i].nama+"</option>";
  	}
  	$("#id_provinsi").html(html);
  }
  
  function load_kota(json){
    console.log(json);
  	var html = "<option value=''>Pilih Kota</option>";
  	for (var i=0;i<json.length;i++){
  	     html = html+ "<option value='"+json[i].id+"'>"+json[i].nama+"</option>";
  	}
  	$("#id_kota").html(html);
  }
  
  function get_kota(){
  	if ($("#id_provinsi").val() == "" || $("#id_provinsi").val()==null){
  	   return false;
  	}
  	$("#id_kota").prop("disabled",true);
  	
  	$.ajax({
  	   url :"<?php echo base_url('Pegawai/Master/get_kota')?>/",
  	   type : "GET",
  	   data :"id_prov="+$("#id_provinsi").val(),
  	   dataType : "json",
  	   success : function(data){
  	      $("#id_kota").prop("disabled",false);
  	      load_kota(data);
  	      
  	   }
  	});
  }
  function sync_kota(provinsi){
    $.ajax({
       url :"<?php echo base_url('Pegawai/Master/get_kota')?>/",
       type : "GET",
       data :"id_prov="+provinsi,
       dataType : "json",
       success : function(data){
          $("#id_kota").prop("disabled",false);
          load_kota(data);
       }
    });
  }
  
  function loadData(json){
	 
	  var html = "";
	  $("#bodytable").html("");
	  
	  for(var i=0;i<json.length;i++){
		  html = html+'<tr >'+
                 '<td>'+json[i].nama+'</td>'+
                 '<td>'+json[i].alamat+'</td>'+
                 '<td>'+json[i].no_telp+'</td>'+
                 '<td class="hidden-xs">'+json[i].email+'</td>'+
                 '<td class="hidden-xs">'+json[i].date_add+'</td>'+
                 '<td><div class="btn-group" >'+
                      '<a id="group'+i+'" class="divpopover btn btn-default" href="javascript:void(0)" data-toggle="popover" data-placement="left" onclick="confirmDelete(this)" data-html="true" title="Hapus Data?" ><i class="fa fa-times"></i></a>'+
                      '<a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Ubah Data" onclick="showUpdate('+i+')"><i class="fa fa-pencil"></i></a>'+
                     '</div>'+
                  '</td>'+
              '</tr>';
	  }
	  
	  $("#bodytable").html(html);
	  // $("#tablemain").DataTable();
	  if (!awalLoad){
		  $('.divpopover').attr("data-content","ok");
		  $('.divpopover').popover();
	  }
	  awalLoad = false;	 
  }
  
  
  function showAdd(){
    $("#myModalLabel").text("Tambah Pegawai");
    $("#id").val("");
    $("#nama").val("");
    $("#alamat").val("");
    $("#no_telp").val("");
    $("#email").val("");
    $("#kodepos").val("");
    $("#id_pegawai_level").val("");
    load_prov(jsonprov);
    $("#modalform").modal("show");    
  }
  
  function showUpdate(i){
    load_prov(jsonprov);
    load_kota(jsonKota);

    $("#myModalLabel").text("Ubah Pegawai");
    $("#id").val(jsonlist[i].id);
    $("#nama").val(jsonlist[i].nama);
    $("#alamat").val(jsonlist[i].alamat);
    $("#no_telp").val(jsonlist[i].no_telp);
    $("#email").val(jsonlist[i].email);
    $("#kodepos").val(jsonlist[i].kode_pos);
  	$("#id_provinsi").val(jsonlist[i].id_provinsi);
  	$("#id_kota").val(jsonlist[i].id_kota);
  	$("#id_pegawai_level").val(jsonlist[i].id_pegawai_level);
	  $("#modalform").modal("show");
  }
  
  $("#myform").on('submit', function(e){
    e.preventDefault();
	  var action = "<?php echo base_url('Pegawai/Master/add')?>/";
	  if ($("#id").val() != ""){
		  action = "<?php echo base_url('Pegawai/Master/edit')?>/";
	  }
	  var param = $('#myform').serialize();
	  if ($("#id").val() != ""){
		 param = $('#myform').serialize()+"&id="+$('#id').val();
	  }
	  
    $.ajax({
      type: 'post',
      url: action,
      data: param,
	    dataType: 'json',
      beforeSend: function() { 
        // tambahkan loading
        $('#aSimpan').html('Sedang Menyimpan...');
      },
      success: function (data) {
  			if (data.status == '3'){
  				console.log("ojueojueokl"+data.status);
  				jsonlist = data.list;
  				loadData(jsonlist);
          $('#aSimpan').html('Simpan');
  				$("#modalform").modal('hide');
  				$("#notif-top").fadeIn(500);
  				$("#notif-top").fadeOut(2500);
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
          url: '<?php echo base_url('Pegawai/Master/delete'); ?>/',
          data: {"id":jsonlist[i].id},
		      dataType: 'json',
          beforeSend: function() { 
            // kasi loading
            $("#aConfirm"+i).html("Sedang Menghapus...");
          },
          success: function (data) {
      			if (data.status == '3'){
  				$("#notif-top").fadeIn(500);
  				$("#notif-top").fadeOut(2500);
      				jsonlist = data.list;
      				loadData(jsonlist);
      			}
          }    
        });
	}
	
	function confirmDelete(el){
		var element = $(el).attr("id");
		console.log(element);
		var id  = element.replace("group","");
		var i = parseInt(id);
		$(el).attr("data-content","<button class=\'btn btn-danger myconfirm\'  href=\'#\' onclick=\'deleteData(this)\' id=\'aConfirm"+i+"\'>Ya</button>");
		$(el).popover();

	}
  

  
</script>
