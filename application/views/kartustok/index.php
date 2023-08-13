<div class="content-wrapper col-12">
    <section class="content-header ml mt-2 auto">
        <!-- <h1>Stok Akhir</h1> -->
        <div class="row mt-3 mb-2">
            <div class="col-lg-4">
                <form action="" method="post">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <label for="weekending" class="input-group-text">Weekending:</label>
                        </div>
                        <select name="" id="" class="form-control">
                            <option value="">Weekending Up</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mt-1 mb-1">

                    </div>

                </form>
            </div>
            <div class="col-lg-4">
                <form action="" method="post">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <label for="weekending" class="input-group-text">Kode:</label>
                        </div>
                        <select name="kode" id="kode" class="form-control">
                            <option value="all">All</option>
                            <?php foreach ($kodeProduk as $key => $value) : ?>
                                <option value="<?= $value->kode ?>"><?= $value->kode ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mt-1 mb-1">
                        <div class="input-group-prepend">
                            <label for="noinv" class="input-group-text">Gudang :</label>
                        </div>
                        <select name="gudang" id="gudang" class="form-control">
                            <option value="all">All</option>
                            <?php foreach ($gudangs as $key => $gudang) : ?>
                                <option value="<?= $gudang->nama ?>"><?= $gudang->kode ?> - <?= $gudang->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </form>
            </div>
            <div class="col-lg-4">
                <div class="input-group input-group-sm mt-1 mb-1">
                    <div class="">
                        <button class="btn btn-primary" onclick="handleFilterProduk()">Filter</button>
                    </div>
                    <div class="input-group-prepend">
                        <label for="noinv" class="input-group-text mt-2">Total Sisa :</label>
                        <input type="text" class="form-control mt-2">

                    </div>
                </div>
            </div>
        </div>

        <a href="<?= base_url('barang/tambah'); ?>" class="btn btn-info mb-2">Tambah Data</a>
        <div class="table-responsive">
            <!-- <table class="table" id="dataTable" width="" cellspacing="0"> -->
            <table id="mytable" class="table table-striped table-bordered table-hover table-full-width" cellspacing="0" width="" style="font-size: small;">
                <thead>
                    <tr style="text-align:center;">
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Barang</th>
                        <th>Kategori</th>
                        <th>Gudang</th>
                        <th>Stok</th>
                        <th>HPP</th>
                        <th>Total</th>
                        <!-- <th>Aksi</th> -->
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        getAllProduk();
    });

    function numberFormat(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    const fetchDataProdukToServer = (url, options, beforeSend) => {
        requestFetch = function() {
            beforeSend
            return fetch.apply(this, arguments);
        }
        requestFetch(url, options).then((response) => {
            return response.json();
        }).then((data) => {
            initDataToTable(data);
        });
    }

    const getAllProduk = async () => {
        const url = "<?= base_url('Kartu_stok/getAllProduk') ?>";
        const options = {
            method: 'POST'
        }

        const beforeSend = $("#mytable > tbody").html(`<tr><td colspan="8" class="text-center"><span ><i class="fa fa-spinner fa-spin"></i> Loading...</span></td></tr>`);

        fetchDataProdukToServer(url, options, beforeSend);

    }

    const handleFilterProduk = async () => {
        const kode = $("#kode").val()
        const gudang = $("#gudang").val()

        const url = "<?= base_url('Kartu_stok/getAllProduk') ?>";

        let postData = new FormData();
        postData.append('kode', kode);
        postData.append('gudang', $("#gudang").val());

        const options = {
            method: 'POST',
            body: postData
        }

        const beforeSend = $("#mytable > tbody").html(`<tr><td colspan="8" class="text-center"><span ><i class="fa fa-spinner fa-spin"></i> Loading...</span></td></tr>`);

        fetchDataProdukToServer(url, options, beforeSend);
    }

    const initDataToTable = (data) => {
        $("#mytable > tbody").empty();
        data.forEach((item, index) => {
            $("#mytable > tbody").append(`
                <tr class="text-center">
                    <td>${index + 1}</td>
                    <td>${item.kode}</td>
                    <td>${item.nama}</td>
                    <td>${item.kategori}</td>
                    <td>${item.gudang}</td>
                    <td>${item.stok}</td>
                    <td>${numberFormat(item.hpp)}</td>
                    <td>${numberFormat(item.jumlah)}</td>
                </tr>
            `)
        })

        $('#mytable').DataTable({
            'paging': true,
            'lengthChange': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    }
</script>