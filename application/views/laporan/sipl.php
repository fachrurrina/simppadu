
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan
            <small>Rekap Bulanan SIPL</small>
        </h1>
        
    </section>

    <!-- Main content -->
    <section class="content">

        

        <!-- Main row -->
        <div class="row">
            
            <div class="col-lg-12">

                <div class="panel panel-default">
                    
                
                    <div class="panel-body">
                        <br />
                        <?php echo validation_errors('<p>', '</p>'); ?>
                        <form class="form-horizontal" role="form" method="post">
                            <div id="form-utama">

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Periode Bulan</label>
                                    <div class="col-sm-4">
                                        <input type="month" class="form-control input-sm" name="periode" id="periode" value="<?php echo date('Y-m') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Per Kecamatan Perusahaan</label>
                                    <div class="col-sm-4">
                                        <select class="form-control input-sm" name="id_kec_perusahaan" id="id_kec_perusahaan">
                                            <option></option>
                                            <?php if($kec): foreach($kec as $r_kec): ?>
                                                <option value="<?php echo $r_kec->id_kec ?>"><?php echo $r_kec->nm_kec; ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                </div>

                             


                                
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-3">
                                        <a class="btn btn-xs btn-primary" href="<?php echo site_url('c_laporan'); ?>">Kembali</a>
                                        <input type="submit" class="btn btn-xs btn-primary" name="cetak" id="cetak" value="Cetak">
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




