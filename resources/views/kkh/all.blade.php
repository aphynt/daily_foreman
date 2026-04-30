@include('layout.head', ['title' => 'Daftar Laporan KKH Per Tanggal'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Daftar Laporan KKH Per Tanggal</a></li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 row">
                            <div class="col-6 col-md-2 mb-2">
                                <label for="tanggalKKH">Tanggal</label>
                                <input type="text" id="tanggalKKH" class="form-control" name="tanggalKKH">
                            </div>
                            <div class="col-6 col-md-2 mb-2">
                                <label for="shift">Shift</label>
                                <select class="form-select" name="shift" id="shift">
                                    <option value="Semua">Semua</option>
                                    <option value="Pagi">Pagi</option>
                                    <option value="Malam">Malam</option>
                                </select>
                            </div>
                            @php
                                $user = DB::connection('daily_foreman')
                                    ->table('users')
                                    ->where('nik', Auth::user()->nik)
                                    ->first();

                                $role = strtoupper(trim($user->role ?? ''));
                                $departemenId = (int) ($user->departemen_id ?? 0);

                                if ($role === 'SEPERVISOR') {
                                    $role = 'SUPERVISOR';
                                }

                                $canAccessDepartemenFilter =
                                    in_array($role, ['ADMIN', 'MANAGEMENT']) ||
                                    (in_array($role, ['SUPERVISOR', 'SUPERINTENDENT']) && $departemenId === 9);
                            @endphp

                            @if ($canAccessDepartemenFilter)
                                <div class="col-6 col-md-2 mb-2">
                                    <label for="departemen">Departemen</label>
                                    <select class="form-select" name="departemen" id="departemen">
                                        <option value="Semua">Semua</option>
                                        @foreach ($dep as $d)
                                            <option value="{{ $d->ID_Departemen }}">{{ $d->Departemen }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="col-6 col-md-2 mb-2">
                                <label for="cluster">Kategori Operasional</label>
                                <select class="form-select" name="cluster" id="cluster">
                                    <option value="Semua">Semua</option>
                                    <option value="HD">HD</option>
                                    <option value="EX">EX</option>
                                    <option value="Unit Support">Unit Support</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-2 mb-2 d-flex align-items-end">
                                <button id="cariKKH" class="btn btn-primary w-100" style="padding-top:10px;padding-bottom:10px;">Tampilkan</button>
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
                            <table id="dataKKH" class="table table-striped table-hover table-bordered nowrap">
                                <thead style="text-align: center; vertical-align: middle;">
                                    <tr>
                                        <th rowspan="2">Hari/Tanggal</th>
                                        <th rowspan="2">Jam Pulang</th>
                                        <th colspan="2">Pengisi</th>
                                        <th rowspan="2">Shift</th>
                                        <th colspan="3">Jam Tidur</th>
                                        <th rowspan="2">Jam Berangkat</th>
                                        <th rowspan="2">Fit Bekerja</th>
                                        <th rowspan="2">Keluhan</th>
                                        <th rowspan="2">Masalah Pribadi</th>
                                        <th colspan="2">Verifikasi P3K</th>
                                        <th colspan="2">Verifikasi Pengawas</th>
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Mulai</th>
                                        <th>Bangun</th>
                                        <th>Total</th>
                                        <th>Nama</th>
                                        <th>Catatan</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('kkh.modal.verifikasiP3K')

@include('layout.footer')
<script>
    (function () {
            const d_week = new Datepicker(document.querySelector('#tanggalKKH'), {
                buttonClass: 'btn',
                autohide: true,
            });
        })();
    document.addEventListener("DOMContentLoaded", function () {
            const inputTanggal = document.getElementById("tanggalKKH");
            const today = new Date();

            const formattedDate = `${String(today.getMonth() + 1).padStart(2, '0')}/${String(today.getDate()).padStart(2,
                '0')}/${today.getFullYear()}`;
            inputTanggal.value = formattedDate;
        });

</script>
<script>
    var table;
    $(document).ready(function() {
        var userRole = "{{ Auth::user()->role }}";
        table = $('#dataKKH').DataTable({


            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('kkh.all_api') }}',
                method: 'GET',
                data: function(d) {
                    var tanggalKKH = $('#tanggalKKH').val();
                    d.tanggalKKH = tanggalKKH;
                    var cluster = $('#cluster').val();
                    d.cluster = cluster;
                    var shift = $('#shift').val();
                    d.shift = shift;
                    var departemen = $('#departemen').val();
                    d.departemen = departemen;
                    delete d.columns;
                    // delete d.search;
                    delete d.order;
                },
            },
            columns: [
                { data: 'TANGGAL_DIBUAT' },
                { data: 'JAM_PULANG' },
                { data: 'NIK_PENGISI' },
                { data: 'NAMA_PENGISI' },
                { data: 'SHIFT' },
                { data: 'JAM_TIDUR' },
                { data: 'JAM_BANGUN' },
                {
                    data: 'TOTAL_TIDUR',
                    render: function(data) {
                        if (data === null || data === '') return '-';

                        var nilai = parseFloat(data);
                        var teks = data + ' Jam';

                        if (!isNaN(nilai) && nilai < 6) {
                            return '<span style="color:red;">' + teks + '</span>';
                        }
                        return '<span style="color:green;">' + teks + '</span>';
                    }
                },
                { data: 'JAM_BERANGKAT' },
                {
                    data: 'FIT_BEKERJA',
                    render: function(data) {
                        if (data == 0 || data === null || data === '') {
                            return '<span style="color:red;">Perlu Verifikasi</span>';
                        }
                        return '<span style="color:green;">Ya</span>';
                    }
                },
                { data: 'KELUHAN' },
                { data: 'MASALAH_PRIBADI' },
                {
                    data: 'PETUGAS_P3K',
                    render: function(data) {
                        return data && data !== '' ? data : '-';
                    }
                },
                {
                    data: 'CATATAN_P3K',
                    render: function(data) {
                        return data && data !== '' ? data : '-';
                    }
                },
                {
                    data: 'NIK_PENGAWAS',
                    render: function(data) {
                        return data && data !== '' ? data : '-';
                    }
                },
                {
                    data: 'NAMA_PENGAWAS',
                    render: function(data) {
                        return data && data !== '' ? data : '-';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        const verifP3k = Number(row.verif_p3k) === 1;
                        const verifPengawas = Number(row.ferivikasi_pengawas) === 1;

                        const butuhP3k =
                            row.BUTUH_P3K === true ||
                            row.BUTUH_P3K === 1 ||
                            row.BUTUH_P3K === '1';

                        const canVerifyP3k =
                            row.CAN_VERIFY_P3K === true ||
                            row.CAN_VERIFY_P3K === 1 ||
                            row.CAN_VERIFY_P3K === '1';

                        const canVerifyPengawas =
                            row.CAN_VERIFY_PENGAWAS === true ||
                            row.CAN_VERIFY_PENGAWAS === 1 ||
                            row.CAN_VERIFY_PENGAWAS === '1';

                        if (canVerifyP3k) {
                            return `
                                <div class="d-grid gap-1">
                                    <button class="btn-verifikasi-p3k badge w-100"
                                        data-id="${row.id}"
                                        data-fit="1"
                                        style="font-size:13px;background-color:#15803d;color:white;">
                                        Klinik FIT
                                    </button>

                                    <button class="btn-verifikasi-p3k badge w-100"
                                        data-id="${row.id}"
                                        data-fit="0"
                                        style="font-size:13px;background-color:#b91c1c;color:white;">
                                        Klinik TIDAK FIT
                                    </button>
                                </div>
                            `;
                        }

                        if (canVerifyPengawas) {
                            return `
                                <button class="btn-verifikasi-pengawas badge w-100"
                                    data-id="${row.id}"
                                    style="font-size:14px;background-color:#001932;color:white;">
                                    Verifikasi Pengawas
                                </button>
                            `;
                        }

                        // if (butuhP3k && !verifP3k) {
                        //     return `<span class="badge bg-warning text-dark w-100">Menunggu Klinik</span>`;
                        // }

                        if (!verifPengawas) {
                            return `<span class="badge bg-secondary w-100">Menunggu Pengawas</span>`;
                        }

                        return ``;
                    }
                }
            ],
            "order": [[0, "asc"]],
            "pageLength": 25,
            "lengthMenu": [10, 15, 25, 50],
        });

        $('#cariKKH').click(function() {
            table.ajax.reload();
        });
        table.ajax.reload();
    });


    let modalVerifikasiP3K;

$(document).ready(function() {
    modalVerifikasiP3K = new bootstrap.Modal(document.getElementById('modalVerifikasiP3K'));
});

$(document).on('click', '.btn-verifikasi-p3k', function(e) {
    e.preventDefault();

    const rowID = $(this).data('id');
    const fitOr = $(this).data('fit');

    $('#p3k_row_id').val(rowID);
    $('#p3k_fit_or').val(fitOr);
    $('#catatan_p3k_modal').val('');

    modalVerifikasiP3K.show();
});

$('#formVerifikasiP3K').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: "{{ route('kkh.verifikasi_p3k') }}",
        method: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            rowID: $('#p3k_row_id').val(),
            fit_or: $('#p3k_fit_or').val(),
            catatan: $('#catatan_p3k_modal').val()
        },
        success: function(response) {
            modalVerifikasiP3K.hide();
            table.ajax.reload(null, false);
        },
        error: function(xhr) {
            console.error(xhr);
        }
    });
});

$(document).on('click', '.btn-verifikasi-pengawas', function(e) {
    e.preventDefault();

    const rowID = $(this).data('id');

    $.ajax({
        url: "{{ route('kkh.verifikasi') }}",
        method: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            rowID: rowID
        },
        success: function(response) {
            table.ajax.reload(null, false);
        },
        error: function(xhr) {
            console.error(xhr);
            table.ajax.reload(null, false);
        }
    });
});
</script>

