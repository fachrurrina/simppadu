<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->no_daftar; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Daftar</label>
    <div class="col-sm-2"><input readonly="" value="<?php echo $edit->tanggal_daftar ?>" type="date" name="tanggal_daftar" id="tanggal_daftar" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $edit->no_sk; ?>" type="text" class="form-control input-sm" name="no_sk" id="no_sk" />
    </div>
</div>

<hr />

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nama Perusahaan / Perorangan Indonesia</label>
    <div class="col-sm-6"><input value="<?php echo $edit->nama; ?>" type="text" name="nama" id="nama" class="form-control input-sm"></div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat </label>
    <div class="col-sm-6"><textarea name="alamat" id="alamat" class="form-control input-sm"><?php echo $edit->alamat; ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan </label>
    <div class="col-sm-4">
        <select name="id_kec" id="id_kec" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($edit->id_kec == $r_kec->id_kec) ? 'selected=""' : ''; ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_kec').change(function(){

            var id_kec = $('#id_kec').val();

            console.log(id_kec);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + id_kec,
                success: function(data) {

                    $('#id_kel').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Gampong</label>
    <div class="col-sm-4">
        <select name="id_kel" id="id_kel" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($edit->id_kel == $r_kel->id_kel) ? 'selected=""' : ''; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>







<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No KTP</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->no_ktp ?>" type="text" class="form-control input-sm" name="no_ktp" id="no_ktp" />
    </div>
</div>

<hr />



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Kapal</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->nama_kapal ?>" type="text" class="form-control input-sm" name="nama_kapal" id="nama_kapal" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tempat & No Registrasi/No Gross Akte</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->tempat_reg_kapal ?>" type="text" class="form-control input-sm" name="tempat_reg_kapal" id="tempat_reg_kapal" />
    </div>
    <div class="col-sm-3">
        <input value="<?php echo $edit->no_reg_kapal ?>" type="text" class="form-control input-sm" name="no_reg_kapal" id="no_reg_kapal" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tempat & Tanda Gelar</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->tempat_gelar_kapal ?>" type="text" class="form-control input-sm" name="tempat_gelar_kapal" id="tempat_gelar_kapal" />
    </div>
    <div class="col-sm-3">
        <input value="<?php echo $edit->tanda_gelar_kapal ?>" type="text" class="form-control input-sm" name="tanda_gelar_kapal" id="tanda_gelar_kapal" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Panggilan Kapal</label>
    <div class="col-sm-5">
        <input value="<?php echo $edit->nama_panggilan_kapal ?>" type="text" class="form-control input-sm" name="nama_panggilan_kapal" id="nama_panggilan_kapal" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Asal Kapal</label>
    <div class="col-sm-5">
        <input value="<?php echo $edit->asal_kapal ?>" type="text" class="form-control input-sm" name="asal_kapal" id="asal_kapal" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Negara Asal Kapal</label>
    <div class="col-sm-5">
        <input value="<?php echo $edit->negara_asal_kapal ?>" type="text" class="form-control input-sm" name="negara_asal_kapal" id="negara_asal_kapal" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tempat Pembuatan Kapal</label>
    <div class="col-sm-5">
        <input value="<?php echo $edit->tempat_pembuatan_kapal ?>" type="text" class="form-control input-sm" name="tempat_pembuatan_kapal" id="tempat_pembuatan_kapal" />
    </div>
</div>


<hr />


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kapal</label>
    <div class="col-sm-5">
        <input value="<?php echo $edit->jenis_kapal ?>" type="text" class="form-control input-sm" name="jenis_kapal" id="jenis_kapal" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Alat Tangkap</label>
    <div class="col-sm-5">
        <select readonly="" class="form-control input-sm" name="id_jenis_alat_tangkap" id="id_jenis_alat_tangkap" >
            <option></option>
            <?php if($jenis_alat_tangkap): foreach($jenis_alat_tangkap as $r_jenis_alat_tangkap): ?>
                <option <?php echo ($edit->id_jenis_alat_tangkap == $r_jenis_alat_tangkap->id_jenis_alat_tangkap) ? 'selected=""' : ''; ?> value="<?php echo $r_jenis_alat_tangkap->id_jenis_alat_tangkap ?>"><?php echo $r_jenis_alat_tangkap->nama_jenis_alat_tangkap ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>


<hr />

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tonase Kotor</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->tonase_kotor ?>" type="text" class="form-control input-sm" name="tonase_kotor" id="tonase_kotor" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tonase Bersih</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->tonase_bersih ?>" type="text" class="form-control input-sm" name="tonase_bersih" id="tonase_bersih" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kekuatan Mesin</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->kekuatan_mesin ?>" type="text" class="form-control input-sm" name="kekuatan_mesin" id="kekuatan_mesin" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Merek Mesin</label>
    <div class="col-sm-5">
        <input value="<?php echo $edit->merek_mesin ?>" type="text" class="form-control input-sm" name="merek_mesin" id="merek_mesin" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Seri Mesin</label>
    <div class="col-sm-5">
        <input value="<?php echo $edit->no_seri_mesin ?>" type="text" class="form-control input-sm" name="no_seri_mesin" id="no_seri_mesin" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bahan Kasco</label>
    <div class="col-sm-5">
        <input value="<?php echo $edit->bahan_kasco ?>" type="text" class="form-control input-sm" name="bahan_kasco" id="bahan_kasco" />
    </div>
</div>

<hr />




<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Surat Izin Usaha Perikanan (IUP)</label>
    <div class="col-sm-5">
        <input value="<?php $edit->no_iup ?>" type="text" class="form-control input-sm" name="no_iup" id="no_iup" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal IUP</label>
    <div class="col-sm-5">
        <input value="<?php echo $edit->tanggal_iup ?>" type="date" class="form-control input-sm" name="tanggal_iup" id="tanggal_iup" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Permohonan IUP</label>
    <div class="col-sm-5">
        <input value="<?php echo $edit->no_permohonan_iup ?>" type="text" class="form-control input-sm" name="no_permohonan_iup" id="no_permohonan_iup" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Permohonan IUP</label>
    <div class="col-sm-5">
        <input value="<?php echo $edit->tanggal_permohonan_iup ?>" type="date" class="form-control input-sm" name="tanggal_permohonan_iup" id="tanggal_permohonan_iup" />
    </div>
</div>

<hr />

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Daerah Penangkapan </label>
    <div class="col-sm-6"><textarea name="daerah_penangkapan" id="daerah_penangkapan" class="form-control input-sm"><?php echo $edit->daerah_penangkapan ?></textarea></div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Daerah Penangkapan Terlarang</label>
    <div class="col-sm-6"><textarea name="daerah_terlarang" id="daerah_terlarang" class="form-control input-sm"><?php echo $edit->daerah_terlarang ?></textarea></div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Pelabuhan Penangkalan</label>
    <div class="col-sm-6"><textarea name="pelabuhan_penangkalan" id="pelabuhan_penangkalan" class="form-control input-sm"><?php echo $edit->pelabuhan_penangkalan ?></textarea></div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Anak Buah Kapal</label>
    <div class="col-sm-5">
        <input value="<?php echo $edit->anak_buah_kapal ?>" type="number" class="form-control input-sm" name="anak_buah_kapal" id="anak_buah_kapal" />
    </div>
</div>

<input type="hidden" name="nilai_retribusi" id="nilai_retribusi" value="<?php echo $edit->nilai_retribusi ?>">




<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal peninjauan lapangan</label>
    <div class="col-sm-6"><input readonly="<?php $edit->tanggal_peninjauan_lapangan ?>" value="<?php echo $edit->tanggal_peninjauan_lapangan ?>" type="date" name="tanggal_peninjauan_lapangan" id="tanggal_peninjauan_lapangan" class="form-control input-sm"></div>
</div>




<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal terbit</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $edit->tanggal_terbit ?>" type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal berlaku</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $edit->tanggal_perpanjangan ?>" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" class="form-control input-sm"></div>
</div>
