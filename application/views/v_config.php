
<div class="container">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Konfigurasi</h4>
            </div>
        

           

            <div class="panel-body">

                <?php echo validation_errors('<p>', '</p>'); ?>
                <form class="form-horizontal" role="form" method="post">
                    <div id="form-utama">


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Kepala Dinas</label>
                            <div class="col-sm-3">
                                <input value="<?php echo $this->m_config->get_nama_kepala_dinas() ?>" type="text" class="form-control input-sm" name="nama_kepala_dinas" id="nama_kepala_dinas" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">NIP Kepala Dinas</label>
                            <div class="col-sm-3">
                                <input value="<?php echo $this->m_config->get_nip_kepala_dinas() ?>" type="text" class="form-control input-sm" name="nip_kepala_dinas" id="nip_kepala_dinas" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nama Bendahara Penerimaan</label>
                            <div class="col-sm-3">
                                <input value="<?php echo $this->m_config->get_nama_bendahara_penerimaan() ?>" type="text" class="form-control input-sm" name="nama_bendahara_penerimaan" id="nama_bendahara_penerimaan" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">NIP Bendahara Penerimaan</label>
                            <div class="col-sm-3">
                                <input value="<?php echo  $this->m_config->get_nip_bendahara_penerimaan() ?>" type="text" class="form-control input-sm" name="nip_bendahara_penerimaan" id="nip_bendahara_penerimaan" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <input type="reset" class="btn btn-default btn-sm">
                                <input type="submit" class="btn btn-primary btn-sm" value="Simpan" name="simpan">
                            </div>
                        </div>
                        

                        
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


