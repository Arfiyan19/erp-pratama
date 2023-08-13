<div class="container">
        <div class="col-md-6">
            <h2 class="">Form Edit Data</h2>
            <form action="" class="form-horizontal" method="POST">
            <input type="hidden" name="id" class="form-control" value="<?= $mapping_coa['id'];?>">
                <div class="form-group">
                    <label for="">Kode Akun</label>
                    <select class="form-control" name="id_coa" id="id_coa">
                        <?php foreach ($akun as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>" <?php echo ($value['id'] == $mapping_coa['id_coa']) ? "selected" : ""; ?> ><?= "K-".$value['kode']." - ".$value['nama'] ?></option>
                        <?php } ?>
                    </select>
                    <small><span class="text-danger"><?=form_error('id_coa');?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Mapping Kode Akun 1</label>
                    <select class="form-control" name="id_coa_1" id="id_coa_1">
                        <?php foreach ($akun as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>" <?php echo ($value['id'] == $mapping_coa['id_coa_1']) ? "selected" : ""; ?> ><?= "K-".$value['kode']." - ".$value['nama'] ?></option>
                        <?php } ?>
                    </select>
                    <small><span class="text-danger"><?=form_error('id_coa_1');?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Mapping Kode Akun 2</label>
                    <select class="form-control" name="id_coa_2" id="id_coa_2">
                        <?php foreach ($akun as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>" <?php echo ($value['id'] == $mapping_coa['id_coa_2']) ? "selected" : ""; ?> ><?= "K-".$value['kode']." - ".$value['nama'] ?></option>
                        <?php } ?>
                    </select>
                    <small><span class="text-danger"><?=form_error('id_coa_2');?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Mapping Kode Akun 3</label>
                    <select class="form-control" name="id_coa_3" id="id_coa_3">
                        <?php foreach ($akun as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>" <?php echo ($value['id'] == $mapping_coa['id_coa_3']) ? "selected" : ""; ?> ><?= "K-".$value['kode']." - ".$value['nama'] ?></option>
                        <?php } ?>
                    </select>
                    <small><span class="text-danger"><?=form_error('id_coa_3');?></span></small>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Edit Data</button>
                <a href="<?=base_url('mapping_coa');?>" class="btn btn-success mb-2">Kembali</a>
            </form>
        </div>
    </div>