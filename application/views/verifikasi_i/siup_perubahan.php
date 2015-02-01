
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
        </tr>
    </thead>
    <tbody>
        <?php 
        $no_sk = $verifikasi->siup_perubahan_no_sk; 
        $data = $this->m_siup->get_where_no_sk($no_sk);

       
        ?>
        <tr>
            <td><?php echo $data->no_sk; ?></td>
            <td><?php echo $data->nama_perusahaan; ?></td>
            <td><?php echo $this->m_bentuk_perusahaan->get_singkatan_bentuk_perusahaan($data->id_bentuk_perusahaan); ?></td>
            <td><?php echo $data->nama_pemilik; ?></td>
            <td><?php echo $data->tanggal_terbit; ?></td>
            <td><?php echo $data->tanggal_perpanjangan; ?></td>
        </tr>
    </tbody>
</table>



<div class="form-group" id="alasan_penerbitan" >
    <label for="inputEmail3" class="col-sm-2 control-label">Perubahan tentang ?</label>
    <div class="col-sm-2" style="padding-top: 3px;">
            
        <label>
            <input readonly="" <?php echo ($verifikasi->siup_perubahan_alasan_penerbitan == 'PL') ? 'checked=""' : ''; ?> type="radio" name="siup_perubahan_alasan_penerbitan" value="PL" id="siup_perubahan_alasan_penerbitan"  /> 
            Perubahan Lain-lain
        </label>
        
    </div>
    <div class="col-sm-2" style="padding-top: 3px;">
            
        <label>
            <input readonly="" <?php echo ($verifikasi->siup_perubahan_alasan_penerbitan == 'PS') ? 'checked=""' : ''; ?> type="radio" name="siup_perubahan_alasan_penerbitan" value="PS" id="siup_perubahan_alasan_penerbitan"  /> 
            Perubahan Status 
        </label>
        
    </div>
</div>


