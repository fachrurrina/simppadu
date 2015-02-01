
<?php if($fo->tdp_perpanjangan_status_perubahan == 1): ?>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Alasan Penerbitan</label>
        <div class="col-sm-2" style="padding-top: 3px;">
            <label>
                <input <?php echo ($fo->tdp_perpanjangan_alasan_penerbitan == 'PL') ? 'checked=""' : ''; ?> disabled="" type="radio" name="alasan_penerbitan" value="PL" id="$tdp_perpanjangan_status_perubahan" /> 
                Perubahan Lain-lain (PL)
            </label>
        </div>
        <div class="col-sm-2" style="padding-top: 3px;">
            <label>
                <input <?php echo ($fo->tdp_perpanjangan_alasan_penerbitan == 'PS') ? 'checked=""' : ''; ?> disabled="" type="radio" name="alasan_penerbitan" value="PS" id="$tdp_perpanjangan_status_perubahan"  /> 
                Perubahan Status (PS)
            </label>
        </div>
        <p style="padding-top: 3px;" class="help-block"><i>Note: Pilihan ini muncul karena Permohonan Perpanjangan disertai dengan Perubahan</i></p>
    </div>
<?php else: ?>
    <input value="PL" type="hidden" name="alasan_penerbitan" id="alasan_penerbitan">
<?php endif; ?>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK Lalu</label>
    <div class="col-sm-3">
        <input value="<?php echo $fo->tdp_perpanjangan_no_sk; /* ini adalah no sk lalu */ ?>" readonly="" type="text" class="form-control input-sm" name="no_sk_lalu"  id="no_sk_lalu"  />
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No SK Baru</label>
    <div class="col-sm-3">
        <input value="" type="text" class="form-control input-sm" name="no_sk"  id="no_sk"  />
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
    <div class="col-sm-10">
        

        
        <select 
        <?php  
        /**
         * jika $tdp_perpanjangan_status_perubahan == 0, maka kbli tidak boleh di edit (disabled)
         * jika $tdp_perpanjangan_status_perubahan == 1, maka kbli boleh di edit
         */
        if($fo->tdp_perpanjangan_status_perubahan == 0){
            echo '';
        }elseif($fo->tdp_perpanjangan_status_perubahan == 1){
            if($fo->tdp_perpanjangan_alasan_penerbitan == 'PS'){
                echo '';
            }
        }
        ?>   


        class="form-control input-sm" name="id_kbli"  id="id_kbli" multiple="" style="height: 300px;">
            <?php if($kbli_5): foreach($kbli_5 as $r_kbli_5): ?>
                <option <?php echo ($data_lalu->id_kbli == $r_kbli_5->id_kbli) ? 'selected=""' : '' ; ?> value="<?php echo $r_kbli_5->id_kbli ?>"><?php echo $r_kbli_5->id_kbli. ' : ' .$r_kbli_5->judul_kbli; ?></option>
            <?php endforeach; endif; ?>
        </select>

    </div>

</div>
