

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Perusahaan / Perorangan</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->sipi_baru_nama ?>" type="text" class="form-control input-sm" name="sipi_baru_nama" id="sipi_baru_nama" />
        <label style="padding-top: 10px;">

            <input type="checkbox" id="samakan_nama"> Samakan dengan Nama Pemohon.
            <script type="text/javascript">
            $('#samakan_nama').click(function(){
                if($(this).is(':checked')){
                    var nama_pemohon = $('#nama_pemohon').val();
                    console.log(nama_pemohon);
                    $('#sipi_baru_nama').val(nama_pemohon);
                }else{
                    $('#sipi_baru_nama').val('');
                }
            });
            </script>
        </label>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Kapal</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->sipi_baru_nama_kapal ?>" type="text" class="form-control input-sm" name="sipi_baru_nama_kapal" id="sipi_baru_nama_kapal" />
    </div>
</div>



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