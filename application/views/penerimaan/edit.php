<div class="container">
  <?php if ($this->session->flashdata('flash2')) : ?>
    <div class="row mt-3">
      <div class="col md-6">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">Data Penerimaan <strong>berhasil </strong><?= $this->session->flashdata('flash2'); ?>
          <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($this->session->flashdata('flash')) : ?>
    <div class="row mt-3">
      <div class="col md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">Data Penerimaan <strong>berhasil </strong><?= $this->session->flashdata('flash'); ?>
          <button type="submit" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <br>

  <form action="<?= base_url('penerimaan/edit/' . $penerimaan['id']); ?>" enctype="multipart/form-data" method="post">
    <div class="row">
      <div class="col-4">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <label for="weekending" class="input-group-text">Jenis Transaksi :</label>
          </div>
          <select class="form-control form-control-sm" name="jenis_transaksi" id="jenis_transaksi">
            <option <?php if ($penerimaan['jenis_transaksi'] == "cash") {
                      echo "selected";
                    } ?> value="cash">Cash</option>
            <option <?php if ($penerimaan['jenis_transaksi'] == "credit") {
                      echo "selected";
                    } ?> value="credit">Credit</option>
          </select>
        </div>
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <label for="weekending" class="input-group-text">Supplier :</label>
          </div>
          <input type="hidden" name="id" value="<?= $penerimaan['id']; ?>">
          <input type="text" name="supplier" id="nama" value="<?= $penerimaan['supplier']; ?>" class="form-control form-control-sm" data-toggle="modal" data-target="#myModal">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="alamat" class="input-group-text">No. Sj Supplier :</label>
          </div>
          <input type="text" name="no_sj" value="<?= $penerimaan['no_sj']; ?>" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="namawin2mgr" class="input-group-text">Tgl. SJ Supplier :</label>
          </div>
          <input type="text" name="tanggal" value="<?= $penerimaan['tanggal']; ?>" class="form-control form-control-sm">
          <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
        </div>
      </div>
      <div class="col-4">
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="namawin2mgr" class="input-group-text">Tgl. Jatuh Tempo :</label>
          </div>
          <input type="text" name="tanggal_jatuh_tempo" value="<?= $penerimaan['tanggal_jatuh_tempo']; ?>" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <label for="weekending" class="input-group-text">No. LPB :</label>
          </div>
          <input type="text" name="no_lpb" value="<?php echo $kode1; ?>" class="form-control form-control-sm" readonly>
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="alamat" class="input-group-text">No. PO :</label>
          </div>
          <input type="text" name="no_po" value="<?= $penerimaan['no_po']; ?>" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="namawin2mgr" class="input-group-text">No. Kontainer :</label>
          </div>
          <input type="text" name="no_kontiner" value="<?= $penerimaan['no_kontiner']; ?>" class="form-control form-control-sm">
          <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
        </div>
      </div>
      <div class="col-4">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <label for="weekending" class="input-group-text">No. Polisi :</label>
          </div>
          <input type="text" name="no_polisi" value="<?= $penerimaan['no_polisi']; ?>" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="alamat" class="input-group-text">Nama Driver :</label>
          </div>
          <input type="text" name="nama_supir" value="<?= $penerimaan['nama_supir']; ?>" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="namawin2mgr" class="input-group-text">No. Segel :</label>
          </div>
          <input type="text" name="no_segel" value="<?= $penerimaan['no_segel']; ?>" class="form-control form-control-sm">
          <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
        </div>
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <label for="weekending" class="input-group-text">Setup Jurnal :</label>
          </div>
          <input type="text" disabled value="<?= $setupJurnal['kode_jurnal'] ?>" class="form-control form-control-sm">
          <input type="hidden" name="setup_jurnal_id" value="<?= $setupJurnal['id'] ?>">
        </div>
      </div>
    </div>

    <div class="table-responsive mt-3">
      <table id="inkuiri" class="table table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr style="text-align:center;">
            <th>#</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Jumlah Karton</th>
            <th>Isi Karton</th>
            <th>Total Qty</th>
            <th>Harga</th>
            <th>Total Harga</th>
          </tr>
        </thead>
        <tbody id="customFields">
          <?php
          $totalQty = 0;
          $totalHarga = 0;
          $counter = 0;
          foreach ($data_item as $key => $value) {
            $counter += 1;
            $totalQty += $value['total_qty'];
            $totalHarga += $value['total_harga'];
          ?>
            <tr>
              <td>
                <a href="javascript:void(0);" class="remCF rows"><i class="fas fa-trash"></i></a>
              </td>
              <td style="text-align:center;">
                <input type="text" name="kode[]" id="kode<?= $key ?>" value="<?= $value['kode']; ?>" onclick="get_barang(this.value,<?= $key ?>)" class="form-control form-control-sm" data-toggle="modal" data-target="#myModal1">
              </td>
              <td>
                <input type="text" name="nama[]" id="namabrg<?= $key ?>" value="<?= $value['nama']; ?>" class="form-control form-control-sm">
              </td>
              <td style="text-align:center;">
                <input type="text" name="qty[]" id="txt1<?= $key ?>" onkeyup="sum(<?= $key ?>);" value="<?= $value['qty']; ?>" class="form-control form-control-sm">
              </td>
              <td style="text-align:center;">
                <input type="text" name="isi_karton[]" id="txt2<?= $key ?>" onkeyup="sum(<?= $key ?>);" value="<?= $value['isi_karton']; ?>" class="form-control form-control-sm">
              </td>
              <td style="text-align:center;">
                <input type="text" name="total_qty[]" id="txt3<?= $key ?>" value="<?= $value['total_qty']; ?>" class="form-control total_qty form-control-sm" readonly>
              </td>
              <td style="text-align:center;">
                <input type="text" id="harga<?= $key ?>" name="harga[]" onkeyup="sumHarga2(<?= $key ?>)" value="<?= $value['harga']; ?>" class="form-control form-control-sm">
              </td>
              <td style="text-align:center;">
                <input type="text" name="total_harga[]" id="total_harga<?= $key ?>" value="<?= $value['total_harga']; ?>" class="form-control form-control-sm total_harga" readonly>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <div class="col-4">
      <div class="input-group input-group-sm mt-1">
        <div class="input-group-prepend">
          <label class="input-group-text">Total Qty :</label>
        </div>
        <input type="text" id="total_qty" value="<?= $totalQty ?>" class="form-control form-control-sm" readonly>
      </div>
      <div class="input-group input-group-sm mt-1">
        <div class="input-group-prepend">
          <label class="input-group-text">Total Harga :</label>
        </div>
        <input type="text" id="total_harga" value="<?= $totalHarga ?>" class="form-control form-control-sm" readonly>
      </div>
    </div>

    <a href="javascript:void(0);" class="addCF btn btn-danger rows"><i class="fas fa-plus"></i></a>
    <button type="submit" class="btn btn-primary mb-2 mt-2">Edit</button>
    <a href="<?= base_url('penerimaan'); ?>" class="btn btn-success">Kembali</a>
  </form>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <div class="modal-body table-responsive">
          <table id="lookup" style="width:750px" class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th>Nama Supplier</th>
                <th>Alamat</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($data->result_array() as $i) :
                $nama = $i['nama'];
                $alamat = $i['alamat'];
              ?>
                <tr class="pilih" data-nama="<?php echo $nama; ?>" data-alamat="<?php echo $alamat; ?>">
                  <td><?php echo $nama; ?></td>
                  <td><?php echo $alamat; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel1"></h4>
        </div>
        <div class="modal-body table-responsive">
          <table id="lookup1" style="width:750px" class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Gudang</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($data2->result_array() as $i) :
                $kode = $i['kode'];
                $namabrg = $i['nama'];
                $gudang = $i['gudang'];
              ?>
                <tr class="pilih1" data-kode="<?php echo $kode; ?>" data-nama="<?php echo $namabrg; ?>" data-gudang="<?php echo $gudang; ?>">
                  <td><?php echo $kode; ?></td>
                  <td><?php echo $namabrg; ?></td>
                  <td><?php echo $gudang; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- end of .container -->

<script src="<?php echo base_url() . 'js/jquery-1.11.2.min.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'bootstrap/js/bootstrap.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'datatables/jquery.dataTables.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'datatables/dataTables.bootstrap.js' ?>" type="text/javascript"></script>

<script>
  // tabel lookup mahasiswa
  var counter = <?= $counter ?>;
  var selektor = 0;

  var t = $("#inkuiri").DataTable();
  $("#lookup").dataTable();
  $('#lookup1').DataTable()
  $('#example2').DataTable({
    'paging': true,
    'lengthChange': false,
    'searching': false,
    'ordering': true,
    'info': true,
    'autoWidth': false
  });

  $(".addCF").click(function() {
    console.log('exip');
    t.row.add(
      ['<a href="javascript:void(0);" class="remCF rows"><i class="fas fa-trash"></i></a>',
        '<input type="text" name="kode[]" id="kode' + counter + '"  class="form-control form-control-sm" onclick="get_barang(this.value,' + counter + ')" />',
        '<input type="text" name="nama[]"  id="namabrg' + counter + '"  class="form-control form-control-sm">',
        '<input type="text" name="qty[]" id="txt1' + counter + '" onkeyup="sum(' + counter + ');"  class="form-control form-control-sm">',
        '<input type="text" name="isi_karton[]" id="txt2' + counter + '" onkeyup="sum(' + counter + ');"  class="form-control form-control-sm">',
        '<input type="text" name="total_qty[]" id="txt3' + counter + '"  class="form-control form-control-sm total_qty" readonly>',
        '<input type="text" name="harga[]"    id="harga' + counter + '"  onkeyup="sumHarga2(' + counter + ')" class="form-control form-control-sm">',
        '<input type="text" name="total_harga[]" id="total_harga' + counter + '"  class="form-control form-control-sm total_harga">'

      ]).draw(false);
    //console.log('<input type="text" name="kode[]" id="kode'+counter+'"  class="form-control form-control-sm" data-toggle="modal" data-target="#myModal1"  />');
    counter++;
  });
  $("#customFields").on('click', '.remCF', function() {
    $(this).parent().parent().remove();
    t.row(':last').remove().draw();
    selektor--;
    console.log('drain selektor' + selektor);
  });

  $('#lookup').DataTable();
  $('#lookup1').DataTable();
  $('#example2').DataTable({
    'paging': true,
    'lengthChange': false,
    'searching': false,
    'ordering': true,
    'info': true,
    'autoWidth': false
  });

  // jika dipilih, nim akan masuk ke input dan modal di tutup
  $(document).on('click', '.pilih', function(e) {
    document.getElementById("nama").value = $(this).attr('data-nama');
    $('#myModal').modal('hide');
    document.getElementById("alamat").value = $(this).attr('data-alamat');
    $('#myModal').modal('hide');
  });

  // jika dipilih, nim akan masuk ke input dan modal di tutup onchange="get_obat_by_id(this.value,'+counter + ')"
  $(document).on('click', '.pilih1', function() {
    console.log('pilih barang' + counter);
    inputs_kode = document.getElementById("kode" + selektor);
    inputs_barang = document.getElementById("namabrg" + selektor);
    console.log(inputs_kode.value);
    //document.getElementById("kode" + counter).value = $(this).attr('data-kode');
    inputs_kode.value = $(this).attr('data-kode');
    $('#myModal1').modal('hide');
    //document.getElementById("namabrg" + counter).value = $(this).attr('data-nama');
    inputs_barang.value = $(this).attr('data-nama');
    $('#myModal1').modal('hide');
  });

  function sum(lokasi) {
    var txtFirstNumberValue = document.getElementById('txt1' + lokasi).value;
    var txtSecondNumberValue = document.getElementById('txt2' + lokasi).value;
    var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);

    if (!isNaN(result)) {
      document.getElementById('txt3' + lokasi).value = result;
    }

    var total_qtys = $('.total_qty').map((_, el) => el.value).get()
    var total_qty = 0;
    total_qtys.forEach(element => {
      total_qty += parseInt(element);
    });
    if (!isNaN(total_qty)) {
      document.getElementById('total_qty').value = total_qty;
    }
    sumHarga2(lokasi);
  }

  function get_barang(kunci, lokasi) {
    $('#myModal1').modal('show');
    selektor = lokasi;
  };

  function sumHarga() {
    const total_qty = Number(document.querySelector('input[name="total_qty"]').value);
    const harga = Number(document.querySelector('input[name="harga"]').value);
    document.querySelector('input[name="total_harga"]').value = total_qty * harga;
  }

  function sumHarga2(lokasi) {
    harga = document.getElementById("harga" + lokasi);
    jumlah = document.getElementById("txt3" + lokasi);
    total = document.getElementById("total_harga" + lokasi);

    console.log('pilih barang kunci dan selektor =' + jumlah.value);
    jumlahtotal = harga.value * jumlah.value;
    total.value = jumlahtotal;


    var total_hargas = $('.total_harga').map((_, el) => el.value).get()
    var total_harga = 0;
    console.log(total_harga);
    total_hargas.forEach(element => {
      total_harga += parseInt(element);
    });
    if (!isNaN(total_harga)) {
      document.getElementById('total_harga').value = total_harga;
    }
  }
</script>