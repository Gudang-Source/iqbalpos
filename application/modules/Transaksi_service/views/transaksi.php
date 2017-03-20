<div class="container-fluid">
   <div class="row">
<!--       <ul class="cbp-vimenu">
        <li data-toggle="tooltip"  data-html="true" data-placement="left" title="CloseRegister"><a href="javascript:void(0)" onclick="CloseRegister()"><i class="fa fa-times" aria-hidden="true"></i></a></li>
        <li data-toggle="tooltip"  data-html="true" data-placement="left" title="switshregister"><a href="pos/switshregister"><i class="fa fa-random" aria-hidden="true"></i></a></li>
      </ul> -->
    <div class="col-md-5 left-side">
      <form action="<?php echo base_url('Transaksi_service/Transaksi/doServices'); ?>" method="post" id="serviceOrder">
          
<!--          <div class="row">
            <div class="row row-horizon">
               <span class="holdList"> -->
                  <!-- list Holds goes here -->
<!--                </span>
               <span class="Hold pl" onclick="AddHold()">+</i></span>
               <span class="Hold pl" onclick="RemoveHold()">-</span>
            </div>
         </div> -->
         <div class="col-xs-8">
            <h2>Pilih Supplier</h2>
         </div>
         <div class="col-xs-4 client-add">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#AddCustomer">
               <span class="fa-stack fa-lg" data-toggle="tooltip" data-placement="top" title="Add New Customer">
                  <i class="fa fa-square fa-stack-2x grey"></i>
                  <i class="fa fa-user-plus fa-stack-1x fa-inverse dark-blue"></i>
               </span>
            </a>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#ticket">
               <span class="fa-stack fa-lg" data-toggle="tooltip" data-placement="top" title="Show Last Receipt">
                  <i class="fa fa-square fa-stack-2x grey"></i>
                  <i class="fa fa-ticket fa-stack-1x fa-inverse dark-blue"></i>
               </span>
            </a>
         </div>
         <div class="col-sm-12">
            <select class="js-select-options form-control" id="supplierSelect" onchange="filterProduk()" name="supplier" required="required">
              <option value="0">Pilih Supplier</option>

            </select>
         </div>
         <div class="col-sm-12">
            <!-- <form onsubmit="return barcode()"> -->
               <textarea name="catatan" class="form-control" placeholder="CATATAN"></textarea><!--  type="text" id="" class="form-control" placeholder="Barcode Scanner"> -->
            <!-- </form> -->
         </div>
         <div class="col-xs-4 table-header">
            <h3>Product</h3>
         </div>
         <div class="col-xs-2 table-header">
            <h3>Header</h3>
         </div>
         <div class="col-xs-2 table-header nopadding">
            <h3 class="text-left">Quantity</h3>
         </div>
         <div class="col-xs-2 table-header nopadding">
            <h3 class="text-left">Stok</h3>
         </div>
         <div class="col-xs-2 table-header nopadding">
            <h3>Total</h3>
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
                     <td class="whiteBg"><input type="text" value="" id="eDiscount" class="total-input Remise" placeholder="N/A"  maxlength="5">
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
            <button type="submit" class="btn btn-green col-md-6 flat-box-btn" data-toggle="modal" data-target="#AddSale" id="btnDoOrder"><h5 class="text-bold">Servis Stok</h5></button>
         </div>
        </form>

      </div>
      <div class="col-md-7 right-side nopadding">
<!--               <div class="row row-horizon">
                  <span class="categories selectedGat" id=""><i class="fa fa-home"></i></span>

              </div>
 -->              <div class="col-sm-12">
                 <div id="searchContaner">
                     <div class="input-group stylish-input-group">
                         <input type="text" id="searchProd" class="form-control"  placeholder="Search" >
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
  var listProduct = <?php echo $list_produk; ?>;
  var listOrder = <?php echo $list_order; ?>;
  var listSupplier = <?php echo $list_supplier; ?>;
  var tax = '<?php echo $tax; ?>';
  var discount = '<?php echo $discount; ?>';
  var total = '<?php echo $total; ?>';
  var totalItems = '<?php echo $total_items; ?>';
  inits(tax, discount, total, totalItems);
  load_supplier(listSupplier);
  load_product(listProduct);
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
      html = "<div class='col-sm-2 col-xs-4' style='display: block;'>"+
              "<a href='javascript:void(0)' class='addPct' id=\'product-"+json[i].id+"\' onclick=\'addToCart("+json[i].id+")\'>"+
                "<div class='product color03 flat-box waves-effect waves-block'>"+
                  "<h3 id='proname'>"+json[i].nama+"</h3>"+
                  "<input id='idname-39' name='name' value='Computer' type='hidden'>"+1
                  "<input id='idprice-39' name='price' value='350' type='hidden'>"+
                  "<input id='category' name='category' value='computers' type='hidden'>"+
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
    console.log(json);
    if(json.length > 0){      
      for (var i=0;i<json.length;i++){
        option = json[i].options;
        select = "stok-"+json[i].rowid;
        html = "<div class='col-xs-12'>"+
                  "<div class='panel panel-default product-details'>"+
                      "<div class='panel-body' style=''>"+
                          "<div class='col-xs-4 nopadding'>"+
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
                          "<div class='col-xs-2'>"+
                            "<span class='textPD'>"+json[i].price+"</span>"+
                          "</div>"+
                          "<div class='col-xs-2 nopadding productNum'>"+
                            "<a href='javascript:void(0)' onclick=reduce_qty(\'"+json[i].rowid+"\')>"+
                              "<span class='fa-stack fa-sm decbutton'>"+
                                "<i class='fa fa-square fa-stack-2x light-grey'></i>"+
                                "<i class='fa fa-minus fa-stack-1x fa-inverse white'></i>"+
                              "</span>"+
                            "</a>"+
                            "<input id=\'qt-"+json[i].rowid+"\' onchange=change_total(\'"+json[i].rowid+"\') class='form-control' value='"+json[i].qty+"' placeholder='0' maxlength='2' type='text'>"+
                            "<a href='javascript:void(0)' onclick=add_qty(\'"+json[i].rowid+"\')>"+
                            "<span class='fa-stack fa-sm incbutton'>"+
                              "<i class='fa fa-square fa-stack-2x light-grey'></i>"+
                              "<i class='fa fa-plus fa-stack-1x fa-inverse white'></i>"+
                            "</span>"+
                            "</a>"+
                          "</div>"+
                          "<div class='col-xs-2 nopadding'>"+
                              "<div class='col-xs-2 nopadding'>"+
                                "<span class='textPD'>"+
                                  "<select id=\'"+select+"\' onchange=changeOption(\'"+json[i].rowid+"\')>"+                                  
                                    "<option value=\'2\'>TIDAK KURANGI</option>"+
                                    "<option value=\'1\'>KURANGI</option>"+
                                  "</select>"+
                                "</span>"+
                              "</div>"+
                          "</div>"+
                          "<div class='col-xs-2 nopadding '>"+
                            "<span class='subtotal textPD'>"+json[i].subtotal+"</span>"+
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
      }
    }
  }
  function filterProduk(){
    $.ajax({
      url :"<?php echo base_url('Transaksi_service/Transaksi/filterProduk')?>/"+$("#supplierSelect").val(),
      type : "GET",
      data :"",
      dataType : "json",
      success : function(data){
        load_product(data);
      }
    });
  }
  function addToCart(id){
    $.ajax({
      url :"<?php echo base_url('Transaksi_service/Transaksi/tambahCart')?>/"+id,
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
      url :"<?php echo base_url('Transaksi_service/Transaksi/deleteCart')?>/"+id,
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
      url :"<?php echo base_url('Transaksi_service/Transaksi/updateOption')?>/"+id+"/"+option,
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
      url :"<?php echo base_url('Transaksi_service/Transaksi/updateCart')?>/"+id+"/"+qty+"/"+state,
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
      url :"<?php echo base_url('Transaksi_service/Transaksi/getTotal')?>",
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
          title: 'Confirm!',
          content: 'Simple confirm!',
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
      url :'<?php echo base_url("Transaksi_service/Transaksi/destroyCart"); ?>',
      type : $('#serviceOrder').attr('method'),
      data : $('#serviceOrder').serialize(),
      dataType : "json",
      success : function(data){
        // console.log(data);        
        load_order(data);
        fillInformation();        
        $('#btnDoOrder').html("<h5 class=\'text-bold\'>Servis Stok</h5>");
        $("#btnDoOrder").prop("disabled", false);
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
        console.log(data);        
        load_order(data);
        fillInformation();        
        $('#btnDoOrder').html("<h5 class=\'text-bold\'>Servis Stok</h5>");
        $("#btnDoOrder").prop("disabled", false);
      }
    });    
  }
  $(document).ready(function(){
    $("#serviceOrder").on('submit', function(e){
      $('#btnDoOrder').html("<h5 class=\'text-bold\'>Saving...</h5>");
      $("#btnDoOrder").prop("disabled", true);
      e.preventDefault();
      $.confirm({
          title: 'Confirm!',
          content: 'Simple confirm!',
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