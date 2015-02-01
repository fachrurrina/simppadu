<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->siuakb_baru_nama_perusahaan ?>" type="text" class="form-control input-sm" name="siuakb_baru_nama_perusahaan" id="siuakb_baru_nama_perusahaan" />
    </div>
</div>



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik / Penanggung Jawab</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->siuakb_baru_nama_pemilik ?>" type="text" class="form-control input-sm" name="siuakb_baru_nama_pemilik" id="siuakb_baru_nama_pemilik" />
    </div>
</div>

<div class="form-group" style="margin-bottom: 0">
    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Usaha</label>

    <div class="col-sm-5">
        <input value="<?php echo $edit->siuakb_baru_jenis_usaha ?>" type="text" class="form-control input-sm" id="siuakb_baru_jenis_usaha" name="siuakb_baru_jenis_usaha" />
    </div>
    
</div>

<br />



<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelengkapan Syarat</label>
    <div class="col-sm-10">
        <?php $array_id_syarat = explode('|', $edit->id_syarat);?>
        <?php if($syarat): foreach ($syarat as $r_syarat): ?>
            <label>
                <input <?php echo (in_array($r_syarat->id_syarat, $array_id_syarat)) ? 'checked=""' : '' ; ?> type="checkbox" name="id_syarat[]" value="<?php echo $r_syarat->id_syarat; ?>" id="id_syarat[]" /> <?php echo $r_syarat->nama_syarat; ?>
            </label>
            <br />
            
        <?php endforeach; endif; ?>
    </div>
</div>

