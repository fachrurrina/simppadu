
<div class="container">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Penerimaan Berkas</h4>
            </div>
         

            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li><a href="<?php echo site_url('c_fo/daftar_1'); ?>">Input Penerimaan</a></li>
                    <li><a href="<?php echo base_url('c_fo/tertunda'); ?>">Tertunda</a></li>
                    <li><a href="<?php echo site_url('c_fo/tolak'); ?>">Tolak</a></li>
                    <li><a href="<?php echo site_url('c_fo/dalam_proses'); ?>">Dalam Proses</a></li>
                    <li class="active"><a href="<?php echo site_url('c_fo/selesai'); ?>">Selesai</a></li>
                </ul>
            </div>

            <div class="panel-body">



                <table class="table table-striped table-condensed datatable">
                    <thead>
                        <tr>
                            
                            <th>No Berkas</th>
                            <th>Tanggal Berkas</th>
                            <th>Nama Pemohon</th>
                            <th>Izin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($selesai): foreach ($selesai as $r_selesai): ?>
                        <tr>
                            
                            <td><?php echo $r_selesai->no_daftar; ?></td>
                            <td><?php echo $r_selesai->tanggal_daftar; ?></td>
                            <td><?php echo $r_selesai->nama_pemohon; ?></td>
                            <td><?php echo $this->m_sub_modul->get_nama_sub_modul($r_selesai->id_sub_modul); ?></td>
                            
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
