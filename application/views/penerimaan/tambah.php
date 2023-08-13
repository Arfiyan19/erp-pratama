<div class="container">
  <div class="row my-3">
    <div class="col">
      <a href="<?= base_url('penerimaan'); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
  </div>

  <div class="row">
    <div class="col" id="alert-space">
    </div>
  </div>

  <form method="post" id="createForm" enctype="multipart/form-data" action="<?= base_url('penerimaan/tambahDataPenerimaan'); ?>">
    <div class="row">
      <div class="col-4">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <label for="weekending" class="input-group-text">Jenis Transaksi :</label>
          </div>
          <select class="form-control form-control-sm" name="jenis_transaksi" id="jenis_transaksi">
            <option value="cash">Cash</option>
            <option value="credit">Credit</option>
          </select>
        </div>
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <label for="weekending" class="input-group-text">Supplier :</label>
          </div>
          <input type="text" name="supplier" id="nama" class="form-control form-control-sm" data-toggle="modal" data-target="#myModal">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="alamat" class="input-group-text">No. Sj Supplier :</label>
          </div>
          <input type="text" name="no_sj" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="namawin2mgr" class="input-group-text">Tgl. SJ Supplier :</label>
          </div>
          <input type="text" name="tanggal" class="form-control form-control-sm">
          <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
        </div>
      </div>
      <div class="col-4">
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="namawin2mgr" class="input-group-text">Tgl. Jatuh Tempo :</label>
          </div>
          <input type="text" name="tanggal_jatuh_tempo" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <label for="weekending" class="input-group-text">No. LPB :</label>
          </div>
          <input type="text" name="no_lpb" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="alamat" class="input-group-text">No. PO :</label>
          </div>
          <input type="text" name="no_po" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="namawin2mgr" class="input-group-text">No. Kontainer :</label>
          </div>
          <input type="text" name="no_kontiner" class="form-control form-control-sm">
          <!-- <input type="text" name="namawin2mgr" id="namawin2mgr" class="form-control form-control-sm"> -->
        </div>
      </div>
      <div class="col-4">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <label for="weekending" class="input-group-text">No. Polisi :</label>
          </div>
          <input type="text" name="no_polisi" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="alamat" class="input-group-text">Nama Driver :</label>
          </div>
          <input type="text" name="nama_supir" class="form-control form-control-sm">
        </div>
        <div class="input-group input-group-sm mt-1">
          <div class="input-group-prepend">
            <label for="namawin2mgr" class="input-group-text">No. Segel :</label>
          </div>
          <input type="text" name="no_segel" class="form-control form-control-sm">
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
        </tbody>
      </table>
    </div>

    <div class="col-4">
      <div class="input-group input-group-sm mt-1">
        <div class="input-group-prepend">
          <label class="input-group-text">Total Qty :</label>
        </div>
        <input type="text" id="total_qty" class="form-control form-control-sm" readonly>
      </div>
      <div class="input-group input-group-sm mt-1">
        <div class="input-group-prepend">
          <label class="input-group-text">Total Harga :</label>
        </div>
        <input type="text" id="total_harga" class="form-control form-control-sm" readonly>
      </div>
    </div>

    <a href="javascript:void(0);" class="addCF btn btn-danger rows"><i class="fas fa-plus"></i></a>
    <!-- <button type="button" class="btn btn-primary mb-2 mt-2" onclick="showModalFaktur()">Proses</button> -->
    <button class="btn btn-primary mb-2 mt-2" type="submit"><i class="fas fa-save"></i>&nbsp;Submit</button>
    <!-- <button type="button" class="btn btn-primary mb-2 mt-2">Proses</button> -->
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
          <CMRK9019>
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

  <!-- Modal -->
  <div class="modal fade" id="modalFaktur" tabindex="-1" role="dialog" aria-labelledby="modalFakturLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFakturLabel">Proses Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          Apakah Anda ingin mencetak faktur untuk data ini?
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-primary" data-dismiss="modal" onclick="submitForm('print')"><i class="fas fa-print"></i>&nbsp;Print</button>
          <button class="btn btn-sm btn-secondary" data-dismiss="modal" onclick="submitForm()"><i class="fas fa-times"></i>&nbsp;Tutup</button>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- end of .container -->
<!-- end of .wtf -->
<!--
<script src="<?php //echo base_url().'js/jquery-1.11.2.min.js'
              ?>" type="text/javascript"></script>
<script src="<?php //echo base_url().'bootstrap/js/bootstrap.js'
              ?>" type="text/javascript"></script>
<script src="<?php //echo base_url().'datatables/jquery.dataTables.js'
              ?>" type="text/javascript"></script>
<script src="<?php //echo base_url().'datatables/dataTables.bootstrap.js'
              ?>" type="text/javascript"></script>
-->

<script type="text/javascript">
  getDefaultData();
  var counter = 0;
  var selektor = 0;

  function getDefaultData() {
    $('input[name=tanggal]').val("<?= date('d/m/Y'); ?>");
    $.get({
      url: '<?= base_url('penerimaan/getNoLPB'); ?>',
      dataType: 'json',
      success: function(result) {
        $('input[name=no_lpb]').val(result);
      }
    })
  }

  // dataTable lookup pesanan barang
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

  // jika dipilih, nim akan masuk ke input dan modal di tutup
  $(document).on('click', '.pilih', function(e) {
    console.log('daftar barang');
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

  function sumHarga(lokasi) {
    const total_qty = Number(document.querySelector('input[name="total_qty' + lokasi + '"]').value);
    const harga = Number(document.querySelector('input[name="harga' + lokasi + '"]').value);
    document.querySelector('input[name="total_harga' + selektor + '"]').value = total_qty * harga;
  }

  function showModalFaktur() {
    $('#modalFaktur').modal('show');
  }

  //'pname[]'
  function submitForm(print) {
    const data = {
      supplier: $("input[name='supplier']").val(),
      no_sj: $("input[name='no_sj']").val(),
      tanggal: $("input[name='tanggal']").val(),
      no_lpb: $("input[name='no_lpb']").val(),
      no_po: $("input[name='no_po']").val(),
      no_kontiner: $("input[name='no_kontiner']").val(),
      no_polisi: $("input[name='no_polisi']").val(),
      nama_supir: $("input[name='nama_supir']").val(),
      no_segel: $("input[name='no_segel']").val(),
      kode: $("input[name='kode[]']").val(),
      nama: $("input[name='nama[]']").val(),
      gudang: $("input[name='gudang[]']").val(),
      qty: $("input[name='qty[]']").val(),
      isi_karton: $("input[name='isi_karton[]']").val(),
      total_qty: $("input[name='total_qty[]']").val(),
      harga: $("input[name='harga[]']").val(),
      total_harga: $("input[name='total_harga[]']").val()
    };

    let url = print ? "/print" : "";

    const alert_success = `
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      Data Penerimaan <strong>berhasil</strong> ditambahkan!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>
    `;

    $.post({
      url: '<?= base_url('penerimaan/tambahDataPenerimaan'); ?>' + url,
      data: data,
      dataType: 'json',
      success: function(result) {
        if (result['errors']) {
          const alert_danger = `
          <div class="alert alert-danger" role="alert">
            ${result['errors']}
          </div>
          `;

          $('#alert-space').html(alert_danger);
        } else {
          getDefaultData();
          $('input[name=supplier]').val("");
          $('input[name=no_sj]').val("");
          $('input[name=no_po]').val("");
          $('input[name=no_kontiner]').val("");
          $('input[name=no_polisi]').val("");
          $('input[name=nama_supir]').val("");
          $('input[name=no_segel]').val("");
          $("input[name='kode[]']").val("");
          $("input[name='nama[]']").val("");
          $("input[name='gudang[]']").val("");
          $("input[name='qty[]']").val("");
          $("input[name='isi_karton[]']").val("");
          $("input[name='total_qty[]']").val("");
          $("input[name='harga[]']").val("");
          $("input[name='total_harga[]']").val("");
          $('#alert-space').html(alert_success);
          // setTimeout(() => $('.alert-success').alert('close'), 5000);
          if (result == "print") {
            window.open('<?= base_url('penerimaan/print'); ?>');
          }
        }
      }
    });

    //   const form = document.getElementById('createForm');
    //   if (!print) {
    //     form.action = "<?= base_url('penerimaan/tambah'); ?>";
    //   } else {
    //     form.action = "<?= base_url('penerimaan/tambah/print'); ?>";
    //   }

    // form.submit();
  }


  //   window.onpopstate = function(event) {
  // window.history.pushState(null, '', "index");
  //   }

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

  //  data-toggle="modal" data-target="#myModal1" 

  $('.addCF').click();
</script>
<script>
  function get_barang(kunci, lokasi) {
    $('#myModal1').modal('show');
    selektor = lokasi;
  };

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
<?php /*
  
*/
?>