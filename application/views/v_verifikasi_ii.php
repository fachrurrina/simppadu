

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Verifikasi I
            <small><?php echo str_replace('_', ' ', $nama_sub_modul) ?></small>
        </h1>
        
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                   
                 


                    <div class="panel-body">

                        <?php echo validation_errors('<p>', '</p>'); ?>
                        <form class="form-horizontal" role="form" method="post">
                            
                            <?php echo $form_verifikasi_ii_tambahan; ?>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-4">
                                    <a href="<?php echo site_url('c_verifikasi_ii'); ?>" class="btn btn-default btn-sm">Kembali</a>
                                    <input type="submit" class="btn btn-primary btn-sm" value="Setujui" name="setujui">

                                    <!-- proses tolak -->
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">Tolak</a>

                                    <div class="modal fade bs-example-modal-sm in" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="false" style="display: none;">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                    <h4 class="modal-title" id="mySmallModalLabel">Tolak</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-2 control-label">Tulis Pesan Kesalahan</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control input-sm" name="pesan_tolak_v_ii" id="pesan_tolak_v_ii" cols="30" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <input type="submit" class="btn btn-danger btn-sm" name="tolak" id="tolak" value="Tolak" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                    <!-- proses tolak -->

                                    
                                </div>
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->


