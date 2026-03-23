@include('layout.head', ['title' => 'Permission Route'])
@include('layout.sidebar')
@include('layout.header')
<style>
    .table-group {
    background: #eef3ff;
    font-weight: 600;
}

table.dataTable td {
    vertical-align: middle;
}

.dataTables_wrapper .dataTables_scroll {
    overflow: auto;
}

</style>
<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Permission Route</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="deptTable" class="table table-striped table-bordered nowrap w-100">
                                <thead>
                                    <tr>
                                        <th width="50">No</th>
                                        <th width="180">Departemen</th>
                                        <th width="220">Nama</th>
                                        <th>Route</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($departemen as $d)

                                        {{-- Header group --}}
                                        <tr class="table-group">
                                            <td></td>
                                            <td><strong>{{ $d['departemen'] }}</strong></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        {{-- Items --}}
                                        @foreach($d['routes'] as $i => $r)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td></td>
                                            <td>{{ $r['name'] ?? '-' }}</td>
                                            <td>{{ $r['route'] }}</td>
                                        </tr>
                                        @endforeach

                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="card">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="roleTable" class="table table-striped table-bordered nowrap w-100">
                                <thead>
                                    <tr>
                                        <th width="50">No</th>
                                        <th width="180">Role</th>
                                        <th width="220">Nama</th>
                                        <th>Route</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($roles as $r)

                                        <tr class="table-group">
                                            <td></td>
                                            <td><strong>{{ $r['role'] }}</strong></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        @foreach($r['routes'] as $i => $rt)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td></td>
                                            <td>{{ $rt['name'] ?? '-' }}</td>
                                            <td>{{ $rt['route'] }}</td>
                                        </tr>
                                        @endforeach

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
        const datepicker_range = new DateRangePicker(document.querySelector('#pc-datepicker-10'), {
            buttonClass: 'btn'
        });
    })();

</script>
<script>
    function makeTable(id) {
        return $(id).DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 50,
            lengthMenu: [[10,25,50,100,-1],[10,25,50,100,'Semua']],
            order: [],
            columnDefs: [
                { orderable: false, targets: [0,1] }
            ],
            language: {
                lengthMenu: 'Tampilkan _MENU_ data',
                search: 'Cari:',
                paginate: { previous: '‹', next: '›' }
            }
        });
    }

    makeTable('#deptTable');
    makeTable('#roleTable');

</script>

