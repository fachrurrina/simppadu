
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK</label>
    <div class="col-sm-3">
        <input type="text" class="form-control input-sm" name="no_sk"  id="no_sk"  />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Penerbitan</label>
    <div class="col-sm-3">
        <input type="date" class="form-control input-sm" name="tanggal_terbit"  id="tanggal_terbit" />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Perpanjangan</label>
    <div class="col-sm-3">
        <input type="date" class="form-control input-sm" name="tanggal_perpanjangan"  id="tanggal_perpanjangan" />
    </div>
</div>


<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">KBLI</label>
    <div class="col-sm-9">
        <select class="form-control input-sm" name="id_kbli"  id="id_kbli" multiple="" style="height: 200px;">
        	<?php if($kbli_5): foreach($kbli_5 as $r_kbli_5): ?>
				<option value="<?php echo $r_kbli_5->id_kbli ?>"><?php echo $r_kbli_5->id_kbli .' : '.$r_kbli_5->judul_kbli; ?></option>
    		<?php endforeach; endif; ?>
        </select>
    </div>
</div>

