<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Front Office
            <small>Edit Pendaftaran <?php echo $this->m_modul->get_nama_modul($edit->id_modul) ?> Yang Di Tolak Verifikasi I </small>
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

                                <div class="form-group has-warning">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Pesan Kesalahan Dari Verifikasi I</label>
                                    <div class="col-sm-6">
                                        <textarea readonly="" class="form-control input-sm" id="pesan_tolak_v_i" name="pesan_tolak_v_i"><?php echo $edit->pesan_tolak_v_i; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
                                    <div class="col-sm-3">
                                        <input readonly="" value="<?php echo $edit->no_daftar; ?>" type="text" class="form-control input-sm" name="no_daftar"  id="no_daftar"  />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Daftar</label>
                                    <div class="col-sm-3">
                                        <input readonly="" value="<?php echo $edit->tanggal_daftar; ?>" type="date" class="form-control input-sm" name="tanggal_daftar"  id="tanggal_daftar" value="<?php echo date('Y-m-d'); ?>" />
                                    </div>
                                </div>
        		

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Modul</label>
                                    <div class="col-sm-4">
                                        <select readonly="" class="form-control input-sm" name="id_modul" id="id_modul">
                                            <option></option>
                                            <?php foreach ($modul as $r_modul): ?>
                                                <option <?php echo ($edit->id_modul == $r_modul->id_modul) ? 'selected' : '' ; ?> value="<?php echo $r_modul->id_modul; ?>"><?php echo $r_modul->nama_modul; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Sub Modul</label>
                                    <div class="col-sm-4">
                                        <select readonly="" class="form-control input-sm" name="id_sub_modul" id="id_sub_modul">
                                            <option></option>
                                            <?php foreach ($sub_modul as $r_sub_modul): ?>
                                                <option <?php echo ($edit->id_sub_modul == $r_sub_modul->id_sub_modul) ? 'selected' : '' ; ?> value="<?php echo $r_sub_modul->id_sub_modul; ?>"><?php echo $r_sub_modul->nama_sub_modul; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemohon</label>
                                    <div class="col-sm-3">
                                        <input value="<?php echo $edit->nama_pemohon ?>" type="text" class="form-control input-sm" name="nama_pemohon" id="nama_pemohon" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">No Telp Pemohon</label>
                                    <div class="col-sm-3">
                                        <input value="<?php echo $edit->no_telp_pemohon ?>" type="text" class="form-control input-sm" name="no_telp_pemohon" id="no_telp_pemohon" />
                                    </div>
                                </div>

                                <hr />
                

                                <div id="form_fo">
                                    <?php echo $form_fo; ?>
                                </div>

                                

                                
                                
                                
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-4">
                                        <a href="<?php echo site_url('c_fo/tolak') ?>" class="btn btn-default btn-sm">Kembali</a>
                                        <input type="submit" class="btn btn-primary btn-sm" value="Simpan" name="simpan">
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



