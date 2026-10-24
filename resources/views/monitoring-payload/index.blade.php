@include('layout.head', ['title' => 'Monitoring Payload'])
@include('layout.sidebar')
@include('layout.header')
<style>
.pc-content {
    color: #111111;
}
.pc-content .card {
    border: 1px solid #dbe2eb;
    border-radius: 12px;
    overflow: hidden;
}
.pc-content .card-body {
    padding: 20px;
}
.pc-content h5,
.pc-content .form-label,
.pc-content .table,
.pc-content .table th,
.pc-content .table td,
.pc-content .dataTables_info,
.pc-content .dataTables_length,
.pc-content .dataTables_filter,
.pc-content .page-link {
    color: #111111 !important;
}
.pc-content .form-select,
.pc-content .form-control {
    color: #111111 !important;
    background-color: #ffffff !important;
    border-color: #cbd5e1 !important;
}
.pc-content .table-responsive {
    width: 100%;
    overflow-x: visible;
    overflow-y: visible;
}
#cbtn-selectors {
    width: 100% !important;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 13px;
}
#cbtn-selectors thead th {
    background: #dbeafe !important;
    color: #111111 !important;
    font-weight: 700;
    padding: 11px 8px;
    vertical-align: middle;
    text-align: center;
    border-color: #cbd5e1;
    white-space: normal;
}
#cbtn-selectors tbody td {
    color: #111111 !important;
    padding: 10px 8px;
    vertical-align: middle;
    border-color: #e2e8f0;
}
#cbtn-selectors tbody tr:nth-child(odd) td {
    background: #ffffff !important;
}
#cbtn-selectors tbody tr:nth-child(even) td {
    background: #f3f6fb !important;
}
#cbtn-selectors tbody tr:hover td {
    background: #e8f1ff !important;
}
#cbtn-selectors tfoot td {
    background: #e2edfc !important;
    color: #111111 !important;
    font-weight: 700;
    padding: 11px 8px;
}
.pc-content .dt-buttons .btn {
    margin-bottom: 6px;
}
.pc-content .dataTables_wrapper {
    width: 100%;
}
[data-pc-theme="dark"] .pc-content,
[data-pc-theme="dark"] .pc-content h5,
[data-pc-theme="dark"] .pc-content .form-label,
[data-pc-theme="dark"] .pc-content .table,
[data-pc-theme="dark"] .pc-content .table th,
[data-pc-theme="dark"] .pc-content .table td,
[data-pc-theme="dark"] .pc-content .dataTables_info,
[data-pc-theme="dark"] .pc-content .dataTables_length,
[data-pc-theme="dark"] .pc-content .dataTables_filter,
[data-pc-theme="dark"] .pc-content .page-link,
[data-bs-theme="dark"] .pc-content,
[data-bs-theme="dark"] .pc-content h5,
[data-bs-theme="dark"] .pc-content .form-label,
[data-bs-theme="dark"] .pc-content .dataTables_info,
[data-bs-theme="dark"] .pc-content .dataTables_length,
[data-bs-theme="dark"] .pc-content .dataTables_filter {
    color: #ffffff !important;
}
[data-pc-theme="dark"] .pc-content .card,
[data-bs-theme="dark"] .pc-content .card {
    background: #1c2431 !important;
    border-color: #3b4759 !important;
}
[data-pc-theme="dark"] .pc-content .form-select,
[data-pc-theme="dark"] .pc-content .form-control,
[data-bs-theme="dark"] .pc-content .form-select,
[data-bs-theme="dark"] .pc-content .form-control {
    background-color: #202b3b !important;
    border-color: #506079 !important;
    color: #ffffff !important;
}
[data-pc-theme="dark"] #cbtn-selectors thead th,
[data-bs-theme="dark"] #cbtn-selectors thead th {
    background: #2d405a !important;
    color: #ffffff !important;
    border-color: #465771;
}
[data-pc-theme="dark"] #cbtn-selectors tbody td,
[data-bs-theme="dark"] #cbtn-selectors tbody td {
    color: #ffffff !important;
    border-color: #3b4759;
}
[data-pc-theme="dark"] #cbtn-selectors tbody tr:nth-child(odd) td,
[data-bs-theme="dark"] #cbtn-selectors tbody tr:nth-child(odd) td {
    background: #1c2431 !important;
}
[data-pc-theme="dark"] #cbtn-selectors tbody tr:nth-child(even) td,
[data-bs-theme="dark"] #cbtn-selectors tbody tr:nth-child(even) td {
    background: #253246 !important;
}
[data-pc-theme="dark"] #cbtn-selectors tbody tr:hover td,
[data-bs-theme="dark"] #cbtn-selectors tbody tr:hover td {
    background: #32455e !important;
}
[data-pc-theme="dark"] #cbtn-selectors tfoot td,
[data-bs-theme="dark"] #cbtn-selectors tfoot td {
    background: #304760 !important;
    color: #ffffff !important;
}
@media (max-width: 768px) {
    .pc-content .card-body {
        padding: 14px;
    }
    #cbtn-selectors {
        font-size: 12px;
    }
    #cbtn-selectors thead th,
    #cbtn-selectors tbody td,
    #cbtn-selectors tfoot td {
        padding: 8px 5px;
    }
    .pc-content .dt-buttons.btn-group.flex-wrap {
        display: none;
    }
}
</style>
@php
$total_LESS_THAN_90 = 0;
$total_BETWEEN_100_AND_115 = 0;
$total_GREATHER_THAN_115 = 0;
$total_MAX_PAYLOAD = 0;
$count = 0;
$sum_2 =  0;
$count_a = 0;
$count_b = 0;
$total_LESS_THAN_100_khusus = 0;
$total_BETWEEN_100_AND_115_khusus = 0;
$total_GREATHER_THAN_115_khusus = 0;
$total_MAX_PAYLOAD_khusus = 0;
$count_khusus = 0;
$sum_2_khusus =  0;
$count_a_khusus = 0;
$count_b_khusus = 0;
$total_LESS_THAN_100_2023 = 0;
$total_BETWEEN_100_AND_115_2023 = 0;
$total_GREATHER_THAN_115_2023 = 0;
$total_MAX_PAYLOAD_2023 = 0;
$count_2023 = 0;
$sum_2_2023 =  0;
$count_a_2023 = 0;
$count_b_2023 = 0;
$total_ritasi_2023 = 0;
$PAYLOAD_AVERAGE_2023 = 0;
$payload_max_2023 = 0;
$grand_total_ritasi_2023 = 0;
@endphp
<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="row">
                        <form action="" method="get" class="w-100">
                            <div class="col-12 col-md-4 d-flex align-items-center">
                                <div class="mb-3 me-2 w-100">
                                    <label for="unit" class="form-label">Unit</label>
                                    <select class="form-select" data-trigger name="unit" id="unit">
                                        <option value="" disabled {{ request('unit') ? '' : 'selected' }}>Pilih unit</option>
                                        @foreach ($data['unit'] as $u)
                                            <option value="{{ $u->VHC_ID }}" @selected(request('unit') == $u->VHC_ID)>{{ $u->VHC_ID }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success" style="font-size:16px;">Tampilkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Monitoring Payload</h5>
                        <div class="dt-responsive table-responsive">
                            <table id="cbtn-selectors" class="table table-striped table-hover table-bordered">
                                <thead style="text-align: center; vertical-align: middle;">
                                    <tr>
                                        <th rowspan="2">Unit</th>
                                        <th colspan="3">Distribusi Payload</th>
                                        <th rowspan="2" style="word-wrap: break-word; white-space: normal;">Maksimal Payload</th>
                                    </tr>
                                    <tr>
                                        <th>&lt; 90</th>
                                        <th>90 - 115</th>
                                        <th>> 115</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['payload'] as $py)
                                    @php
                                        $count++;
                                        if ($py['GREATHER_THAN_115'] > 0) {
                                            $count_a++;
                                        }
                                        if ($py['MAX_PAYLOAD'] > 0) {
                                            $count_b++;
                                        }
                                        $sum_2 += $py['LESS_THAN_90'] + $py['BETWEEN_100_AND_115'] + $py['GREATHER_THAN_115'];
                                        $total_LESS_THAN_90 += $py['LESS_THAN_90'];
                                        $total_BETWEEN_100_AND_115 += $py['BETWEEN_100_AND_115'];
                                        $total_GREATHER_THAN_115 += $py['GREATHER_THAN_115'];
                                        $total_MAX_PAYLOAD += $py['MAX_PAYLOAD'];
                                    @endphp
                                        <tr>
                                            <td>{{ $py['VHC_ID'] }}</td>
                                            <td style="text-align: center">{{ round($py['LESS_THAN_90'], 1) }}</td>
                                            <td style="text-align: center">{{ round($py['BETWEEN_90_AND_115'], 1) }}</td>
                                            <td style="text-align: center">{{ round($py['GREATHER_THAN_115'], 1) }}</td>
                                            <td style="text-align: center">{{ round($py['MAX_PAYLOAD'], 1) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>%</td>
                                        <td style="text-align: center">{{ $sum_2 != 0 ? round($total_LESS_THAN_90 / $sum_2, 2 ) * 100 : 0 }}</td>
                                        <td style="text-align: center">{{ $sum_2 != 0 ? round($total_BETWEEN_100_AND_115 / $sum_2, 2 ) * 100 : 0 }}</td>
                                        <td style="text-align: center">{{ $sum_2 != 0 ? round($total_GREATHER_THAN_115 / $sum_2, 2 ) * 100 : 0 }}</td>
                                        <td style="text-align: center">{{ $count_b != 0 ? round($total_MAX_PAYLOAD / $count_b, 1) : 0 }}</td>
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
    setTimeout(function () {
        location.reload();
    }, 300000);
</script>
<script>
    (function () {
        const pickerElement = document.querySelector('#pc-datepicker-5');
        if (!pickerElement || typeof DateRangePicker === 'undefined') return;
        const datepicker_range = new DateRangePicker(pickerElement, {
            buttonClass: 'btn'
        });
    })();
</script>
<script>
    $('#basic-btn').DataTable({
        dom: 'Bfrtip',
        buttons: ['excel', 'print']
    });
    $('#cbtn-selectors').DataTable({
        dom: 'Bfrtip',
        pageLength:20,
        buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, ':visible'],
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
                orientation: 'portrait',
                pageSize: 'A4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                    format: {
                        body: function(data, row, column, node) {
                            return data
                                .replace(/&lt;/g, '<')
                                .replace(/&gt;/g, '>')
                                .replace(/&amp;/g, '&');
                        }
                    }
                },
                customize: function (doc) {
                    doc.content[1].margin = [10, 10, 10, 10];
                }
            },
            'colvis'
        ]
    });
    $('#cbtn-selectors-khusus').DataTable({
        dom: 'Bfrtip',
        pageLength:15,
        buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, ':visible'],
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
                orientation: 'portrait',
                pageSize: 'A4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                    format: {
                        body: function(data, row, column, node) {
                            return data
                                .replace(/&lt;/g, '<')
                                .replace(/&gt;/g, '>')
                                .replace(/&amp;/g, '&');
                        }
                    }
                },
                customize: function (doc) {
                    doc.content[1].margin = [10, 10, 10, 10];
                }
            },
            'colvis'
        ]
    });
    $('#cbtn-selectors-2023').DataTable({
        dom: 'Bfrtip',
        pageLength:15,
        buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, ':visible'],
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
                orientation: 'portrait',
                pageSize: 'A4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                    format: {
                        body: function(data, row, column, node) {
                            return data
                                .replace(/&lt;/g, '<')
                                .replace(/&gt;/g, '>')
                                .replace(/&amp;/g, '&');
                        }
                    }
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
