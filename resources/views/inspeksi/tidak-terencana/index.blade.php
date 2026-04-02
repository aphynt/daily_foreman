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
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}
                                            <td>{{ date('H:i', strtotime($item->waktu)) }}
                                            <td>{{ $item->pelanggaran }}</td>
                                            <td>{{ $item->inspektor }}</td>
                                            <td>{{ $item->inspektor }}</td>
                                            <td>
                                                <a href="{{ route('inspeksi.slurrypump.preview', $item->uuid) }}" class="avtar avtar-s btn btn-primary btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm0-2h14V7H5zm7-2q-2.05 0-3.662-1.112T6 13q.725-1.775 2.338-2.887T12 9t3.663 1.113T18 13q-.725 1.775-2.337 2.888T12 17m0-2.5q-.625 0-1.062-.437T10.5 13t.438-1.062T12 11.5t1.063.438T13.5 13t-.437 1.063T12 14.5m0 1q1.05 0 1.775-.725T14.5 13t-.725-1.775T12 10.5t-1.775.725T9.5 13t.725 1.775T12 15.5"/></svg>
                                                </a>
                                                <a href="#" class="avtar avtar-s btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSP{{$item->id}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7 6v13zm4.25 15H7q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v4.3q-.425-.125-.987-.213T17 10V6H7v13h3.3q.15.525.4 1.038t.55.962M9 17h1q0-1.575.5-2.588L11 13.4V8H9zm4-5.75q.425-.275.963-.55T15 10.3V8h-2zM17 22q-2.075 0-3.537-1.463T12 17t1.463-3.537T17 12t3.538 1.463T22 17t-1.463 3.538T17 22m1.65-2.65l.7-.7l-1.85-1.85V14h-1v3.2z"/></svg>
                                                </a>
                                            </td>
                                        </tr>
                                        @include('inspeksi.slurry-pump.delete')
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
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                },
                customize: function (doc) {
                    // Menyesuaikan margin atau pengaturan tambahan
                    doc.content[1].margin = [10, 10, 10, 10]; // Atur margin [kiri, atas, kanan, bawah]
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

