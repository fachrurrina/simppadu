




<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan / Perorangan</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->sipi_baru_nama ?>" type="text" class="form-control input-sm" name="sipi_baru_nama" id="sipi_baru_nama" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Kapal</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $verifikasi->sipi_baru_nama_kapal ?>" type="text" class="form-control input-sm" name="sipi_baru_nama_kapal" id="sipi_baru_nama_kapal" />
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

