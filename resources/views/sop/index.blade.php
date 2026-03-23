@include('layout.head', ['title' => 'Standar Operasional Prosedur'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li style="font-size: 14pt"><a href="javascript: void(0)"><b>Standar Operasional Prosedur</b></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <form method="GET" action="">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Cari nama SOP / Departemen..."
                                            value="{{ request('search') }}">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-search"></i> Cari
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table id="example" class="table table-striped table-hover table-bordered nowrap">
                                <thead style="text-align: center; vertical-align: middle;">
                                   <tr>
                                        <th>No</th>
                                        <th>Nama File</th>
                                        <th>Departemen</th>
                                        <th>Aksi</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($sop as $s)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $s->nama_file }}</td>
                                            <td>{{ $s->nama_departemen }}</td>
                                            <td>
                                                <a href="{{ route('sop.preview', $s->uuid) }}"
                                                    class="btn btn-primary btn-sm d-inline-flex align-items-center gap-2 px-4 py-2">
                                                        <i class="fas fa-eye"></i>
                                                        <span>Lihat</span>
                                                </a>
                                            </td>
                                        </tr>
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
