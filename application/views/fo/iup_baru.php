
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan / Perorangan</label>
    <div class="col-sm-3">
        <input type="text" class="form-control input-sm" name="iup_baru_nama_perusahaan" id="iup_baru_nama_perusahaan" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Penanggung jawab</label>
    <div class="col-sm-3">
        <input type="text" class="form-control input-sm" name="iup_baru_nama_penanggung_jawab" id="iup_baru_nama_penanggung_jawab" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Kelengkapan Syarat</label>
    <div class="col-sm-10">
        <?php if($syarat): foreach ($syarat as $r_syarat): ?>
            <label>
                <input type="checkbox" name="id_syarat[]" value="<?php echo $r_syarat->id_syarat; ?>" id="id_syarat[]" /> <?php echo $r_syarat->nama_syarat; ?>
            </label>
            <br />
            
        <?php endforeach; endif; ?>
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        <a href="<?php echo site_url('c_fo') ?>" class="btn btn-default btn-sm">Kembali</a>
        <input type="submit" class="btn btn-primary btn-sm" value="Simpan" name="simpan">
    </div>
</div>