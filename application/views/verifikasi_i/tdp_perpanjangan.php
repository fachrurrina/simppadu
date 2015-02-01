
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
            <th>Nama Perusahaan</th>
            <th>Bentuk Perusahaan</th>
            <th>Nama Pemilik</th>
            <th>Tanggal Terbit</th>
            <th>Tanggal Perpanjangan</th>
            <th>Pembaharuan Ke</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no_sk = $verifikasi->tdp_perpanjangan_no_sk; 
        $data = $this->m_tdp->get_where_no_sk($no_sk);

       
        ?>
        <tr>
            <td><?php echo $data->no_sk; ?></td>
            <td><?php echo $data->nama_perusahaan; ?></td>
            <td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
            <td><?php echo $data->nama_pemilik; ?></td>
            <td><?php echo $data->tanggal_terbit; ?></td>
            <td><?php echo $data->tanggal_perpanjangan; ?></td>
            <td><?php echo $data->pembaharuan_ke; ?></td>
        </tr>
    </tbody>
</table>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Sekaligus perubahan?</label>
    <div class="col-sm-1" style="padding-top: 3px;">
            
        <label>
            <input <?php echo ($verifikasi->tdp_perpanjangan_status_perubahan == 1) ? 'checked=""' : '' ; ?> disabled="" type="checkbox" value="1" name="tdp_perpanjangan_status_perubahan" class="tdp_perpanjangan_status_perubahan" id="tdp_perpanjangan_status_perubahan"/> 
        </label>
        
    </div>
</div>

<?php if($verifikasi->tdp_perpanjangan_status_perubahan == 1): ?>

<div class="form-group" id="alasan_penerbitan" >
    <label for="inputEmail3" class="col-sm-2 control-label">Perubahan tentang ?</label>
    <div class="col-sm-2" style="padding-top: 3px;">
            
        <label>
            <input <?php echo ($verifikasi->tdp_perpanjangan_alasan_penerbitan == 'PL') ? 'checked=""' : '' ; ?> disabled="" type="radio" name="tdp_perpanjangan_alasan_penerbitan" value="PL" id="tdp_perpanjangan_alasan_penerbitan"  /> 
            Perubahan Lain-lain
        </label>
        
    </div>
    <div class="col-sm-2" style="padding-top: 3px;">
            
        <label>
            <input <?php echo ($verifikasi->tdp_perpanjangan_alasan_penerbitan == 'PS') ? 'checked=""' : '' ; ?> disabled="" type="radio" name="tdp_perpanjangan_alasan_penerbitan" value="PS" id="tdp_perpanjangan_alasan_penerbitan"  /> 
            Perubahan Status 
        </label>
        
    </div>
</div>

<?php endif; ?>


