<div class="container">
        <div class="col-md-6">
            <h2 class="">Form Edit Data</h2>
            <form action="" class="form-horizontal" method="POST">
            <input type="hidden" name="id" class="form-control" value="<?= $tahun['id'];?>">
                <div class="form-group">
                    <label for="">Tahun</label>
                    <input type="text" name="year" placeholder="Masukkan Kategori" class="form-control" value="<?= $tahun['year'];?>">
                    <small><span class="text-danger"><?=form_error('year');?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <input type="text" name="description" placeholder="Masukkan Deskripsi" class="form-control" value="<?= $tahun['description'];?>">
                    <small><span class="text-danger"><?=form_error('description');?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <ul style="list-style: none">
                        <li><input type="radio" name="is_active" value="1" <?php echo ($tahun['is_active'] == 1) ? 'checked="checked"' : ""; ?> >Aktif</li>
                        <li><input type="radio" name="is_active" value="0" <?php echo ($tahun['is_active'] == 0) ? 'checked="checked"' : ""; ?> >Tidak Aktif</li>
                    </ul>
                    <small><span class="text-danger"><?=form_error('is_active');?></span></small>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Edit Data</button>
                <a href="<?=base_url('tahun');?>" class="btn btn-success mb-2">Kembali</a>
            </form>
        </div>
    </div>