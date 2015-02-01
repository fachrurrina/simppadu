<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Kapal</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->sipk_baru_nama_kapal ?>" type="text" class="form-control input-sm" name="sipk_baru_nama_kapal" id="sipk_baru_nama_kapal" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemilik / Penanggung Jawab</label>
    <div class="col-sm-3">
        <input value="<?php echo $edit->sipk_baru_nama_pemilik ?>" type="text" class="form-control input-sm" name="sipk_baru_nama_pemilik" id="sipk_baru_nama_pemilik" />
        <label style="padding-top: 10px;">

            <input type="checkbox" id="samakan_nama"> Samakan dengan Nama Pemohon.
            <script type="text/javascript">
            $('#samakan_nama').click(function(){
                if($(this).is(':checked')){
                    var nama_pemohon = $('#nama_pemohon').val();
                    console.log(nama_pemohon);
                    $('#sipk_baru_nama_pemilik').val(nama_pemohon);
                }else{
                    $('#sipk_baru_nama_pemilik').val('');
                }
            });
            </script>
        </label>
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


