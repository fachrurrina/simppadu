

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK Lalu</label>
    <div class="col-sm-3">
        <input readonly="" value="<?php echo $fo->tdi_perubahan_no_sk; ?>" type="text" class="form-control input-sm" name="no_sk_lalu"  id="no_sk_lalu"  />
    </div>
</div>

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
    <label for="inputEmail3" class="col-sm-2 control-label">KBLI</label>
    <div class="col-sm-6">
        <select class="form-control input-sm" name="id_kbli[]"  id="id_kbli[]" multiple="" style="height: 200px;">
        <?php 
        $arrray_id_kbli = explode('|', $data_lalu->id_kbli);
        ?>
            <?php if($kbli_5): foreach($kbli_5 as $r_kbli_5): ?>
                <option <?php echo (in_array($r_kbli_5->id_kbli, $arrray_id_kbli)) ? 'selected=""' : '' ?> value="<?php echo $r_kbli_5->id_kbli ?>"><?php echo $r_kbli_5->id_kbli .' : '.$r_kbli_5->judul_kbli; ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>



