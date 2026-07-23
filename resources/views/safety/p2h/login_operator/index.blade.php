@include('layout.head', ['title' => 'Login Operator'])
@include('layout.sidebar')
@include('layout.header')
<style>

    #cbtn-selectors thead tr:first-child th:first-child {
        position: sticky;
        left: 0;
        background-color: #f8f9fa !important;
        z-index: 5;
    }

    #cbtn-selectors tbody tr td:first-child {
        position: sticky;
        left: 0;
        z-index: 3;
    }


    #cbtn-selectors tbody tr:nth-child(odd) td:first-child {
        background-color: #ffffff !important;
    }

    #cbtn-selectors tbody tr:nth-child(even) td:first-child {
        background-color: #f9f9f9 !important;
    }

    #cbtn-selectors tbody tr:hover td:first-child {
        background-color: #eceff1 !important;
    }

    #cbtn-selectors thead tr:first-child th:first-child::after,
    #cbtn-selectors tbody tr td:first-child::after {
        content: "";
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 1px;
        border-right: 2px solid rgba(102, 100, 100, 0.15);
    }
</style>
<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li> --}}
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Login Operator</a></li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 row">
                            <div class="col-12 col-md-2 mb-2">
                                <label for="tanggalP2H">Tanggal</label>
                                <input type="text" id="tanggalP2H" class="form-control" name="tanggalP2H">
                            </div>
                            <div class="col-12 col-md-2 mb-2">
                                <label for="shiftP2H">Shift</label>
                                <select class="form-select" id="shiftP2H" name="shiftP2H">
                                    @foreach ($data['shift'] as $shh)
                                    <option
                                        value="{{ $shh->SHIFTNO }}"
                                        {{ $shh->SHIFTNO == 6 ? 'selected' : '' }}>
                                        {{ $shh->SHIFTDESC }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-2 mb-2 d-flex align-items-end">
                                <button id="cariP2H" class="btn btn-primary w-100" style="padding-top:10px;padding-bottom:10px;">Tampilkan</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="cbtn-selectors" class="table table-striped table-hover table-bordered nowrap">
                                <thead style="text-align: center; vertical-align: middle;">
                                    <tr>
                                        <th>Unit</th>
                                        <th>Login Time</th>
                                        <th>Login HM</th>
                                        <th>Logout Time</th>
                                        <th>Logout HM</th>
                                        <th>Duration Time</th>
                                        <th>Duration HM</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <!-- Data dari API akan ditambahkan di sini -->
                                </tbody>
                            </table>
                            {{-- @foreach($support as $item)
                                @include('alat-support.modal.edit', ['item' => $item])
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')
<script>
    (function () {
            const d_week = new Datepicker(document.querySelector('#tanggalP2H'), {
                buttonClass: 'btn',
                autohide: true,
            });
        })();
    document.addEventListener("DOMContentLoaded", function () {
            const inputTanggal = document.getElementById("tanggalP2H");
            const yesterday = new Date();
            yesterday.setDate(yesterday.getDate() - 1);

            const formattedDate =
                `${String(yesterday.getMonth()+1).padStart(2,'0')}/` +
                `${String(yesterday.getDate()).padStart(2,'0')}/` +
                `${yesterday.getFullYear()}`;

            inputTanggal.value = formattedDate;
        });

</script>
<script>
    function renderVerification(date) {

        let result = '';

        if (date) {

            let formattedDate = new Date(date);

            let year = formattedDate.getFullYear();
            let month = (formattedDate.getMonth() + 1)
                .toString()
                .padStart(2, '0');

            let day = formattedDate.getDate()
                .toString()
                .padStart(2, '0');

            let hours = formattedDate.getHours()
                .toString()
                .padStart(2, '0');

            let minutes = formattedDate.getMinutes()
                .toString()
                .padStart(2, '0');

            let seconds = formattedDate.getSeconds()
                .toString()
                .padStart(2, '0');

            result += `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        }


        return result || '-';
    }

    $(document).ready(function () {
        const userRole = "{{ Auth::user()->position }}";
        const userDepartemen = "{{ Auth::user()->departemen_id }}";

        const table = $('#cbtn-selectors').DataTable({
            dom: 'Bfrtip',
            paging: false,
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape', // Set orientation menjadi landscape
                    pageSize: 'A4', // Ukuran halaman (opsional, default A4)
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    },
                    customize: function (doc) {
                        // Menyesuaikan margin atau pengaturan tambahan
                        doc.content[1].margin = [10, 10, 10, 10]; // Atur margin [kiri, atas, kanan, bawah]
                    }
                },
                'colvis'
            ],

            processing: true,
            serverSide: false,
            ajax: {
                url: '{{ route('p2h.apiLoginOperator') }}',
                method: 'GET',
                data: function (d) {
                    d.tanggalP2H = $('#tanggalP2H').val();
                    d.shiftP2H = $('#shiftP2H').val();
                    delete d.columns;
                    delete d.order;
                },
            },
            columns: [
                {
                    data: 'VHC_ID'
                },
                {
                    data: 'OPR_REPORTTIME_LOGIN',
                    render: function (data) {
                        return renderVerification(data);
                    }
                },
                {
                    data: 'LGN_HOURMETER_LOGIN',
                    render: function(data) {
                        if (data == null) return '-';
                        return parseFloat(data).toFixed(1);
                    }
                },
                {
                    data: 'OPR_REPORTTIME_LOGOUT',
                    render: function (data) {
                        return renderVerification(data);
                    }
                },
                {
                    data: 'LGN_HOURMETER_LOGOUT',
                    render: function(data) {
                        if (data == null) return '-';
                        return parseFloat(data).toFixed(1);
                    }
                },
                {
                    data: 'LGN_DURATION_TIME',
                    render: function(data) {
                        if (data == null) return '-';
                        return parseFloat(data).toFixed(1);
                    }
                },
                {
                    data: 'LGN_DURATION_HM',
                    render: function(data) {
                        if (data == null) return '-';
                        return parseFloat(data).toFixed(1);
                    }
                }
            ],
            order: [[0, 'asc']],
        });

        // Tombol pencarian manual
        $('#cariP2H').click(function () {
            table.ajax.reload(null, false);
        });

        // Delegated event handler untuk tombol Verifikasi
        $('#cbtn-selectors').on('click', '.btn-verifikasi', function () {
            const btn = $(this);
            const row = {
                VHC_ID: btn.data('vhc_id'),
                OPR_REPORTTIME: btn.data('opr_time'),
                MTR_HOURMETER: btn.data('hm'),
                OPR_NRP: btn.data('nrp')
            };
            verifP2H(row);
        });
    });

    // Fungsi global verifikasi
    window.verifP2H = function (row) {
        // if (!confirm("Yakin ingin memverifikasi data ini?")) return;

        $.ajax({
            url: "{{ route('p2h.verifikasi') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                VHC_ID: row.VHC_ID,
                OPR_REPORTTIME: row.OPR_REPORTTIME,
                MTR_HOURMETER: row.MTR_HOURMETER,
                OPR_NRP: row.OPR_NRP
            },
            success: function (response) {
                // alert("Verifikasi berhasil!");
                $('#cbtn-selectors').DataTable().ajax.reload(null, false);
            },
            error: function (xhr) {
                let title = 'Gagal';
                let message = 'Terjadi kesalahan saat memverifikasi data.';

                if (xhr.responseJSON) {
                    title = xhr.responseJSON.error || 'Gagal';
                    message = xhr.responseJSON.message || message;
                } else {
                    try {
                        let response = JSON.parse(xhr.responseText);
                        title = response.error || 'Gagal';
                        message = response.message || message;
                    } catch (e) {
                        message = xhr.responseText || message;
                    }
                }

                Swal.fire({
                    icon: 'error',
                    title: title,
                    text: message
                });
            }
        });
    };
</script>

