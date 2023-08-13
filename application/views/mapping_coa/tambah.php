<div class="container">
        <div class="col-md-6">
            <h2 class="">Form Tambah Data</h2>
            <form action="<?= base_url('mapping_coa/tambah');?>" class="form-horizontal" method="POST">
                <div class="form-group">
                    <label for="">Kode Akun</label>
                    <select class="form-control" name="id_coa" id="id_coa">
                        <option value="" selected="" disabled="">- Select Kode Akun -</option>
                        <?php foreach ($akun as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= "K-".$value['kode']." - ".$value['nama'] ?></option>
                        <?php } ?>
                    </select>
                    <small><span class="text-danger"><?=form_error('id_coa');?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Mapping Kode Akun 1</label>
                    <select class="form-control" name="id_coa_1" id="id_coa_1">
                        <option value="" selected="" disabled="">- Select Mapping Kode Akun 1 -</option>
                        <?php foreach ($akun as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= "K-".$value['kode']." - ".$value['nama'] ?></option>
                        <?php } ?>
                    </select>
                    <small><span class="text-danger"><?=form_error('id_coa_1');?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Mapping Kode Akun 2</label>
                    <select class="form-control" name="id_coa_2" id="id_coa_2">
                        <option value="" selected="" disabled="">- Select Mapping Kode Akun 2 -</option>
                        <?php foreach ($akun as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= "K-".$value['kode']." - ".$value['nama'] ?></option>
                        <?php } ?>
                    </select>
                    <small><span class="text-danger"><?=form_error('id_coa_2');?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Mapping Kode Akun 3</label>
                    <select class="form-control" name="id_coa_3" id="id_coa_3">
                        <option value="" selected="" disabled="">- Select Mapping Kode Akun 3 -</option>
                        <?php foreach ($akun as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= "K-".$value['kode']." - ".$value['nama'] ?></option>
                        <?php } ?>
                    </select>
                    <small><span class="text-danger"><?=form_error('id_coa_3');?></span></small>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Tambah Data</button>
                <a href="<?=base_url('mapping_coa');?>" class="btn btn-success mb-2">Kembali</a>
            </form>
        </div>
    </div>