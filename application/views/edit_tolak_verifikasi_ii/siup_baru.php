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

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-6">
        <input value="<?php echo $edit->nama_perusahaan; ?>" type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control input-sm">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bentuk Perusahaan</label>
    <div class="col-sm-3">
        <select class="form-control input-sm" name="id_bentuk_perusahaan" id="id_bentuk_perusahaan">
            <option></option>
            <?php if($bentuk_perusahaan): foreach($bentuk_perusahaan as $r_bentuk_perusahaan): ?>
                <option <?php echo ($edit->id_bentuk_perusahaan == $r_bentuk_perusahaan->id_bentuk_perusahaan) ? 'selected=""' : '' ; ?> value="<?php echo $r_bentuk_perusahaan->id_bentuk_perusahaan ?>"><?php echo $r_bentuk_perusahaan->nama_bentuk_perusahaan ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Perusahaan</label>
    <div class="col-sm-6"><textarea name="alamat_perusahaan" id="alamat_perusahaan" class="form-control input-sm"><?php echo $edit->alamat_perusahaan ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Perusahaan</label>
    <div class="col-sm-4">
        <select name="id_kec_perusahaan" id="id_kec_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($edit->id_kec_perusahaan == $r_kec->id_kec) ? 'selected=""' : ''; ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
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
        <select name="id_kel_perusahaan" id="id_kel_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($edit->id_kel_perusahaan == $r_kel->id_kel) ? 'selected=""' : ''; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nama Pemilik</label>
    <div class="col-sm-6"><input value="<?php echo $edit->nama_pemilik; ?>" type="text" name="nama_pemilik" id="nama_penanggung_jawab" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">No KTP Pemilik</label>
    <div class="col-sm-6"><input value="<?php echo $edit->no_ktp_pemilik; ?>" type="text" name="no_ktp_pemilik" id="no_ktp_pemilik" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Jabatan Pemilik</label>
    <div class="col-sm-6"><input value="<?php echo $edit->jabatan_pemilik; ?>" type="text" name="jabatan_pemilik" id="jabatan_pemilik" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Pemilik</label>
    <div class="col-sm-6"><textarea name="alamat_pemilik" id="alamat_pemilik" class="form-control input-sm"><?php echo $edit->alamat_pemilik ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemilik</label>
    <div class="col-sm-4">
        <select name="id_kec_pemilik" id="id_kec_pemilik" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($edit->id_kec_pemilik == $r_kec->id_kec) ? 'selected=""' : ''; ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
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
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($edit->id_kel_pemilik == $r_kel->id_kel) ? 'selected=""' : ''; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>




 <div class="form-group">
    <label for="" class="col-sm-2 control-label">No Telepon</label>
    <div class="col-sm-6"><input value="<?php echo $edit->no_telp ?>" type="text" name="no_telp" id="no_telp"  class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">No Fax</label>
    <div class="col-sm-6"><input value="<?php echo $edit->no_fax ?>" type="text" name="no_fax" id="no_fax" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Modal dan Kekayaan bersih perusahaan (tidak termasuk yanah dan banguanan) dalam Rp. (Rupiah)</label>
    <div class="col-sm-3"><input value="<?php echo $edit->modal_perusahaan ?>" type="number" name="modal_perusahaan" id="modal_perusahaan" value="" class="form-control input-sm"></div>

    <script type="text/javascript">
        $('#modal_perusahaan').change(function(){
            $('#ket_status_modal').val(get_status_modal_perusahaan($(this).val()));
        });
    </script>
    <div class="col-sm-1"><input value="<?php echo get_status_modal_perusahaan($edit->modal_perusahaan) ?>" readonly="" type="text" class="form-control input-sm" name="ket_status_modal" id="ket_status_modal"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Jumlah Penyerapan Tenaga Kerja</label>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">A. S1</label>
    <div class="col-sm-2">
        <input value="<?php echo $edit->tenaga_kerja_a ?>" type="number" name="tenaga_kerja_a" id="tenaga_kerja_a" class="form-control input-sm">
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">B. D3</label>
    <div class="col-sm-2">
        <input value="<?php echo $edit->tenaga_kerja_b ?>" type="number" name="tenaga_kerja_b" id="tenaga_kerja_b" class="form-control input-sm">
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">C. SMA</label>
    <div class="col-sm-2">
        <input value="<?php echo $edit->tenaga_kerja_c ?>" type="number" name="tenaga_kerja_c" id="tenaga_kerja_c" class="form-control input-sm">
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">D. SMP</label>
    <div class="col-sm-2">
        <input value="<?php echo $edit->tenaga_kerja_d ?>" type="number" name="tenaga_kerja_d" id="tenaga_kerja_d" class="form-control input-sm">
    </div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Kelembagaan</label>
    <div class="col-sm-5">
        
        <select name="id_kelembagaan" id="id_kelembagaan" class="form-control input-sm">
            <option></option>
            <?php if($kelembagaan_siup): foreach($kelembagaan_siup as $kelembagaan_siup): ?>
                <option <?php echo ($edit->id_kelembagaan == $kelembagaan_siup->id_kelembagaan) ? 'selected=""' : ''; ?> value="<?php echo $kelembagaan_siup->id_kelembagaan ?>"><?php echo $kelembagaan_siup->kelembagaan ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Kode KBLI</label>
    <div class="col-sm-10">
        <ul>
            <?php  
            $array_kbli_4 = explode('|', $edit->id_kbli);
            ?>
            <?php if($array_kbli_4): foreach($array_kbli_4 as $kbli_4): ?>
                <li class="control-label" style="text-align: left;"><?php echo $kbli_4; ?> : <?php echo $this->m_kbli->get_judul_kbli($kbli_4); ?></li>
            <?php endforeach; endif; ?>
        </ul>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Barang / Jasa Dagangan Utama</label>
    <div class="col-sm-6"><textarea name="barang_jasa_dagangan_utama" id="barang_jasa_dagangan_utama" class="form-control input-sm"><?php echo $edit->barang_jasa_dagangan_utama ?></textarea></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal terbit</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $edit->tanggal_terbit ?>" type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal berlaku</label>
    <div class="col-sm-6"><input readonly="" value="<?php echo $edit->tanggal_perpanjangan ?>" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" class="form-control input-sm"></div>
</div>