



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik / Penanggung Jawab</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->siot_baru_nama_pemilik ?>" type="text" class="form-control input-sm" name="siot_baru_nama_pemilik" id="siot_baru_nama_pemilik" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Rumah Sakit</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->siot_baru_nama_rumah_sakit ?>" type="text" class="form-control input-sm" name="siot_baru_nama_rumah_sakit" id="siot_baru_nama_rumah_sakit" />
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

