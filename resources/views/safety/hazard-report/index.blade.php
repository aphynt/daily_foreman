@include('layout.head', ['title' => 'Daftar Laporan Inspeksi'])
@include('layout.sidebar')
@include('layout.header')

<style>
    .mode-desktop {
        display: block;
    }
    .mode-hp {
        display: none;
    }

    @media (max-width: 768px) {
        .mode-desktop {
            display: none;
        }
        .mode-hp {
            display: block;
        }
    }
    .accordion-modern .accordion-item{
        border:none;
        border-radius:12px;
        margin-bottom:12px;
        overflow:hidden;
        box-shadow:0 4px 14px rgba(0,0,0,0.06);
    }

    .accordion-modern .accordion-button{
        background:#ffffff;
        font-weight:600;
        font-size:14px;
        padding:14px 18px;
    }

    .accordion-modern .accordion-button:not(.collapsed){
        background:#f8fafc;
        color:#111;
        box-shadow:none;
    }

    .accordion-modern .accordion-body{
        background:#fafafa;
        padding:20px;
    }

    .info-label{
        font-size:13px;
        font-weight:600;
        color:#666;
        margin-bottom:4px;
    }

    .info-value{
        font-size:14px;
        color:#222;
    }

    .btn-action{
        padding:6px 14px;
        border-radius:8px;
        font-size:13px;
        font-weight:500;
        text-decoration:none;
    }

    .btn-rincian{
        background:#22c55e;
        color:white;
    }

    .btn-rincian:hover{
        background:#16a34a;
    }

    .btn-hapus{
        background:#ef4444;
        color:white;
    }

    .btn-hapus:hover{
        background:#dc2626;
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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Daftar Laporan Inspeksi</a></li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 d-flex flex-wrap flex-md-nowrap align-items-center justify-content-between gap-2">

                            {{-- FILTER TANGGAL --}}
                            <div class="d-flex align-items-center">
                                <form action="" method="get">
                                    <div class="input-group input-group-sm" id="pc-datepicker-10">
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
                                @if (canAccess('hazard-report.insert'))
                                    <a href="{{ route('hazard-report.insert') }}">
                                        <span class="badge bg-success px-3 py-2" style="font-size:14px">
                                            <i class="fas fa-plus"></i> Buat Hazard Report
                                        </span>
                                    </a>
                                @endif

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mode-hp">
            <div class="col-sm-12">
                <div class="card">
                    <div class="accordion accordion-modern" id="accordionFlushExample">
                        @foreach ($hazard as $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse{{ $item->uuid }}">

                                    <div class="d-flex justify-content-between w-100 align-items-center">

                                        <span>
                                        {{ $loop->iteration }}.
                                        {{ date('d M Y', strtotime($item->tanggal_pelaporan)) }}
                                        • {{ date('H:i', strtotime($item->tanggal_pelaporan)) }}
                                        </span>

                                            @if ($item->status == 0)
                                                <span class="badge bg-warning">Review</span>
                                            @elseif($item->status == 1)
                                                <span class="badge bg-info">Open</span>
                                            @else
                                                <span class="badge bg-success">Close</span>
                                            @endif

                                    </div>

                                </button>
                            </h2>
                            <div id="flush-collapse{{ $item->uuid }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">

                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <div class="info-label">No. Inspeksi</div>
                                        <div class="info-value">{{ $item->no_inspeksi ?? '-' }}</div>
                                    </div>

                                    <div class="col-6 mb-3">
                                        <div class="info-label">Shift</div>
                                        <div class="info-value">{{ $item->shift ?? '-' }}</div>
                                    </div>

                                    <div class="col-6 mb-3">
                                        <div class="info-label">Departemen</div>
                                        <div class="info-value">{{ $item->nama_departemen ?? '-' }}</div>
                                    </div>

                                    <div class="col-6 mb-3">
                                        <div class="info-label">Kepada</div>
                                        <div class="info-value">{{ $item->kepada ?? '-' }}</div>
                                    </div>

                                    <div class="col-6 mb-3">
                                        <div class="info-label">Lokasi</div>
                                        <div class="info-value">{{ $item->lokasi ?? '-' }}</div>
                                     </div>

                                </div>

                                    <div class="mt-3">

                                        <a href="{{ route('hazard-report.review', $item->uuid) }}"
                                            class="btn-action btn-rincian me-2">
                                            Lihat
                                        </a>

                                        @if (Auth::user()->role == 'ADMIN')
                                        <a href="#"
                                            class="btn-action btn-hapus"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteHazardReport{{ $item->uuid }}">
                                            Hapus
                                        </a>
                                        @endif

                                    </div>

                                </div>

                            </div>
                        </div>
                        {{-- @include('safety.hazard-report.delete') --}}

                        @endforeach

                      </div>
                </div>
            </div>
        </div>

        <div class="row mode-desktop">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="cbtn-selectors" class="table table-striped table-hover table-bordered nowrap">
                                <thead style="text-align: center; vertical-align: middle;">
                                    <tr>
                                        <th>No</th>
                                        <th>No. Inspeksi</th>
                                        <th>Tanggal Pelaporan</th>
                                        <th>Jam Kejadian</th>
                                        <th>Shift</th>
                                        <th>Kepada</th>
                                        <th>Departemen</th>
                                        <th>Lokasi</th>
                                        <th>Status SCC</th>
                                        <th>Status Penerima</th>
                                        <th>Aksi</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($hazard as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_inspeksi }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_pelaporan)) }}</td>
                                        <td>{{ date('H:i', strtotime($item->tanggal_pelaporan)) }}</td>
                                        <td>{{ $item->shift }}</td>
                                        <td>{{ $item->kepada }}</td>
                                        <td>{{ $item->nama_departemen }}</td>
                                        <td>{{ $item->lokasi }}</td>
                                        <td>
                                            @if ($item->verified_scc == 'reject')
                                                <span class="badge bg-danger">Reject</span>
                                            @elseif($item->verified_scc == 'accept')
                                                <span class="badge bg-success">Accepted</span>
                                            @else
                                                <span class="badge bg-info">Review</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 0)
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($item->status == 1)
                                                <span class="badge bg-info">Open</span>
                                            @else
                                                <span class="badge bg-success">Close</span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-3 text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('hazard-report.review', $item->uuid) }}"
                                                class="btn btn-sm btn-success rounded-pill px-3 shadow-sm">
                                                    <i class="fas fa-eye me-1"></i> Lihat
                                                </a>

                                                @if (Auth::user()->role == 'ADMIN')
                                                    <button class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteHazardReport{{ $item->uuid }}">
                                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @include('safety.hazard-report.delete')
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
        const datepicker_range = new DateRangePicker(document.querySelector('#pc-datepicker-10'), {
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
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
                },
                customize: function (doc) {
                    doc.content[1].margin = [10, 10, 10, 10];
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

    // [ Custom File (JSON) ]
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

