@include('layout.head', ['title' => 'Payload & Ritation'])
@include('layout.sidebar')
@include('layout.header')
<style>
.payload-page {
    --payload-text: #111111;
    --payload-muted: #334155;
    --payload-surface: #ffffff;
    --payload-heading: #e7eef8;
    --payload-summary: #e9f1ff;
    --payload-total: #edf2f7;
    --payload-border: #cbd5e1;
    --payload-hover: #eaf1fa;
}
:is([data-pc-theme="dark"], [data-bs-theme="dark"], [data-theme="dark"], .dark, .dark-mode) .payload-page,
.payload-page:is([data-pc-theme="dark"], [data-bs-theme="dark"], [data-theme="dark"], .dark, .dark-mode) {
    --payload-text: #ffffff;
    --payload-muted: #e2e8f0;
    --payload-surface: #1e293b;
    --payload-heading: #334155;
    --payload-summary: #263d5b;
    --payload-total: #304158;
    --payload-border: #475569;
    --payload-hover: #35465e;
}
.payload-page .card,
.payload-page .card-body {
    background-color: var(--payload-surface);
    color: var(--payload-text);
}
.payload-page h5,
.payload-page .breadcrumb,
.payload-page .breadcrumb-item,
.payload-page .breadcrumb-item a {
    color: var(--payload-text) !important;
}
.payload-page .table-responsive {
    overflow-x: auto;
    width: 100%;
}
.payload-page table.table {
    width: 100%;
    border-color: var(--payload-border);
    color: var(--payload-text) !important;
}
.payload-page table.table th,
.payload-page table.table td {
    font-size: 13px;
    padding: 9px 10px;
    vertical-align: middle;
    white-space: nowrap;
    color: var(--payload-text) !important;
    background-color: var(--payload-surface);
    border-color: var(--payload-border);
}
.payload-page table.table thead th {
    background-color: var(--payload-heading) !important;
    font-weight: 700;
    text-align: center;
}
.payload-page #dom-jqry thead th {
    background-color: var(--payload-summary) !important;
}
.payload-page table.table tfoot td {
    background-color: var(--payload-total) !important;
    font-weight: 700;
}
.payload-page table.table tbody tr:hover td {
    background-color: var(--payload-hover) !important;
}
.payload-page #cbtn-selectors tbody td:nth-child(2) {
    background-color: var(--payload-surface);
    font-weight: 700;
}
.payload-page #cbtn-selectors tbody tr:hover td:nth-child(2) {
    background-color: var(--payload-hover);
}
.payload-page .table-container {
    overflow: visible;
}
.payload-page #cbtn-selectors {
    width: 100% !important;
    table-layout: auto;
}
.payload-page #cbtn-selectors th,
.payload-page #cbtn-selectors td {
    white-space: normal;
    overflow-wrap: break-word;
}
.payload-page .dataTables_wrapper,
.payload-page .dataTables_info,
.payload-page .dataTables_length,
.payload-page .dataTables_filter,
.payload-page .dataTables_paginate,
.payload-page .dt-buttons {
    color: var(--payload-text) !important;
}
.payload-page .dataTables_wrapper label,
.payload-page .dataTables_wrapper select,
.payload-page .dataTables_wrapper input {
    color: var(--payload-text) !important;
}
.payload-page .dataTables_wrapper select,
.payload-page .dataTables_wrapper input {
    background-color: var(--payload-surface);
    border: 1px solid var(--payload-border);
    border-radius: 6px;
    padding: 5px 9px;
}
.payload-page .dataTables_wrapper .paginate_button {
    color: var(--payload-text) !important;
}
.payload-page .dataTables_wrapper .dt-button {
    border-radius: 6px;
    padding: 6px 12px;
    margin-bottom: 8px;
}
@media (max-width: 767px) {
    .payload-page .card-body {
        padding: 14px;
    }
    .payload-page table.table th,
    .payload-page table.table td {
        font-size: 12px;
        padding: 8px;
    }
}
</style>
@php
    $dataCount = count($grouped);
    $totalPayloadLastHour = 0;
    $totalPayloadShift = 0;
    $totalPayloadShiftAve = 0;
    $totalPayloadToday = 0;
    $totalPayloadLess90 = 0;
    $totalPayload90115 = 0;
    $totalPayloadMore115 = 0;
    $totalRitAvgLast3Hour = 0;
    $totalRitAvgShift = 0;
    $totalRitAvgToday = 0;
    $totalRitLastHour = 0;
    $totalRitShift = 0;
    $totalRitShiftAve = 0;
    $totalRitToday = 0;
    $totalRitLast3Hour = 0;
    $countPayloadShift = 0;
    $totalPayloadShift110 = 0;
    $totalDistribution = 0;
@endphp
<section class="pc-container payload-page">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Payload & Ritation</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Excavator</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Resume Summary per EX</h5>
                        <div class="dt-responsive table-responsive">
                            <table id="dom-jqry" class="table table-striped table-hover table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Fleet</th>
                                        <th colspan="2">Payload</th>
                                        <th rowspan="2">Ritation</th>
                                    </tr>
                                    <tr>
                                        <th>Average</th>
                                        <th>> 120</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grouped as $key => $dt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dt['ASG_LOADERID'] }}</td>
                                            <td>{{ number_format($dt['PAYLOAD_SHIFT'], 0) }}</td>
                                            <td>{{ number_format($dt['PAYLOAD_MORE120'], 0) }}</td>
                                            <td>{{ number_format($dt['RIT_SHIFT'], 0) }}</td>
                                        </tr>
                                        @php
                                            if ($dt['PAYLOAD_SHIFT'] > 0) {
                                                $totalPayloadShiftAve += $dt['PAYLOAD_SHIFT'];
                                                $countPayloadShift++;
                                            }
                                            $totalPayloadShift110 += $dt['PAYLOAD_MORE120'];
                                            $totalRitShiftAve += $dt['RIT_SHIFT'];
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Total</td>
                                        <td>
                                            @if ($countPayloadShift > 0)
                                                {{ number_format($totalPayloadShiftAve / $countPayloadShift, 0) }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                                {{ $totalPayloadShift110 }}
                                        </td>
                                        <td>
                                            {{ number_format($totalRitShiftAve, 0) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5>All Summary per EX</h5>
                        <div class="dt-responsive table-responsive table-container">
                            <table id="cbtn-selectors" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="3">No</th>
                                        <th rowspan="3">Fleet</th>
                                        <th colspan="5">Payload</th>
                                        <th colspan="2">Ritation</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Average</th>
                                        <th colspan="3">Distribution</th>
                                        <th>Average</th>
                                        <th>Cummulative</th>
                                    </tr>
                                    <tr>
                                        <th>Last Hour</th>
                                        <th>This Shift</th>
                                        <th>< 90</th>
                                        <th>90 - 115</th>
                                        <th>> 115</th>
                                        <th>This Shift</th>
                                        <th>This Shift</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grouped as $key => $dt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dt['ASG_LOADERID'] }}</td>
                                            <td>{{ number_format($dt['PAYLOAD_LASTHOUR'], 0) }}</td>
                                            <td>{{ number_format($dt['PAYLOAD_SHIFT'], 0) }}</td>
                                            <td>{{ number_format($dt['PAYLOAD_LESS90'], 0) }}</td>
                                            <td>{{ number_format($dt['PAYLOAD_90115'], 0) }}</td>
                                            <td>{{ number_format($dt['PAYLOAD_MORE115'], 0) }}</td>
                                            <td>{{ number_format($dt['RITAVG_SHIFT'], 0) }}</td>
                                            <td>{{ number_format($dt['RIT_SHIFT'], 0) }}</td>
                                        </tr>
                                        @php
                                            $totalPayloadLastHour += $dt['PAYLOAD_LASTHOUR'];
                                            $totalPayloadShift += $dt['PAYLOAD_SHIFT'];
                                            $totalRitLast3Hour += $dt['RIT_LAST3HOUR'];
                                            $totalPayloadLess90 += $dt['PAYLOAD_LESS90'];
                                            $totalPayload90115 += $dt['PAYLOAD_90115'];
                                            $totalPayloadMore115 += $dt['PAYLOAD_MORE115'];
                                            $totalDistribution = $totalPayloadLess90 + $totalPayload90115 + $totalPayloadMore115;
                                            $totalRitAvgLast3Hour += $dt['RIT_LASTHOUR'];
                                            $totalRitAvgShift += $dt['RITAVG_SHIFT'];
                                            $totalRitLastHour += $dt['RIT_LASTHOUR'];
                                            $totalRitShift += $dt['RIT_SHIFT'];
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Total</td>
                                        <td>
                                            {{ $countPayloadShift != 0 ? number_format($totalPayloadLastHour / $countPayloadShift, 0) : 0 }}
                                        </td>
                                        <td>
                                            {{ $countPayloadShift != 0 ? number_format($totalPayloadShift / $countPayloadShift, 0) : 0 }}
                                        </td>
                                        <td>
                                            {{ number_format($totalPayloadLess90, 0) }}
                                        </td>
                                        <td>
                                            {{ number_format($totalPayload90115, 0) }}
                                        </td>
                                        <td>
                                            {{ number_format($totalPayloadMore115, 0) }}
                                        </td>
                                        <td>
                                            {{ number_format($totalRitAvgShift, 0) }}
                                        </td>
                                        <td>
                                            {{ number_format($totalRitShift, 0) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Persentasi</td>
                                        <td>
                                            {{ $totalDistribution > 0 ? number_format(($totalPayloadLess90 / $totalDistribution) * 100, 0) . '%' : '0%' }}
                                        </td>
                                        <td>
                                            {{ $totalDistribution > 0 ? number_format(($totalPayload90115 / $totalDistribution) * 100, 0) . '%' : '0%' }}
                                        </td>
                                        <td>
                                            {{ $totalDistribution > 0 ? number_format(($totalPayloadMore115 / $totalDistribution) * 100, 0) . '%' : '0%' }}
                                        </td>
                                        <td colspan="2"></td>
                                    </tr>
                                </tfoot>
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
    setTimeout(function() {
        location.reload();
    }, 300000);
</script>
<script>
    $('#basic-btn').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
    });
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
                orientation: 'landscape',
                pageSize: 'A3',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
                },
                customize: function (doc) {
                    doc.content[1].margin = [10, 10, 10, 10];
                }
            },
            'colvis'
        ],
        "pageLength": 15,
        paging: false,
        autoWidth: false
    });
    $('#excel-bg').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            customize: function (xlsx) {
                var sheet = xlsx.xl.worksheets['hallo.xml'];
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
