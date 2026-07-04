<style>
    .wrap-sm{
        white-space: normal !important;
        word-break: break-word;
        overflow-wrap: anywhere;
        max-width: 150px;
    }

    .wrap-cell{
        white-space: normal !important;
        word-break: break-word;
        overflow-wrap: anywhere;
        max-width: 220px;
    }

    .wrap-lg{
        white-space: normal !important;
        word-break: break-word;
        overflow-wrap: anywhere;
        max-width: 320px;
    }

    #deletedTable th{
        white-space: nowrap;
        text-align:center;
        vertical-align:middle;
    }

    #deletedTable td{
        vertical-align:top;
    }

    .deleted-card{
        border:none;
        border-radius:12px;
        box-shadow:0 3px 12px rgba(0,0,0,.08);
    }

    .deleted-card .card-body{
        padding:15px;
    }
</style>


<div class="modal fade" id="trashHazardModal" tabindex="-1">

    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header bg-danger text-white">

                <div>

                    <h4 class="mb-1">
                        <i class="fas fa-trash-restore-alt me-2"></i>
                        Recycle Bin Hazard Report
                    </h4>

                    <small>
                        Data Hazard Report yang telah dihapus
                    </small>

                </div>

                <button
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="alert alert-warning border-0 shadow-sm">

                    <div class="d-flex">

                        <div class="me-3">

                            <i class="fas fa-info-circle fa-2x"></i>

                        </div>

                        <div>

                            <strong>Informasi</strong>

                            <br> Data masih dapat dipulihkan apabila diperlukan.

                        </div>

                    </div>

                </div>

                <div class="row mb-3">

                    <div class="col-md-3">

                        <div class="card deleted-card bg-light">

                            <div class="card-body">

                                <small class="text-muted">
                                    Total Data Dihapus
                                </small>

                                <h2 class="text-danger mb-0">

                                    {{ $deletedHazard->count() }}

                                </h2>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-9">

                        <input
                            type="text"
                            id="searchDeleted"
                            class="form-control"
                            placeholder="🔍 Cari No. Inspeksi, Departemen, Lokasi, Bahaya ...">

                    </div>

                </div>


                <div class="table-responsive">

                    <table
                        class="table table-hover table-bordered align-middle"
                        id="deletedTable"
                        style="table-layout:fixed;width:100%;">

                        <thead class="table-danger">

                        <tr>

                            <th width="60">No</th>

                            <th width="180">No. Inspeksi</th>

                            <th width="120">Tanggal</th>

                            <th width="180">Lokasi</th>

                            <th width="260">Bahaya</th>

                            <th width="60">Aksi</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($deletedHazard as $item)

                            <tr>

                                <td class="text-center">

                                    {{ $loop->iteration }}

                                </td>

                                <td class="wrap-sm">

                                    <strong>

                                        {{ $item->no_inspeksi }}

                                    </strong>

                                </td>

                                <td>

                                    {{ date('d-m-Y',strtotime($item->tanggal_pelaporan)) }}

                                    <br>

                                    <small class="text-muted">

                                        {{ date('H:i',strtotime($item->tanggal_pelaporan)) }}

                                    </small>

                                </td>

                                <td class="wrap-cell">

                                    {{ $item->lokasi }}

                                </td>

                                <td class="wrap-lg">

                                    {{ $item->bahaya }}

                                </td>


                                <td>

                                    <button
                                        type="button"
                                        class="btn btn-success btn-sm btnRestore"
                                        data-id="{{ $item->uuid }}"
                                        data-no="{{ $item->no_inspeksi }}">

                                        <i class="fas fa-trash-restore"></i>

                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8">

                                    <div class="text-center py-5">

                                        <i class="fas fa-trash fa-4x text-secondary mb-3"></i>

                                        <h4 class="mb-2">

                                            Recycle Bin Kosong

                                        </h4>

                                        <p class="text-muted">

                                            Tidak ada Hazard Report yang telah dihapus.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    <i class="fas fa-times me-1"></i>

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>
