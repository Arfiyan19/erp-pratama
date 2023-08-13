<link href="<?= base_url('assets/css/sb-admin-2.min.css');?>" rel="stylesheet">
<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">

<div class="container pt-3">
  <h2 class="text-center">LAPORAN PENERIMAAN BARANG</h2>
  <h2 class="text-center">DARI SUPPLIER</h2>

  <div class="row mt-4">
    <div class="col-4 d-flex justify-content-center">
      <table>
        <tr>
          <td>Supplier</td>
          <td>:</td>
          <td><?= $data['supplier'] ? $data['supplier'] : "-"; ?></td>
        </tr>
        <tr>
          <td>No. SJ. Supplier</td>
          <td>:</td>
          <td><?= $data['no_sj'] ? $data['no_sj'] : "-"; ?></td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>:</td>
          <td><?= $data['tanggal'] ? $data['tanggal'] : "-"; ?></td>
        </tr>
      </table>
    </div>
    <div class="col-4 d-flex justify-content-center">
      <table>
        <tr>
          <td>No. LPB</td>
          <td>:</td>
          <td><?= $data['no_lpb'] ? $data['no_lpb'] : "-"; ?></td>
        </tr>
        <tr>
          <td>No. PO</td>
          <td>:</td>
          <td><?= $data['no_po'] ? $data['no_po'] : "-"; ?></td>
        </tr>
        <tr>
          <td>No. Kontainer</td>
          <td>:</td>
          <td><?= $data['no_kontiner'] ? $data['no_kontiner'] : "-"; ?></td>
        </tr>
      </table>
    </div>
    <div class="col-4 d-flex justify-content-center">
      <table>
        <tr>
          <td>No. Polisi</td>
          <td>:</td>
          <td><?= $data['no_polisi'] ? $data['no_polisi'] : "-"; ?></td>
        </tr>
        <tr>
          <td>Supir</td>
          <td>:</td>
          <td><?= $data['nama_supir'] ? $data['nama_supir'] : "-"; ?></td>
        </tr>
        <tr>
          <td>No. Segel</td>
          <td>:</td>
          <td><?= $data['no_segel'] ? $data['no_segel'] : "-"; ?></td>
        </tr>
      </table>
    </div>
  </div>

  <div class="row mt-3">
    <table class="table table-bordered">
      <thead>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Jumlah Karton</th>
        <th>Satuan/Karton</th>
        <th>Total Jumlah</th>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td><?= $data['kode']; ?></td>
          <td><?= $data['nama']; ?></td>
          <td><?= $data['qty']; ?></td>
          <td><?= $data['isi_karton']; ?></td>
          <td><?= $data['total_qty']; ?></td>
        </tr>
        <tr>
          <td colspan="5" class="font-weight-bold text-right">TOTAL</td>
          <td><?= $data['total_qty']; ?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="row mt-3 d-flex">
    <div class="col-4 d-flex flex-column text-center">
      Diterima Oleh
      <div class="mt-3">(<span style="padding: 0 100px"></span>)</div>
    </div>
    <div class="col-4 d-flex flex-column text-center">
      Diperiksa Oleh
      <div class="mt-3">(<span style="padding: 0 100px"></span>)</div>
    </div>
    <div class="col-4 d-flex flex-column text-center">
      Diperiksa Oleh
      <div class="mt-3">(<span style="padding: 0 100px"></span>)</div>
    </div>
  </div>

  <div class="row d-flex justify-content-between mt-5">
    <span>Lembar Putih: Kantor Pusat</span>
    <span>Lembar Merah: Gudang</span>
    <span>Lembar Kuning: Accounting</span>
    <span>Lembar Hijau: Logistik</span>
    <span>Lembar Biru: Penerima</span>
  </div>
  
</div>

<script src="<?= base_url('assets/jquery-2.2.4.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

<script>
  window.print();
  
</script>
