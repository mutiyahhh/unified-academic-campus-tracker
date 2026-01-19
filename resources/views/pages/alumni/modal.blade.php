<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">TAMBAH DATA ALUMNI</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form action="{{ route('alumni.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="name" class="required form-label">Program Studi</label>
                                <select class="form-select" name="prodi" data-control="select2" data-placeholder="Pilih Program Studi" data-dropdown-parent="#kt_modal_1">
                                    <option></option>
                                    @foreach ($akreditas as $akreditas)
                                    <option value="{{ $akreditas->name }}">{{ $akreditas->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="nim" class="required form-label">NIM</label>
                                <input type="text" name="nim" class="form-control"
                                    placeholder="Masukan NIM Alumni" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="name" class="required form-label">Nama</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Masukan Nama Alumni" required>
                            </div>
                        </div>
                       <div class="col-md-6">
                        <div class="mb-6">
                        <label for="gender" class="required form-label">Jenis Kelamin</label>
                                {{-- select input --}}
                                <select class="form-select" name="gender" data-control="select2" data-placeholder="Pilih Jenis Kelamin" data-dropdown-parent="#kt_modal_1">
                                    <option></option>
                                    <option value="woman">Perempuan</option>
                                    <option value="men">Laki-Laki</option>
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
                                    placeholder="Masukan Alamat Mahasiswa" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="religion" class="required form-label">Agama</label>
                                <select class="form-select" name="religion" data-control="select2" data-placeholder="Pilih Agama" data-dropdown-parent="#kt_modal_1">
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
                                <select class="form-select" name="blood_type" data-control="select2" data-placeholder="Pilih Golongan Darah" data-dropdown-parent="#kt_modal_1">
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
                                <label for="entry_year" class="required form-label">Tahun Masuk</label>
                                <input type="text" name="entry_year" class="form-control"
                                    placeholder="Masukan Tahun Masuk" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="graduation_year" class="required form-label">Tahun Lulus</label>
                                <input type="text" name="graduation_year" class="form-control"
                                    placeholder="Masukan Tahun Lulus" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="work_status" class="required form-label">Status Pekerjaan</label>
                                <select class="form-select" name="work_status" data-control="select2" data-placeholder="Pilih Status Pekerjaan" data-dropdown-parent="#kt_modal_1">
                                    <option></option>
                                    <option value="bekerja">Bekerja</option>
                                    <option value="tidak bekerja">Tidak Bekerja</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="work_waiting_time" class="required form-label">Waktu Tunggu Kerja</label>
                                <input type="text" name="work_waiting_time" class="form-control"
                                    placeholder="Masukan Waktu Tunggu Kerja" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="institution_name" class="required form-label">Nama Institusi</label>
                                <input type="text" name="institution_name" class="form-control"
                                    placeholder="Masukan Nama Institusi" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="job_according_major" class="required form-label">Pekerjaan Sesuai Jurusan</label>
                                <select class="form-select" name="job_according_major" data-control="select2" data-placeholder="Pilih Pekerjaan Sesuai Jurusan" data-dropdown-parent="#kt_modal_1">
                                    <option></option>
                                    <option value="sesuai">Sesuai</option>
                                    <option value="tidak sesuai">Tidak Sesuai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
