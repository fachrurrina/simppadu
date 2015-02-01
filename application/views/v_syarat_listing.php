
<div class="container">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Master Syarat (Listing)</h4>
            </div>
         

            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="<?php echo site_url('c_syarat/listing'); ?>">Listing</a></li>
                    <li><a href="<?php echo site_url('c_syarat/tambah'); ?>">Tambah</a></li>
                </ul>
            </div>

            <div class="panel-body">

                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Modul</th>
                            <th>Sub Modul</th>
                            <th>Nama Syarat</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($syarat): foreach ($syarat as $r_syarat): ?>
                        <tr>
                            <td>
                                <form action="" method="post">
                                    
                                    <a href="<?php echo site_url('c_syarat/edit/'. $r_syarat->id_syarat); ?>" class="btn btn-primary btn-xs">Edit</a>
                                    <a href="<?php echo site_url('c_syarat/hapus/'. $r_syarat->id_syarat); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin ingin menghapus data syarat ini ? ');">Hapus</a>
                                    
                                </form>
                                
                            </td>
                            <td><?php echo $this->m_modul->get_nama_modul($r_syarat->id_modul); ?></td>
                            <td><?php echo $this->m_sub_modul->get_nama_sub_modul($r_syarat->id_sub_modul); ?></td>
                            <td><?php echo $r_syarat->nama_syarat; ?></td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="6">Belum ada data</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
