<div class="container">
        <div class="col-md-6">
            <h2 class="">Form Tambah Data</h2>
            <form action="<?= base_url('rekening/tambah');?>" class="form-horizontal" method="POST">
                <div class="form-group">
                    <label for="">Nama Rekening</label>
                    <input type="text" name="name" placeholder="Masukkan Nama Rekening" class="form-control">
                    <small><span class="text-danger"><?=form_error('name');?></span></small>
                </div>
                <div class="form-group">
                    <label for="">No Akun</label>
                    <select class="form-control" name="id_chartofaccount" id="id_chartofaccount">
                        <option value="" selected="" disabled="">- Select No Akun -</option>
                        <?php foreach ($akun as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>"><?= "K-".$value['kode']." - ".$value['nama'] ?></option>
                        <?php } ?>
                    </select>
                    <small><span class="text-danger"><?=form_error('description');?></span></small>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Tambah Data</button>
                <a href="<?=base_url('rekening');?>" class="btn btn-success mb-2">Kembali</a>
            </form>
        </div>
    </div>