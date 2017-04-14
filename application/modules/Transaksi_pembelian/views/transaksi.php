<style type="text/css">
  .product-details input[type="text"]{
    width: 5em !important;
  }
</style>
<div class="container-fluid">
   <div class="row">
    <h3><strong>Transaksi</strong> - Pembelian</h3>
   </div>
   <div class="row">
    <div class="col-md-5 left-side">
      <form action="<?php echo base_url('Transaksi_pembelian/Transaksi/doSubmit'); ?>" method="post" id="pembelian">          
         <div class="col-xs-8">
            <h2>Pilih Supplier</h2>
         </div>
<!--          <div class="col-xs-4 client-add">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#ticket" onclick="showPO()">
               <span class="fa-stack fa-lg" data-toggle="tooltip" data-placement="top" title="Choose From Purchase Order">
                  <i class="fa fa-square fa-stack-2x grey"></i>
                  <i class="fa fa-ticket fa-stack-1x fa-inverse dark-blue"></i>
               </span>
            </a>
         </div>    -->      
        
         <div class="col-sm-12">
            <select class="js-select-options form-control" id="supplierSelect" onchange="filterProduk()" name="supplier" required="required">
              <option value="0">Pilih Supplier</option>
            </select>
            <input type="hidden" name="idpo" value="0" id="idpo">
         </div>
         <div class="col-xs-8">
          <h2>Pilih Purchase Order</h2>
         </div>
         <div class="col-sm-12">
            <select class="js-select-options form-control" id="poSelect" onchange="choosePO()" name="po" required="required">
              <option value="0">Tanpa Purchase Order</option>
            </select>
         </div>
         <div class="col-sm-12">
         &nbsp;
         </div>
         <div class="col-sm-12">
               <textarea name="catatan" class="form-control" placeholder="CATATAN" id="catatan"></textarea>
         </div>
         <div class="col-xs-3 table-header">
            <h3>Product</h3>
         </div>
         <div class="col-xs-3 table-header nopadding">
            <h3>Opsi</h3>
         </div>
         <div class="col-xs-2 table-header nopadding">
            <h3>QTY</h3>
         </div>
         <div class="col-xs-2 table-header nopadding">
            <h3>Harga Satuan</h3>
         </div>
         <div class="col-xs-2 table-header nopadding">
            <h3>Total Berat</h3>
         </div>
         <div id="productList">
            <!-- product List goes here  -->
         </div>
         <div class="footer-section">
            <div class="table-responsive col-sm-12 totalTab">
               <table class="table">
                  <tr>
                     <td class="active" width="40%">Subtotal</td>
                     <td class="whiteBg" width="60%"><span id="Subtot"></span>
                        <span class="float-right"><b id="eTotalItem"><span></span> Item</b></span>
                     </td>
                  </tr>
                  <tr>
                     <td class="active">TAX</td>
                     <td class="whiteBg"><input type="text" value="" id="eTax" class="total-input TAX" placeholder="N/A"  maxlength="5">
                        <span class="float-right"><b id="taxValue"></b></span>
                     </td>
                  </tr>
                  <tr>
                     <td class="active">Discount</td>
                     <td class="whiteBg">
                        <input type="text" value="" id="eDiscount" class="total-input Remise" placeholder="N/A"  maxlength="5">
                        <span class="float-right"><b id="RemiseValue"></b></span>
                     </td>
                  </tr>
                  <tr>
                     <td class="active">Total</td>
                     <td class="whiteBg light-blue text-bold"><span id="eTotal"></span></td>
                  </tr>
               </table>
            </div>
            <button type="button" onclick="cancelOrder()" class="btn btn-red col-md-6 flat-box-btn"><h5 class="text-bold">Cancel</h5></button>
            <button type="submit" class="btn btn-green col-md-6 flat-box-btn" data-toggle="modal" data-target="#AddSale" id="btnDoOrder"><h5 class="text-bold">Proses Pembelian</h5></button>
         </div>
        </form>

      </div>
      <div class="col-md-7 right-side nopadding">
        <div class="row row-horizon" id="kategoriGat">
            <span class="categories selectedGat" id=""><i class="fa fa-home"></i></span>
        </div>
        <div class="col-sm-12">
           <div id="searchContaner">
               <div class="input-group stylish-input-group">
                   <input type="text" id="searchProd" class="form-control"  placeholder="Search" oninput="search()">
                   <span class="input-group-addon">
                       <button type="submit">
                           <span class="glyphicon glyphicon-search"></span>
                       </button>
                   </span>
               </div>
          </div>
        </div>
       <div id="productList2">
       </div>
      </div>
   </div>
</div>
<!-- /.container -->
<!-- Modal PO -->
<div class="modal fade" id="modalpo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">List Purchase Order</h4>
      </div>
      <div class="modal-body">
         <div class="row">
           <div class="col-lg-12"  id="body-detail-po">
           </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" data-dismiss="modal">Ok</button>
      </div>
    </div>
 </div>
</div>
<!-- /.Modal PO-->

<script type="text/javascript">
  function maskInputMoney(){
    $('.money').mask('#.##0', {reverse: true});
  }
  function unmaskInputMoney(){
    $('.money').unmask();
  }
  var listProduct = <?php echo $list_produk; ?>;
  var listOrder = <?php echo $list_order; ?>;
  var listSupplier = <?php echo $list_supplier; ?>;
  var listWarna = "";
  var listUkuran = "";
  var tax = '<?php echo $tax; ?>';
  var discount = '<?php echo $discount; ?>';
  var total = '<?php echo $total; ?>';
  var totalItems = '<?php echo $total_items; ?>';
  maskInputMoney();
  inits(tax, discount, total, totalItems);
  load_supplier(listSupplier);
  // load_product(listProduct);
  load_order(listOrder);

  function load_supplier(json){
    var html = "";
    $("#supplierSelect").html('');
    html = "<option value='0' selected disabled>Pilih Supplier</option>";
    $("#supplierSelect").append(html);
    for (var i=0;i<json.length;i++){
      html = "<option value=\'"+json[i].id+"\'>"+json[i].nama+"</option>";
      $("#supplierSelect").append(html);
    }
  }
  function load_product(json){
    var html = "";
    $("#productList2").html('');
    for (var i=0;i<json.length;i++){
      html = "<div class='col-sm-2 col-xs-3' style='display: block;'>"+
              "<a href='javascript:void(0)' class='addPct' id=\'product-"+json[i].id+"\' onclick=\'addToCart("+json[i].id+")\'>"+
                "<div class='product color03 flat-box waves-effect waves-block'>"+
                  "<h3 id='proname'>"+json[i].nama+"</h3>"+
                  "<div class='mask'>"+
                    "<h3>"+json[i].harga_beli+"</h3>"+
                    "<p>"+json[i].deskripsi+"</p>"+
                  "</div>"+
                  "<img src='#' alt=\'"+json[i].id_kategori+"\'>"+
                "</div>"+
              "</a>"+
             "</div>";
      $("#productList2").append(html);
    }
  }
  function load_order(json){
    var html = "";
    var option = "";
    var select = "";
    $("#productList").html("");
      for (var i=0;i<json.length;i++){
        html = "<div class='col-xs-12'>"+
                  "<div class='panel panel-default product-details'>"+
                      "<div class='panel-body' style=''>"+
                          "<div class='col-xs-3 nopadding'>"+
                              "<div class='col-xs-2 nopadding'>"+
                                  "<a href='javascript:void(0)' onclick=delete_order(\'"+json[i].rowid+"\')>"+
                                  "<span class='fa-stack fa-sm productD'>"+
                                    "<i class='fa fa-circle fa-stack-2x delete-product'></i>"+
                                    "<i class='fa fa-times fa-stack-1x fa-fw fa-inverse'></i>"+
                                  "</span>"+
                                  "</a>"+
                              "</div>"+
                              "<div class='col-xs-10 nopadding'>"+
                                "<span class='textPD'>"+json[i].produk+"</span>"+
                              "</div>"+
                          "</div>"+
                          "<div class='col-xs-3'>"+
                            "<span class='TextPD'>"+
                              "<select name=ukuran id=\'uk-"+json[i].rowid+"\' class=\'form-control\' onchange=updateOption(\'"+json[i].rowid+"\')>"+
                                "<option value=0 select disabled>Pilih Ukuran</option>"+
                              "</select>"+
                            "</span>"+
                            "<span class='TextPD'>"+
                              "<select name=warna id=\'wr-"+json[i].rowid+"\' class=\'form-control\' onchange=updateOption(\'"+json[i].rowid+"\')>"+
                                "<option value=0 select disabled>Pilih Warna</option>"+
                              "</select>"+
                            "</span>"+
                          "</div>"+
                          "<div class='col-xs-2'>"+
                            "<input id=\'qt-"+json[i].rowid+"\' class='form-control' value='"+json[i].qty+"' placeholder='0' maxlength='2' type='text' onchange=updateQty(\'"+json[i].rowid+"\')>"+
                          "</div>"+
                          "<div class='col-xs-2 nopadding productNum text-center'>"+
                            ""+json[i].harga_beli+
                            "<input type=hidden id=\'hb-"+json[i].rowid+"\' class=\'form-control\' value='"+json[i].harga_beli+"'  onchange=updateHargaBeli(\'"+json[i].rowid+"\')>"+
                          "</div>"+
                          "<div class='col-xs-2 nopadding productNum text-center'>"+
                            ""+json[i].subtotal+
                            "<input type=hidden id=\'tb-"+json[i].rowid+"\' class=\'form-control\' value='"+json[i].total_berat+"' onchange=updateOption(\'"+json[i].rowid+"\')>"+
                          "</div>"+
                      "</div>"+
                  "</div>"+
              "</div>";
        $("#productList").append(html);
        loadUkuran(json[i].id, json[i].rowid, listUkuran, json[i].ukuran);
        loadWarna(json[i].id, json[i].rowid, listWarna, json[i].warna);
      }
  }
  function loadUkuran(rid, id, json, pilih){
    $.ajax({
      url :"<?php echo base_url('Transaksi_purchaseorder/Transaksi/getUkuran')?>/"+rid,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        var html = "";
        $("#uk-"+id).html('');
        html = "<option value='0' selected>Tidak Ada Ukuran</option>";
        $("#uk-"+id).append(html);
        for (var i=0;i<data.length;i++){
          var pilihs = "";
          if(data[i].id == pilih){
            pilihs = "selected";
          }
          html = "<option value=\'"+data[i].id+"\' "+pilihs+">"+data[i].nama+"</option>";
          $("#uk-"+id).append(html);
        }
      }
    });     
  }
  function updateOption(id){
    var ukuran = $("#uk-"+id).val();
    var warna = $("#wr-"+id).val();
    var totalBerat = $("#tb-"+id).val();
    $.ajax({
      url :"<?php echo base_url('Transaksi_pembelian/Transaksi/updateOption')?>/"+id+"/"+warna+"/"+ukuran+"/"+totalBerat,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        load_order(data);
        fillInformation();
      }
    });    
  }
  function updateHargaBeli(id){
    var hb = $('#hb-'+id).val();
    $.ajax({
      url :"<?php echo base_url('Transaksi_pembelian/Transaksi/updateHargaBeli')?>/"+id+"/"+hb,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        load_order(data);
        fillInformation();
      }
    });    
  }
  function updateQty(id){
    var qty = $("#qt-"+id).val();
    $.ajax({
      url :"<?php echo base_url('Transaksi_pembelian/Transaksi/updateQty')?>/"+id+"/"+qty,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        load_order(data);
        fillInformation();
      }
    });
  }
  function loadWarna(rid, id, json, pilih){
    $.ajax({
      url :"<?php echo base_url('Transaksi_purchaseorder/Transaksi/getWarna')?>/"+rid,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        var html = "";
        $("#wr-"+id).html('');
        html = "<option value='0' selected>Tidak Ada Warna</option>";
        $("#wr-"+id).append(html);
        for (var i=0;i<data.length;i++){
          var pilihs = "";
          if(data[i].id == pilih){
            pilihs = "selected";
          }      
          html = "<option value=\'"+data[i].id+"\' "+pilihs+">"+data[i].nama+"</option>";
          $("#wr-"+id).append(html);
        }
      }
    });    
  }
  function filterProduk(){
    $.ajax({
      url :"<?php echo base_url('Transaksi_pembelian/Transaksi/filterProduk')?>/"+$("#supplierSelect").val(),
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        filterKategori();
        load_product(data);
        loadPO();
      }
    });
  }
  function filterKategori(){
    $.ajax({
      url :"<?php echo base_url('Transaksi_pembelian/Transaksi/getKategori')?>/"+$("#supplierSelect").val(),
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        load_kategori(data);
      }
    });    
  }
  function load_kategori(json){
    var html = "";
    $("#kategoriGat").html('');
    html = "<span class='categories selectedGat'><i class='fa fa-home'></i></span>";
    $("#kategoriGat").append(html);
    for (var i=0;i<json.length;i++){
      html = "<span class='categories' onclick=filterProdukByKategori(\'"+json[i].id+"\') id=\'gat-"+json[i].id+"\'>"+json[i].nama+"</span>";
      $("#kategoriGat").append(html);
    }
  }
  function filterProdukByKategori(id){
    var keyword = $("#searchProd").val();
    var supplier = $("#supplierSelect").val();
    $( ".categories" ).removeClass('selectedGat');
    $( "#gat-"+id ).addClass( "selectedGat" );

    if(supplier != 0){    
      $.ajax({
        url :"<?php echo base_url('Transaksi_pembelian/Transaksi/filterProdukByKategori')?>/"+supplier+"/"+id+"/"+keyword,
        type : "GET",
        data :"",
        dataType : "json",
        success : function(data){
          load_product(data);
        }
      });
    }
  }
  function search(){
    var keyword = $("#searchProd").val();
    var supplier = $("#supplierSelect").val();
    var kategori = $(".selectedGat").attr('id');
    var realkategori = "";
    if(kategori != null || kategori != undefined){    
      realkategori = kategori;
    }
    if(supplier != 0){    
      $.ajax({
        url :"<?php echo base_url('Transaksi_pembelian/Transaksi/filterProdukByName')?>",
        type : "POST",
        data : "keyword="+keyword+"&supplier="+supplier+"&kategori="+realkategori,
        dataType : "json",
        success : function(data){
          load_product(data);
        }
      });
    }
  }
  function addToCart(id){
    $.ajax({
      url :"<?php echo base_url('Transaksi_pembelian/Transaksi/tambahCart')?>/"+id,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        load_order(data);
        fillInformation();
      }
    });
  }
  function delete_order(id){
    $.ajax({
      url :"<?php echo base_url('Transaksi_pembelian/Transaksi/deleteCart')?>/"+id,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        load_order(data);
        fillInformation();
      }
    });    
  }
  function changeOption(id){
    var qty = $("#qt-"+id).val();
    var option = $("#stok-"+id).val();
    $.ajax({
      url :"<?php echo base_url('Transaksi_pembelian/Transaksi/updateOption')?>/"+id+"/"+option,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        load_order(data);
        fillInformation();
      }
    });
  }
  function add_qty(id){
    var lastValue = $("#qt-"+id).val();
    lastValue = parseInt(lastValue) + 1;
    $("#qt-"+id).val(lastValue);
    change_total(id, 'tambah');
  }
  function reduce_qty(id){
    var lastValue = $("#qt-"+id).val();
    if(parseInt(lastValue) > 1){    
      lastValue = parseInt(lastValue) - 1;
      $("#qt-"+id).val(lastValue);
    }else{
      delete_order(id);
    }
    change_total(id, 'kurang');
  }
  function change_total(id, state){
    var qty = $("#qt-"+id).val();
    $.ajax({
      url :"<?php echo base_url('Transaksi_pembelian/Transaksi/updateCart')?>/"+id+"/"+qty+"/"+state,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        console.log(data);
        load_order(data);
        fillInformation();
      }
    });
  }
  function inits(etax, ediscount, etotal, etotal_items){
    $("#eTax").val(etax);
    $("#eDiscount").val(ediscount);
    $("#eTotal").html(etotal);    
    $("#eTotalItem").html(etotal_items);    
  }
  function fillInformation(){
    $.ajax({
      url :"<?php echo base_url('Transaksi_pembelian/Transaksi/getTotal')?>",
      type : "GET",
      data :"",
      success : function(data){        
        var jsonObjectParse = JSON.parse(data);
        var jsonObjectStringify = JSON.stringify(jsonObjectParse);
        var jsonObjectFinal = JSON.parse(jsonObjectStringify);
        var etx = jsonObjectFinal.tax;
        var edc = jsonObjectFinal.discount;
        var etl = jsonObjectFinal.total;
        var eti = jsonObjectFinal.total_items; 
        inits(etx, edc, etl, eti);
        totalItems = eti;
      }
    });    
  }
  function cancelOrder(){
      $.confirm({
          title: 'Cancel',
          content: 'Cancel Pembelian Barang?',
          buttons: {
              confirm: function () {
                  doClear();
              },
              cancel: function () {
                  // $.alert('Canceled!');
              }
          }
      });    
  }
  function doClear(){
    $('#btnDoOrder').html("<h5 class=\'text-bold\'>Clearing...</h5>");
    $("#btnDoOrder").prop("disabled", true);    
    $.ajax({
      url :'<?php echo base_url("Transaksi_pembelian/Transaksi/destroyCart"); ?>',
      type : $('#pembelian').attr('method'),
      data : $('#pembelian').serialize(),
      dataType : "json",
      success : function(data){
        // console.log(data);        
        load_order(data);
        fillInformation();        
        $('#btnDoOrder').html("<h5 class=\'text-bold\'>Proses Pembelian</h5>");
        $("#btnDoOrder").prop("disabled", false);
        window.close();
      }
    });    
  }
  function doSubmit(){
    $.ajax({
      url :$('#pembelian').attr('action'),
      type : $('#pembelian').attr('method'),
      data : $('#pembelian').serialize(),
      dataType : "json",
      success : function(data){        
        load_order(data);
        fillInformation();        
        $('#btnDoOrder').html("<h5 class=\'text-bold\'>Proses Pembelian</h5>");
        $("#btnDoOrder").prop("disabled", false);
        window.close();
      }
    });    
  }
  function loadPO(){
      var id = $("#supplierSelect").val();
      $.ajax({
        url :"<?php echo base_url('Transaksi_pembelian/Transaksi/getDataPO')?>/"+id,
        type : "GET",
        data :"",
        dataType :"json",
        success : function(data){
          if(data.status==1){
            load_poselect(data.list);
          }else if(data.status==0){
            $.confirm({
                title: 'Purchase Order',
                content: 'Belum ada PO untuk supplier ini!',
                buttons: {
                    confirm: function () {
                      clear_poselect();           
                    }
                }
            }); 
          }
        }
      });           
  }
  function clear_poselect(){
    $("#poSelect").html('');
    $('#poSelect').select2({data: [{id: '0', text: 'Tanpa Purchase Order'}]}).trigger('change');
  }
  function load_poselect(json){
    var html = "";
    $("#poSelect").html('');
    html = "<option value='0' selected >Tanpa Purchase Order</option>";
    $("#poSelect").append(html);
    for (var i=0;i<json.length;i++){
      html = "<option value=\'"+json[i].id+"\'>"+json[i].id+"</option>";
      $("#poSelect").append(html);
    }
  }  
  function showPO(){
      $.ajax({
        url :"<?php echo base_url('Transaksi_pembelian/Transaksi/listPO')?>",
        type : "GET",
        data :"",
        success : function(data){
          $("#body-detail-po").html(data);
        }
      });       
      $("#modalpo").modal("show");    
  }
  function choosePO(){
      var id = $("#poSelect").val();
      $.ajax({
        url :"<?php echo base_url('Transaksi_pembelian/Transaksi/addCartFromExistingPO')?>/"+id,
        type : "GET",
        data :"",
        dataType : "json",
        success : function(data){
          fillInfoPO(id);
          load_order(data);
        }
      });
  }
  function fillInfoPO(idPO){
    // getInfoPO
    $.ajax({
      url :"<?php echo base_url('Transaksi_pembelian/Transaksi/getInfoPO')?>/"+idPO,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        $("#idpo").val(data[0].id);
        $("#supplierSelect").val(data[0].id_supplier);
        $("#catatan").val(data[0].catatan);
      }
    });
  }
  $(document).ready(function(){
    $("#pembelian").on('submit', function(e){
      $('#btnDoOrder').html("<h5 class=\'text-bold\'>Saving...</h5>");
      $("#btnDoOrder").prop("disabled", true);
      e.preventDefault();
      $.confirm({
          title: 'Konfirmasi Pembelian',
          content: 'Yakin ingin membeli barang ?',
          buttons: {
              confirm: function () {
                  doSubmit();
              },
              cancel: function () {
                  
              }
          }
      });      
    });
  });
</script>