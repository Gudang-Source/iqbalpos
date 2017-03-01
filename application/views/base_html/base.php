<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>POS - point of sale</title>
      <!-- jQuery -->
      <script type="text/javascript" src="<?=base_url()?>assets/js/jquery-2.2.2.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>assets/js/loading.js"></script>
      <!-- normalize & reset style -->
      <link rel="stylesheet" href="<?=base_url()?>assets/css/normalize.min.css"  type='text/css'>
      <link rel="stylesheet" href="<?=base_url()?>assets/css/reset.min.css"  type='text/css'>
      <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css"  type='text/css'>
      <!-- google lato font -->
      <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,300' rel='stylesheet' type='text/css'>
      <!-- Bootstrap Core CSS -->
      <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
      <!-- bootstrap-horizon -->
      <link href="<?=base_url()?>assets/css/bootstrap-horizon.css" rel="stylesheet">
      <!-- datatable style -->
      <link href="<?=base_url()?>assets/datatables/css/dataTables.bootstrap.css" rel="stylesheet">
      <!-- font awesome -->
      <link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css">
      <!-- include summernote css-->
      <link href="<?=base_url()?>assets/css/summernote.css" rel="stylesheet">
      <!-- waves -->
      <link rel="stylesheet" href="<?=base_url()?>assets/css/waves.min.css">
      <!-- daterangepicker -->
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/daterangepicker.css" />
      <!-- css for the preview keyset extension -->
      <link href="<?=base_url()?>assets/css/keyboard-previewkeyset.css" rel="stylesheet">
      <!-- keyboard widget style -->
      <link href="<?=base_url()?>assets/css/keyboard.css" rel="stylesheet">
      <!-- Select 2 style -->
      <link href="<?=base_url()?>assets/css/select2.min.css" rel="stylesheet">
      <!-- Sweet alert swal -->
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/sweetalert.css">
      <!-- datepicker css -->
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap-datepicker.min.css">
      <!-- Custom CSS -->
      <link href="<?=base_url()?>assets/css/Style-Dark.css" rel="stylesheet">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="#"><img src="http://localhost/zarpos/assets/img/logo.png" alt="logo"></a>
            </div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav">
                  <li class="flat-box"><a href="http://localhost/zarpos/"><i class="fa fa-credit-card"></i> POS</a></li>
                 <li class="flat-box"><a href="http://localhost/zarpos/products"><i class="fa fa-archive"></i> Product</a></li>
                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle flat-box" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users"></i> People <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                       <li class="flat-box"><a href="http://localhost/zarpos/customers"><i class="fa fa-user"></i> Customers</a></li>
                       <li class="flat-box"><a href="http://localhost/zarpos/suppliers"><i class="fa fa-truck"></i> Suppliers</a></li>
                    </ul>
                 </li>
                 <li class="flat-box"><a href="http://localhost/zarpos/sales"><i class="fa fa-ticket"></i> Sales</a></li>
                 <li class="flat-box"><a href="http://localhost/zarpos/expences"><i class="fa fa-usd"></i> Expense</a></li>
                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle flat-box" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bookmark"></i> Categories <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                       <li class="flat-box"><a href="http://localhost/zarpos/categories"><i class="fa fa-archive"></i> Product</a></li>
                       <li class="flat-box"><a href="http://localhost/zarpos/categorie_expences"><i class="fa fa-usd"></i> Expense</a></li>
                    </ul>
                 </li>
                 <li class="flat-box"><a href="http://localhost/zarpos/settings?tab=setting"><i class="fa fa-cogs"></i> Setting</a></li>                 <li class="flat-box"><a href="http://localhost/zarpos/stats"><i class="fa fa-line-chart"></i> Reports</a></li>               </ul>
               <ul class="nav navbar-nav navbar-right">
                  <li><a href="">
                        <img class="img-circle topbar-userpic hidden-xs" src="http://localhost/zarpos/files/Avatars/9fff9cc26e539214e9a5fd3b6a10cde9.jpg" width="30px" height="30px">
                        <span class="hidden-xs"> &nbsp;&nbsp;admin Doe </span>
                     </a>
                  </li>
<!--                   <li class="dropdown language">
                     <a href="#" class="dropdown-toggle flat-box" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="http://localhost/zarpos/assets/img/flags/en.png" class="flag" alt="language">
                        <span class="caret"></span></a>
                     <ul class="dropdown-menu">
                        <li class="flat-box"><a href="http://localhost/zarpos/dashboard/change/english"><img src="http://localhost/zarpos/assets/img/flags/en.png" class="flag" alt="language"> English</a></li>
                        <li class="flat-box"><a href="http://localhost/zarpos/dashboard/change/francais"><img src="http://localhost/zarpos/assets/img/flags/fr.png" class="flag" alt="language"> Français</a></li>
                        <li class="flat-box"><a href="http://localhost/zarpos/dashboard/change/portuguese"><img src="http://localhost/zarpos/assets/img/flags/pr.png" class="flag" alt="language"> Portuguese</a></li>
                        <li class="flat-box"><a href="http://localhost/zarpos/dashboard/change/spanish"><img src="http://localhost/zarpos/assets/img/flags/sp.png" class="flag" alt="language"> Spanish</a></li>
                        <li class="flat-box"><a href="http://localhost/zarpos/dashboard/change/arabic"><img src="http://localhost/zarpos/assets/img/flags/ar.png" class="flag" alt="language"> العربية</a></li>
                        <li class="flat-box"><a href="http://localhost/zarpos/dashboard/change/danish"><img src="http://localhost/zarpos/assets/img/flags/da.png" class="flag" alt="language"> Danish</a></li>
                        <li class="flat-box"><a href="http://localhost/zarpos/dashboard/change/turkish"><img src="http://localhost/zarpos/assets/img/flags/tr.png" class="flag" alt="language"> Turkish</a></li>
                        <li class="flat-box"><a href="http://localhost/zarpos/dashboard/change/greek"><img src="http://localhost/zarpos/assets/img/flags/gr.png" class="flag" alt="language"> Greek</a></li>
                     </ul>
                  </li> -->
                  <li class="flat-box"><a href="http://localhost/zarpos/logout" title="Logout"><i class="fa fa-sign-out fa-lg"></i></a></li>
               </ul>
            </div>
            <div id="loadingimg"></div>
         </div>
         <!-- /.container -->
      </nav>
      <!-- Page Content -->


      <!-- Page Content -->
      <?=modules::run($view)?>
   <script type="text/javascript">
   function OpenRegister(status, storeid){
      if(status == 0) {
         $('#CashinHand').modal('show');
         $('#store').val(storeid);
      }else {
         window.location.href = "<?=base_url()?>pos/openregister/" + storeid;
      }
   }

   </script>
   <!-- Modal add user -->
   <div class="modal fade" id="CashinHand" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel">Cash in Hand</h4>
         </div>
          <form action="<?=base_url()?>pos/openregister" method="post" accept-charset="utf-8" enctype="multipart/form-data">         <div class="modal-body">
             <div class="form-group">
              <label for="CashinHand">Cash in Hand</label>
              <input type="number" step="any" name="cash" Required class="form-control" id="CashinHand" placeholder="Cash in Hand">
              <input type="hidden" name="store" class="form-control" id="store">
            </div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-add">Submit</button>
           </div>
          </form>       
      </div>
    </div>
   </div>
   <!-- /.Modal -->
   



      <!-- slim scroll script -->
      <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.slimscroll.min.js"></script>
      <!-- waves material design effect -->
      <script type="text/javascript" src="<?=base_url()?>assets/js/waves.min.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
      <!-- keyboard widget dependencies -->
      <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.keyboard.js"></script>
      <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.keyboard.extension-all.js"></script>
      <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.keyboard.extension-extender.js"></script>
      <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.keyboard.extension-typing.js"></script>
      <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.mousewheel.js"></script>
      <!-- select2 plugin script -->
      <script type="text/javascript" src="<?=base_url()?>assets/js/select2.min.js"></script>
      <!-- dalatable scripts -->
      <script src="<?=base_url()?>assets/datatables/js/jquery.dataTables.min.js"></script>
      <script src="<?=base_url()?>assets/datatables/js/dataTables.bootstrap.js"></script>
      <!-- summernote js -->
      <script src="<?=base_url()?>assets/js/summernote.js"></script>
      <!-- chart.js script -->
      <script src="<?=base_url()?>assets/js/Chart.js"></script>
      <!-- moment JS -->
      <script type="text/javascript" src="<?=base_url()?>assets/js/moment.min.js"></script>
      <!-- Include Date Range Picker -->
      <script type="text/javascript" src="<?=base_url()?>assets/js/daterangepicker.js"></script>
      <!-- Sweet Alert swal -->
      <script src="<?=base_url()?>assets/js/sweetalert.min.js"></script>
      <!-- datepicker script -->
      <script src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
      <!-- creditCardValidator script -->
      <script src="<?=base_url()?>assets/js/jquery.creditCardValidator.js"></script>
      <!-- creditCardValidator script -->
      <script src="<?=base_url()?>assets/js/credit-card-scanner.js"></script>
      <script src="<?=base_url()?>assets/js/jquery.redirect.js"></script>
      <!-- ajax form -->
      <script src="<?=base_url()?>assets/js/jquery.form.min.js"></script>
      <!-- custom script -->
      <script src="<?=base_url()?>assets/js/app.js"></script>
   </body>
</html>
