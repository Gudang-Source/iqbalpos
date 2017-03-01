<!-- Page Content -->
<div class="container">
   <div class="row" style="margin-top:100px;">
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

          <tbody>
             <?php foreach ($pegawai->result_array() as $spegawai):?>
              <tr id="tRow<?=$spegawai['id']?>">
                 <td><?=$spegawai['nama'];?></td>
                 <td><?=$spegawai['alamat'];?></td>
                 <td><?=$spegawai['no_telp'];?></td>
                 <td class="hidden-xs"><?=$spegawai['email'];?></td>
                 <td class="hidden-xs"><?=$spegawai['date_add'];?></td>
                 <td><div class="btn-group">
                       <a class="btn btn-default" href="javascript:void(0)" data-toggle="popover" data-placement="left"  data-html="true" title='Hapus Data?' data-content='<a class="btn btn-danger" onclick="delRow(<?=$spegawai['id']?>)" href="#">Ya</a>'><i class="fa fa-times"></i></a>
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
          <button type="submit" class="btn btn-add">Simpan</button>
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
          <button type="submit" class="btn btn-add">Simpan</button>
        </div>
      </form>
    </div>
 </div>
</div>
<!-- /.Modal Edit-->
<script type="text/javascript">
    function showDialogUpdate(id, r){
        var iRow = r.parentNode.parentNode.parentNode.rowIndex;
        $.ajax({
          type: 'post',
          url: '<?=base_url('Pegawai/Master/get')?>/'+id,
          data: $('form').serialize(),
          success: function (i) {
            var jsonObjectParse = JSON.parse(i);
            var jsonObjectStringify = JSON.stringify(jsonObjectParse);
            var jsonObjectFinal = JSON.parse(jsonObjectStringify);
            document.getElementById("row").value=iRow;
            document.getElementById("eid").value=jsonObjectFinal.id; 
            document.getElementById("enama").value=jsonObjectFinal.nama; 
            document.getElementById("ealamat").value=jsonObjectFinal.alamat; 
            document.getElementById("eno_telp").value=jsonObjectFinal.no_telp; 
            document.getElementById("eemail").value=jsonObjectFinal.email; 
            document.getElementById("ekodepos").value=jsonObjectFinal.kode_pos; 
            document.getElementById("eid_provinsi").value=jsonObjectFinal.id_provinsi;
            document.getElementById("eid_kota").value=jsonObjectFinal.id_kota;
            document.getElementById("eid_pegawai_level").value=jsonObjectFinal.id_pegawai_level;
            $("#EditPegawai").modal('show');
          }    
        });        
    }
</script>
<script type="text/javascript">
  $(document).ready(function(){
    delRow = function(id){
        $.ajax({
          type: 'post',
          url: '<?=base_url('Pegawai/Master/delete')?>/'+id,
          data: $('form').serialize(),
          success: function (i) {
            if(i==2){
              $('#tRow'+id).remove();
            }else if(i==1){

            }else if(1==0){

            }
          }    
        });
    }
    $("#formAddPegawai").on('submit', function(e){
      var table = document.getElementById('Table');
      e.preventDefault();
      $.ajax({
        type: 'post',
        url: '<?=base_url('Pegawai/Master/add')?>/',
        data: $('#formAddPegawai').serialize(),
        success: function (i) {
          var jsonObjectParse     = JSON.parse(i);
          var jsonObjectStringify = JSON.stringify(jsonObjectParse);
          var jsonObjectFinal     = JSON.parse(jsonObjectStringify);
          if(jsonObjectFinal.status == 3){
            var row         = table.insertRow(1);
            var nama        = row.insertCell(0);
            var alamat      = row.insertCell(1);
            var no_telp     = row.insertCell(2);
            var email       = row.insertCell(3);
            var date_add    = row.insertCell(4);
            nama.innerHTML        = jsonObjectFinal.nama;
            alamat.innerHTML      = jsonObjectFinal.alamat;
            no_telp.innerHTML     = jsonObjectFinal.no_telp;
            email.innerHTML       = jsonObjectFinal.email;
            date_add.innerHTML    = jsonObjectFinal.date_add;            
          }else if(jsonObjectFinal.status == 2){

          }else if(jsonObjectFinal.status == 1){

          }
        }
      });
      $("#AddPegawai").modal('hide');
    });
    $("#formEditPegawai").on('submit', function(e){
      var table   = document.getElementById('Table');
      var rowVal  = document.getElementById('row').value;
      var row     = table.rows[rowVal];
      var eid     = document.getElementById('eid').value;
      e.preventDefault();
      $.ajax({
        type: 'post',
        url: '<?=base_url('Pegawai/Master/edit')?>/'+eid,
        data: $('#formEditPegawai').serialize(),
        success: function (i) {
          var jsonObjectParse     = JSON.parse(i);
          var jsonObjectStringify = JSON.stringify(jsonObjectParse);
          var jsonObjectFinal     = JSON.parse(jsonObjectStringify);
          if(jsonObjectFinal.status == 3){
            row.cells[0].innerHTML = jsonObjectFinal.nama;
            row.cells[1].innerHTML = jsonObjectFinal.alamat;
            row.cells[2].innerHTML = jsonObjectFinal.no_telp;
            row.cells[3].innerHTML = jsonObjectFinal.email;
            row.cells[4].innerHTML = jsonObjectFinal.date_add;
          }else if(jsonObjectFinal.status == 2){

          }else if(jsonObjectFinal.status == 1){

          }
        }
      });
      $("#EditPegawai").modal('hide');
    });
  });
</script>
