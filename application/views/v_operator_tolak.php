
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Operator
            <small>Di Tolak Verifikasi II</small>
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
                            <li><a href="<?php echo site_url('c_operator/belum'); ?>">Belum</a></li>
                            <li class="active"><a href="<?php echo site_url('c_operator/tolak'); ?>">Ditolak</a></li>
                            <li><a href="<?php echo site_url('c_operator/sudah'); ?>">Sudah</a></li>
                            
                        </ul>
                    </div>

                    <div class="panel-body">

                        <table class="table table-striped table-condensed datatable">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No Berkas</th>
                                    <th>Tanggal Berkas</th>
                                    <th>Nama Pemohon</th>
                                    <th>Izin</th>
                                    <th>No SK</th>
                                    <th>Alasan Ditolak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($tolak): foreach ($tolak as $r_tolak): ?>
                                <tr>
                                    <td>
                                        <form action="" method="post">
                                            <a href="<?php echo site_url('c_operator/edit_tolak/'. $r_tolak->no_daftar); ?>"  class="btn btn-primary btn-xs">Edit</a>
                                        </form>
                                    </td>
                                    <td><?php echo $r_tolak->no_daftar; ?></td>
                                    <td><?php echo $r_tolak->tanggal_daftar; ?></td>
                                    <td><?php echo $r_tolak->nama_pemohon; ?></td>
                                    <td><?php echo $nama_sub_modul = $this->m_sub_modul->get_nama_sub_modul($r_tolak->id_sub_modul); ?></td>
                                    <td>
                                        <?php 
                                        $nama_model = 'm_'.explode('_', $nama_sub_modul)[0];
                                        echo $this->$nama_model->get_no_sk_where_no_daftar($r_tolak->no_daftar); 
                                        ?>
                                    </td>
                                    <td><?php echo $r_tolak->pesan_tolak_v_ii; ?></td>
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

