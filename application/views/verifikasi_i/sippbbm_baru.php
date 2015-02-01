<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Pekerjaan Pemohon</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->sippbbm_baru_pekerjaan_pemohon ?>" type="text" class="form-control input-sm" name="sippbbm_baru_pekerjaan_pemohon" id="sippbbm_baru_pekerjaan_pemohon" />
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Alamat Pemohon</label>
    <div class="col-sm-6"><textarea readonly="" name="sippbbm_baru_alamat_pemohon" id="sippbbm_baru_alamat_pemohon" class="form-control input-sm"><?php echo $verifikasi->sippbbm_baru_alamat_pemohon ?></textarea></div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kecamatan Pemohon</label>
    <div class="col-sm-4">
        <select readonly="" name="sippbbm_baru_id_kec_pemohon" id="sippbbm_baru_id_kec_pemohon" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kec as $r_kec): ?>
                <option <?php echo ($verifikasi->sippbbm_baru_id_kec_pemohon == $r_kec->id_kec) ? 'selected=""' : '' ?> value="<?php echo $r_kec->id_kec; ?>"><?php echo $r_kec->nm_kec; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#sippbbm_baru_id_kec_pemohon').change(function(){

            var sippbbm_baru_id_kec_pemohon = $('#sippbbm_baru_id_kec_pemohon').val();

            console.log(sippbbm_baru_id_kec_pemohon);

            $.ajax({
                url: '<?php echo site_url("c_ajax/load_combo_kel") ?>/' + sippbbm_baru_id_kec_pemohon,
                success: function(data) {

                    $('#sippbbm_baru_id_kel_pemohon').html(data);
                    
                }
            });
        });
    });
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelurahan Pemohon</label>
    <div class="col-sm-4">
        <select readonly="" name="sippbbm_baru_id_kel_pemohon" id="sippbbm_baru_id_kel_pemohon" class="form-control input-sm">
            <option value=""></option>
            <?php foreach ($kel as $r_kel): ?>
                <option <?php echo ($verifikasi->sippbbm_baru_id_kel_pemohon == $r_kel->id_kel) ? 'selected=""' : '' ?> value="<?php echo $r_kel->id_kel; ?>"><?php echo $r_kel->nm_kel; ?></option>
            <?php endforeach; ?>
        </select>
        <p class="help-block">Jika ada kecamatan atau gampong yang belum tersedia, silahkan hubungi administrator untuk menambahkan</p>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->sippbbm_baru_nama_perusahaan ?>" type="text" class="form-control input-sm" name="sippbbm_baru_nama_perusahaan" id="sippbbm_baru_nama_perusahaan" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik / Penanggung Jawab</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->sippbbm_baru_nama_pemilik ?>" type="text" class="form-control input-sm" name="sippbbm_baru_nama_pemilik" id="sippbbm_baru_nama_pemilik" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelengkapan Syarat</label>
    <div class="col-sm-10">
        <?php $array_id_syarat = explode('|', $verifikasi->id_syarat);?>
        <?php if($syarat): foreach ($syarat as $r_syarat): ?>
            <label>
                <input disabled="" <?php echo (in_array($r_syarat->id_syarat, $array_id_syarat)) ? 'checked=""' : '' ; ?> type="checkbox" name="id_syarat[]" value="<?php echo $r_syarat->id_syarat; ?>" id="id_syarat[]" /> <?php echo $r_syarat->nama_syarat; ?>
            </label>
            <br />
            
        <?php endforeach; endif; ?>
    </div>
</div>

