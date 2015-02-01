<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->no_daftar; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Urut SIUJK</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->no_urut; ?>" readonly="" type="text" class="form-control input-sm" name="no_urut" id="no_urut" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->no_sk; ?>" readonly="" type="text" class="form-control input-sm" name="no_sk" id="no_sk" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-6"><input readonly="" type="text" name="nama_perusahaan" id="nama_perusahaan" value="<?php echo $verifikasi->nama_perusahaan; ?>" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Kualifikasi</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->kualifikasi ?>" type="text" name="kualifikasi" id="kualifikasi" value="" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Perusahaan</label>
    <div class="col-sm-6"><textarea readonly="" name="alamat_perusahaan" id="alamat_perusahaan" class="form-control input-sm"><?php echo $verifikasi->alamat_perusahaan ?></textarea></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">RT</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->rt_perusahaan ?>" type="text" name="rt_perusahaan" id="rt" value="" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">RW</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->rw_perusahaan ?>" type="text" name="rw_perusahaan" id="rw" value="" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Perusahaan</label>
    <div class="col-sm-4">
        <select readonly="" name="id_kec_perusahaan" id="id_kec_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($verifikasi->id_kec_perusahaan == $r_kec->id_kec) ? 'selected=""' : ''; ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Perusahaan</label>
    <div class="col-sm-4">
        <select readonly="" name="id_kel_perusahaan" id="id_kel_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($verifikasi->id_kel_perusahaan == $r_kel->id_kel) ? 'selected=""' : ''; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Kode Pos</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->kode_pos ?>" type="text" name="kode_pos" id="kode_pos" value="" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">No Telepon</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->no_telp ?>" type="text" name="no_telp" id="no_telp" value="" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">No Fax</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->no_fax ?>" type="text" name="no_fax" id="no_fax" value="" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nama Pemilik / Penanggung Jawab</label>
    <div class="col-sm-6"><input readonly="" type="text" name="nama_pemilik" id="nama_pemilik" value="<?php echo $verifikasi->nama_pemilik; ?>" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">No KTP Pemilik / Penanggung Jawab</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->no_ktp_pemilik ?>" type="text" name="no_ktp_pemilik" id="no_ktp_pemilik" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">NPWP</label>
    <div class="col-sm-6"><input readonly="" type="text" name="npwp" id="npwp" value="<?php echo $verifikasi->npwp; ?>" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Bidang Usaha</label>
    <div class="col-sm-6">
        <select readonly="" style="height: 200px;" multiple="" name="id_bidang_siujk[]" id="id_bidang_siujk[]" class="form-control input-sm">
            <?php if($bidang_siujk): foreach($bidang_siujk as $r_bidang_siujk): ?>
                <option <?php echo (in_array($r_bidang_siujk->id_bidang_siujk, explode('|', $verifikasi->id_bidang_siujk))) ? 'selected=""' : '' ;  ?> value="<?php echo $r_bidang_siujk->id_bidang_siujk; ?>"><?php echo $r_bidang_siujk->nama_bidang_siujk; ?></option>
            <?php endforeach; endif; ?>
        </select>
        <p class="help-block">Tekan tahan tombol ctrl untuk melakukan multi select</p>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Berlaku</label>
    <div class="col-sm-6"><input readonly="" type="date" name="tanggal_berlaku" id="tanggal_berlaku" value="<?php echo $verifikasi->tanggal_terbit ?>" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Berakhir</label>
    <div class="col-sm-6"><input readonly="" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" value="<?php echo $verifikasi->tanggal_perpanjangan ?>" class="form-control input-sm"></div>
</div>

