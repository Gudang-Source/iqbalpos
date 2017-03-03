<!-- Page Content -->
<div class="container">
   <div class="row" style="margin-top:100px;">
      <table id="TablePegawai" class="table table-striped table-bordered" cellspacing="0" width="100%">
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

          <tbody>
             <?php foreach ($pegawai->result_array() as $spegawai):?>
              <tr id="tRow<?=$spegawai['id']?>">
                 <td><?=$spegawai['nama'];?></td>
                 <td><?=$spegawai['alamat'];?></td>
                 <td><?=$spegawai['no_telp'];?></td>
                 <td class="hidden-xs"><?=$spegawai['email'];?></td>
                 <td class="hidden-xs"><?=$spegawai['date_add'];?></td>
                 <td><div class="btn-group">
                      <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Hapus Data" href="javascript:void(0)" onclick="showDialogDelete('<?=$spegawai['id']?>')"><i class="fa fa-times"></i></a>
                      <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Ubah Data" onclick="showDialogUpdate('<?=$spegawai['id']?>', this)"><i class="fa fa-pencil"></i></a>
                     </div>
                  </td>
              </tr>
           <?php endforeach;?>
          </tbody>
      </table>
   </div>
   <!-- Button trigger modal -->
   <button type="button" class="btn btn-add btn-lg" data-toggle="modal" data-target="#AddPegawai">
     Tambah Pegawai
   </button>
</div>
<!-- /.container -->

<!-- Modal Add -->
<div class="modal fade" id="AddPegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Pegawai</h4>
      </div>
      <form action="" method="POST" id="formAddPegawai">      
        <div class="modal-body">
              <div class="form-group">
               <label for="nama">Nama Pegawai</label>
               <input type="text" name="nama" maxlength="50" Required class="form-control" id="nama" placeholder="Nama Pegawai">
             </div>
             <div class="form-group">
               <label for="alamat">Alamat Pegawai</label>
               <input type="text" name="alamat" maxlength="30" class="form-control" id="alamat" placeholder="Alamat Pegawai">
             </div>
             <div class="form-group">
               <label for="no_telp">No Telp Pegawai</label>
               <input type="text" maxlength="50" name="no_telp" class="form-control" id="no_telp" placeholder="No Telp Pegawai">
             </div>
             <div class="form-group">
               <label for="email">Email Pegawai</label>
               <input type="email" maxlength="50" name="email" class="form-control" id="email" placeholder="Email Pegawai">
             </div>
             <div class="form-group">
               <label for="password">Password</label>
               <input type="password" maxlength="50" name="password" class="form-control" id="password" placeholder="Password">
             </div>
             <div class="form-group">
               <label for="kodepos">Kode Pos</label>
               <input type="text" maxlength="10" name="kodepos" class="form-control" id="kodepos" placeholder="Kode Pos">
             </div>
             <div class="form-group">
               <label for="id_provinsi">Provinsi</label>
               <input type="text" maxlength="50" name="id_provinsi" class="form-control" id="id_provinsi" placeholder="Provinsi">
             </div>
             <div class="form-group">
               <label for="id_kota">Kota</label>
               <input type="text" maxlength="50" name="id_kota" class="form-control" id="id_kota" placeholder="Kota">
             </div>
             <div class="form-group">
               <label for="id_pegawai_level">Level</label>
               <input type="text" maxlength="50" name="id_pegawai_level" class="form-control" id="id_pegawai_level" placeholder="Level">
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

<!-- Modal Edit -->
<div class="modal fade" id="EditPegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ubah Data Pegawai</h4>
      </div>
      <form action="" method="POST" id="formEditPegawai">      
        <div class="modal-body">
              <div class="form-group">
               <label for="nama">Nama Pegawai</label>
               <input type="text" name="nama" maxlength="50" Required class="form-control" id="enama" placeholder="Nama Pegawai">
               <input type="hidden" name="row" maxlength="50" Required class="form-control" id="row">
               <input type="hidden" name="id" maxlength="50" Required class="form-control" id="eid">
             </div>
             <div class="form-group">
               <label for="alamat">Alamat Pegawai</label>
               <input type="text" name="alamat" maxlength="30" class="form-control" id="ealamat" placeholder="Alamat Pegawai">
             </div>
             <div class="form-group">
               <label for="no_telp">No Telp Pegawai</label>
               <input type="text" maxlength="50" name="no_telp" class="form-control" id="eno_telp" placeholder="No Telp Pegawai">
             </div>
             <div class="form-group">
               <label for="email">Email Pegawai</label>
               <input type="email" maxlength="50" name="email" class="form-control" id="eemail" placeholder="Email Pegawai">
             </div>
             <div class="form-group">
               <label for="kodepos">Kode Pos</label>
               <input type="text" maxlength="10" name="kodepos" class="form-control" id="ekodepos" placeholder="Kode Pos">
             </div>
             <div class="form-group">
               <label for="id_provinsi">Provinsi</label>
               <input type="text" maxlength="50" name="id_provinsi" class="form-control" id="eid_provinsi" placeholder="Provinsi">
             </div>
             <div class="form-group">
               <label for="id_kota">Kota</label>
               <input type="text" maxlength="50" name="id_kota" class="form-control" id="eid_kota" placeholder="Kota">
             </div>
             <div class="form-group">
               <label for="id_pegawai_level">Level</label>
               <input type="text" maxlength="50" name="id_pegawai_level" class="form-control" id="eid_pegawai_level" placeholder="Level">
             </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-add" id="eSimpan">Simpan</button>
        </div>
      </form>
    </div>
 </div>
</div>
<!-- /.Modal Edit-->
<!-- Modal Delete -->
<div class="modal fade" id="HapusPegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Hapus Pegawai?</h4>
      </div>
      <form action="" method="POST" id="formHapusPegawai">      
        <div class="modal-body">
              <div class="form-group">
               <label for="nama">Nama Pegawai</label>
               <input type="text" name="nama" maxlength="50" Required class="form-control" id="hnama" placeholder="Nama Pegawai">
               <input type="hidden" name="row" maxlength="50" Required class="form-control" id="hrow">
               <input type="hidden" name="id" maxlength="50" Required class="form-control" id="hid">               
             </div>
             <div class="form-group">
               <label for="alamat">Alamat Pegawai</label>
               <input type="text" name="alamat" maxlength="30" class="form-control" id="halamat" placeholder="Alamat Pegawai">
             </div>
             <div class="form-group">
               <label for="no_telp">No Telp Pegawai</label>
               <input type="text" maxlength="50" name="no_telp" class="form-control" id="hno_telp" placeholder="No Telp Pegawai">
             </div>
             <div class="form-group">
               <label for="email">Email Pegawai</label>
               <input type="email" maxlength="50" name="email" class="form-control" id="hemail" placeholder="Email Pegawai">
             </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-add" id="aHapus">Hapus</button>
        </div>
      </form>
    </div>
 </div>
</div>
<!-- /.Modal Delete-->
<script type="text/javascript">
  $(document).ready(function(){
    var t = $('#TablePegawai').DataTable();
    showDialogDelete = function(id){
        if ( $("#tRow"+id).hasClass('selectedRow') ) {
            $("#tRow"+id).removeClass('selectedRow');
        }else {
            t.$('tr.selectedRow').removeClass('selectedRow');
            $("#tRow"+id).addClass('selectedRow');
        }
        $.ajax({
          type: 'post',
          url: '<?php echo base_url('Pegawai/Master/get'); ?>/'+id,
          data: $('form').serialize(),
          success: function (i) {
            var jsonObjectParse = JSON.parse(i);
            var jsonObjectStringify = JSON.stringify(jsonObjectParse);
            var jsonObjectFinal = JSON.parse(jsonObjectStringify);
            $("#hrow").val(jsonObjectFinal.id);
            $("#hid").val(jsonObjectFinal.id);
            $("#hnama").val(jsonObjectFinal.nama);
            $("#halamat").val(jsonObjectFinal.alamat);
            $("#hno_telp").val(jsonObjectFinal.no_telp);
            $("#hemail").val(jsonObjectFinal.email);
            $("#HapusPegawai").modal('show');
          }    
        });
    }
    showDialogUpdate = function(id, r){
        var iRow = r.parentNode.parentNode.parentNode.rowIndex;
        $.ajax({
          type: 'post',
          url: '<?php echo base_url('Pegawai/Master/get'); ?>/'+id,
          data: $('form').serialize(),
          success: function (i) {
            var jsonObjectParse = JSON.parse(i);
            var jsonObjectStringify = JSON.stringify(jsonObjectParse);
            var jsonObjectFinal = JSON.parse(jsonObjectStringify);
            $("#row").val(iRow);
            $("#eid").val(jsonObjectFinal.id);
            $("#enama").val(jsonObjectFinal.nama);
            $("#ealamat").val(jsonObjectFinal.alamat);
            $("#eno_telp").val(jsonObjectFinal.no_telp);
            $("#eemail").val(jsonObjectFinal.email);
            $("#ekodepos").val(jsonObjectFinal.kode_pos);
            $("#eid_provinsi").val(jsonObjectFinal.id_provinsi);
            $("#eid_kota").val(jsonObjectFinal.id_kota);
            $("#eid_pegawai_level").val(jsonObjectFinal.id_pegawai_level);
            $("#EditPegawai").modal('show');
          }    
        });
    }
    $('#formHapusPegawai').on('submit', function(e){
      e.preventDefault();
      var hrow = "#tRow" + $('#hrow').val();
      $.ajax({
        type: 'post',
        url: '<?php echo base_url('Pegawai/Master/delete'); ?>',
        data: $('#formHapusPegawai').serialize(),
        beforeSend: function() { 
          $("#aHapus").html('<option> Deleting ...</option>');
          $('#aHapus').attr('disabled', 'disabled');
        },
        success: function (i) {
          if(i==2){
            t.row(hrow).remove().draw();
            $("#aHapus").html('Ya');
            $('#aHapus').removeAttr('disabled');
          }else if(i==1){
            $("#aHapus").html('Ya');
            $('#aHapus').removeAttr('disabled');
          }else if(1==0){
            $("#aHapus").html('Ya');
            $('#aHapus').removeAttr('disabled');
          }      
        }    
      });
      $("#HapusPegawai").modal('hide');
    });
    $("#formAddPegawai").on('submit', function(e){
      e.preventDefault();
      $.ajax({
        type: 'post',
        url: '<?=base_url('Pegawai/Master/add')?>/',
        data: $('#formAddPegawai').serialize(),
        beforeSend: function() { 
          $("#aSimpan").html('<option> Loading ...</option>');
          $('#aSimpan').attr('disabled', 'disabled');
        },
        success: function (i) {
          var jsonObjectParse     = JSON.parse(i);
          var jsonObjectStringify = JSON.stringify(jsonObjectParse);
          var jsonObjectFinal     = JSON.parse(jsonObjectStringify);
          if(jsonObjectFinal.status == 3){
            var htmlPop = '<div class="btn-group"><a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Hapus Data" href="javascript:void(0)" onclick="showDialogDelete(\''+jsonObjectFinal.id+'\')"><i class="fa fa-times"></i></a><a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Ubah Data" onclick="showDialogUpdate(\''+jsonObjectFinal.id+'\', this)"><i class="fa fa-pencil"></i></a></div>';
            var sData = [
                jsonObjectFinal.nama,
                jsonObjectFinal.alamat,
                jsonObjectFinal.no_telp,
                jsonObjectFinal.email,
                jsonObjectFinal.date_add,
                htmlPop
            ]
            var nRowIndex = t.row.add( sData ).draw().node();
            $(nRowIndex).attr( 'id', 'tRow'+jsonObjectFinal.id );

            $("#aSimpan").html('Simpan');
            $('#aSimpan').removeAttr('disabled');
          }else if(jsonObjectFinal.status == 2){
            $("#aSimpan").html('Simpan');
            $('#aSimpan').removeAttr('disabled');
          }else if(jsonObjectFinal.status == 1){
            $("#aSimpan").html('Simpan');
            $('#aSimpan').removeAttr('disabled');
          }
        }
      });
      $('[data-toggle="tooltip"]').tooltip();
      $('[data-toggle="popover"]').popover();
      $("#AddPegawai").modal('hide');
    });
    $("#formEditPegawai").on('submit', function(e){
      var eid     = $('#eid').val();
      var hrow    = "#tRow" + eid;
      e.preventDefault();
      $.ajax({
        type: 'post',
        url: '<?=base_url('Pegawai/Master/edit')?>/'+eid,
        data: $('#formEditPegawai').serialize(),
        beforeSend: function() { 
          $("#eSimpan").html('<option> Loading ...</option>');
          $('#eSimpan').attr('disabled', 'disabled');          
        },
        success: function (i) {
          var jsonObjectParse     = JSON.parse(i);
          var jsonObjectStringify = JSON.stringify(jsonObjectParse);
          var jsonObjectFinal     = JSON.parse(jsonObjectStringify);
          if(jsonObjectFinal.status == 3){

            t.row(hrow).remove().draw();
            var htmlPop = '<div class="btn-group"><a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Hapus Data" href="javascript:void(0)" onclick="showDialogDelete(\''+jsonObjectFinal.id+'\')"><i class="fa fa-times"></i></a><a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Ubah Data" onclick="showDialogUpdate(\''+jsonObjectFinal.id+'\', this)"><i class="fa fa-pencil"></i></a></div>';
            var sData = [
                jsonObjectFinal.nama,
                jsonObjectFinal.alamat,
                jsonObjectFinal.no_telp,
                jsonObjectFinal.email,
                jsonObjectFinal.date_add,
                htmlPop
            ]
            var nRowIndex = t.row.add( sData ).draw().node();
            $(nRowIndex).attr( 'id', 'tRow'+jsonObjectFinal.id );
            $("#eSimpan").html('Simpan');
            $('#eSimpan').removeAttr('disabled');
          }else if(jsonObjectFinal.status == 2){
            $("#eSimpan").html('Simpan');
            $('#eSimpan').removeAttr('disabled');
          }else if(jsonObjectFinal.status == 1){
            $("#eSimpan").html('Simpan');
            $('#eSimpan').removeAttr('disabled');
          }
        }
      });
      $("#EditPegawai").modal('hide');
    });   
  });
</script>
