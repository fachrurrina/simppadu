<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Front Office
            <small>Input Penerimaan Berkas</small>
        </h1>
        
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Main row -->
        <div class="row">
            

           <div class="col-lg-12">

                <div class="panel panel-default">
                    

                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="<?php echo site_url('c_fo/daftar_1'); ?>">Input Penerimaan</a></li>
                            <li><a href="<?php echo site_url('c_fo/tertunda'); ?>">Tertunda</a></li>
                            <li><a href="<?php echo site_url('c_fo/tolak'); ?>">Ditolak</a></li>
                            <li><a href="<?php echo site_url('c_fo/dalam_proses'); ?>">Dalam Proses</a></li>
                            <li><a href="<?php echo site_url('c_fo/selesai'); ?>">Selesai</a></li>
                        </ul>
                    </div>

                    <div class="panel-body">

                        
                        <form class="form-horizontal" role="form" method="get" action="<?php echo site_url('c_fo/daftar_2'); ?>">
                            <div id="form-utama">


                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Daftar</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control input-sm" name="tanggal_daftar"  id="tanggal_daftar" value="<?php echo date('Y-m-d'); ?>" />
                                    </div>
                                </div>
                

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Modul</label>
                                    <div class="col-sm-4">
                                        <select class="form-control input-sm" name="id_modul" id="id_modul">
                                            <option></option>
                                            <?php foreach ($modul as $r_modul): ?>
                                                <option value="<?php echo $r_modul->id_modul; ?>"><?php echo $r_modul->nama_modul; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        console.log('ready');
                                        $('#id_modul').change(function() {

                                            var id_modul = $('#id_modul').val();

                                            console.log('berhasil');

                                            $.ajax({
                                                url: '<?php echo site_url("c_fo/get_where_id_modul") ?>/' + id_modul,
                                                success: function(data) {
                                                    $('#id_sub_modul').html(data);
                                                }
                                            });

                                        });
                                    });
                                </script>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Sub Modul</label>
                                    <div class="col-sm-4">
                                        <select class="form-control input-sm" name="id_sub_modul" id="id_sub_modul">
                                            <!-- isi dari combo sub modul akan di load dari ajax -->
                                        </select>
                                    </div>
                                </div>
                                
                                

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-4">
                                        <!-- <a id="lanjutkan" class="btn btn-primary btn-sm">Lanjutkan</a> -->
                                        <input type="submit" class="btn btn-primary btn-sm" value="Lanjutkan" name="lanjutkan">
                                    </div>
                                </div>
                                
                                
                                
                                
                            </div>


                            
                        </form>

                    </div>
                </div>
            </div>



        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->



       