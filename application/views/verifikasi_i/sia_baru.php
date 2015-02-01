



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik / Penanggung Jawab</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->sia_baru_nama_pemilik ?>" type="text" class="form-control input-sm" name="sia_baru_nama_pemilik" id="sia_baru_nama_pemilik" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Apotik</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->sia_baru_nama_apotik ?>" type="text" class="form-control input-sm" name="sia_baru_nama_apotik" id="sia_baru_nama_apotik" />
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

