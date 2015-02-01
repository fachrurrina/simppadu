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
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-5">
        <input type="text" class="form-control input-sm" name="keyword_no_sk" id="keyword_no_sk" />
    </div>
    <div class="col-sm-3">
        <a class="btn btn-default btn-xs" id="cari" class="cari">Cari</a>
    </div>
</div>

<script type="text/javascript">
    $('#cari').click(function(){
        var keyword_no_sk = $('#keyword_no_sk').val();
        $.get("<?php echo site_url('c_ajax/load_data_tdp_perubahan'); ?>", {
            no_sk : keyword_no_sk
        }, function(data){
            $('#table_data > tbody').html(data);
        });
    });
</script>



<table class="table table-striped table-condensed" id="table_data">
    <thead>
        <tr>
            <th>No SK</th>
            <th>Nama Perusahaan</th>
            <th>Bentuk Perusahaan</th>
            <th>Nama Pemilik</th>
            <th>Tanggal Terbit</th>
            <th>Tanggal Perpanjangan</th>
        </tr>
    </thead>
    <tbody>
        <!-- <tr>
            <td>Lorem.</td>
            <td>Repellendus!</td>
            <td>In.</td>
            <td>Hic.</td>
            <td>Atque!</td>
        </tr> -->
    </tbody>
</table>


<div class="form-group" id="alasan_penerbitan" >
    <label for="inputEmail3" class="col-sm-2 control-label">Perubahan tentang ?</label>
    <div class="col-sm-2" style="padding-top: 3px;">
            
        <label>
            <input type="radio" name="tdp_perubahan_alasan_penerbitan" value="PL" id="tdp_perubahan_alasan_penerbitan" checked="" /> 
            Perubahan Lain-lain
        </label>
        
    </div>
    <div class="col-sm-2" style="padding-top: 3px;">
            
        <label>
            <input type="radio" name="tdp_perubahan_alasan_penerbitan" value="PS" id="tdp_perubahan_alasan_penerbitan"  /> 
            Perubahan Status 
        </label>
        
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        <a href="<?php echo site_url('c_fo') ?>" class="btn btn-default btn-sm">Kembali</a>
        <input type="submit" class="btn btn-primary btn-sm" value="Simpan" name="simpan">
    </div>
</div>

