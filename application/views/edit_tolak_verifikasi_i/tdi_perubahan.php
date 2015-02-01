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
        <input value="<?php echo $edit->tdi_perubahan_no_sk; ?>" type="text" class="form-control input-sm" name="keyword_no_sk" id="keyword_no_sk" />
    </div>
    <div class="col-sm-3">
        <a class="btn btn-default btn-xs" id="cari" class="cari">Cari</a>
    </div>
</div>

<script type="text/javascript">
    $('#cari').click(function(){
        var keyword_no_sk = $('#keyword_no_sk').val();
        $.get("<?php echo site_url('c_ajax/load_data_tdi_perubahan'); ?>", {
            no_sk : keyword_no_sk
        }, function(data){
            console.log(data);
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
            
        </tr>
    </thead>
    <tbody>
        <?php 
        $no_sk = $edit->tdi_perubahan_no_sk; 
        $data = $this->m_tdi->get_where_no_sk($no_sk);
        ?>
        <tr>
            <input type="hidden" name="tdi_perubahan_no_sk" id="tdi_perubahan_no_sk" value="<?php echo $edit->tdi_perubahan_no_sk; ?>">
            <td><?php echo $data->no_sk; ?></td>
            <td><?php echo $data->nama_perusahaan; ?></td>
            <td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
            <td><?php echo $data->nama_pemilik; ?></td>
            <td><?php echo $data->tanggal_terbit; ?></td>
            
        </tr>
    </tbody>
</table>



