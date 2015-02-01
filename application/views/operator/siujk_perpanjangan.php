<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Daftar</label>
    <div class="col-sm-3">
        <input value="<?php echo $fo->no_daftar; ?>" readonly="" type="text" class="form-control input-sm" name="no_daftar" id="no_daftar" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK Lalu</label>
    <div class="col-sm-3">
        <input value="<?php echo $data_lalu->no_sk; ?>" readonly="" type="text" class="form-control input-sm" name="no_sk_lalu" id="no_sk_lalu" />
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-3">
        <input value="<?php echo $data_baru->no_sk; ?>" readonly="" type="text" class="form-control input-sm" name="no_sk" id="no_sk" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-6"><input value="<?php echo $data_lalu->nama_perusahaan; ?>" type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Kualifikasi</label>
    <div class="col-sm-6"><input value="<?php echo $data_lalu->kualifikasi; ?>" type="text" name="kualifikasi" id="kualifikasi" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Perusahaan</label>
    <div class="col-sm-6"><textarea name="alamat_perusahaan" id="alamat_perusahaan" class="form-control input-sm"><?php echo $data_lalu->alamat_perusahaan; ?></textarea></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">RT</label>
    <div class="col-sm-6"><input  value="<?php echo $data_lalu->rt_perusahaan ?>" type="text" name="rt_perusahaan" id="rt" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">RW</label>
    <div class="col-sm-6"><input  value="<?php echo $data_lalu->rw_perusahaan ?>" type="text" name="rw_perusahaan" id="rw" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan</label>
    <div class="col-sm-4">
        <select name="id_kec_perusahaan" id="id_kec_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($data_lalu->id_kec_perusahaan == $r_kec->id_kec) ? 'selected=""' : '' ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
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
    <label for="inputEmail3" class="col-sm-2 control-label">Gampong</label>
    <div class="col-sm-4">
        <select name="id_kel_perusahaan" id="id_kel_perusahaan" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($data_lalu->id_kel_perusahaan == $r_kel->id_kel) ? 'selected=""' : '' ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Kode Pos</label>
    <div class="col-sm-6"><input  value="<?php echo $data_lalu->kode_pos ?>"  type="text" name="kode_pos" id="kode_pos" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">No Telepon</label>
    <div class="col-sm-6"><input  value="<?php echo $data_lalu->no_telp ?>"  type="text" name="no_telp" id="no_telp" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">No Fax</label>
    <div class="col-sm-6"><input  value="<?php echo $data_lalu->no_fax ?>" type="text" name="no_fax" id="no_fax" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Nama Pemilik / Penanggung Jawab</label>
    <div class="col-sm-6"><input value="<?php echo $data_lalu->nama_pemilik ?>" type="text" name="nama_pemilik" id="nama_pemilik" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">No KTP Pemilik / Penanggung Jawab</label>
    <div class="col-sm-6"><input value="<?php echo $data_lalu->no_ktp_pemilik ?>" type="text" name="no_ktp_pemilik" id="no_ktp_pemilik" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">NPWP</label>
    <div class="col-sm-6"><input value="<?php echo $data_lalu->npwp; ?>" type="text" name="npwp" id="npwp" class="form-control input-sm"></div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Bidang Usaha</label>
    <div class="col-sm-6">
        <select style="height: 200px;" multiple="" name="id_bidang_siujk[]" id="id_bidang_siujk[]" class="form-control input-sm">

            <?php if($bidang_siujk): foreach($bidang_siujk as $r_bidang_siujk): ?>
                <option <?php echo (in_array($r_bidang_siujk->id_bidang_siujk, explode('|', $data_lalu->id_bidang_siujk))) ? 'selected=""' : '' ?> value="<?php echo $r_bidang_siujk->id_bidang_siujk; ?>"><?php echo $r_bidang_siujk->nama_bidang_siujk; ?></option>
            <?php endforeach; endif; ?>

        </select>
        <p class="help-block">Tekan tahan tombol ctrl untuk melakukan multi select</p>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal terbit</label>
    <div class="col-sm-6"><input value="<?php echo $data_baru->tanggal_terbit ?>" readonly="" type="date" name="tanggal_terbit" id="tanggal_terbit" value="" class="form-control input-sm"></div>
</div>
<div class="form-group">
    <label for="" class="col-sm-2 control-label">Tanggal berlaku</label>
    <div class="col-sm-6"><input value="<?php echo $data_baru->tanggal_perpanjangan ?>" readonly="" type="date" name="tanggal_perpanjangan" id="tanggal_perpanjangan" value="" class="form-control input-sm"></div>
</div>


<?php
// if($fo->siujk_perpanjangan_status_perubahan == 0){
    ?>
        <script type="text/javascript">
            // $("#form_operator :input").attr("readonly", true);
        </script>
    <?php
// }
?>