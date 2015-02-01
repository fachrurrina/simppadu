<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->no_daftar; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Urut TDP</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->no_urut; ?>" readonly="" type="text" class="form-control input-sm" name="no_urut" id="no_urut" />
    </div>
</div>

<div class="form-group">    
    <label for="inputEmail3" class="col-sm-2 control-label">No SK Lalu</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->no_sk_lalu; ?>" readonly="" type="text" class="form-control input-sm" name="no_sk_lalu" id="no_sk_lalu" />
    </div>
</div>

<div class="form-group">    
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->no_sk; ?>" readonly="" type="text" class="form-control input-sm" name="no_sk" id="no_sk" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-3">
        <input value="<?php echo $verifikasi->nama_perusahaan; ?>" readonly="" type="text" class="form-control input-sm" name="nama_perusahaan" id="nama_perusahaan" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bentuk Perusahaan</label>
    <div class="col-sm-3">
        <select readonly="" class="form-control input-sm" name="id_bentuk_perusahaan" id="id_bentuk_perusahaan">
        <?php if($bentuk_perusahaan): foreach($bentuk_perusahaan as $r_bentuk_perusahaan): ?>
        	<option <?php echo ($verifikasi->id_bentuk_perusahaan == $r_bentuk_perusahaan->id_bentuk_perusahaan) ? 'selected=""' : '' ; ?> value="<?php echo $r_bentuk_perusahaan->id_bentuk_perusahaan ?>"><?php echo $r_bentuk_perusahaan->nama_bentuk_perusahaan ?></option>
    	<?php endforeach; endif; ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Status Perusahaan</label>
    <div class="col-sm-3">
        <select readonly="" class="form-control input-sm" name="status_perusahaan" id="status_perusahaan" >
        	<option <?php echo ($verifikasi->status_perusahaan == "Kantor Pusat") ? 'selected=""' : '' ; ?> value="Kantor Pusat">Kantor Pusat</option>
        	<option <?php echo ($verifikasi->status_perusahaan == "Kantor Cabang") ? 'selected=""' : '' ; ?> value="Kantor Cabang">Kantor Cabang</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Perusahaan</label>
    <div class="col-sm-6">
        <textarea readonly="" name="alamat_perusahaan" id="alamat_perusahaan" cols="30" rows="2" class="form-control input-sm"><?php echo $verifikasi->alamat_perusahaan;  ?></textarea>
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Perusahaan</label>
    <div class="col-sm-3">
        <select readonly="" class="form-control input-sm" name="id_kec_perusahaan" id="id_kec_perusahaan">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($verifikasi->id_kec_perusahaan == $r_kec->id_kec) ? 'selected=""' : '' ; ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo trim($r_kec->nm_kec); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Gampong / Kelurahan Perusahaan</label>
    <div class="col-sm-4">
        <select readonly="" name="id_kel_perusahaan" id="id_kel_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($verifikasi->id_kel_perusahaan == $r_kel->id_kel) ? 'selected=""' : '' ; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo trim($r_kel->nm_kel); ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nilai Investasi / Modal Perusahaan (Rp.)</label>
    <div class="col-sm-3"><input value="<?php echo $verifikasi->nilai_investasi; ?>" readonly="" type="number" step="50000" name="nilai_investasi" id="nilai_investasi"  class="form-control input-sm"></div>
    <script type="text/javascript">
        $('#nilai_investasi').change(function(){
            $('#ket_status_modal').val(get_status_modal_perusahaan($(this).val()));
        });
    </script>
    <div class="col-sm-1"><input value="<?php echo get_status_modal_perusahaan($verifikasi->nilai_investasi); ?>" readonly="" type="text" class="form-control input-sm" name="ket_status_modal" id="ket_status_modal"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nama Pemilik / Penanggung Jawab</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->nama_pemilik ?>" type="text" name="nama_pemilik" id="nama_pemilik" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">No KTP Penanggung Jawab</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->no_ktp_pemilik ?>" type="text" name="no_ktp_pemilik" id="no_ktp_pemilik"  class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">No Telepon</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->no_telp ?>" type="text" name="no_telp" id="no_telp" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">No Fax</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->no_fax ?>" type="text" name="no_fax" id="no_fax" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">NPWP</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->npwp ?>" type="text" name="npwp" id="npwp" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">No Akte Notaris</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->no_akte_notaris ?>" type="text" name="no_akte_notaris" id="no_akte_notaris" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">KBLI</label>
    <div class="col-sm-9">
        <div class="col-sm-10">
        <ul>
            <li class="control-label" style="text-align: left;"><?php echo $verifikasi->id_kbli; ?> : <?php echo $this->m_kbli->get_judul_kbli($verifikasi->id_kbli); ?></li>
        </ul>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Terbit</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->tanggal_terbit; ?>" type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Perpanjangan</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->tanggal_perpanjangan; ?>" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" class="form-control input-sm"></div>
</div>



