<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">TAMBAH DATA MAHASISWA</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form action="{{ route('mahasiswa.store') }}" method="post">
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
                                    placeholder="Masukan NIM Mahasiswa" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="nik" class="required form-label">NIK</label>
                                <input type="text" 
                                       name="nik" 
                                       id="nik" 
                                       class="form-control"
                                       placeholder="Masukan NIK (16 digit)" 
                                       maxlength="16" 
                                       pattern="[0-9]{16}"
                                       required
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 16) this.value = this.value.slice(0, 16);">
                                <div class="form-text text-muted">NIK harus tepat 16 digit angka</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="name" class="required form-label">Nama</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Masukan Nama Mahasiswa" required>
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
                                <label for="phone_number" class="required form-label">No. Telp</label>
                                <input type="text" name="phone_number" class="form-control"
                                    placeholder="Masukan No. Telp" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="gender" class="required form-label">Jenis Kelamin</label>
                                {{-- select input --}}
                                <select class="form-select" name="gender" data-control="select2" data-placeholder="Pilih Jenis kelamin" data-dropdown-parent="#kt_modal_1">
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
                                <label for="mothers_name" class="required form-label">Nama Ibu</label>
                                <input type="text" name="mothers_name" class="form-control"
                                    placeholder="Masukan Nama Ibu" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="fathers_name" class="required form-label">Nama Ayah</label>
                                <input type="text" name="fathers_name" class="form-control"
                                    placeholder="Masukan Nama Ayah" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="generation" class="required form-label">Angkatan</label>
                                <input type="text" 
                                       name="generation" 
                                       id="generation" 
                                       class="form-control"
                                       placeholder="2020" 
                                       maxlength="4"
                                       required>
                                <div class="form-text text-muted">(contoh: 2021)</div>
                                <div id="generation_error" class="form-text text-danger" style="display: none;">Only allow year format (e.g. 2020)</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="lecturer" class="required form-label">Dosen Wali</label>
                                <input type="text" name="lecturer" class="form-control"
                                    placeholder="Masukan Dosen Wali" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="gpa" class="required form-label">IPK</label>
                                <input type="text" 
                                       name="gpa" 
                                       id="gpa" 
                                       class="form-control"
                                       placeholder="4.00" 
                                       required>
                                <div class="form-text text-muted">Masukkan IPK dengan format angka (1.00 - 4.00), contoh: 3.75</div>
                                <div id="gpa_error" class="form-text text-danger" style="display: none;">Only allow range 1.00 – 4.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="status" class="required form-label">Status Mahasiswa</label>
                                <select class="form-select" name="status" id="status_mahasiswa" data-control="select2" data-placeholder="Pilih Status Mahasiswa" data-dropdown-parent="#kt_modal_1">
                                    <option></option>
                                    <option value="aktif">Aktif</option>
                                    <option value="cuti">Cuti</option>
                                    <option value="lulus">Lulus</option>
                                    <option value="mengundurkan diri">Mengundurkan Diri</option>
                                </select>
                            </div>
                        </div>
                        {{-- Status Prakerin - Only shown when Status = Aktif --}}
                        <div class="col-md-6" id="prakerin_field_wrapper" style="display: none;">
                            <div class="mb-6">
                                <label for="prakerin_status" class="required form-label">Status Prakerin</label>
                                <select class="form-select" name="prakerin_status" id="prakerin_status" data-control="select2" data-placeholder="Pilih Status Prakerin" data-dropdown-parent="#kt_modal_1">
                                    <option></option>
                                    <option value="belum terlaksana">Belum Terlaksana</option>
                                    <option value="sedang terlaksana">Sedang Terlaksana</option>
                                    <option value="sudah terlaksana">Sudah Terlaksana</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Conditional fields for Status = Aktif --}}
                    <div id="status_aktif_fields" style="display: none;">
                        <div class="row">
                            {{-- Status Seminar - Only shown when Prakerin = Sudah Terlaksana --}}
                            <div class="col-md-6" id="seminar_field_wrapper" style="display: none;">
                                <div class="mb-6">
                                    <label for="seminar_status" class="required form-label">Status Seminar</label>
                                    <select class="form-select" name="seminar_status" id="seminar_status" data-control="select2" data-placeholder="Pilih Status Seminar" data-dropdown-parent="#kt_modal_1">
                                        <option></option>
                                        <option value="belum terlaksana">Belum Terlaksana</option>
                                        <option value="sudah terlaksana">Sudah Terlaksana</option>
                                    </select>
                                </div>
                            </div>
                            {{-- Status Sidang - Only shown when Seminar = Sudah Terlaksana --}}
                            <div class="col-md-6" id="meeting_field_wrapper" style="display: none;">
                                <div class="mb-6">
                                    <label for="meeting_status" class="required form-label">Status Sidang</label>
                                    <select class="form-select" name="meeting_status" id="meeting_status" data-control="select2" data-placeholder="Pilih Status Sidang" data-dropdown-parent="#kt_modal_1">
                                        <option></option>
                                        <option value="belum terlaksana">Belum Terlaksana</option>
                                        <option value="sudah terlaksana">Sudah Terlaksana</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Dynamic fields for Alumni (shown when status = Lulus OR when Status Sidang = Sudah Terlaksana) --}}
                    <div id="alumni_fields" style="display: none;">
                        <hr class="my-4" style="border-color: #e9ecef;">
                        <h5 class="mb-4 text-gray-700">Informasi Pekerjaan (Alumni)</h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label for="work_status" class="required form-label">Status Pekerjaan</label>
                                    <select class="form-select" name="work_status" id="work_status" data-control="select2" data-placeholder="Pilih Status Pekerjaan" data-dropdown-parent="#kt_modal_1">
                                        <option></option>
                                        <option value="tidak bekerja">Tidak Bekerja</option>
                                        <option value="belum bekerja">Belum Bekerja</option>
                                        <option value="bekerja">Bekerja</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="work_waiting_time_field" style="display: none;">
                                <div class="mb-6">
                                    <label for="work_waiting_time" class="form-label">Waktu Menunggu Kerja (bulan)</label>
                                    <input type="text" name="work_waiting_time" class="form-control" placeholder="Contoh: 3">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="job_fields" style="display: none;">
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label for="institution_name" class="required form-label">Nama Institusi/Perusahaan</label>
                                    <input type="text" name="institution_name" class="form-control" placeholder="Masukan Nama Institusi/Perusahaan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label for="job_according_major" class="required form-label">Pekerjaan Sesuai Jurusan</label>
                                    <select class="form-select" name="job_according_major" data-control="select2" data-placeholder="Pilih" data-dropdown-parent="#kt_modal_1">
                                        <option></option>
                                        <option value="ya">Ya</option>
                                        <option value="tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" id="submit_mahasiswa" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
