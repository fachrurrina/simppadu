
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




<table class="table table-striped table-condensed" id="table_data">
    <thead>
        <tr>
            <th>No SK</th>
            <th>Nama Optik</th>
            <th>Nama Pemilik</th>
            <th>Tanggal Terbit</th>
            <th>Tanggal Perpanjangan</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no_sk = $verifikasi->sipo_perpanjangan_no_sk; 
        $data = $this->m_sipo->get_where_no_sk($no_sk);

       
        ?>
        <tr>
            <td><?php echo $data->no_sk; ?></td>
            <td><?php echo $data->nama_optik; ?></td>
            <td><?php echo $data->nama_pemilik; ?></td>
            <td><?php echo $data->tanggal_terbit; ?></td>
            <td><?php echo $data->tanggal_perpanjangan; ?></td>
        </tr>
    </tbody>
</table>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Sekaligus perubahan?</label>
    <div class="col-sm-1" style="padding-top: 3px;">
            
        <label>
            <input disabled="" <?php echo ($verifikasi->sipo_perpanjangan_status_perubahan == 1) ? 'checked=""' : ''; ?> type="checkbox" value="1" name="sipo_perpanjangan_status_perubahan" class="sipo_perpanjangan_status_perubahan" id="sipo_perpanjangan_status_perubahan"/> 
        </label>
        
    </div>
</div>

