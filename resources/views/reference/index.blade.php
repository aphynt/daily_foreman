@include('layout.head', ['title' => 'Reference'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Reference</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-2 mb-2 d-flex align-items-end">
                        <a href="#" class="btn btn-success w-100" style="padding-top:10px;padding-bottom:10px;" data-bs-toggle="modal" data-bs-target="#tambahReferensi">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                    @include('reference.modal.insert')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="refTable" class="table table-striped table-bordered nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Keterangan</th>
                                        <th>Is Active</th>
                                        <th>Value</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($config as $conf)
                                        <tr>
                                            <td>{{ $conf->id }}</td>
                                            <td>{{ $conf->keterangan }}</td>
                                            <td>
                                                <div class="form-check form-switch custom-switch-v1 mb-2"><input type="checkbox"
                                                    class="form-check-input input-light-success" id="customswitchlightv1-3"
                                                    {{ $conf->statusenabled == true ? 'checked' : '' }} disabled>
                                            </td>
                                            <td>{{ $conf->value }}</td>
                                            <td>
                                                <div class="col-12 col-md-2 mb-2 d-flex align-items-end">
                                                    <a href="#" class="btn btn-warning" style="padding-left:10px;padding-right:10px;" data-bs-toggle="modal" data-bs-target="#editReferensi{{ $conf->id }}">
                                                        Edit
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @include('reference.modal.edit')
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

    makeTable('#refTable');
</script>

