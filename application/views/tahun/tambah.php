<div class="container">
        <div class="col-md-6">
            <h2 class="">Form Tambah Data</h2>
            <form action="<?= base_url('tahun/tambah');?>" class="form-horizontal" method="POST">
                <div class="form-group">
                    <label for="">Tahun</label>
                    <input type="number" name="year" placeholder="Masukkan Tahun" class="form-control">
                    <small><span class="text-danger"><?=form_error('year');?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <input type="text" name="description" placeholder="Masukkan Deskripsi" class="form-control">
                    <small><span class="text-danger"><?=form_error('description');?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <ul style="list-style: none">
                        <li><input type="radio" name="is_active" value="1" checked="checked">Aktif</li>
                        <li><input type="radio" name="is_active" value="0">Tidak Aktif</li>
                    </ul>
                    <small><span class="text-danger"><?=form_error('is_active');?></span></small>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Tambah Data</button>
                <a href="<?=base_url('tahun');?>" class="btn btn-success mb-2">Kembali</a>
            </form>
        </div>
    </div>