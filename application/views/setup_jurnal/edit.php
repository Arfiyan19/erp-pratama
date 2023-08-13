<div class="container">
    <div class="col-md-12">
        <h2 class="">Form Edit Data</h2>
        <form action="" class="form-horizontal" method="POST">
            <input type="hidden" name="id" class="form-control" value="<?= $setup_jurnal['id']; ?>">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Kode Jurnal</label>
                    <input type="text" name="kode_jurnal" placeholder="Masukkan Kode Jurnal" value="<?= $setup_jurnal['kode_jurnal'] ?>" class="form-control">
                    <small><span class="text-danger"><?= form_error('kode_jurnal'); ?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Formulir</label>
                    <select class="form-control" name="formulir" id="formulir">
                        <option value="penerimaan_barang" <?php echo ('penerimaan_barang' == $setup_jurnal['formulir']) ? "selected" : ""; ?>>Penerimaan Barang</option>
                        <option value="pengiriman_barang" <?php echo ('pengiriman_barang' == $setup_jurnal['formulir']) ? "selected" : ""; ?>>Pengiriman Barang</option>
                        <option value="pendapatan_lain" <?php echo ('pendapatan_lain' == $setup_jurnal['formulir']) ? "selected" : ""; ?>>Pendapatan Lain</option>
                        <option value="pengeluaran" <?php echo ('pengeluaran' == $setup_jurnal['formulir']) ? "selected" : ""; ?>>Pengeluaran</option>
                        <option value="hutang_piutang" <?php echo ('hutang_piutang' == $setup_jurnal['formulir']) ? "selected" : ""; ?>>Hutang Piutang</option>
                        <option value="gaji" <?php echo ('gaji' == $setup_jurnal['formulir']) ? "selected" : ""; ?>>Gaji</option>
                    </select>
                    <small><span class="text-danger"><?= form_error('id_coa'); ?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Tabulasi</label>
                    <select class="form-control" name="tabulasi" id="tabulasi">
                        <option value="" selected="" disabled>- Select Formulir -</option>
                        <option value="piutang" <?php echo ('piutang' == $setup_jurnal['tabulasi']) ? "selected" : ""; ?>>Piutang</option>
                        <option value="hutang" <?php echo ('hutang' == $setup_jurnal['tabulasi']) ? "selected" : ""; ?>>Hutang</option>
                        <option value="pembelian" <?php echo ('pembelian' == $setup_jurnal['tabulasi']) ? "selected" : ""; ?>>Pembelian</option>
                        <option value="penjualan" <?php echo ('penjualan' == $setup_jurnal['tabulasi']) ? "selected" : ""; ?>>Penjualan</option>
                        <option value="kasKecil" <?php echo ('kasKecil' == $setup_jurnal['tabulasi']) ? "selected" : ""; ?>>Kas Kecil</option>
                        <option value="setorKasKecil" <?php echo ('setorKasKecil' == $setup_jurnal['tabulasi']) ? "selected" : ""; ?>>Setor Kas Kecil</option>
                        <option value="budgetEvent" <?php echo ('budgetEvent' == $setup_jurnal['tabulasi']) ? "selected" : ""; ?>>Budget Event</option>
                        <option value="setorPajak" <?php echo ('setorPajak' == $setup_jurnal['tabulasi']) ? "selected" : ""; ?>>Setor Pajak</option>
                        <option value="uangMukaPenjualan" <?php echo ('uangMukaPenjualan' == $setup_jurnal['tabulasi']) ? "selected" : ""; ?>>Uang Muka Penjualan</option>
                        <option value="uangMukaPembelian" <?php echo ('uangMukaPembelian' == $setup_jurnal['tabulasi']) ? "selected" : ""; ?>>Uang Muka Pembelian</option>
                    </select>
                    <small><span class="text-danger"><?= form_error('id_coa'); ?></span></small>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <input type="text" name="keterangan" placeholder="Masukkan Deskripsi" value="<?= $setup_jurnal['keterangan'] ?>" class="form-control">
                    <small><span class="text-danger"><?= form_error('keterangan'); ?></span></small>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Entitas Akuntansi</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5>Jurnal Anggaran</h5>
                            <a href="javascript:tambah('jurnalAnggaran', 1)" type="button" class="btn btn-primary" id="tambahAnggaran">
                                + Tambah
                            </a>
                            <table class="table table-striped table-borderless table-hover">
                                <thead>
                                    <tr class="table-active">
                                        <th scope="col">Elemen</th>
                                        <th scope="col">D/K</th>
                                        <th scope="col">Nominal</th>
                                    </tr>
                                </thead>
                                <tbody id="jurnalAnggaran">
                                    <?php foreach ($setup_jurnal_anggaran as $key => $value) { ?>
                                        <tr nomor="<?= $key ?>">
                                            <td>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <a href="javascript:hapus('<?= $key ?>')" type="button" class="btn btn-danger">-</a>
                                                    </div>
                                                    <div class="col-10">
                                                        <select name="elemenjurnalAnggaran[]" id="elemen<?= $key ?>" class="form-control elemen">
                                                            <option value="kodeAkun" <?php echo ('kodeAkun' == $value['elemen']) ? "selected" : ""; ?>>Kode Akun</option>
                                                            <option value="mapAkun1" <?php echo ('mapAkun1' == $value['elemen']) ? "selected" : ""; ?>>Map Akun 1</option>
                                                            <option value="mapAkun2" <?php echo ('mapAkun2' == $value['elemen']) ? "selected" : ""; ?>>Map Akun 2</option>
                                                            <option value="mapAkun3" <?php echo ('mapAkun3' == $value['elemen']) ? "selected" : ""; ?>>Map Akun 3</option>
                                                            <option value="sumberDanaPiutang" <?php echo ('sumberDanaPiutang' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Piutang</option>
                                                            <option value="sumberDanaPiutang1" <?php echo ('sumberDanaPiutang1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Piutang 1</option>
                                                            <option value="sumberDanaPiutang2" <?php echo ('sumberDanaPiutang2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Piutang 2</option>
                                                            <option value="sumberDanaPiutang3" <?php echo ('sumberDanaPiutang3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Piutang 3</option>
                                                            <option value="sumberDanaHutang" <?php echo ('sumberDanaHutang' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Hutang</option>
                                                            <option value="sumberDanaHutang1" <?php echo ('sumberDanaHutang1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Hutang 1</option>
                                                            <option value="sumberDanaHutang2" <?php echo ('sumberDanaHutang2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Hutang 2</option>
                                                            <option value="sumberDanaHutang3" <?php echo ('sumberDanaHutang3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Hutang 3</option>
                                                            <option value="sumberDanaPenjualan" <?php echo ('sumberDanaPenjualan' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Penjualan</option>
                                                            <option value="sumberDanaPenjualan1" <?php echo ('sumberDanaPenjualan1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Penjualan 1</option>
                                                            <option value="sumberDanaPenjualan2" <?php echo ('sumberDanaPenjualan2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Penjualan 2</option>
                                                            <option value="sumberDanaPenjualan3" <?php echo ('sumberDanaPenjualan3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Penjualan 3</option>
                                                            <option value="sumberDanaPembelian" <?php echo ('sumberDanaPembelian' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Pembelian</option>
                                                            <option value="sumberDanaPembelian1" <?php echo ('sumberDanaPembelian1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Pembelian 1</option>
                                                            <option value="sumberDanaPembelian2" <?php echo ('sumberDanaPembelian2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Pembelian 2</option>
                                                            <option value="sumberDanaPembelian3" <?php echo ('sumberDanaPembelian3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Pembelian 3</option>
                                                            <option value="sumberDanaPengajuanKasKecil" <?php echo ('sumberDanaPengajuanKasKecil' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Pengajuan Kas Kecil</option>
                                                            <option value="sumberDanaPengajuanKasKecil1" <?php echo ('sumberDanaPengajuanKasKecil1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Pengajuan Kas Kecil 1</option>
                                                            <option value="sumberDanaPengajuanKasKecil2" <?php echo ('sumberDanaPengajuanKasKecil2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Pengajuan Kas Kecil 2</option>
                                                            <option value="sumberDanaPengajuanKasKecil3" <?php echo ('sumberDanaPengajuanKasKecil3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Pengajuan Kas Kecil 3</option>
                                                            <option value="sumberDanaSetorKasKecil" <?php echo ('sumberDanaSetorKasKecil' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Stor Kas Kecil</option>
                                                            <option value="sumberDanaSetorKasKecil1" <?php echo ('sumberDanaSetorKasKecil1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Stor Kas Kecil 1</option>
                                                            <option value="sumberDanaSetorKasKecil2" <?php echo ('sumberDanaSetorKasKecil2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Stor Kas Kecil 2</option>
                                                            <option value="sumberDanaSetorKasKecil3" <?php echo ('sumberDanaSetorKasKecil3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Stor Kas Kecil 3</option>
                                                            <option value="sumberDanaSetorPajak" <?php echo ('sumberDanaSetorPajak' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Setor Pajak</option>
                                                            <option value="sumberDanaSetorPajak1" <?php echo ('sumberDanaSetorPajak1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Setor Pajak 1</option>
                                                            <option value="sumberDanaSetorPajak2" <?php echo ('sumberDanaSetorPajak2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Setor Pajak 2</option>
                                                            <option value="sumberDanaSetorPajak3" <?php echo ('sumberDanaSetorPajak3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Setor Pajak 3</option>
                                                            <option value="sumberDanaPenerimaanPindahBuku" <?php echo ('sumberDanaPenerimaanPindahBuku' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Penerimaan Pindah Buku</option>
                                                            <option value="sumberDanaPengeluaranPindahBuku" <?php echo ('sumberDanaPengeluaranPindahBuku' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Pengeluaran Pindah Buku</option>
                                                            <option value="rekeningKasKecil" <?php echo ('rekeningKasKecil' == $value['elemen']) ? "selected" : ""; ?>>Rekening Kas Kecil</option>
                                                            <option value="rekeningKasKecil1" <?php echo ('rekeningKasKecil1' == $value['elemen']) ? "selected" : ""; ?>>Map Kas Kecil 1</option>
                                                            <option value="rekeningKasKecil2" <?php echo ('rekeningKasKecil2' == $value['elemen']) ? "selected" : ""; ?>>Map Kas Kecil 2</option>
                                                            <option value="rekeningKasKecil3" <?php echo ('rekeningKasKecil3' == $value['elemen']) ? "selected" : ""; ?>>Map Kas Kecil 3</option>
                                                            <option value="akunPiutang" <?php echo ('akunPiutang' == $value['elemen']) ? "selected" : ""; ?>>Akun Piutang</option>
                                                            <option value="akunPiutang1" <?php echo ('akunPiutang1' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Piutang 1</option>
                                                            <option value="akunPiutang2" <?php echo ('akunPiutang2' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Piutang 2</option>
                                                            <option value="akunPiutang3" <?php echo ('akunPiutang3' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Piutang 3</option>
                                                            <option value="akunHutang" <?php echo ('akunHutang' == $value['elemen']) ? "selected" : ""; ?>>Akun Hutang</option>
                                                            <option value="akunHutang1" <?php echo ('akunHutang1' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Hutang 1</option>
                                                            <option value="akunHutang2" <?php echo ('akunHutang2' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Hutang 2</option>
                                                            <option value="akunHutang3" <?php echo ('akunHutang3' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Hutang 3</option>
                                                            <option value="akunPenjualan" <?php echo ('akunPenjualan' == $value['elemen']) ? "selected" : ""; ?>>Akun Penjualan</option>
                                                            <option value="akunPenjualan1" <?php echo ('akunPenjualan1' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Penjualan 1</option>
                                                            <option value="akunPenjualan2" <?php echo ('akunPenjualan2' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Penjualan 2</option>
                                                            <option value="akunPenjualan3" <?php echo ('akunPenjualan3' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Penjualan 3</option>
                                                            <option value="akunPembelian" <?php echo ('akunPembelian' == $value['elemen']) ? "selected" : ""; ?>>Akun Pembelian</option>
                                                            <option value="akunPembelian1" <?php echo ('akunPembelian1' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Pembelian 1</option>
                                                            <option value="akunPembelian2" <?php echo ('akunPembelian2' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Pembelian 2</option>
                                                            <option value="akunPembelian3" <?php echo ('akunPembelian3' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Pembelian 3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <select name="d/kjurnalAnggaran[]" id="d/k" class="form-control">
                                                    <option value="debit" <?php echo ('debit' == $value['tipe']) ? "selected" : ""; ?>>Debit</option>
                                                    <option value="kredit" <?php echo ('kredit' == $value['tipe']) ? "selected" : ""; ?>>Kredit</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="nominaljurnalAnggaran[]" id="nominal<?= $key ?>" class="form-control">
                                                    <option value="nominalPiutang" <?php echo ('nominalPiutang' == $value['nominal']) ? "selected" : ""; ?>>Nominal Piutang</option>
                                                    <option value="nominalHutang" <?php echo ('nominalHutang' == $value['nominal']) ? "selected" : ""; ?>>Nominal Hutang</option>
                                                    <option value="nominalPenjualan" <?php echo ('nominalPenjualan' == $value['nominal']) ? "selected" : ""; ?>>Nominal Penjualan</option>
                                                    <option value="nominalPembelian" <?php echo ('nominalPembelian' == $value['nominal']) ? "selected" : ""; ?>>Nominal Pembelian</option>
                                                    <option value="nominalReturPenjualan" <?php echo ('nominalReturPenjualan' == $value['nominal']) ? "selected" : ""; ?>>Nominal Retur Penjualan</option>
                                                    <option value="nominalReturPembelian" <?php echo ('nominalReturPembelian' == $value['nominal']) ? "selected" : ""; ?>>Nominal Retur Pembelian</option>
                                                    <option value="nominalBudgetEvent" <?php echo ('nominalBudgetEvent' == $value['nominal']) ? "selected" : ""; ?>>Nominal Budget Event</option>
                                                    <option value="nominalSetorPajak" <?php echo ('nominalSetorPajak' == $value['nominal']) ? "selected" : ""; ?>>Nominal Setor Pajak</option>
                                                    <option value="nominalKasKecil" <?php echo ('nominalKasKecil' == $value['nominal']) ? "selected" : ""; ?>>Nominal Kas Kecil</option>
                                                    <option value="nominalSetorKasKecil" <?php echo ('nominalSetorKasKecil' == $value['nominal']) ? "selected" : ""; ?>>Nominal Setor Kas Kecil</option>
                                                    <option value="nominalPindahbukuPenerimaan" <?php echo ('nominalPindahbukuPenerimaan' == $value['nominal']) ? "selected" : ""; ?>>Nominal Pindahbuku Penerimaan</option>
                                                    <option value="nominalPindahbukuPengeluaran" <?php echo ('nominalPindahbukuPengeluaran' == $value['nominal']) ? "selected" : ""; ?>>Nominal Pindahbuku Pengeluaran</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <h5>Jurnal Finansial</h5>
                            <a href="javascript:tambah('jurnalFinansial', 1)" type="button" class="btn btn-primary" id="tambahFinansial">
                                + Tambah
                            </a>
                            <table class="table table-striped table-borderless table-hover">
                                <thead>
                                    <tr class="table-active">
                                        <th scope="col">Elemen</th>
                                        <th scope="col">D/K</th>
                                        <th scope="col">Nominal</th>
                                    </tr>
                                </thead>
                                <tbody id="jurnalFinansial">
                                    <?php foreach ($setup_jurnal_finansial as $key => $value) { ?>
                                        <tr nomor="<?= $key ?>">
                                            <td>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <a href="javascript:hapus('<?= $key ?>')" type="button" class="btn btn-danger">-</a>
                                                    </div>
                                                    <div class="col-10">
                                                        <select name="elemenjurnalFinansial[]" id="elemen<?= $key ?>" class="form-control elemen">
                                                            <option value="kodeAkun" <?php echo ('kodeAkun' == $value['elemen']) ? "selected" : ""; ?>>Kode Akun</option>
                                                            <option value="mapAkun1" <?php echo ('mapAkun1' == $value['elemen']) ? "selected" : ""; ?>>Map Akun 1</option>
                                                            <option value="mapAkun2" <?php echo ('mapAkun2' == $value['elemen']) ? "selected" : ""; ?>>Map Akun 2</option>
                                                            <option value="mapAkun3" <?php echo ('mapAkun3' == $value['elemen']) ? "selected" : ""; ?>>Map Akun 3</option>
                                                            <option value="sumberDanaPiutang" <?php echo ('sumberDanaPiutang' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Piutang</option>
                                                            <option value="sumberDanaPiutang1" <?php echo ('sumberDanaPiutang1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Piutang 1</option>
                                                            <option value="sumberDanaPiutang2" <?php echo ('sumberDanaPiutang2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Piutang 2</option>
                                                            <option value="sumberDanaPiutang3" <?php echo ('sumberDanaPiutang3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Piutang 3</option>
                                                            <option value="sumberDanaHutang" <?php echo ('sumberDanaHutang' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Hutang</option>
                                                            <option value="sumberDanaHutang1" <?php echo ('sumberDanaHutang1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Hutang 1</option>
                                                            <option value="sumberDanaHutang2" <?php echo ('sumberDanaHutang2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Hutang 2</option>
                                                            <option value="sumberDanaHutang3" <?php echo ('sumberDanaHutang3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Hutang 3</option>
                                                            <option value="sumberDanaPenjualan" <?php echo ('sumberDanaPenjualan' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Penjualan</option>
                                                            <option value="sumberDanaPenjualan1" <?php echo ('sumberDanaPenjualan1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Penjualan 1</option>
                                                            <option value="sumberDanaPenjualan2" <?php echo ('sumberDanaPenjualan2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Penjualan 2</option>
                                                            <option value="sumberDanaPenjualan3" <?php echo ('sumberDanaPenjualan3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Penjualan 3</option>
                                                            <option value="sumberDanaPembelian" <?php echo ('sumberDanaPembelian' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Pembelian</option>
                                                            <option value="sumberDanaPembelian1" <?php echo ('sumberDanaPembelian1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Pembelian 1</option>
                                                            <option value="sumberDanaPembelian2" <?php echo ('sumberDanaPembelian2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Pembelian 2</option>
                                                            <option value="sumberDanaPembelian3" <?php echo ('sumberDanaPembelian3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Pembelian 3</option>
                                                            <option value="sumberDanaPengajuanKasKecil" <?php echo ('sumberDanaPengajuanKasKecil' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Pengajuan Kas Kecil</option>
                                                            <option value="sumberDanaPengajuanKasKecil1" <?php echo ('sumberDanaPengajuanKasKecil1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Pengajuan Kas Kecil 1</option>
                                                            <option value="sumberDanaPengajuanKasKecil2" <?php echo ('sumberDanaPengajuanKasKecil2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Pengajuan Kas Kecil 2</option>
                                                            <option value="sumberDanaPengajuanKasKecil3" <?php echo ('sumberDanaPengajuanKasKecil3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Pengajuan Kas Kecil 3</option>
                                                            <option value="sumberDanaSetorKasKecil" <?php echo ('sumberDanaSetorKasKecil' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Stor Kas Kecil</option>
                                                            <option value="sumberDanaSetorKasKecil1" <?php echo ('sumberDanaSetorKasKecil1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Stor Kas Kecil 1</option>
                                                            <option value="sumberDanaSetorKasKecil2" <?php echo ('sumberDanaSetorKasKecil2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Stor Kas Kecil 2</option>
                                                            <option value="sumberDanaSetorKasKecil3" <?php echo ('sumberDanaSetorKasKecil3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Stor Kas Kecil 3</option>
                                                            <option value="sumberDanaSetorPajak" <?php echo ('sumberDanaSetorPajak' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Setor Pajak</option>
                                                            <option value="sumberDanaSetorPajak1" <?php echo ('sumberDanaSetorPajak1' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Setor Pajak 1</option>
                                                            <option value="sumberDanaSetorPajak2" <?php echo ('sumberDanaSetorPajak2' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Setor Pajak 2</option>
                                                            <option value="sumberDanaSetorPajak3" <?php echo ('sumberDanaSetorPajak3' == $value['elemen']) ? "selected" : ""; ?>>Map Sumber Dana Setor Pajak 3</option>
                                                            <option value="sumberDanaPenerimaanPindahBuku" <?php echo ('sumberDanaPenerimaanPindahBuku' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Penerimaan Pindah Buku</option>
                                                            <option value="sumberDanaPengeluaranPindahBuku" <?php echo ('sumberDanaPengeluaranPindahBuku' == $value['elemen']) ? "selected" : ""; ?>>Sumber Dana Pengeluaran Pindah Buku</option>
                                                            <option value="rekeningKasKecil" <?php echo ('rekeningKasKecil' == $value['elemen']) ? "selected" : ""; ?>>Rekening Kas Kecil</option>
                                                            <option value="rekeningKasKecil1" <?php echo ('rekeningKasKecil1' == $value['elemen']) ? "selected" : ""; ?>>Map Kas Kecil 1</option>
                                                            <option value="rekeningKasKecil2" <?php echo ('rekeningKasKecil2' == $value['elemen']) ? "selected" : ""; ?>>Map Kas Kecil 2</option>
                                                            <option value="rekeningKasKecil3" <?php echo ('rekeningKasKecil3' == $value['elemen']) ? "selected" : ""; ?>>Map Kas Kecil 3</option>
                                                            <option value="akunPiutang" <?php echo ('akunPiutang' == $value['elemen']) ? "selected" : ""; ?>>Akun Piutang</option>
                                                            <option value="akunPiutang1" <?php echo ('akunPiutang1' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Piutang 1</option>
                                                            <option value="akunPiutang2" <?php echo ('akunPiutang2' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Piutang 2</option>
                                                            <option value="akunPiutang3" <?php echo ('akunPiutang3' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Piutang 3</option>
                                                            <option value="akunHutang" <?php echo ('akunHutang' == $value['elemen']) ? "selected" : ""; ?>>Akun Hutang</option>
                                                            <option value="akunHutang1" <?php echo ('akunHutang1' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Hutang 1</option>
                                                            <option value="akunHutang2" <?php echo ('akunHutang2' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Hutang 2</option>
                                                            <option value="akunHutang3" <?php echo ('akunHutang3' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Hutang 3</option>
                                                            <option value="akunPenjualan" <?php echo ('akunPenjualan' == $value['elemen']) ? "selected" : ""; ?>>Akun Penjualan</option>
                                                            <option value="akunPenjualan1" <?php echo ('akunPenjualan1' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Penjualan 1</option>
                                                            <option value="akunPenjualan2" <?php echo ('akunPenjualan2' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Penjualan 2</option>
                                                            <option value="akunPenjualan3" <?php echo ('akunPenjualan3' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Penjualan 3</option>
                                                            <option value="akunPembelian" <?php echo ('akunPembelian' == $value['elemen']) ? "selected" : ""; ?>>Akun Pembelian</option>
                                                            <option value="akunPembelian1" <?php echo ('akunPembelian1' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Pembelian 1</option>
                                                            <option value="akunPembelian2" <?php echo ('akunPembelian2' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Pembelian 2</option>
                                                            <option value="akunPembelian3" <?php echo ('akunPembelian3' == $value['elemen']) ? "selected" : ""; ?>>Map Akun Pembelian 3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <select name="d/kjurnalFinansial[]" id="d/k" class="form-control">
                                                    <option value="debit" <?php echo ('debit' == $value['tipe']) ? "selected" : ""; ?>>Debit</option>
                                                    <option value="kredit" <?php echo ('kredit' == $value['tipe']) ? "selected" : ""; ?>>Kredit</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="nominaljurnalFinansial[]" id="nominal<?= $key ?>" class="form-control">
                                                    <option value="nominalPiutang" <?php echo ('nominalPiutang' == $value['nominal']) ? "selected" : ""; ?>>Nominal Piutang</option>
                                                    <option value="nominalHutang" <?php echo ('nominalHutang' == $value['nominal']) ? "selected" : ""; ?>>Nominal Hutang</option>
                                                    <option value="nominalPenjualan" <?php echo ('nominalPenjualan' == $value['nominal']) ? "selected" : ""; ?>>Nominal Penjualan</option>
                                                    <option value="nominalPembelian" <?php echo ('nominalPembelian' == $value['nominal']) ? "selected" : ""; ?>>Nominal Pembelian</option>
                                                    <option value="nominalReturPenjualan" <?php echo ('nominalReturPenjualan' == $value['nominal']) ? "selected" : ""; ?>>Nominal Retur Penjualan</option>
                                                    <option value="nominalReturPembelian" <?php echo ('nominalReturPembelian' == $value['nominal']) ? "selected" : ""; ?>>Nominal Retur Pembelian</option>
                                                    <option value="nominalBudgetEvent" <?php echo ('nominalBudgetEvent' == $value['nominal']) ? "selected" : ""; ?>>Nominal Budget Event</option>
                                                    <option value="nominalSetorPajak" <?php echo ('nominalSetorPajak' == $value['nominal']) ? "selected" : ""; ?>>Nominal Setor Pajak</option>
                                                    <option value="nominalKasKecil" <?php echo ('nominalKasKecil' == $value['nominal']) ? "selected" : ""; ?>>Nominal Kas Kecil</option>
                                                    <option value="nominalSetorKasKecil" <?php echo ('nominalSetorKasKecil' == $value['nominal']) ? "selected" : ""; ?>>Nominal Setor Kas Kecil</option>
                                                    <option value="nominalPindahbukuPenerimaan" <?php echo ('nominalPindahbukuPenerimaan' == $value['nominal']) ? "selected" : ""; ?>>Nominal Pindahbuku Penerimaan</option>
                                                    <option value="nominalPindahbukuPengeluaran" <?php echo ('nominalPindahbukuPengeluaran' == $value['nominal']) ? "selected" : ""; ?>>Nominal Pindahbuku Pengeluaran</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mb-2">Edit Data</button>
                    <a href="<?= base_url('setup_jurnal'); ?>" class="btn btn-success mb-2">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var base_url = '{site_url}SetUpJurnal';

    function tambah(tipe, nomor) {
        var formulir = $('#formulir').val();
        if (formulir == 'fakturPembelian' || formulir == 'fakturPenjualan' || formulir == 'pengeluaranKasKecil') {
            var option = `
                <option value="rekeningBank">Rekening Bank</option>
                <option value="mapRekeningBank1">Map Rekening Bank 1</option>
                <option value="mapRekeningBank2">Map Rekening Bank 2</option>
                <option value="mapRekeningBank3">Map Rekening Bank 3</option>
                <option value="mapRekeningPajak">Map Rekening Pajak</option>
                <option value="mapRekeningPajak1">Map Rekening Pajak 1</option>
                <option value="mapRekeningPajak2">Map Rekening Pajak 2</option>
                <option value="mapRekeningPajak3">Map Rekening Pajak 3</option>
            `;
            if (formulir == 'fakturPenjualan') {
                option += `
                    <option value="budgetEvent">Budget Event</option>
                    <option value="mapBE1">Map Budget Event 1</option>
                    <option value="mapBE2">Map Budget Event 2</option>
                    <option value="mapBE3">Map Budget Event 3</option>
                `;
            }
        } else {
            var option = ``;
        }
        var isiTabel = `
            <tr nomor="${nomor}">
                <td>
                    <div class="row">
                        <div class="col-2">
                            <a href="javascript:hapus('${nomor}')" type="button" class="btn btn-danger">-</a>
                        </div>
                        <div class="col-10">
                            <select name="elemen${tipe}[]" id="elemen${nomor}" class="form-control elemen">
                                <option value=""></option>
                                <option value="kodeAkun">Kode Akun</option>
                                <option value="mapAkun1">Map Akun 1</option>
                                <option value="mapAkun2">Map Akun 2</option>
                                <option value="mapAkun3">Map Akun 3</option>
                                <option value="sumberDanaPiutang">Sumber Dana Piutang</option>
                                <option value="sumberDanaPiutang1">Map Sumber Dana Piutang 1</option>
                                <option value="sumberDanaPiutang2">Map Sumber Dana Piutang 2</option>
                                <option value="sumberDanaPiutang3">Map Sumber Dana Piutang 3</option>
                                <option value="sumberDanaHutang">Sumber Dana Hutang</option>
                                <option value="sumberDanaHutang1">Map Sumber Dana Hutang 1</option>
                                <option value="sumberDanaHutang2">Map Sumber Dana Hutang 2</option>
                                <option value="sumberDanaHutang3">Map Sumber Dana Hutang 3</option>
                                <option value="sumberDanaPenjualan">Sumber Dana Penjualan</option>
                                <option value="sumberDanaPenjualan1">Map Sumber Dana Penjualan 1</option>
                                <option value="sumberDanaPenjualan2">Map Sumber Dana Penjualan 2</option>
                                <option value="sumberDanaPenjualan3">Map Sumber Dana Penjualan 3</option>
                                <option value="sumberDanaPembelian">Sumber Dana Pembelian</option>
                                <option value="sumberDanaPembelian1">Map Sumber Dana Pembelian 1</option>
                                <option value="sumberDanaPembelian2">Map Sumber Dana Pembelian 2</option>
                                <option value="sumberDanaPembelian3">Map Sumber Dana Pembelian 3</option>
                                <option value="sumberDanaPengajuanKasKecil">Sumber Dana Pengajuan Kas Kecil</option>
                                <option value="sumberDanaPengajuanKasKecil1">Map Sumber Dana Pengajuan Kas Kecil 1</option>
                                <option value="sumberDanaPengajuanKasKecil2">Map Sumber Dana Pengajuan Kas Kecil 2</option>
                                <option value="sumberDanaPengajuanKasKecil3">Map Sumber Dana Pengajuan Kas Kecil 3</option>
                                <option value="sumberDanaSetorKasKecil">Sumber Dana Stor Kas Kecil</option>
                                <option value="sumberDanaSetorKasKecil1">Map Sumber Dana Stor Kas Kecil 1</option>
                                <option value="sumberDanaSetorKasKecil2">Map Sumber Dana Stor Kas Kecil 2</option>
                                <option value="sumberDanaSetorKasKecil3">Map Sumber Dana Stor Kas Kecil 3</option>
                                <option value="sumberDanaSetorPajak">Sumber Dana Setor Pajak</option>
                                <option value="sumberDanaSetorPajak1">Map Sumber Dana Setor Pajak 1</option>
                                <option value="sumberDanaSetorPajak2">Map Sumber Dana Setor Pajak 2</option>
                                <option value="sumberDanaSetorPajak3">Map Sumber Dana Setor Pajak 3</option>
                                <option value="sumberDanaPenerimaanPindahBuku">Sumber Dana Penerimaan Pindah Buku</option>
                                <option value="sumberDanaPengeluaranPindahBuku">Sumber Dana Pengeluaran Pindah Buku</option>
                                <option value="rekeningKasKecil">Rekening Kas Kecil</option>
                                <option value="rekeningKasKecil1">Map Kas Kecil 1</option>
                                <option value="rekeningKasKecil2">Map Kas Kecil 2</option>
                                <option value="rekeningKasKecil3">Map Kas Kecil 3</option>
                                <option value="akunPiutang">Akun Piutang</option>
                                <option value="akunPiutang1">Map Akun Piutang 1</option>
                                <option value="akunPiutang2">Map Akun Piutang 2</option>
                                <option value="akunPiutang3">Map Akun Piutang 3</option>
                                <option value="akunHutang">Akun Hutang</option>
                                <option value="akunHutang1">Map Akun Hutang 1</option>
                                <option value="akunHutang2">Map Akun Hutang 2</option>
                                <option value="akunHutang3">Map Akun Hutang 3</option>
                                <option value="akunPenjualan">Akun Penjualan</option>
                                <option value="akunPenjualan1">Map Akun Penjualan 1</option>
                                <option value="akunPenjualan2">Map Akun Penjualan 2</option>
                                <option value="akunPenjualan3">Map Akun Penjualan 3</option>
                                <option value="akunPembelian">Akun Pembelian</option>
                                <option value="akunPembelian1">Map Akun Pembelian 1</option>
                                <option value="akunPembelian2">Map Akun Pembelian 2</option>
                                <option value="akunPembelian3">Map Akun Pembelian 3</option>
                                ${option}
                            </select>
                        </div>
                    </div>
                </td>
                <td>
                    <select name="d/k${tipe}[]" id="d/k" class="form-control">
                        <option value="" disabled selected>Pilih Jenis</option>
                        <option value="debit">Debit</option>
                        <option value="kredit">Kredit</option>
                    </select>
                </td>
                <td>
                    <select name="nominal${tipe}[]" id="nominal${nomor}" class="form-control">
                        <option value=""></option>
                        <option value="nominalPiutang">Nominal Piutang</option>
                        <option value="nominalHutang">Nominal Hutang</option>
                        <option value="nominalPenjualan">Nominal Penjualan</option>
                        <option value="nominalPembelian">Nominal Pembelian</option>
                        <option value="nominalReturPenjualan">Nominal Retur Penjualan</option>
                        <option value="nominalReturPembelian">Nominal Retur Pembelian</option>
                        <option value="nominalBudgetEvent">Nominal Budget Event</option>
                        <option value="nominalSetorPajak">Nominal Setor Pajak</option>
                        <option value="nominalKasKecil">Nominal Kas Kecil</option>
                        <option value="nominalSetorKasKecil">Nominal Setor Kas Kecil</option>
                        <option value="nominalPindahbukuPenerimaan">Nominal Pindahbuku Penerimaan</option>
                        <option value="nominalPindahbukuPengeluaran">Nominal Pindahbuku Pengeluaran</option>
                    </select>
                </td>
            </tr>`;
        nomorBaru = nomor + 1;
        switch (tipe) {
            case 'jurnalAnggaran':
                $('#jurnalAnggaran').append(isiTabel);
                break;
            case 'jurnalFinansial':
                $('#jurnalFinansial').append(isiTabel);
                break;
            default:
                break;
        }
        $('#tambahAnggaran').attr('href', 'javascript:tambah("jurnalAnggaran", ' + nomorBaru + ')');
        $('#tambahFinansial').attr('href', 'javascript:tambah("jurnalFinansial", ' + nomorBaru + ')');
        $(`#elemen${nomor}`).select2({
            placeholder: "Pilih Elemen",
            allowClear: true
        });
        $(`#nominal${nomor}`).select2({
            placeholder: "Pilih Nominal",
            allowClear: true
        });
    }

    function hapus(nomor) {
        $(`tr[nomor="${nomor}"]`).remove();
    }

    function save() {
        var form = $('#formSetUpJurnal')[0];
        var formData = new FormData(form);
        $.ajax({
            url: base_url + '/save',
            dataType: 'json',
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                pageBlock();
            },
            afterSend: function() {
                unpageBlock();
            },
            success: function(data) {
                if (data.status == 'success') {
                    swal("Berhasil!", "Berhasil Menambah Data", "success");
                    redirect(base_url);
                } else {
                    swal("Gagal!", "Gagal Menambah Data", "error");
                }
            },
            error: function() {
                swal("Gagal!", "Internal Server Error", "error");
            }
        })
    }

    function pilihFormulir() {
        var formulir = $('#formulir').val();
        $('#showTabulasi').show();
        if (formulir === 'fakturPembelian' || formulir === 'fakturPenjualan') {
            $('#tipeTransaksi').html(
                `<div class="form-group">
                    <label>Transaksi :</label>
                    <select name="tipeTransaksi" class="form-control">
                        <option value="" disabled selected>Pilih Tipe Transaksi</option>
                        <option value="cash">Cash</option>
                        <option value="kredit">Kredit</option>
                    </select>
                </div>`
            );
        } else if (formulir === 'pengirimanBarang' || formulir === 'penerimaanBarang') {
            $('#tipeTransaksi').html(
                `<div class="form-group">
                    <label>Jenis :</label>
                    <select name="jenis" class="form-control">
                        <option value="" disabled selected>Pilih Jenis</option>
                        <option value="jasa">Barang</option>
                        <option value="barang">Jasa</option>
                    </select>
                </div>`
            );
        } else if (formulir === 'returPembelian' || formulir === 'returPenjualan') {
            $('#tipeTransaksi').html(
                `<div class="form-group">
                    <label>Transaksi :</label>
                    <select name="tipeTransaksi" class="form-control">
                        <option value="" disabled selected>Pilih Tipe Transaksi</option>
                        <option value="cash">Cash</option>
                        <option value="kredit">Kredit</option>
                    </select>
                </div>`
            );
            $('#tabulasi').val('');
            $('#caraBayar').val('');
            $('#caraBayar').empty();
            $('#showTabulasi').hide();
        } else {
            $('#tipeTransaksi').empty();
        }
    }

    function pilihTabulasi() {
        var tabulasi = $('#tabulasi').val();
        if (tabulasi === 'pembelian' || tabulasi === 'penjualan') {
            $('#caraBayar').html(
                `<div class="form-group">
                    <label>Cara Bayar :</label>
                    <select name="cara_pembayaran" class="form-control">
                        <option value="" disabled selected>Pilih Tipe Cara Bayar</option>
                        <option value="cash">Cash</option>
                        <option value="kredit">Kredit</option>
                    </select>
                </div>`
            );
        } else {
            $('#caraBayar').empty();
        }
    }
</script>