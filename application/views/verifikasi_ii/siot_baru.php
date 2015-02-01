<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->no_daftar; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Daftar</label>
    <div class="col-sm-2"><input readonly="" value="<?php echo $verifikasi->tanggal_daftar ?>" type="date" name="tanggal_daftar" id="tanggal_daftar" class="form-control input-sm"></div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->no_sk; ?>" type="text" class="form-control input-sm" name="no_sk" id="no_sk" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nomor Surat Dirjen Bina Upaya Kesehatan</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->no_surat_dirjen_buk ?>" type="text" class="form-control input-sm" name="no_surat_dirjen_buk" id="no_surat_dirjen_buk" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Surat Dirjen Bina Upaya Kesehatan</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->tanggal_surat_dirjen_buk ?>" type="date" class="form-control input-sm" name="tanggal_surat_dirjen_buk" id="tanggal_surat_dirjen_buk" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Rumah Sakit</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->nama_rumah_sakit; ?>" type="text" class="form-control input-sm" name="nama_rumah_sakit" id="nama_rumah_sakit" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Klasifikasi Rumah Sakit yang telah ditentukan oleh kementerian Kesehatan</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->klasifikasi_kelas_menkes ?>" type="text" class="form-control input-sm" name="klasifikasi_kelas_menkes" id="klasifikasi_kelas_menkes" />
    </div>
</div>



<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Rumah Sakit</label>
    <div class="col-sm-6"><textarea readonly="" name="alamat_rumah_sakit" id="alamat_rumah_sakit" class="form-control input-sm"><?php echo $verifikasi->alamat_rumah_sakit ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Rumah Sakit</label>
    <div class="col-sm-4">
        <select readonly="" name="id_kec_rumah_sakit" id="id_kec_rumah_sakit" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($verifikasi->id_kec_rumah_sakit == $r_kec->id_kec) ? 'selected=""' : '' ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_kec_rumah_sakit').change(function(){

            var id_kec_rumah_sakit = $('#id_kec_rumah_sakit').val();

            console.log(id_kec_rumah_sakit);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + id_kec_rumah_sakit,
                success: function(data) {

                    $('#id_kel_rumah_sakit').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Rumah Sakit</label>
    <div class="col-sm-4">
        <select readonly="" name="id_kel_rumah_sakit" id="id_kel_rumah_sakit" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($verifikasi->id_kel_rumah_sakit == $r_kel->id_kel) ? 'selected=""' : '' ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->nama_pemilik; ?>" type="text" class="form-control input-sm" name="nama_pemilik" id="nama_pemilik" />
    </div>
</div>



<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Pemilik</label>
    <div class="col-sm-6"><textarea readonly="" name="alamat_pemilik" id="alamat_pemilik" class="form-control input-sm"><?php echo $verifikasi->alamat_pemilik ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemilik</label>
    <div class="col-sm-4">
        <select readonly="" name="id_kec_pemilik" id="id_kec_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($verifikasi->id_kec_pemilik == $r_kec->id_kec) ? 'selected=""' : '' ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
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
        <select readonly="" name="id_kel_pemilik" id="id_kel_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($verifikasi->id_kel_pemilik == $r_kel->id_kel) ? 'selected=""' : '' ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Dokter Penanggung Jawab</label>
    <div class="col-sm-3">
        <input readonly="" rea value="<?php echo $verifikasi->dokter_penanggung_jawab ?>" type="text" class="form-control input-sm" name="dokter_penanggung_jawab" id="dokter_penanggung_jawab" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No. SIP Dokter</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->no_sip_dokter ?>" type="text" class="form-control input-sm" name="no_sip_dokter" id="no_sip_dokter" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Berlaku SIP</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->tanggal_berlaku_sip ?>" type="date" class="form-control input-sm" name="tanggal_berlaku_sip" id="tanggal_berlaku_sip" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal terbit</label>
    <div class="col-sm-4"><input readonly="" value="<?php echo $verifikasi->tanggal_terbit ?>" type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal berlaku</label>
    <div class="col-sm-4"><input readonly="" value="<?php echo $verifikasi->tanggal_perpanjangan ?>" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" class="form-control input-sm"></div>
</div>
