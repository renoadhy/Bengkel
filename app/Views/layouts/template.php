<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Bengkel SFP Motor</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url('assets/css/fa.css');?>" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/css/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url('assets/css/skins/_all-skins.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/plugins/iCheck/flat/blue.css');?>" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo base_url('assets/plugins/morris/morris.css');?>" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css');?>" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">
    <!-- Date Picker -->
    <link href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css');?>" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.css')?>">
    <!-- old jquery -->
    <!-- <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js');?>"></script> -->
    <script src="<?php echo base_url('assets/js/jquery-new.js');?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/yearpicker.css');?>">
    <style>
    .swal-wide {
        width: 250px !important;
    }
    </style>



</head>

<body class="skin-black" style="font-size:15px">
    <div class="wrapper">
        <header class="main-header text-lg">
            <!-- Logo -->
            <a href="<?php echo base_url('/dashboard');?>" class="logo"> Bengkel SFP Motor</a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url('assets/img/avatar5.png');?>" class="user-image"
                                    alt="User Image" />
                                <span class="hidden-xs"><?php echo $_SESSION['nm_user'];
                                ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url('assets/img/avatar5.png');?>" class="img-circle"
                                        alt="User Image" />
                                    <p>
                                        <?php echo $_SESSION['nm_user'];?>
                                        <small>( <?php echo $_SESSION['level'];?> )</small>
                                    </p>
                                </li>

                                <li class="user-footer">
                                    <center>
                                        <div class=" ">
                                            <a href="<?php echo base_url('logout');?>"
                                                class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </center>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo base_url('assets/img/avatar5.png');?>" class="img-circle"
                            alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p><?php  echo $_SESSION['nm_user'];?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li><a href="<?php echo base_url('/dashboard');?>"><i class="fa fa-dashboard"></i>
                            Dashboard</a></li>  
                    <li class="header">MASTER DATA</li>
                    <li><a href="<?php echo base_url('user');?>"><i class="fa fa-user"></i>
                            Data Pengguna</a></li>   
                    <li><a href="<?php echo base_url('supplier');?>"><i class="fa fa-folder"></i>
                            Data Supplier</a></li> 
                    <li><a href="<?php echo base_url('servis');?>"><i class="fa fa-wrench"></i>
                            Data Servis</a></li> 
                    <li><a href="<?php echo base_url('sparepart');?>"><i class="fa fa-cogs"></i>
                            Data Sparepart</a></li>                             
                    <li class="header">TRANSAKSI</li>
                    <li><a href="<?php echo base_url('masuk');?>"><i class="fa fa-shopping-cart"></i>
                            Pembelian Sparepart</a></li>
                    <li><a href="<?php echo base_url('keluar');?>"><i class="fa fa-money"></i>
                            Pembayaran Sparepart</a></li> 
                    <li><a href="<?php echo base_url('servisKeluar');?>"><i class="fa fa-money"></i>
                            Pembayaran Jasa Servis</a></li> 
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper">
        <?= $this->renderSection("content"); ?>             
        </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2022 <a href="#"> </a> | </strong> Universitas Dr. Soetomo | Fakultas Teknik Informatika - Kelas Profesional 2019
</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<!-- jQuery UI 1.11.2 -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
// $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->

<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
<!-- Morris.js charts -->
<!-- <script src="<?php echo base_url('http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js');?>"></script> -->
<script src="<?php echo base_url('assets/plugins/morris/morris.min.js');?>" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/plugins/sparkline/jquery.sparkline.min.js');?>" type="text/javascript">
</script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');?>" type="text/javascript">
</script>
<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js');?>"
    type="text/javascript">
</script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/plugins/knob/jquery.knob.js');?>" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js');?>" type="text/javascript">
</script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>" type="text/javascript">
</script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"
    type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript">
</script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/js/app.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.js')?>"></script>


<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url('assets/js/pages/dashboard.js');?>" type="text/javascript"></script> -->

<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url('assets/js/demo.js');?>" type="text/javascript"></script> -->

<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/yearpicker.js')?>"></script>
<style>
html {
    font-size: 13px;
}
</style>

</body>

</html>