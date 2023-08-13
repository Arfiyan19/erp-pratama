<script>
    $(document).ready(function() {

        $("#index_datatable").DataTable()
        resetNominal()
        resetUrlPushState();
    })

    const numberFormat = (number) => {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    const resetUrlPushState = () => {
        let url = window.location.href;
        if (url.indexOf("?") != -1) {
            let resUrl = url.split("?");

            if (typeof window.history.pushState == 'function') {
                window.history.pushState({}, "Hide", resUrl[0]);
            }
        }
    }

    async function postData(url = '', data = {}, type) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: type,
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        return response.json();
    }

    const handleFilterDataHutang = () => {
        const supplier = $("#supplier").children('option:selected');
        const usiaHutang = $("#usiaHutang").children('option:selected');
        const tanggalAwal = $("#tanggalawal")
        const tanggalAkhir = $("#tanggalakhir")

        if (usiaHutang.val() == "") {
            alert('Usia Hutang harap dipilih');
            return false;
        } else if (tanggalAwal.val() == "") {
            alert('Tanggal Awal harap dipilih');
            return false;
        } else if (tanggalAkhir.val() == "") {
            alert('Tanggal Akhir harap dipilih');
            return false;
        } else {

            //master path - original path
            path = window.location.pathname;

            //Redirectss original path to this
            window.history.pushState(null, null, path + `?supplier=${supplier.text()}&usia_hutang=${usiaHutang.text()}&tanggal_awal=${tanggalAwal.val()}&tanggal_akhir=${tanggalAkhir.val()}`);

            postData('<?= base_url('HutangMenu/getDataHutangMenu') ?>', {
                    supplier: supplier.val(),
                    usiaHutang: usiaHutang.val(),
                    tanggalAwal: tanggalAwal.val(),
                    tanggalAkhir: tanggalAkhir.val()
                }, 'POST')
                .then((response) => {
                    $('#index_datatable').fadeOut("slow", function() {
                        $(this).hide();
                        $("#index_datatable > tbody").html(`<tr><td colspan="8" class="text-center"><span ><i class="fa fa-spinner fa-spin"></i> Loading...</span></td></tr>`);
                    }).fadeIn("slow", function() {
                        $(this).show();
                        initData(response);
                    });
                });
        }
    }

    const initData = (response) => {
        if (response.length > 0) {
            if ($.fn.DataTable.isDataTable('#index_datatable')) {
                $('#index_datatable').DataTable().destroy();
            }

            $("#index_datatable > tbody").empty();

            let totNominalUtang = 0;
            let totNominalPembayaran = 0;
            let totSisaUtang = 0;
            response.forEach((v) => {
                totNominalUtang += parseFloat(v.nominal_hutang)
                totNominalPembayaran += parseFloat(v.nominal_pembayaran)
                totSisaUtang += parseFloat(v.sisa_hutang)
                $("#index_datatable > tbody").append(`
                    <tr class="text-center">
                        <td>${v.supplier}</td>
                        <td>${v.kode}</td>
                        <td>${v.tanggal}</td>
                        <td>${v.tanggal_jt}</td>
                        <td>${numberFormat(v.nominal_hutang)}</td>
                        <td>${numberFormat(v.nominal_pembayaran)}</td>
                        <td>${numberFormat(v.sisa_hutang)}</td>
                        <td>${v.usiaHutang} Hari</td>
                    </tr>
                `);
            });


            $("#index_datatable").DataTable();

            $("#index_datatable > tfoot tr #totNominalUtang").html("Rp. " + numberFormat(totNominalUtang));
            $("#index_datatable > tfoot tr #totNominalPembayaran").html("Rp. " + numberFormat(totNominalPembayaran));
            $("#index_datatable > tfoot tr #totSisaUtang").html("Rp. " + numberFormat(totSisaUtang));
        } else {
            resetNominal()
        }
    }

    const handleResetDataHutang = () => {
        resetUrlPushState();
        $("#supplier").val("all").trigger('change');
        $("#usiaHutang").val("").trigger('change');
        $("#tanggalawal").val("")
        $("#tanggalakhir").val("")
        $('#index_datatable').fadeOut("slow", function() {
            $(this).hide();
            $("#index_datatable > tbody").html(`<tr><td colspan="8" class="text-center"><span ><i class="fa fa-spinner fa-spin"></i> Loading...</span></td></tr>`);
        }).fadeIn("slow", function() {
            $(this).show();
            resetNominal();
        });

    }

    const resetNominal = () => {

        $("#index_datatable > tbody").html(`<tr><td colspan="8" class="text-center text-danger">Data Kosong</td></tr>`);

        $("#index_datatable > tfoot tr #totNominalUtang").html("Rp. " + 0);
        $("#index_datatable > tfoot tr #totNominalPembayaran").html("Rp. " + 0);
        $("#index_datatable > tfoot tr #totSisaUtang").html("Rp. " + 0);

        $("#index_datatable").DataTable();
    }
</script>