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
                  <th class="text-center">Nama Customer Level</th>
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
     Tambah Customer Level
   </button>
</div>
<!-- /.container -->

<!-- Modal Add -->
<div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Customer Level</h4>
      </div>
      <form action="" method="POST" id="myform">      
        <div class="modal-body">
           <div class="row">
             <div class="col-sm-12">
                <div class="form-group">
                 <label for="nama">Nama Customer Level</label>
                 <input type="text" name="nama" maxlength="50" Required class="form-control" id="nama" placeholder="Nama Customer Level">
                 <input type="hidden" name="id" maxlength="50" Required class="form-control" id="id" placeholder="ID Customer Level">
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
  // initialize datatable
  var table    = $("#TableMain").DataTable();
  var jsonlist = <?php echo $list; ?>;
  var awalLoad = true;
  
  loadData(jsonlist);

  function loadData(json){
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
  }
  
  
  function showAdd(){
    $("#myModalLabel").text("Tambah Customer Level");
    $("#id").val("");
    $("#nama").val("");
    $("#modalform").modal("show");    
  }
  
  function showUpdate(i){
    $("#myModalLabel").text("Ubah Customer Level");
    $("#id").val(jsonlist[i].id);
    $("#nama").val(jsonlist[i].nama);
	  $("#modalform").modal("show");
  }
  
  $("#myform").on('submit', function(e){
    e.preventDefault();
    var notifText = 'Data berhasil ditambahkan!';
    var action = "<?php echo base_url('Customer_level/Master/add')?>/";
    if ($("#id").val() != ""){
      action = "<?php echo base_url('Customer_level/Master/edit')?>/";
      notifText = 'Data berhasil diubah!';
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
          url: '<?php echo base_url('Customer_level/Master/delete'); ?>/',
          data: {"id":jsonlist[i].id},
		      dataType: 'json',
          beforeSend: function() { 
            // kasi loading
            $("#aConfirm"+i).html("Sedang Menghapus...");
          },
          success: function (data) {
      			if (data.status == '3'){
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
    $(el).attr("data-content","<button class=\'btn btn-danger myconfirm\'  href=\'#\' onclick=\'deleteData(this)\' id=\'aConfirm"+i+"\' style=\'min-width:85px\'><i class=\'fa fa-trash\'></i> Ya</button>");
		$(el).popover();

	}
  

  
</script>
