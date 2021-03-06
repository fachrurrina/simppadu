<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $edit->no_daftar; ?>"  type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
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
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik</label>
    <div class="col-sm-3">
        <input  value="<?php echo $edit->nama_pemilik; ?>" type="text" class="form-control input-sm" name="nama_pemilik" id="nama_pemilik" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-3">
        <input  value="<?php echo $edit->nama_perusahaan; ?>" type="text" class="form-control input-sm" name="nama_perusahaan" id="nama_perusahaan" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Bentuk Perusahaan</label>
    <div class="col-sm-3">
        <select  class="form-control input-sm" name="id_bentuk_perusahaan" id="id_bentuk_perusahaan">
            <option></option>
            <?php if($bentuk_perusahaan): foreach($bentuk_perusahaan as $r_bentuk_perusahaan): ?>
                <option <?php echo ($edit->id_bentuk_perusahaan == $r_bentuk_perusahaan->id_bentuk_perusahaan) ? 'selected=""' : ''; ?> value="<?php echo $r_bentuk_perusahaan->id_bentuk_perusahaan ?>"><?php echo $r_bentuk_perusahaan->nama_bentuk_perusahaan ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>



<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Perusahaan</label>
    <div class="col-sm-6"><textarea  name="alamat_perusahaan" id="alamat_perusahaan" class="form-control input-sm"><?php echo $edit->alamat_perusahaan ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Perusahaan</label>
    <div class="col-sm-4">
        <select  name="id_kec_perusahaan" id="id_kec_perusahaan" class="form-control input-sm">
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
        <select  name="id_kel_perusahaan" id="id_kel_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($edit->id_kel_perusahaan == $r_kel->id_kel) ? 'selected=""' : ''; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Limbah</label>
    <div class="col-sm-5">
        <input  value="<?php echo $edit->jenis_limbah ?>" type="text" class="form-control input-sm" name="jenis_limbah" id="jenis_limbah" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Ton</label>
    <div class="col-sm-3">
        <input  value="<?php echo $edit->jumlah_ton ?>" type="number" class="form-control input-sm" name="jumlah_ton" id="jumlah_ton" />
    </div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Lokasi Penyimpanan</label>
    <div class="col-sm-6"><textarea  name="alamat_penyimpanan" id="alamat_penyimpanan" class="form-control input-sm"><?php echo $edit->alamat_penyimpanan ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Lokasi Penyimpanan</label>
    <div class="col-sm-4">
        <select  name="id_kec_penyimpanan" id="id_kec_penyimpanan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($edit->id_kec_penyimpanan == $r_kec->id_kec) ? 'selected=""' : ''; ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_kec_penyimpanan').change(function(){

            var id_kec_penyimpanan = $('#id_kec_penyimpanan').val();

            console.log(id_kec_penyimpanan);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + id_kec_penyimpanan,
                success: function(data) {

                    $('#id_kel_penyimpanan').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Lokasi Penyimpanan</label>
    <div class="col-sm-4">
        <select  name="id_kel_penyimpanan" id="id_kel_penyimpanan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($edit->id_kel_penyimpanan == $r_kel->id_kel) ? 'selected=""' : ''; ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Maksud Penyimpanan</label>
    <div class="col-sm-4"><input  value="<?php echo $edit->maksud_penyimpanan ?>" type="text" name="maksud_penyimpanan" id="maksud_penyimpanan" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Waktu Keberangkatan</label>
    <div class="col-sm-4"><input  value="<?php echo $edit->waktu_keberangkatan ?>" type="date" name="waktu_keberangkatan" id="waktu_keberangkatan" class="form-control input-sm"></div>
</div>

<hr />

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Dipindahkan Haknya/Dijual Kepada</label>
    <div class="col-sm-4"><input  value="<?php echo $edit->dipindahkan_kepada ?>" type="text" name="dipindahkan_kepada" id="dipindahkan_kepada" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-6"><textarea  name="alamat_pindah" id="alamat_pindah" class="form-control input-sm"><?php echo $edit->alamat_pindah ?></textarea></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Jumlah Ton/Kg Saat Ini</label>
    <div class="col-sm-2"><input  value="<?php echo $edit->jumlah_ton_pindah ?>" type="number" name="jumlah_ton_pindah" id="jumlah_ton_pindah" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Kendaraan Angkutan</label>
    <div class="col-sm-4"><input  value="<?php echo $edit->kendaraan_angkutan ?>" type="text" name="kendaraan_angkutan" id="kendaraan_angkutan" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nopol Kendaraan Angkutan</label>
    <div class="col-sm-4"><input  value="<?php echo $edit->nopol_kendaraan ?>" type="text" name="nopol_kendaraan" id="nopol_kendaraan" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Lokasi Penyimpanan</label>
    <div class="col-sm-6"><textarea  name="lokasi_penyimpanan_pindah" id="lokasi_penyimpanan_pindah" class="form-control input-sm"><?php echo $edit->lokasi_penyimpanan_pindah ?></textarea></div>
</div>


<div class="form-group">
    <label for="" class="col-sm-2 control-label">Maksud Penyimpanan</label>
    <div class="col-sm-4"><input  value="<?php echo $edit->maksud_penyimpanan_pindah ?>" type="text" name="maksud_penyimpanan_pindah" id="maksud_penyimpanan_pindah" class="form-control input-sm"></div>
</div>

<hr />

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Keterangan Barang</label>
    
</div>

<?php foreach(explode('|', $edit->keterangan_barang) as $keterangan_barang): ?>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label"></label>
        <div class="col-sm-4"><input  value="<?php echo $keterangan_barang ?>" type="text" name="keterangan_barang[]" id="keterangan_barang[]" class="form-control input-sm"></div>
    </div>
<?php endforeach; ?>
