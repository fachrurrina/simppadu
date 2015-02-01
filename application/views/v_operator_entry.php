<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Operator
            <small>Entry <?php echo str_replace('_', ' ', $nama_sub_modul) ?></small>
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
                        <form id="form_operator" class="form-horizontal" role="form" method="post" action="">
                            
                            

                            <?php echo $form_operator; ?>

                            

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                <div class="col-sm-4">
                                    <a href="<?php echo site_url('c_operator/belum') ?>" id="Kembali" class="btn btn-default btn-sm">Kembali</a>
                                    <input type="submit" class="btn btn-primary btn-sm" value="Simpan" name="simpan">
                                </div>
                            </div>
                            
                            
                        </form>

                    </div>
                </div>
            </div>
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->




