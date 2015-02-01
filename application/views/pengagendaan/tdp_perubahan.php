
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK Lalu</label>
    <div class="col-sm-3">
        <input value="<?php echo $data_lalu->no_sk; /* ini adalah no sk lalu */ ?>" readonly="" type="text" class="form-control input-sm" name="no_sk_lalu"  id="no_sk_lalu"  />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK Baru</label>
    <div class="col-sm-3">
        <input type="text" class="form-control input-sm" name="no_sk"  id="no_sk"  />
    </div>

</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Alasan Penerbitan</label>
    <div class="col-sm-2" style="padding-top: 3px;">
        <label>
            <input disabled="" <?php echo ($fo->tdp_perubahan_alasan_penerbitan == 'PL') ? 'checked=""' : '' ; ?> type="radio" name="alasan_penerbitan" value="PL" id="tdp_perpanjangan_status_perubahan" checked="" /> 
            Perubahan Lain-lain (PL)
        </label>
    </div>
    <div class="col-sm-2" style="padding-top: 3px;">
        <label>
            <input disabled="" <?php echo ($fo->tdp_perubahan_alasan_penerbitan == 'PS') ? 'checked=""' : '' ; ?> type="radio" name="alasan_penerbitan" value="PB" id="tdp_perpanjangan_status_perubahan"  /> 
            Perubahan Status (PB)
        </label>
    </div>
    
</div>




<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Penerbitan</label>
    <div class="col-sm-3">
        <input value="" type="date" class="form-control input-sm" name="tanggal_terbit"  id="tanggal_terbit" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Perpanjangan</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $data_lalu->tanggal_perpanjangan ?>" type="date" class="form-control input-sm" name="tanggal_perpanjangan"  id="tanggal_perpanjangan" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">KBLI</label>
    <div class="col-sm-10">
        <select class="form-control input-sm" name="id_kbli"  id="id_kbli" multiple="" style="height: 300px;">
        	<?php if($kbli_5): foreach($kbli_5 as $r_kbli_5): ?>
				<option <?php echo ($data_lalu->id_kbli == $r_kbli_5->id_kbli) ? 'selected=""' : '' ; ?> value="<?php echo $r_kbli_5->id_kbli ?>"><?php echo $r_kbli_5->id_kbli. ' : ' .$r_kbli_5->judul_kbli; ?></option>
    		<?php endforeach; endif; ?>
        </select>
        <p class="help-block">Jika tidak merubah KBLI, biarkan saja</p>
    </div>
</div>
