
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Verifikasi I
            <small><?php echo $this->m_modul->get_nama_modul($verifikasi->id_modul) ?></small>
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
                                    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
                                    <div class="col-sm-3">
                                        <input value="<?php echo $verifikasi->no_daftar; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar"  id="no_daftar" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Daftar</label>
                                    <div class="col-sm-3">
                                        <input value="<?php echo $verifikasi->tanggal_daftar; ?>" readonly="" type="date" class="form-control input-sm" name="tanggal_daftar"  id="tanggal_daftar" value="<?php echo date('Y-m-d'); ?>" />
                                    </div>
                                </div>
                

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Modul</label>
                                    <div class="col-sm-4">
                                        <select disabled="" class="form-control input-sm" name="id_modul" id="id_modul">
                                            <option></option>
                                            <?php foreach ($modul as $r_modul): ?>
                                                <option <?php echo ($verifikasi->id_modul == $r_modul->id_modul) ? 'selected' : '' ; ?> value="<?php echo $r_modul->id_modul; ?>"><?php echo $r_modul->nama_modul; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Sub Modul</label>
                                    <div class="col-sm-4">
                                        <select disabled="" class="form-control input-sm" name="id_sub_modul" id="id_sub_modul">
                                            <option></option>
                                            <?php foreach ($sub_modul as $r_sub_modul): ?>
                                                <option <?php echo ($verifikasi->id_sub_modul == $r_sub_modul->id_sub_modul) ? 'selected' : '' ; ?> value="<?php echo $r_sub_modul->id_sub_modul; ?>"><?php echo $r_sub_modul->nama_sub_modul; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemohon</label>
                                    <div class="col-sm-3">
                                        <input value="<?php echo $verifikasi->nama_pemohon; ?>" readonly="" type="text" class="form-control input-sm" name="nama_pemohon" id="nama_pemohon" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">No Telp Pemohon</label>
                                    <div class="col-sm-3">
                                        <input value="<?php echo $verifikasi->no_telp_pemohon; ?>" readonly="" type="text" class="form-control input-sm" name="no_telp_pemohon" id="no_telp_pemohon" />
                                    </div>
                                </div>

                                <hr />

                                
                

                                <div id="form_verifikasi_tambahan">
                                    <?php echo $form_verifikasi_tambahan; ?>
                                </div>
                                
                                
                                
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-4">
                                        <a href="" class="btn btn-default btn-sm">Kembali</a>
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
                                                                <textarea class="form-control input-sm" name="pesan_tolak_v_i" id="pesan_tolak_v_i" cols="30" rows="5"></textarea>
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
                                
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->

