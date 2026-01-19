<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">TAMBAH DATA AKREDITASI</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form action="{{ route('akreditas.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="name" class="required form-label">Program Studi</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan Program Studi"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="university" class="required form-label">Perguruan Tinggi</label>
                                <input type="text" name="university" class="form-control"
                                    placeholder="Masukkan Perguruan Tinggi" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="level" class="required form-label">Strata</label>
                                <input type="text" name="level" class="form-control"
                                    placeholder="Masukkan Strata" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="region" class="required form-label">Wilayah</label>
                                <input type="text" name="region" class="form-control"
                                    placeholder="Masukkan Wilayah" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="sk_number" class="required form-label">No. SK</label>
                                <input type="text" name="sk_number" class="form-control"
                                    placeholder="Masukkan No. SK" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="sk_year" class="required form-label">Tahun SK</label>
                                <input type="text" name="sk_year" class="form-control"
                                    placeholder="Masukkan Tahun SK" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="rank" class="required form-label">Peringkat</label>
                                <input type="text" name="rank" class="form-control"
                                    placeholder="Masukkan Peringkat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="expired" class="required form-label">Tanggal Kadaluarsa</label>
                                <input class="form-control" name="expired" placeholder="Masukkan Tanggal Kadaluwarsa" id="kt_datepicker_1" required/>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
