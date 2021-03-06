<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $fo->no_daftar; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Daftar</label>
    <div class="col-sm-2"><input readonly="" value="<?php echo $fo->tanggal_daftar ?>" type="date" name="tanggal_daftar" id="tanggal_daftar" class="form-control input-sm"></div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $agenda->no_sk; ?>" type="text" class="form-control input-sm" name="no_sk" id="no_sk" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik</label>
    <div class="col-sm-3">
        <input value="<?php echo $fo->sia_baru_nama_pemilik; ?>" type="text" class="form-control input-sm" name="nama_pemilik" id="nama_pemilik" />
    </div>
</div>



<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Pemilik</label>
    <div class="col-sm-6"><textarea name="alamat_pemilik" id="alamat_pemilik" class="form-control input-sm"></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemilik</label>
    <div class="col-sm-4">
        <select name="id_kec_pemilik" id="id_kec_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_kec_pemilik').change(function(){

            var id_kec_pemilik = $('#id_kec_pemilik').val();

            console.log(id_kec_pemilik);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + id_kec_pemilik,
                success: function(data) {

                    $('#id_kel_pemilik').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Pemilik</label>
    <div class="col-sm-4">
        <select name="id_kel_pemilik" id="id_kel_pemilik" class="form-control input-sm">
            
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nomor Surat Izin Praktek Apoteker (SIPA)</label>
    <div class="col-sm-3">
        <input value="" type="text" class="form-control input-sm" name="no_sipa" id="no_sipa" />
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Apotek</label>
    <div class="col-sm-3">
        <input value="<?php echo $fo->sia_baru_nama_apotek; ?>" type="text" class="form-control input-sm" name="nama_apotek" id="nama_apotek" />
    </div>
</div>





<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Apotek</label>
    <div class="col-sm-6"><textarea name="alamat_apotek" id="alamat_apotek" class="form-control input-sm"></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Apotek</label>
    <div class="col-sm-4">
        <select name="id_kec_apotek" id="id_kec_apotek" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_kec_apotek').change(function(){

            var id_kec_apotek = $('#id_kec_apotek').val();

            console.log(id_kec_apotek);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + id_kec_apotek,
                success: function(data) {

                    $('#id_kel_apotek').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Apotek</label>
    <div class="col-sm-4">
        <select name="id_kel_apotek" id="id_kel_apotek" class="form-control input-sm">
            
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik Sarana</label>
    <div class="col-sm-3">
        <input value="" type="text" class="form-control input-sm" name="nama_pemilik_sarana" id="nama_pemilik_sarana" />
    </div>
</div>





<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Pemilik Sarana</label>
    <div class="col-sm-6"><textarea name="alamat_pemilik_sarana" id="alamat_pemilik_sarana" class="form-control input-sm"></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemilik Sarana</label>
    <div class="col-sm-4">
        <select name="id_kec_pemilik_sarana" id="id_kec_pemilik_sarana" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_kec_pemilik_sarana').change(function(){

            var id_kec_pemilik_sarana = $('#id_kec_pemilik_sarana').val();

            console.log(id_kec_pemilik_sarana);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + id_kec_pemilik_sarana,
                success: function(data) {

                    $('#id_kel_pemilik_sarana').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Pemilik Sarana</label>
    <div class="col-sm-4">
        <select name="id_kel_pemilik_sarana" id="id_kel_pemilik_sarana" class="form-control input-sm">
            
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nomor Akte Perjanjian Kerjasama</label>
    <div class="col-sm-3">
        <input value="" type="text" class="form-control input-sm" name="no_akte_perjanjian" id="no_akte_perjanjian" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Akte Perjanjian Kerjasama</label>
    <div class="col-sm-4"><input value="" type="date" name="tanggal_akte_perjanjian" id="tanggal_akte_perjanjian" class="form-control input-sm"></div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Yang dibuat diharapkan Notaris</label>
    <div class="col-sm-3">
        <input value="" type="text" class="form-control input-sm" name="nama_notaris_akte_perjanjian" id="nama_notaris_akte_perjanjian" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Di</label>
    <div class="col-sm-3">
        <input value="" type="text" class="form-control input-sm" name="tempat_akte_perjanjian" id="tempat_akte_perjanjian" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal terbit</label>
    <div class="col-sm-4"><input readonly="" value="<?php echo $agenda->tanggal_terbit ?>" type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control input-sm"></div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal daftar ulang</label>
    <div class="col-sm-4"><input readonly="" value="<?php echo $agenda->tanggal_daftar_ulang ?>" type="date" name="tanggal_daftar_ulang" id="tanggal_daftar_ulang" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal berlaku</label>
    <div class="col-sm-4"><input readonly="" value="<?php echo $agenda->tanggal_perpanjangan ?>" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" class="form-control input-sm"></div>
</div>
