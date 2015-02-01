

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan 
            <small>Penerbitan Izin Bulanan</small>
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
                            <div id="form-utama">

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Izin</label>
                                    <div class="col-sm-4">
                                        <select class="form-control input-sm" name="id_modul" id="id_modul">
                                            <option></option>
                                            <?php if($modul): foreach($modul as $r_modul): ?>
                                                <option url="<?php echo site_url('c_laporan/laporan_'. $r_modul->singkatan) ?>" value="<?php echo $r_modul->id_modul ?>"><?php echo $r_modul->nama_modul; ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                </div>

                                
                                
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-3">
                                        
                                        <a class="btn btn-xs btn-primary" onclick="
                                            var url = $('#id_modul > option:selected').attr('url');
                                            window.location.assign(url);
                                        ">Lanjutkan</a>
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




