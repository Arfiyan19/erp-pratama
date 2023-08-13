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

    const handleFilterDataPiutang = () => {
        const mitra = $("#mitra").children('option:selected');
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
            window.history.pushState(null, null, path + `?mitra=${mitra.text()}&usia_hutang=${usiaHutang.text()}&tanggal_awal=${tanggalAwal.val()}&tanggal_akhir=${tanggalAkhir.val()}`);

            postData('<?= base_url('Piutang/getDataPiutang') ?>', {
                    mitra: mitra.val(),
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

            let totNominalPiutang = 0;
            let totNominalPembayaran = 0;
            let totSisaPiutang = 0;
            response.forEach((v) => {
                totNominalPiutang += parseFloat(v.nominal_piutang)
                totNominalPembayaran += parseFloat(v.nominal_pembayaran)
                totSisaPiutang += parseFloat(v.sisa_piutang)
                $("#index_datatable > tbody").append(`
                    <tr class="text-center">
                        <td>${v.mitra}</td>
                        <td>${v.kode}</td>
                        <td>${v.tanggal}</td>
                        <td>${v.tanggal_jt}</td>
                        <td>${numberFormat(v.nominal_piutang)}</td>
                        <td>${numberFormat(v.nominal_pembayaran)}</td>
                        <td>${numberFormat(v.sisa_piutang)}</td>
                        <td>${v.usiaHutang} Hari</td>
                    </tr>
                `);
            });


            $("#index_datatable").DataTable();

            $("#index_datatable > tfoot tr #totNominalPiutang").html("Rp. " + numberFormat(totNominalPiutang));
            $("#index_datatable > tfoot tr #totNominalPembayaran").html("Rp. " + numberFormat(totNominalPembayaran));
            $("#index_datatable > tfoot tr #totSisaPiutang").html("Rp. " + numberFormat(totSisaPiutang));
        } else {
            resetNominal()
        }
    }

    const handleResetDataPiutang = () => {
        resetUrlPushState();
        $("#mitra").val("all").trigger('change');
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

        $("#index_datatable > tfoot tr #totNominalPiutang").html("Rp. " + 0);
        $("#index_datatable > tfoot tr #totNominalPembayaran").html("Rp. " + 0);
        $("#index_datatable > tfoot tr #totSisaPiutang").html("Rp. " + 0);

        $("#index_datatable").DataTable();
    }
</script>