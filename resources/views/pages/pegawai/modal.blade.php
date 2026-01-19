<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">TAMBAH DATA PEGAWAI</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form action="{{ route('pegawai.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="name" class="required form-label">Program Studi</label>
                                <select class="form-select" name="prodi" data-control="select2"
                                    data-placeholder="Pilih Program Studi" data-dropdown-parent="#kt_modal_1">
                                    <option></option>
                                    @foreach ($akreditas as $akreditas)
                                        <option value="{{ $akreditas->name }}">{{ $akreditas->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="nip" class="required form-label">NIP</label>
                                <input type="text" name="nip" class="form-control"
                                    placeholder="Masukan NIP Pegawai" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="name" class="required form-label">Nama</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Masukan Nama Pegawai" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="gender" class="required form-label">Jenis Kelamin</label>
                                <select class="form-select" name="gender" data-control="select2"
                                    data-placeholder="Pilih Jenis Kelamin" data-dropdown-parent="#kt_modal_1">
                                    <option></option>
                                    <option value="men">Perempuan</option>
                                    <option value="women">Laki-Laki</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="birth_place" class="required form-label">Tempat Lahir</label>
                                <input type="text" name="birth_place" class="form-control"
                                    placeholder="Masukan Tempat Lahir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="birth_date" class="required form-label">Tanggal Lahir</label>
                                <input class="form-control" name="birth_date" placeholder="Masukan Tanggal Lahir"
                                    id="kt_datepicker_1" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="address" class="required form-label">Alamat</label>
                                <input type="text" name="address" class="form-control"
                                    placeholder="Masukan Alamat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="religion" class="required form-label">Agama</label>
                                <select class="form-select" name="religion" data-control="select2"
                                    data-placeholder="Pilih Agama" data-dropdown-parent="#kt_modal_1">
                                    <option></option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="blood_type" class="required form-label">Golongan Darah</label>
                                <select class="form-select" name="blood_type" data-control="select2"
                                    data-placeholder="Pilih Golongan Darah" data-dropdown-parent="#kt_modal_1">
                                    <option></option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="generation" class="required form-label">Angkatan</label>
                                <input type="text" name="generation" class="form-control"
                                    placeholder="Masukan Angkatan" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="education" class="required form-label">Pendidikan</label>
                                <input type="text" name="education" class="form-control"
                                    placeholder="Masukan Pendidikan" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="work_bond" class="required form-label">Ikatan Kerja</label>
                                <select class="form-select" name="work_bond" data-control="select2"
                                    data-placeholder="Pilih Ikatan Kerja" data-dropdown-parent="#kt_modal_1">
                                    <option></option>
                                    <option value="tenaga pendidik">Tenaga Pendidik</option>
                                    <option value="dosen tetap">Dosen Tetap</option>
                                    <option value="dosen kontrak">Dosen Kontrak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="active_status" class="required form-label">Status Keaktifan</label>
                                <select class="form-select" name="active_status" data-control="select2"
                                    data-placeholder="Pilih Status Keaktifan" data-dropdown-parent="#kt_modal_1">
                                    <option></option>
                                    <option value="aktif">Aktif</option>
                                    <option value="cuti">Cuti</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="card_number_status" class="required form-label">Status No Pokok</label>
                                <input type="text" name="card_number_status" class="form-control"
                                    placeholder="Masukan Status No Pokok" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="phone_number" class="required form-label">No. Telp</label>
                                <input type="text" name="phone_number" class="form-control"
                                    placeholder="Masukan No. Telp" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
