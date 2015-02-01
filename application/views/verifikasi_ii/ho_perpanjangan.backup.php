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

<hr />

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Surat Permohonan</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->tanggal_permohonan ?>" type="date" name="tanggal_permohonan" id="tanggal_permohonan" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Direktur / Penanggung Jawab</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->nama_pemilik; ?>" type="text" class="form-control input-sm" name="nama_pemilik" id="nama_pemilik" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin Pemilik</label>
    <div class="col-sm-2" style="padding-top: 3px;">
            
        <label>
            <input readonly="" checked="" type="radio" name="jenis_kelamin_pemilik" value="1" id="jenis_kelamin_pemilik"  /> 
            Laki-laki
        </label>

        <label>
            <input readonly="" type="radio" name="jenis_kelamin_pemilik" value="0" id="jenis_kelamin_pemilik"  /> 
            Perempuan
        </label>
        
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Pekerjaan Pemilik</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->pekerjaan_pemilik ?>" type="text" class="form-control input-sm" name="pekerjaan_pemilik" id="pekerjaan_pemilik" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Pemilik</label>
    <div class="col-sm-6"><textarea readonly="" name="alamat_pemilik" id="alamat_pemilik" class="form-control input-sm"><?php echo $verifikasi->alamat_pemilik; ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemilik</label>
    <div class="col-sm-4">
        <select readonly="" name="id_kec_pemilik" id="id_kec_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($verifikasi->id_kec_pemilik == $r_kec->id_kec) ? 'selected=""' : ''; ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
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
                <option <?php echo ($verifikasi->id_kel_pemilik == $r_kel->id_kel) ? 'selected=""' : ''; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>


<hr />



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->nama_perusahaan; ?>" type="text" class="form-control input-sm" name="nama_perusahaan" id="nama_perusahaan" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bentuk Perusahaan</label>
    <div class="col-sm-3">
        <select readonly="" class="form-control input-sm" name="id_bentuk_perusahaan" id="id_bentuk_perusahaan">
            <option></option>
            <?php if($bentuk_perusahaan): foreach($bentuk_perusahaan as $r_bentuk_perusahaan): ?>
                <option <?php echo ($verifikasi->id_bentuk_perusahaan == $r_bentuk_perusahaan->id_bentuk_perusahaan) ? 'selected=""' : ''; ?> value="<?php echo $r_bentuk_perusahaan->id_bentuk_perusahaan ?>"><?php echo $r_bentuk_perusahaan->nama_bentuk_perusahaan ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bidang Usaha</label>
    <div class="col-sm-7">
        <select readonly="" class="form-control input-sm" name="id_bidang_ho" id="id_bidang_ho" >
            <option></option>
            <?php if($bidang_ho): foreach($bidang_ho as $r_bidang_ho): ?>
                <option <?php echo ($verifikasi->id_bidang_ho == $r_bidang_ho->id_bidang_ho) ? 'selected=""' : ''; ?> value="<?php echo $r_bidang_ho->id_bidang_ho ?>"><?php echo $r_bidang_ho->nama_bidang_ho ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Perusahaan</label>
    <div class="col-sm-6"><textarea readonly="" name="alamat_perusahaan" id="alamat_perusahaan" class="form-control input-sm"><?php echo $verifikasi->alamat_perusahaan; ?></textarea></div>
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_kec_perusahaan').change(function(){

            var id_kec_perusahaan = $('#id_kec_perusahaan').val();

            console.log(id_kec_perusahaan);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + id_kec_perusahaan,
                success: function(data) {

                    $('#id_kel_perusahaan').html(data);
                    
                }
            });
        });
    });
</script>

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


<hr />

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">NPWPD / NPWRD</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->npwpd_npwrd ?>" type="text" class="form-control input-sm" name="npwpd_npwrd" id="npwpd_npwrd" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Luas Tempat Usaha (p x l)</label>
    <div class="col-sm-2">
        <input readonly="" value="<?php echo $verifikasi->panjang_tempat_usaha ?>" type="number" class="form-control input-sm" name="panjang_tempat_usaha" id="panjang_tempat_usaha" />
    </div>

    <div class="col-sm-2">
        <input readonly="" value="<?php echo $verifikasi->lebar_tempat_usaha ?>" type="number" class="form-control input-sm" name="lebar_tempat_usaha" id="lebar_tempat_usaha" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Status Kepemilikan Tanah</label>
    <div class="col-sm-3">
        <select readonly="" class="form-control input-sm" name="status_kepemilikan_tanah" id="status_kepemilikan_tanah">
            <option value="Hak Pakai">Hak Pakai</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Batas Utara</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->batas_utara ?>" type="text" class="form-control input-sm" name="batas_utara" id="batas_utara" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Batas Selatan</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->batas_selatan ?>" type="text" class="form-control input-sm" name="batas_selatan" id="batas_selatan" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Batas Barat</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->batas_barat ?>" type="text" class="form-control input-sm" name="batas_barat" id="batas_barat" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Batas Timur</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->batas_timur ?>" type="text" class="form-control input-sm" name="batas_timur" id="batas_timur" />
    </div>
</div>

<input type="hidden" name="kode_index_luas" id="kode_index_luas" value="<?php echo $verifikasi->kode_index_luas ?>">
<input type="hidden" name="kode_index_gangguan" id="kode_index_gangguan" value="<?php echo $verifikasi->kode_index_gangguan ?>">
<input type="hidden" name="kode_index_lokasi" id="kode_index_lokasi" value="<?php echo $verifikasi->kode_index_lokasi ?>">
<input type="hidden" name="kode_index_harga_dasar" id="kode_index_harga_dasar" value="<?php echo $verifikasi->kode_index_harga_dasar ?>">

<input type="hidden" name="nilai_retribusi" id="nilai_retribusi" value="<?php echo $verifikasi->nilai_retribusi ?>">

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Mesin Penggerak</label>
    <div class="col-sm-6">
        <input readonly="" value="<?php echo $verifikasi->mesin_penggerak ?>" type="text" class="form-control input-sm" name="mesin_penggerak" id="mesin_penggerak" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bahan Bakar Mesin Penggerak</label>
    <div class="col-sm-3">
        <select readonly="" class="form-control input-sm" name="bahan_bakar" id="bahan_bakar">
            <option <?php echo ($verifikasi->bahan_bakar == 'Bensin') ? 'selected=""' : ''; ?> value="Bensin">Bensin</option>
            <option <?php echo ($verifikasi->bahan_bakar == 'Solar') ? 'selected=""' : ''; ?> value="Solar">Solar</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Pembangkit Listrik</label>
    <div class="col-sm-6">
        <input readonly="" value="<?php echo $verifikasi->pembangkit_listrik ?>" type="text" class="form-control input-sm" name="pembangkit_listrik" id="pembangkit_listrik" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Surat Keterangan Usaha</label>
    <div class="col-sm-4">
        <input readonly="" value="<?php echo $verifikasi->no_surat_ket_usaha ?>" type="text" class="form-control input-sm" name="no_surat_ket_usaha" id="no_surat_ket_usaha" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal Surat Keterangan Usaha</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->tanggal_surat_ket_usaha ?>" type="date" name="tanggal_surat_ket_usaha" id="tanggal_surat_ket_usaha" class="form-control input-sm"></div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal peninjauan lapangan</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->tanggal_peninjauan_lapangan ?>" type="date" name="tanggal_peninjauan_lapangan" id="tanggal_peninjauan_lapangan" class="form-control input-sm"></div>
</div>



<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal terbit</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->tanggal_terbit ?>" type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal daftar ulang</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->tanggal_daftar_ulang ?>" type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal berlaku</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $verifikasi->tanggal_perpanjangan ?>" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" class="form-control input-sm"></div>
</div>
