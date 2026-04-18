@include('layout.head', ['title' => 'Inspeksi Tidak Terencana dan Kepatuhan Golden Rules'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li> --}}
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Inspeksi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Tidak Terencana dan Kepatuhan Golden Rules</a></li>
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
                                @if (canAccess('inspeksi.tidakterencana.insert'))
                                    <a href="{{ route('inspeksi.tidakterencana.insert') }}">
                                        <span class="badge bg-success px-3 py-2" style="font-size:14px">
                                            <i class="fas fa-plus"></i> Isi Inspeksi
                                        </span>
                                    </a>
                                @endif

                                {{-- ADMIN & MANAGEMENT --}}
                                {{--
                                @if (canAccess('inspeksi.tidakterencana.bundlepdf'))
                                    <a href="{{ route('inspeksi.tidakterencana.bundlepdf') }}" target="_blank">
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
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="cbtn-selectors" class="table table-striped table-hover table-bordered nowrap">
                                <thead style="text-align: center; vertical-align: middle;">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">NIK</th>
                                        <th rowspan="2">Nama</th>
                                        <th rowspan="2">Hari/Tanggal</th>
                                        <th rowspan="2">Waktu</th>
                                        <th rowspan="2">Kode Pelanggaran</th>
                                        <th colspan="2">PIC</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pages as $pageIndex => $page)
                                        <table border="1" width="100%" cellspacing="0" cellpadding="4">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">Nama</th>
                                                    <th rowspan="2">NIK/Unit ID</th>
                                                    <th rowspan="2">Tanggal</th>
                                                    <th rowspan="2">Waktu</th>
                                                    <th colspan="5">Pelanggaran</th>
                                                    <th rowspan="2">Keterangan</th>
                                                </tr>
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for($i = 0; $i < 30; $i++)
                                                    @php $row = $page[$i] ?? null; @endphp
                                                    <tr>
                                                        <td>{{ $i + 1 }}</td>
                                                        <td>{{ $row->nama ?? '' }}</td>
                                                        <td>{{ $row->nik ?? '' }}</td>
                                                        <td>{{ $row->tanggal ?? '' }}</td>
                                                        <td>{{ $row->waktu ?? '' }}</td>
                                                        <td>{{ isset($row) && $row->level == 1 ? '✓' : '' }}</td>
                                                        <td>{{ isset($row) && $row->level == 2 ? '✓' : '' }}</td>
                                                        <td>{{ isset($row) && $row->level == 3 ? '✓' : '' }}</td>
                                                        <td>{{ isset($row) && $row->level == 4 ? '✓' : '' }}</td>
                                                        <td>{{ isset($row) && $row->level == 5 ? '✓' : '' }}</td>
                                                        <td>{{ $row->keterangan ?? '' }}</td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>

                                        @if(!$loop->last)
                                            <div style="page-break-after: always;"></div>
                                        @endif
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
    // range picker
    (function () {
        const datepicker_range = new DateRangePicker(document.querySelector('#pc-datepicker-8'), {
            buttonClass: 'btn'
        });
    })();

</script>
<script>
    // [ HTML5 Export Buttons ]
    $('#basic-btn').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });

    // [ Column Selectors ]
    $('#cbtn-selectors').DataTable({
        dom: 'Bfrtip',
        order: [[1, 'asc'], [3, 'asc'], [4, 'asc']],
        rowGroup: {
            dataSrc: 1 // kolom NIK
        },
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: { columns: [0, ':visible'] }
            },
            {
                extend: 'excelHtml5',
                exportOptions: { columns: ':visible' }
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ]
    });
    // [ Excel - Cell Background ]
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

