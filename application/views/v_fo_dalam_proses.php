<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Front Office
            <small>Dalam Proses</small>
        </h1>
        
    </section>

    <!-- Main content -->
    <section class="content">

        

        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    
                 

                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li><a href="<?php echo site_url('c_fo/daftar_1'); ?>">Input Penerimaan</a></li>
                            <li><a href="<?php echo base_url('c_fo/tertunda'); ?>">Tertunda</a></li>
                            <li><a href="<?php echo site_url('c_fo/tolak'); ?>">Tolak</a></li>
                            <li class="active"><a href="<?php echo site_url('c_fo/dalam_proses'); ?>">Dalam Proses</a></li>
                            <li><a href="<?php echo site_url('c_fo/selesai'); ?>">Selesai</a></li>
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
                                    <th>Tahapan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($dalam_proses): foreach ($dalam_proses as $r_dalam_proses): ?>
                                <tr>
                                    
                                    <td><?php echo $r_dalam_proses->no_daftar; ?></td>
                                    <td><?php echo $r_dalam_proses->tanggal_daftar; ?></td>
                                    <td><?php echo $r_dalam_proses->nama_pemohon; ?></td>
                                    <td><?php echo $this->m_sub_modul->get_nama_sub_modul($r_dalam_proses->id_sub_modul); ?></td>
                                    <td>
                                        <?php 
                                        $tahapan = array(
                                            2 =>   'Verifikasi I',
                                            4 =>   'Penetapan',
                                            5 =>   'Penetapan (Belum Lunas)',
                                            6 =>   'Pengagendaan',
                                            7 =>   'Operator',
                                            9 =>   'Ditolak Verifikasi II',
                                            8 =>   'Verifkasi II',
                                            10 =>  'Cetak (Belum)'
                                        ); 
                                        
                                        echo $tahapan[$r_dalam_proses->status_proses];
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->

