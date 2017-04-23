<style type="text/css">
  .product-details input[type="text"]{
    width: 5em !important;
  }
</style>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h3><strong>Stok</strong> - Service</h3>
    </div> 
   </div>
   <div class="row">
    <div class="col-md-5 left-side">
      <form action="<?php echo base_url('Stok_service/Transaksi/doServices'); ?>" method="post" id="serviceOrder">
        <div class="col-xs-8"> &nbsp; </div>           
         <div class="col-sm-12">
          <div class="form-group">
            <label class="label-control">Supplier</label>
            <select class="js-select-options form-control" id="supplierSelect" onchange="filterProduk()" name="supplier" required="required">
              <option value="0">Pilih Supplier</option>
            </select>
          </div>
         </div>
         <div class="col-sm-12">
          <div class="form-group">
            <label class="label-control">Catatan</label>
            <textarea name="catatan" class="form-control" placeholder="Catatan"></textarea>
          </div>  
         </div>
         <div class="col-xs-4 table-header text-center">
            <label>PRODUK</label>
         </div>
         <div class="col-xs-3 table-header nopadding text-center">
            <label class="text-left">QUANTITY</label>
         </div>
         <div class="col-xs-2 table-header nopadding text-center">
            <label class="text-left">STOK</label>
         </div>
         <div class="col-xs-3 table-header nopadding text-center">
            <label>TOTAL (IDR)</label>
         </div>
         <div id="productList">
            <!-- product List goes here  -->

         </div>
         <div class="footer-section">
            <div class="table-responsive col-sm-12 totalTab">
               <table class="table">
                  <tr>
                     <td class="active" width="40%">Total Qty</td>
                     <td class="whiteBg" width="60%"><span id="Subtot"></span>
                        <span class="float-right"><b><span id="eTotalItem"></span> Item</b></span>
                     </td>
                  </tr>
                  <tr>
                     <td class="active">Total Harga (IDR)</td>
                     <td class="whiteBg light-blue text-bold text-right"><span id="eTotal" class="money"></span></td>
                  </tr>
               </table>
            </div>
            <button type="button" onclick="cancelOrder()" class="btn btn-red col-md-6 flat-box-btn"><h5 class="text-bold">Cancel</h5></button>
            <button type="submit" class="btn btn-green col-md-6 flat-box-btn" data-toggle="modal" data-target="#AddSale" id="btnDoOrder"><h5 class="text-bold">Servis Stok</h5></button>
         </div>
        </form>

      </div>
      <div class="col-md-7 right-side nopadding">
              <div class="row row-horizon" id="kategoriGat">
                  <span class="categories" id=""><i class="fa fa-home"></i></span>
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
              <!-- product list section -->
         <div id="productList2">
         </div>
      </div>
   </div>
</div>
<!-- /.container -->
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
  var tax = '<?php echo $tax; ?>';
  var discount = '<?php echo $discount; ?>';
  var total = '<?php echo $total; ?>';
  var totalItems = '<?php echo $total_items; ?>';
  inits(tax, discount, total, totalItems);
  load_supplier(listSupplier);
  load_order(listOrder);

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
        url :"<?php echo base_url('Stok_service/Transaksi/filterProdukByName')?>",
        type : "POST",
        data : "keyword="+keyword+"&supplier="+supplier+"&kategori="+realkategori,
        dataType : "json",
        success : function(data){
          load_product(data);
        }
      });
    }
  }  
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
    var color = 2; 
    $("#productList2").html('');
    for (var i=0;i<json.length;i++){
      if(color == 7) { color = 1; }
      var colorClass = 'color0' + color; color++;
      html = "<div class='col-sm-2 col-xs-4' style='display: block;'>"+
              "<a href='javascript:void(0)' class='addPct' id=\'product-"+json[i].id+"\' onclick=\'typeStok("+json[i].id +","+ json[i].rowid+")\'>"+
                "<div class='product "+colorClass+" flat-box waves-effect waves-block'>"+
                  "<h3 id='proname'>"+json[i].nama+"</h3>"+
                  "<div class='mask'>"+
                    "<h3>Rp <span class='money'>"+json[i].harga_beli+"</span></h3>"+
                    "<p>"+json[i].deskripsi+"</p>"+
                  "</div>"+
                  // "<img src=\'<?php echo base_url('upload/produk') ?>/"+json[i].foto+"\' alt=\'"+json[i].id_kategori+"\'>"+
                  "<img src='<?php echo base_url('upload/produk')?>/"+json[i].foto+"'>"+
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
    if(json.length > 0){      
      for (var i=0;i<json.length;i++){
        option = json[i].options;
        select = "stok-"+json[i].rowid;
        textSelect = "textStok-"+json[i].rowid;
        html = "<div class='col-xs-12'>"+
                  "<div class='panel panel-default product-details'>"+
                      "<div class='panel-body' style=''>"+
                          "<div class='col-xs-4 nopadding'>"+
                              "<div class='col-xs-4 nopadding'>"+
                                  "<a href='javascript:void(0)' onclick=delete_order(\'"+json[i].rowid+"\')>"+
                                  "<span class='fa-stack fa-sm productD'>"+
                                    "<i class='fa fa-circle fa-stack-2x delete-product'></i>"+
                                    "<i class='fa fa-times fa-stack-1x fa-fw fa-inverse'></i>"+
                                  "</span>"+
                                  "</a>"+
                              "</div>"+
                              "<div class='col-xs-8 nopadding'>"+
                                "<span class='textPD'>"+json[i].produk+"</span>"+
                              "</div>"+
                          "</div>"+
                          "<div class='col-xs-3 nopadding'>"+
                            "<span class='textPD'>"+
                              "<input id=\'qt-"+json[i].rowid+"\' "
                              +"onchange=\"addToCart("+ json[i].id[0] +", \'"+ json[i].rowid +"\');\""
                              +"class='form-control' value='"+json[i].qty+"' placeholder='0' maxlength='2' type='text'>"+
                            "</span>"+
                          "</div>"+
                          "<div class='col-xs-3 nopadding'>"+
                            "<span class='textPD'>"+
                              "<p id=\'"+textSelect+"\'>?</p>"+
                              "<select id=\'"+select+"\' class='form-control' onchange=changeOption(\'"+json[i].rowid+"\') style='display:none;'>"+                                  
                                "<option value=\'2\'>Tidak Kurangi</option>"+
                                "<option value=\'1\'>Kurangi</option>"+
                              "</select>"+
                            "</span>"+
                          "</div>"+
                          "<div class='col-xs-2 nopadding '>"+
                            "<span class='subtotal textPD money'>"+json[i].subtotal+"</span>"+
                          "</div>"+
                      "</div>"+
                  "</div>"+
              "</div>";
        $("#productList").append(html);
        if(option == 1){
          // kurangi stok
          $("#"+select).val(1);
        }else{
          // tidak kurangi stok
          $("#"+select).val(2);              
        }
        $("#"+textSelect).text($("#"+select+" :selected").text())
      }
    }
  }
  function filterProduk(){
    $.ajax({
      url :"<?php echo base_url('Stok_service/Transaksi/filterProduk')?>/"+$("#supplierSelect").val(),
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        filterKategori();
        load_product(data);
      }
    });
  }
  function filterKategori(){
    $.ajax({
      url :"<?php echo base_url('Stok_service/Transaksi/getKategori')?>/"+$("#supplierSelect").val(),
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
    // html = "<span class='categories'><i class='fa fa-home'></i></span>";
    html = "<span class='categories selectedGat' onclick=filterProdukByKategori(0) id=\'gat-0\'><i class='fa fa-home'></i></span>";
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
        url :"<?php echo base_url('Stok_service/Transaksi/filterProdukByKategori')?>/"+supplier+"/"+id+"/"+keyword,
        type : "GET",
        data :"",
        dataType : "json",
        success : function(data){
          load_product(data);
        }
      });
    }
  }
  function addToCart(id, rowid, jenisStok=''){
    // alert(id +" - "+ rowid);
    //set default value (if addToCart is called from product thumbnail onclick)
    var qty = 1; 
    var addEvent = 'click';
    if(jenisStok == '') { //if addToCart is called from qty-input onchange
      jenisStok = $("#stok-"+rowid).val();
      qty = $("#qt-"+rowid).val();
      addEvent = 'input';
    }
    $.ajax({
      url :"<?php echo base_url('Stok_service/Transaksi/tambahCart')?>/"+id,
      type : "POST",
      data : {"jenis_stok": jenisStok, "qty": qty, "event": addEvent},
      dataType : "json",
      success : function(data){
        if(data.status == 0){
          var list = data.list;
          var elem = $("#qt-"+data.rowid);
          $.confirm({
              title: 'Stok',
              content: 'Stok tidak mencukupi! <br>Max Qty: <b>'+list.stok+"</b>",
              buttons: {
                  ok: function () {
                    $(elem).val(parseInt(list.stok)); 
                    change_jenisStok(data.rowid, jenisStok);
                    change_total(data.rowid);
                    // $(elem).trigger('change'); 
                  }
              }
          });           
        } else {
        // console.log(data);        
          var getRow = data.filter(function (index) { return index.id[0] == id }) || 0;
          load_order(data);
          change_jenisStok(getRow[0].rowid, jenisStok);
          // fillInformation();
        }
      }
    });
  }
  function delete_order(id){
    $.ajax({
      url :"<?php echo base_url('Stok_service/Transaksi/deleteCart')?>/"+id,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        load_order(data);
        fillInformation();
      }
    });    
  }
  function change_jenisStok(rowid, jenisStok) {
    // console.log(rowid); console.log(jenisStok);
    $("#stok-"+rowid + " option[value='"+jenisStok+"']").attr("selected", "selected");
    changeOption(rowid);
    $("#textStok"+rowid).html($("stok-"+rowid+" :selected").text());
  }
  function changeOption(id){
    var qty = $("#qt-"+id).val();
    var option = $("#stok-"+id).val();
    $.ajax({
      url :"<?php echo base_url('Stok_service/Transaksi/updateOption')?>/"+id+"/"+option,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        load_order(data);
        fillInformation();
      }
    });
  }
  function add_qty(id){ //tidak dipakai sementara ini
    var lastValue = $("#qt-"+id).val();
    lastValue = parseInt(lastValue) + 1;
    $("#qt-"+id).val(lastValue);
    change_total(id, 'tambah');
  }
  function reduce_qty(id){ //tidak dipakai sementara ini
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
    var jenisStok = $("#stok-"+id).val();
    $.ajax({
      url :"<?php echo base_url('Stok_service/Transaksi/updateCart')?>/"+id+"/"+qty+"/"+jenisStok+"/"+state,
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        // console.log(data);
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
    unmaskInputMoney();
    maskInputMoney();
  }
  function fillInformation(){
    $.ajax({
      url :"<?php echo base_url('Stok_service/Transaksi/getTotal')?>",
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
          title: 'Batal',
          content: 'Batalkan Transaksi ?',
          buttons: {
              confirm: function () {
                  doClear();
              },
              cancel: function () {
                  // $.alert('Canceled!');
                  $('#btnDoOrder').html("<h5 class=\'text-bold\'>Cancel</h5>");
                  $("#btnDoOrder").prop("disabled", false);  
              }
          }
      });    
  }
  function doClear(){
    $('#btnDoOrder').html("<h5 class=\'text-bold\'>Clearing...</h5>");
    $("#btnDoOrder").prop("disabled", true);    
    $.ajax({
      url :'<?php echo base_url("Stok_service/Transaksi/destroyCart"); ?>',
      type : $('#serviceOrder').attr('method'),
      data : $('#serviceOrder').serialize(),
      dataType : "json",
      success : function(data){
        // console.log(data);        
        load_order(data);
        fillInformation();        
        $('#btnDoOrder').html("<h5 class=\'text-bold\'>Servis Stok</h5>");
        $("#btnDoOrder").prop("disabled", false);
        window.close();
      }
    });    
  }
  function doSubmit(){
    $.ajax({
      url :$('#serviceOrder').attr('action'),
      type : $('#serviceOrder').attr('method'),
      data : $('#serviceOrder').serialize(),
      dataType : "json",
      success : function(data){        
        load_order(data);
        fillInformation();        
        $('#btnDoOrder').html("<h5 class=\'text-bold\'>Servis Stok</h5>");
        $("#btnDoOrder").prop("disabled", false);
        // window.close();
        window.location.reload(false);
      }
    });    
  }
  function typeStok(id, rowid){
    $.confirm({
        title: 'Jenis Transaksi',
        content: '' +
        '<form action="" class="formName" method="post">' +
        '<div class="form-group">' +
        '<label>Pilih Jenis Transaksi</label>' +
        '<select id=\'jenis-stok\' class=\'form-control\'>'+
          '<option value=\'1\'>Kurangi Stok</option>'+
          '<option value=\'2\'>Tidak Kurangi Stok</option>'+
        '</select>'+
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Pilih',
                btnClass: 'btn-blue',
                action: function () {
                    var jenisStok = this.$content.find('#jenis-stok').val() || 0;
                    if(!jenisStok){
                        $.alert('Tidak ada opsi yang anda pilih!');
                        return false;
                    }
                    // $.alert('Your name is ' + jenisStok);
                    addToCart(id, rowid, jenisStok);
                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });    
  }
  $(document).ready(function(){
    $("#serviceOrder").on('submit', function(e){
      $('#btnDoOrder').html("<h5 class=\'text-bold\'>Saving...</h5>");
      $("#btnDoOrder").prop("disabled", true);
      e.preventDefault();
      $.confirm({
          title: 'Konfirmasi Service Stok',
          content: 'Yakin ingin service stok ?',
          buttons: {
              confirm: function () {
                  doSubmit();
              },
              cancel: function () {
                  $('#btnDoOrder').html("<h5 class=\'text-bold\'>Service Stok</h5>");
                  $("#btnDoOrder").prop("disabled", false);
              }
          }
      });      
    });
  });
</script>