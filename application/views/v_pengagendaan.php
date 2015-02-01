


<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengagendaan
            <small><?php echo str_replace('_', ' ', $nama_sub_modul) ?></small>
        </h1>
        
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12">
                
                <?php
                if($pesan_kesalahan){
                    foreach ($pesan_kesalahan as $r_pesan_kesalahan) {
                        echo alert('warning', $r_pesan_kesalahan);
                    }
                }
                ?>
                <div class="panel panel-default">
                    
                
                    <div class="panel-body">

                        
                        <form class="form-horizontal" role="form" method="post" action="">
                            
                            

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Daftar</label>
                                <div class="col-sm-3">
                                    <input readonly="" type="date" class="form-control input-sm" name="tanggal_daftar"  id="tanggal_daftar" value="<?php echo $fo->tanggal_daftar; ?>" />
                                </div>
                            </div>
                            

                            <?php echo $form_pengagendaan_tambahan; ?>

        	

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-4">
                                    <a href="<?php echo site_url('c_pengagendaan/belum') ?>" id="Kembali" class="btn btn-default btn-sm">Kembali</a>
                                    <input type="submit" class="btn btn-primary btn-sm" value="Agendakan" name="agendakan">
                                </div>
                            </div>
                            
                            
                        </form>

                    </div>
                </div>
            </div>
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->




