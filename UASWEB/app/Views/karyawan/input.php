<?php
echo $this->extend('template/index');
echo $this->section('content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title_card; ?></h3>
            </div>
            <!-- /.card-header -->

            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <?php if(validation_errors()){
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>  
                            <?php echo validation_list_errors() ?>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if(session()->getFlashdata('error')){
                        ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-warning"></i> Error</h5>  
                                <?php echo session()->getFlashdata('error'); ?>
                            </div>
                        <?php
                    }
                    ?>

                    <?php echo csrf_field() ?>
                    <?php 
                        if (current_url(true)->getSegment(2) == 'edit') {
                            ?>
                            <input type="hidden" name="param" id="param" value="<?php echo $edit_data ['idkaryawan']; ?>">
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <label for="idkaryawan">Idkaryawan</label>
                        <input type="text" name="idkaryawan" id="idkaryawan" value="<?php echo empty(set_value('idkaryawan')) ? (empty($edit_data['kdasrama']) ? "":$edit_data['kdasrama']) : set_value('kdasrama') ; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="namakaryawan">Nama_karyawan</label>
                        <input type="text" name="namakaryawan" id="namakaryawan" value="<?php echo empty(set_value('namakaryawan')) ? (empty($edit_data['namaasrama']) ? "":$edit_data['namaasrama']) : set_value('namaasrama') ; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="bagian">Bagian</label>
                        <input type="bagian" name="bagian" id="bagian" class="form-control">
                    </div>    
                    <div class="form-group">
                        <label for="notelp">Notelp</label>
                        <input type="notelp" name="notelp" id="notelp" class="form-control">
                    </div>                               
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>        
    </div>
</div>
<?php
echo $this->endSection();
