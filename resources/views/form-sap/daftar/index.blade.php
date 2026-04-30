@include('layout.head', ['title' => 'Daftar Laporan Inspeksi PICA'])
@include('layout.sidebar')
@include('layout.header')

<style>
    #cbtn-selectors {
        width: 100% !important;
        table-layout: auto;
        border-collapse: collapse;
    }

    #cbtn-selectors thead th,
    #cbtn-selectors tbody td {
        white-space: normal !important;
        overflow-wrap: break-word;
        vertical-align: middle;
    }

    #cbtn-selectors thead th {
        text-align: center;
        vertical-align: middle;
        font-size: 13px;
        line-height: 1.3;
    }

    #cbtn-selectors tbody td {
        font-size: 13px;
        line-height: 1.35;
    }

    #cbtn-selectors .text-cell {
        white-space: normal !important;
        overflow-wrap: break-word;
    }

    #cbtn-selectors .text-center-cell {
        text-align: center;
    }

    #cbtn-selectors .img-cell {
        padding: 6px !important;
    }

    #cbtn-selectors .img-group {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        align-items: center;
        justify-content: center;
        max-width: 100%;
    }

    #cbtn-selectors .img-item {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        border: 1px solid #dcdcdc;
        border-radius: 4px;
        background: #fff;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #cbtn-selectors .img-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    #cbtn-selectors .img-empty {
        text-align: center;
        color: #888;
        font-size: 12px;
    }

    #cbtn-selectors .status-badge {
        display: inline-block;
        min-width: 62px;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
    }

    #cbtn-selectors .status-open {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffe69c;
    }

    #cbtn-selectors .status-close {
        background: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
    }

    #cbtn-selectors .aksi-cell {
        white-space: nowrap !important;
        text-align: center;
    }

    #cbtn-selectors .aksi-cell .badge {
        margin: 2px;
    }

    table.dataTable td,
    table.dataTable th {
        white-space: normal !important;
    }

    .dataTables_wrapper .dt-buttons {
        margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 12px;
    }

    #pc-datepicker-10 .btn {
        min-height: 38px;
        line-height: 1.2;
    }

    #pc-datepicker-10 a.btn,
    #pc-datepicker-10 button.btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    #pc-datepicker-10 .form-control {
        min-height: 38px;
    }

</style>

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0)">Daftar Laporan Inspeksi PICA</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-12">
                        <div class="mb-3 d-flex flex-wrap flex-md-nowrap align-items-center justify-content-between gap-2">

                            {{-- FILTER TANGGAL --}}
                            <div class="d-flex align-items-center">
                                <form action="" method="get">
                                    <div class="input-group input-group-sm" id="pc-datepicker-8">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            placeholder="Start date"
                                            name="rangeStart"
                                            style="max-width:160px"
                                            id="range-start">

                                        <span class="input-group-text">s/d</span>

                                        <input type="text"
                                            class="form-control form-control-sm"
                                            placeholder="End date"
                                            name="rangeEnd"
                                            style="max-width:160px"
                                            id="range-end">

                                        <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
                                        @if (in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT']))
                                            <button
                                                type="submit"
                                                name="export"
                                                value="excel"
                                                class="btn btn-success btn-sm d-inline-flex align-items-center justify-content-center gap-1 px-2"
                                            >
                                                <i class="fas fa-download"></i>
                                                <span>Download</span>
                                            </button>
                                        @endif
                                    </div>
                                </form>
                            </div>

                            {{-- ACTION BUTTON --}}
                            <div class="d-flex flex-wrap gap-2">

                                {{-- Kembali --}}
                                <a href="{{ url()->previous() }}">
                                    <span class="badge bg-secondary px-3 py-2" style="font-size:14px">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </span>
                                </a>

                                {{-- FOREMAN & SUPERVISOR --}}
                                @if (canAccess('form-pengawas-sap.index'))
                                    <a href="{{ route('form-pengawas-sap.index') }}">
                                        <span class="badge bg-success px-3 py-2" style="font-size:14px">
                                            <i class="fas fa-plus"></i> Isi Inpeksi
                                        </span>
                                    </a>
                                @endif

                                {{-- ADMIN & MANAGEMENT --}}
                                {{--
                                @if (canAccess('inspeksi.workshop.bundlepdf'))
                                    <a href="{{ route('inspeksi.workshop.bundlepdf') }}" target="_blank">
                                        <span class="badge bg-primary px-3 py-2" style="font-size:14px">
                                            <i class="fas fa-download"></i> Bundle PDF
                                        </span>
                                    </a>
                                @endif
                                --}}

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mode-desktop">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="cbtn-selectors" class="table table-striped table-hover table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 95px;">Tanggal Inspeksi</th>
                                        <th style="width: 120px;">Level</th>
                                        <th style="width: 120px;">Lokasi</th>
                                        <th style="width: 120px;">Inspektor</th>
                                        <th style="width: 220px;">Uraian Temuan</th>
                                        {{-- <th style="width: 110px;">Dokumentasi Temuan</th> --}}
                                        <th style="width: 95px;">Tingkat Risiko</th>
                                        <th style="width: 220px;">Rekomendasi Tindak Lanjut</th>
                                        <th style="width: 95px;">Due Date</th>
                                        <th style="width: 110px;">PIC</th>
                                        <th style="width: 105px;">Tanggal Perbaikan</th>
                                        {{-- <th style="width: 120px;">Dokumentasi Tindakan Perbaikan</th> --}}
                                        <th style="width: 90px;">Status</th>
                                        <th style="width: 120px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report as $item)
                                        {{-- @php
                                            $fotoTemuan = array_values(array_filter([
                                                $item->file_temuan ?? null,
                                                $item->file_temuan2 ?? null,
                                                $item->file_temuan3 ?? null,
                                            ]));

                                            $fotoPerbaikan = array_values(array_filter([
                                                $item->file_tindakLanjut ?? null,
                                                $item->file_tindakLanjut2 ?? null,
                                                $item->file_tindakLanjut3 ?? null,
                                            ]));
                                        @endphp --}}

                                        <tr>
                                            <td class="text-center-cell">{{ $loop->iteration }}</td>
                                            <td class="text-center-cell">
                                                {{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d-m-Y') ?? '-' }}
                                                {{ \Carbon\Carbon::parse($item->jam_kejadian)->format('H:i') ?? '-' }}
                                            </td>
                                            <td class="text-cell">{{ $item->level ?? '-' }}</td>
                                            <td class="text-cell">{{ $item->area ?? '-' }}</td>
                                            <td class="text-cell">
                                                {{ implode(', ', array_filter([
                                                    $item->inspektor1,
                                                    $item->inspektor2,
                                                    $item->inspektor3,
                                                    $item->inspektor4,
                                                    $item->inspektor5
                                                ])) ?: '-' }}
                                            </td>
                                            <td class="text-cell">{{ $item->temuan ?? '-' }}</td>

                                            {{-- <td class="img-cell">
                                                @if (count($fotoTemuan))
                                                    <div class="img-group">
                                                        @foreach ($fotoTemuan as $foto)
                                                            <a href="{{ $foto }}" target="_blank" class="img-item">
                                                                <img src="{{ $foto }}" alt="Dokumentasi Temuan">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="img-empty">-</div>
                                                @endif
                                            </td> --}}

                                            <td class="text-center-cell">{{ $item->tingkat_risiko ?? '-' }}</td>
                                            <td class="text-center-cell">{{ $item->tindak_lanjut ?? '-' }}</td>
                                            <td class="text-center-cell">
                                                {{ $item->due_date ? date('d-m-Y', strtotime($item->due_date)) : '-' }}
                                            </td>
                                            <td class="text-cell">{{ $item->departemen ?? '-' }}</td>
                                            <td class="text-center-cell">
                                                {{ $item->tanggal_perbaikan ? date('d-m-Y', strtotime($item->tanggal_perbaikan)) : '-' }}
                                            </td>

                                            {{-- <td class="img-cell">
                                                @if (count($fotoPerbaikan))
                                                    <div class="img-group">
                                                        @foreach ($fotoPerbaikan as $foto)
                                                            <a href="{{ $foto }}" target="_blank" class="img-item">
                                                                <img src="{{ $foto }}" alt="Dokumentasi Tindakan Perbaikan">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="img-empty">-</div>
                                                @endif
                                            </td> --}}

                                            <td class="text-center-cell">
                                                @if ($item->is_finish)
                                                    <span class="status-badge status-close">Close</span>
                                                @else
                                                    <span class="status-badge status-open">Open</span>
                                                @endif
                                            </td>

                                            <td class="aksi-cell">
                                                <a href="{{ route('form-pengawas-sap.rincian', $item->uuid) }}">
                                                    <span class="badge bg-success">Rincian</span>
                                                </a>

                                                @if (Auth::user()->role == 'ADMIN')
                                                    <a href="#">
                                                        <span
                                                            class="badge bg-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteLaporanSAP{{ $item->uuid }}"
                                                        >
                                                            <i class="fas fa-trash-alt"></i> Hapus
                                                        </span>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>

                                        @include('form-sap.delete')
                                    @endforeach
                                </tbody>
                            </table>
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
        new DateRangePicker(document.querySelector('#pc-datepicker-10'), {
            buttonClass: 'btn'
        });
    })();
</script>

<script>
    $('#basic-btn').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });

    $('#cbtn-selectors').DataTable({
        dom: 'Bfrtip',
        pageLength: 25,
        autoWidth: false,
        scrollX: false,
        columnDefs: [
            { targets: [0, 1, 6, 8, 10, 11, 12], className: 'text-center align-middle' },
            { targets: [12], orderable: false, searchable: false }
        ],
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11]
                }
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 6, 7, 8, 9, 10, 11]
                },
                customize: function (doc) {
                    doc.content[1].margin = [10, 10, 10, 10];
                    doc.styles.tableHeader.alignment = 'center';
                    doc.styles.tableHeader.fontSize = 9;
                    doc.defaultStyle.fontSize = 8;
                }
            },
            'colvis'
        ]
    });

    $('#excel-bg').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            customize: function (xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                $('row c[r^="F"]', sheet).each(function () {
                    if ($('is t', this).text().replace(/[^\d]/g, '') * 1 >= 500000) {
                        $(this).attr('s', '20');
                    }
                });
            }
        }]
    });

    $('#pdf-json').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            text: 'JSON',
            action: function (e, dt, button, config) {
                var data = dt.buttons.exportData();
                $.fn.dataTable.fileSave(new Blob([JSON.stringify(data)]), 'Export.json');
            }
        }]
    });
</script>
