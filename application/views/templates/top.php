<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Simppadu | <?php echo ucwords((explode('_', $this->uri->segment('1'))[1])) ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo base_url('assets/bootstrap-3.3.1/dist/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/font-awesome-4.2.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/css/ionicons-2.0.0/css/ionicons.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo base_url('assets/css/morris/morris.css') ?>" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo base_url('assets/css/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="<?php echo base_url('assets/css/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo base_url('assets/css/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <!-- <link href="<?php // echo base_url('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet" type="text/css" /> -->
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/AdminLTE.css') ?>" rel="stylesheet" type="text/css" />
        

        

        <!-- AdminLTE App -->
        <script src="<?php echo base_url('assets/bootstrap-3.3.1/dist/js/jquery-2.1.0.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/bootstrap-3.3.1/dist/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/jquery-ui-1.11.2/jquery-ui.min.js') ?>" type="text/javascript"></script>

        <!-- Morris.js charts -->
        <script src="<?php echo base_url('assets/js/plugins/raphael/raphael-min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/plugins/morris/morris.min.js') ?>" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?php echo base_url('assets/js/plugins/sparkline/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo base_url('assets/js/plugins/jqueryKnob/jquery.knob.js') ?>" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo base_url('assets/js/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="<?php echo base_url('assets/js/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <!--<script src="<?php // echo base_url('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>" type="text/javascript"></script>-->
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/js/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('assets/js/AdminLTE/app.js') ?>" type="text/javascript"></script>


        <link href="<?php echo base_url('assets/DataTables-1.10.4/media/css/jquery.dataTables.css') ?>" rel="stylesheet">
        <script type="text/javascript" src="<?php echo base_url('assets/DataTables-1.10.4/media/js/jquery.dataTables.js') ?>"></script> 
    
        <script type="text/javascript">
            $(document).ready(function(){
                $('.datatable').dataTable({
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ Baris/Halaman",
                        "zeroRecords": "Maaf, Tidak ditemukan apapun",
                        "info": "Halaman _PAGE_ / _PAGES_",
                        "infoEmpty": "Tidak ada Record yang tersedia",
                        "infoFiltered": "(filtered from _MAX_ total records)"
                    },
                    "scrollX": true
                    
                    
                });
            });
        </script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!--<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>-->

        <!-- AdminLTE for demo purposes -->
        <!--<script src="js/AdminLTE/demo.js" type="text/javascript"></script>-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <![endif]-->



    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Simppadu
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                       
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Fachrul Andy <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="" class="img-circle" alt="User Image" />
                                    <p>
                                        Fachrul Andy - Web Developer
                                        <!-- <small>Programmer</small> -->
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!-- <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li> -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="<?php echo ($this->uri->segment(1) == 'c_home') ? 'active' : '' ?>">
                            <a href="<?php echo site_url('c_home') ?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview <?php echo ($this->uri->segment(1) == 'c_fo') ? 'active' : '' ?>">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Front Office</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php echo ($this->uri->segment(2) == 'daftar_1') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_fo/daftar_1') ?>"><i class="fa fa-angle-double-right"></i> Input Penerimaan Berkas</a></li>
                                <li <?php echo ($this->uri->segment(2) == 'tertunda') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_fo/tertunda') ?>"><i class="fa fa-angle-double-right"></i> Tertunda</a></li>
                                <li <?php echo ($this->uri->segment(2) == 'tolak') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_fo/tolak') ?>"><i class="fa fa-angle-double-right"></i> Di Tolak Verifikasi I</a></li>
                                <li <?php echo ($this->uri->segment(2) == 'dalam_proses') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_fo/dalam_proses') ?>"><i class="fa fa-angle-double-right"></i> Telah Di Proses</a></li>
                                <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Telah Selesai</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo ($this->uri->segment(1) == 'c_verifikasi_i') ? 'active' : '' ?>">
                            <a href="#">
                                <i class="fa fa-check-square-o"></i>
                                <span>Verifikasi I</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php echo ($this->uri->segment(2) == 'belum') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_verifikasi_i/belum') ?>"><i class="fa fa-angle-double-right"></i> Belum Di Verifikasi</a></li>
                                <li <?php echo ($this->uri->segment(2) == 'tolak') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_verifikasi_i/tolak') ?>"><i class="fa fa-angle-double-right"></i> Sudah Di tolak</a></li>
                                <li <?php echo ($this->uri->segment(2) == 'sudah') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_verifikasi_i/sudah') ?>"><i class="fa fa-angle-double-right"></i> Sudah Di Setujui</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo ($this->uri->segment(1) == 'c_penetapan') ? 'active' : '' ?>">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Penetapan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php echo ($this->uri->segment(2) == 'belum') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_penetapan/belum') ?>"><i class="fa fa-angle-double-right"></i> Belum Di Tetapkan</a></li>
                                <li <?php echo ($this->uri->segment(2) == 'belum_lunas') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_penetapan/belum_lunas') ?>"><i class="fa fa-angle-double-right"></i> Belum Lunas</a></li>
                                <li <?php echo ($this->uri->segment(2) == 'sudah_lunas') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_penetapan/sudah_lunas') ?>"><i class="fa fa-angle-double-right"></i> Sudah Lunas</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo ($this->uri->segment(1) == 'c_pengagendaan') ? 'active' : '' ?>">
                            <a href="#">
                                <i class="fa fa-list-alt"></i>
                                <span>Pengagendaan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php echo ($this->uri->segment(2) == 'belum') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_pengagendaan/belum') ?>"><i class="fa fa-angle-double-right"></i> Belum Di Agendakan</a></li>
                                <li <?php echo ($this->uri->segment(2) == 'sudah') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_pengagendaan/sudah') ?>"><i class="fa fa-angle-double-right"></i> Sudah Di Agendakan</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo ($this->uri->segment(1) == 'c_operator') ? 'active' : '' ?>">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Operator</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php echo ($this->uri->segment(2) == 'belum') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_operator/belum') ?>"><i class="fa fa-angle-double-right"></i> Belum Di Entry</a></li>
                                <li <?php echo ($this->uri->segment(2) == 'tolak') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_operator/tolak') ?>"><i class="fa fa-angle-double-right"></i> Di Tolak Verifikasi II</a></li>
                                <li <?php echo ($this->uri->segment(2) == 'sudah') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_operator/sudah') ?>"><i class="fa fa-angle-double-right"></i> Di Setujui Verifikasi II</a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo ($this->uri->segment(1) == 'c_verifikasi_ii') ? 'active' : '' ?>">
                            <a href="#">
                                <i class="fa fa-check-square-o"></i>
                                <span>Verifikasi II</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php echo ($this->uri->segment(2) == 'belum') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_verifikasi_ii/belum') ?>"><i class="fa fa-angle-double-right"></i> Belum Di Verifikasi</a></li>
                                <li <?php echo ($this->uri->segment(2) == 'sudah') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_verifikasi_ii/sudah') ?>"><i class="fa fa-angle-double-right"></i> Sudah Di Setujui</a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo ($this->uri->segment(1) == 'c_cetak') ? 'active' : '' ?>">
                            <a href="#">
                                <i class="fa fa-print"></i>
                                <span>Cetak</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php echo ($this->uri->segment(2) == 'belum') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_cetak/belum') ?>"><i class="fa fa-angle-double-right"></i> Belum Di Cetak</a></li>
                                <li <?php echo ($this->uri->segment(2) == 'sudah') ? 'class="active"' : '' ?>><a href="<?php echo site_url('c_cetak/sudah') ?>"><i class="fa fa-angle-double-right"></i> Sudah Di Cetak</a></li>
                            </ul>
                        </li>

                        <li class="<?php echo ($this->uri->segment(1) == 'c_laporan') ? 'active' : '' ?>">
                            <a href="<?php echo site_url('c_laporan') ?>">
                                <i class="fa fa-table"></i> <span>Laporan</span>
                            </a>
                        </li>
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>