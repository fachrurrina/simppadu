

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Front Office
            <small>Penetapan <?php echo $this->m_modul->get_nama_modul($penetapan->id_modul) ?></small>
        </h1>
        
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    
                 
                    <div class="panel-body">

                        <?php echo validation_errors('<p>', '</p>'); ?>
                        <form class="form-horizontal" role="form" method="post" id="form_penetapan">
                            <div id="form-utama">

                                
                                <?php echo $form_penetapan_tambahan; ?>
                                
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->


