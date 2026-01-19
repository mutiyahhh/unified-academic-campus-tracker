<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">TAMBAH DATA PENERIMAAN MAHASISWA BARU</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form action="{{ route('pmb.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="mb-6">
                            <label for="prodi" class="required form-label">Program Studi</label>
                            <select class="form-select" name="prodi" data-control="select2"
                                data-placeholder="Pilih Program Studi" data-dropdown-parent="#kt_modal_1">
                                <option></option>
                                @foreach ($akreditas as $akreditas)
                                    <option value="{{ $akreditas->name }}">{{ $akreditas->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-6">
                            <label for="year" class="required form-label">Tahun Penerimaan</label>
                            <input type="text" name="year" class="form-control" placeholder="Masukan Tahun Penerimaan"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-6">
                            <label for="number_of_registrants" class="required form-label">Jumlah Pendaftar</label>
                            <input type="text" name="number_of_registrants" class="form-control"
                                placeholder="Masukan Jumlah Pendaftar" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-6">
                            <label for="quota_accepted" class="required form-label">Kuota Diterima</label>
                            <input type="text" name="quota_accepted" class="form-control"
                                placeholder="Masukan Kuota Diterima" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-6">
                            <label for="re_registration" class="required form-label">Pendaftar Ulang</label>
                            <input type="text" name="re_registration" class="form-control"
                                placeholder="Masukan Jumlah Pendaftar Ulang" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
