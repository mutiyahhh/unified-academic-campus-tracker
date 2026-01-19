@extends('layouts.master')
@section('title', 'MAHASISWA')
@section('page-title', 'EDIT DATA MAHASISWA')
@section('breadcrumb', 'MAHASISWA')

@section('content')
    @include('partials.alert')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="name" class="required form-label">Program Studi</label>
                            <select class="form-select" name="prodi" data-control="select2" data-placeholder="Pilih Program Studi"
                            >
                                <option></option>
                                @foreach ($akreditas as $akreditas)
                                    <option value="{{ $akreditas->name }}"
                                        {{ $mahasiswa->prodi == $akreditas->name ? 'selected' : '' }}>
                                        {{ $akreditas->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="nim" class="required form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="Masukan NIM Mahasiswa"
                                required value="{{ $mahasiswa->nim }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="nik" class="required form-label">NIK</label>
                            <input type="text" 
                                   name="nik" 
                                   id="nik_edit" 
                                   class="form-control" 
                                   placeholder="Masukan NIK (16 digit)"
                                   maxlength="16" 
                                   pattern="[0-9]{16}"
                                   required 
                                   value="{{ $mahasiswa->nik }}"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 16) this.value = this.value.slice(0, 16);">
                            <div class="form-text text-muted">NIK harus tepat 16 digit angka</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="name" class="required form-label">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Mahasiswa"
                                required value="{{ $mahasiswa->name }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="birth_place" class="required form-label">Tempat Lahir</label>
                            <input type="text" name="birth_place" class="form-control" placeholder="Masukan Tempat Lahir"
                                required value="{{ $mahasiswa->birth_place }}">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="birth_date" class="required form-label">Tanggal Lahir</label>
                            <input class="form-control" name="birth_date" placeholder="Masukan Tanggal Lahir"
                                id="kt_datepicker_1" required value="{{ $mahasiswa->birth_date }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="address" class="required form-label">Alamat</label>
                            <input type="text" name="address" class="form-control" placeholder="Masukan Alamat Mahasiswa"
                                required value="{{ $mahasiswa->address }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="religion" class="required form-label">Agama</label>
                            <select class="form-select" name="religion" data-control="select2"
                                data-placeholder="Pilih Agama">
                                <option></option>
                                <option value="Islam" {{ $mahasiswa->religion == 'Islam' ? 'selected' : '' }}>Islam
                                </option>
                                <option value="Kristen" {{ $mahasiswa->religion == 'Kristen' ? 'selected' : '' }}>Kristen
                                </option>
                                <option value="Katolik" {{ $mahasiswa->religion == 'Katolik' ? 'selected' : '' }}>Katolik
                                </option>
                                <option value="Hindu" {{ $mahasiswa->religion == 'Hindu' ? 'selected' : '' }}>Hindu
                                </option>
                                <option value="Budha" {{ $mahasiswa->religion == 'Budha' ? 'selected' : '' }}>Budha
                                </option>
                                <option value="Konghucu" {{ $mahasiswa->religion == 'Konghucu' ? 'selected' : '' }}>
                                    Konghucu</option>
                                <option value="Lainnya" {{ $mahasiswa->religion == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="phone_number" class="required form-label">No. Telp</label>
                            <input type="text" name="phone_number" class="form-control"
                                placeholder="Masukan No. Telp" required value="{{ $mahasiswa->phone_number }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="gender" class="required form-label">Jenis Kelamin</label>
                            <select class="form-select" name="gender" data-control="select2"
                                data-placeholder="Pilih Jenis Kelamin">
                                <option></option>
                                <option value="woman" {{ $mahasiswa->gender == 'woman' ? 'selected' : ''}}>Perempuan</option>
                                <option value="men" {{ $mahasiswa->gender == 'men' ? 'selected' : ''}}>Laki-Laki</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="blood_type" class="required form-label">Golongan Darah</label>
                            <select class="form-select" name="blood_type" data-control="select2"
                                data-placeholder="Pilih Golongan Darah">
                                <option></option>
                                <option value="A" {{ $mahasiswa->blood_type == 'A' ? 'selected' : ''}}>A</option>
                                <option value="B" {{ $mahasiswa->blood_type == 'B' ? 'selected' : ''}}>B</option>
                                <option value="AB" {{ $mahasiswa->blood_type == 'AB' ? 'selected' : ''}}>AB</option>
                                <option value="O" {{ $mahasiswa->blood_type == 'O' ? 'selected' : ''}}>O</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="mothers_name" class="required form-label">Nama Ibu</label>
                            <input type="text" name="mothers_name" class="form-control"
                                placeholder="Masukan Nama Ibu" required value="{{ $mahasiswa->mothers_name }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="fathers_name" class="required form-label">Nama Ayah</label>
                            <input type="text" name="fathers_name" class="form-control"
                                placeholder="Masukan Nama Ayah" required value="{{ $mahasiswa->fathers_name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="generation" class="required form-label">Angkatan</label>
                            <input type="text" 
                                   name="generation" 
                                   id="generation_edit" 
                                   class="form-control" 
                                   placeholder="2020"
                                   maxlength="4"
                                   required 
                                   value="{{ $mahasiswa->generation }}">
                            <div class="form-text text-muted">Masukkan tahun angkatan (contoh: 2020)</div>
                            <div id="generation_edit_error" class="form-text text-danger" style="display: none;">Only allow year format (e.g. 2020)</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="lecturer" class="required form-label">Dosen Wali</label>
                            <input type="text" name="lecturer" class="form-control" placeholder="Masukan Dosen Wali"
                                required value="{{ $mahasiswa->lecturer }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="gpa" class="required form-label">IPK</label>
                            <input type="text" 
                                   name="gpa" 
                                   id="gpa_edit" 
                                   class="form-control"
                                   placeholder="4.00" 
                                   required 
                                   value="{{ $mahasiswa->gpa }}">
                            <div class="form-text text-muted">Masukkan IPK dengan format angka (1.00 - 4.00), contoh: 3.75</div>
                            <div id="gpa_edit_error" class="form-text text-danger" style="display: none;">Only allow range 1.00 – 4.00</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="status" class="required form-label">Status Mahasiswa</label>
                            <select class="form-select" name="status" id="status_mahasiswa_edit" data-control="select2" data-placeholder="Pilih Status Mahasiswa">
                                <option></option>
                                <option value="aktif" {{ $mahasiswa->status == 'aktif' ? 'selected' : ''}}>Aktif</option>
                                <option value="cuti" {{ $mahasiswa->status == 'cuti' ? 'selected' : ''}}>Cuti</option>
                                <option value="lulus" {{ $mahasiswa->status == 'lulus' ? 'selected' : ''}}>Lulus</option>
                                <option value="mengundurkan diri" {{ $mahasiswa->status == 'mengundurkan diri' ? 'selected' : ''}}>Mengundurkan Diri</option>
                            </select>
                        </div>
                    </div>
                    {{-- Status Prakerin - Only shown when Status = Aktif --}}
                    <div class="col-md-6" id="prakerin_field_wrapper_edit" style="display: {{ $mahasiswa->status == 'aktif' ? 'block' : 'none' }};">
                        <div class="mb-6">
                            <label for="prakerin_status" class="required form-label">Status Prakerin</label>
                            <select class="form-select" name="prakerin_status" id="prakerin_status_edit" data-control="select2" data-placeholder="Pilih Status Prakerin">
                                <option></option>
                                <option value="belum terlaksana" {{ $mahasiswa->prakerin_status == 'belum terlaksana' ? 'selected' : ''}}>Belum Terlaksana</option>
                                <option value="sedang terlaksana" {{ $mahasiswa->prakerin_status == 'sedang terlaksana' ? 'selected' : ''}}>Sedang Terlaksana</option>
                                <option value="sudah terlaksana" {{ $mahasiswa->prakerin_status == 'sudah terlaksana' ? 'selected' : ''}}>Sudah Terlaksana</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                {{-- Conditional fields for Status = Aktif --}}
                <div id="status_aktif_fields_edit" style="display: {{ $mahasiswa->status == 'aktif' ? 'block' : 'none' }};">
                    <div class="row">
                        {{-- Status Seminar - Only shown when Prakerin = Sudah Terlaksana --}}
                        <div class="col-md-6" id="seminar_field_wrapper_edit" style="display: {{ ($mahasiswa->status == 'aktif' && $mahasiswa->prakerin_status == 'sudah terlaksana') ? 'block' : 'none' }};">
                            <div class="mb-6">
                                <label for="seminar_status" class="required form-label">Status Seminar</label>
                                <select class="form-select" name="seminar_status" id="seminar_status_edit" data-control="select2" data-placeholder="Pilih Status Seminar">
                                    <option></option>
                                    <option value="belum terlaksana" {{ $mahasiswa->seminar_status == 'belum terlaksana' ? 'selected' : ''}}>Belum Terlaksana</option>
                                    <option value="sudah terlaksana" {{ $mahasiswa->seminar_status == 'sudah terlaksana' ? 'selected' : ''}}>Sudah Terlaksana</option>
                                </select>
                            </div>
                        </div>
                        {{-- Status Sidang - Only shown when Seminar = Sudah Terlaksana --}}
                        <div class="col-md-6" id="meeting_field_wrapper_edit" style="display: {{ ($mahasiswa->status == 'aktif' && $mahasiswa->seminar_status == 'sudah terlaksana') ? 'block' : 'none' }};">
                            <div class="mb-6">
                                <label for="meeting_status" class="required form-label">Status Sidang</label>
                                <select class="form-select" name="meeting_status" id="meeting_status_edit" data-control="select2" data-placeholder="Pilih Status Sidang">
                                    <option></option>
                                    <option value="belum terlaksana" {{ $mahasiswa->meeting_status == 'belum terlaksana' ? 'selected' : ''}}>Belum Terlaksana</option>
                                    <option value="sudah terlaksana" {{ $mahasiswa->meeting_status == 'sudah terlaksana' ? 'selected' : ''}}>Sudah Terlaksana</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Dynamic fields for Alumni (shown when status = Lulus OR when Status Sidang = Sudah Terlaksana) --}}
                @php
                    $alumni = \App\Models\Alumni::where('nim', $mahasiswa->nim)->first();
                    $showAlumniFields = ($mahasiswa->status == 'lulus') || ($mahasiswa->status == 'aktif' && $mahasiswa->meeting_status == 'sudah terlaksana');
                @endphp
                <div id="alumni_fields_edit" style="display: {{ $showAlumniFields ? 'block' : 'none' }};">
                    <hr class="my-4" style="border-color: #e9ecef;">
                    <h5 class="mb-4 text-gray-700">Informasi Pekerjaan (Alumni)</h5>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="work_status" class="required form-label">Status Pekerjaan</label>
                                <select class="form-select" name="work_status" id="work_status_edit" data-control="select2" data-placeholder="Pilih Status Pekerjaan">
                                    <option></option>
                                    <option value="tidak bekerja" {{ ($alumni && $alumni->work_status == 'tidak bekerja') ? 'selected' : '' }}>Tidak Bekerja</option>
                                    <option value="belum bekerja" {{ ($alumni && $alumni->work_status == 'belum bekerja') ? 'selected' : '' }}>Belum Bekerja</option>
                                    <option value="bekerja" {{ ($alumni && $alumni->work_status == 'bekerja') ? 'selected' : '' }}>Bekerja</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="work_waiting_time_field_edit" style="display: none;">
                            <div class="mb-6">
                                <label for="work_waiting_time" class="form-label">Waktu Menunggu Kerja (bulan)</label>
                                <input type="text" name="work_waiting_time" class="form-control" placeholder="Contoh: 3" value="{{ $alumni ? $alumni->work_waiting_time : '' }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" id="job_fields_edit" style="display: {{ ($alumni && $alumni->work_status == 'bekerja') ? 'block' : 'none' }};">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="institution_name" class="required form-label">Nama Institusi/Perusahaan</label>
                                <input type="text" name="institution_name" class="form-control" placeholder="Masukan Nama Institusi/Perusahaan" value="{{ $alumni ? $alumni->institution_name : '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="job_according_major" class="required form-label">Pekerjaan Sesuai Jurusan</label>
                                <select class="form-select" name="job_according_major" data-control="select2" data-placeholder="Pilih">
                                    <option></option>
                                    <option value="ya" {{ ($alumni && $alumni->job_according_major == 'ya') ? 'selected' : '' }}>Ya</option>
                                    <option value="tidak" {{ ($alumni && $alumni->job_according_major == 'tidak') ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="button" id="submit_mahasiswa_edit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    
    {{-- Save Confirmation Modal --}}
    <div class="modal fade" tabindex="-1" id="save_confirmation_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Konfirmasi Simpan</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menyimpan perubahan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
                    <button type="button" class="btn btn-primary" id="confirm_save_btn">Ya, Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('addon-script')
    <script>
        $("#kt_datepicker_1").flatpickr();
        
        // Dynamic form fields for Status Mahasiswa conditional logic in edit form
        $(document).ready(function() {
            var previousStatusEdit = '{{ $mahasiswa->status }}';
            
            function handleStatusMahasiswa() {
                var status = $('#status_mahasiswa_edit').val();
                var prakerinStatus = $('#prakerin_status_edit').val();
                var seminarStatus = $('#seminar_status_edit').val();
                var meetingStatus = $('#meeting_status_edit').val();
                
                    // Handle Status = Aktif
                if (status === 'aktif') {
                    // Show Status Prakerin field (always visible for Aktif)
                    $('#prakerin_field_wrapper_edit').slideDown();
                    
                    // Set default if empty
                    if (!prakerinStatus) {
                        $('#prakerin_status_edit').val('belum terlaksana').trigger('change');
                        prakerinStatus = 'belum terlaksana';
                    }
                    
                    // IMPORTANT: If Prakerin = "Belum Terlaksana" OR "Sedang Terlaksana"
                    // Do NOT show Status Seminar, Status Sidang, or Informasi Pekerjaan
                    // Show Save button immediately
                    if (prakerinStatus === 'belum terlaksana' || prakerinStatus === 'sedang terlaksana') {
                        // Hide all subsequent fields
                        $('#status_aktif_fields_edit').slideUp();
                        $('#seminar_field_wrapper_edit').slideUp();
                        $('#meeting_field_wrapper_edit').slideUp();
                        $('#alumni_fields_edit').slideUp();
                        
                        // Auto-set defaults for hidden fields
                        $('#seminar_status_edit').val('belum terlaksana').trigger('change');
                        $('#meeting_status_edit').val('belum terlaksana').trigger('change');
                        $('#work_status_edit').val('belum bekerja').trigger('change');
                    } else if (prakerinStatus === 'sudah terlaksana') {
                        // Show Status Seminar and Sidang fields container
                        $('#status_aktif_fields_edit').slideDown();
                        
                        // Show Status Seminar (always shown when Prakerin = Sudah Terlaksana)
                        $('#seminar_field_wrapper_edit').slideDown();
                        
                        // Set default for seminar if empty
                        if (!seminarStatus) {
                            $('#seminar_status_edit').val('belum terlaksana').trigger('change');
                            seminarStatus = 'belum terlaksana';
                        }
                        
                        // Show Status Sidang ONLY if Seminar = Sudah Terlaksana
                        if (seminarStatus === 'sudah terlaksana') {
                            $('#meeting_field_wrapper_edit').slideDown();
                            
                            // Set default for meeting if empty
                            if (!meetingStatus) {
                                $('#meeting_status_edit').val('belum terlaksana').trigger('change');
                                meetingStatus = 'belum terlaksana';
                            }
                            
                            // Show Informasi Pekerjaan ONLY if Status Sidang = Sudah Terlaksana
                            if (meetingStatus === 'sudah terlaksana') {
                                $('#alumni_fields_edit').slideDown();
                            } else {
                                $('#alumni_fields_edit').slideUp();
                                // Auto-set work_status to "Belum Bekerja" if hidden
                                $('#work_status_edit').val('belum bekerja').trigger('change');
                            }
                        } else {
                            // Seminar is not "Sudah Terlaksana", hide Sidang and Alumni fields
                            $('#meeting_field_wrapper_edit').slideUp();
                            $('#meeting_status_edit').val('belum terlaksana').trigger('change');
                            $('#alumni_fields_edit').slideUp();
                            $('#work_status_edit').val('belum bekerja').trigger('change');
                        }
                    }
                }
                // Handle Status = Cuti or Mengundurkan Diri
                else if (status === 'cuti' || status === 'mengundurkan diri') {
                    // Hide all fields
                    $('#prakerin_field_wrapper_edit').slideUp();
                    $('#status_aktif_fields_edit').slideUp();
                    $('#alumni_fields_edit').slideUp();
                    
                    // Auto-fill defaults only when status changes to Cuti/Mengundurkan Diri
                    if (previousStatusEdit !== status) {
                        $('#prakerin_status_edit').val('belum terlaksana').trigger('change');
                        $('#seminar_status_edit').val('belum terlaksana').trigger('change');
                        $('#meeting_status_edit').val('belum terlaksana').trigger('change');
                        $('#work_status_edit').val('belum bekerja').trigger('change');
                    }
                }
                // Handle Status = Lulus
                else if (status === 'lulus') {
                    // Hide all status fields (prakerin/seminar/sidang)
                    $('#prakerin_field_wrapper_edit').slideUp();
                    $('#status_aktif_fields_edit').slideUp();
                    
                    // Auto-set defaults (no user input)
                    $('#prakerin_status_edit').val('sudah terlaksana').trigger('change');
                    $('#seminar_status_edit').val('sudah terlaksana').trigger('change');
                    $('#meeting_status_edit').val('sudah terlaksana').trigger('change');
                    
                    // Show Informasi Pekerjaan immediately
                    $('#alumni_fields_edit').slideDown();
                }
                // Other statuses (empty)
                else {
                    $('#prakerin_field_wrapper_edit').slideUp();
                    $('#status_aktif_fields_edit').slideUp();
                    $('#alumni_fields_edit').slideUp();
                }
                
                // Update previous status
                previousStatusEdit = status;
            }
            
            function toggleJobFields() {
                var workStatus = $('#work_status_edit').val();
                if (workStatus === 'bekerja') {
                    // Only show job fields when "Bekerja" is selected
                    $('#job_fields_edit').slideDown();
                } else {
                    // Hide all job fields for "Tidak Bekerja" and "Belum Bekerja"
                    $('#job_fields_edit').slideUp();
                }
                // Always hide work_waiting_time_field (not needed anymore)
                $('#work_waiting_time_field_edit').slideUp();
            }
            
            // Listen to status change
            $('#status_mahasiswa_edit').on('change', function() {
                handleStatusMahasiswa();
            });
            
            // Listen to prakerin_status change
            $('#prakerin_status_edit').on('change', function() {
                var status = $('#status_mahasiswa_edit').val();
                if (status === 'aktif') {
                    handleStatusMahasiswa();
                }
            });
            
            // Listen to seminar_status change
            $('#seminar_status_edit').on('change', function() {
                var status = $('#status_mahasiswa_edit').val();
                if (status === 'aktif') {
                    handleStatusMahasiswa();
                }
            });
            
            // Listen to meeting_status change
            $('#meeting_status_edit').on('change', function() {
                var status = $('#status_mahasiswa_edit').val();
                if (status === 'aktif') {
                    handleStatusMahasiswa();
                }
            });
            
            // Listen to work_status change
            $('#work_status_edit').on('change', function() {
                toggleJobFields();
            });
            
            // Initialize on page load
            handleStatusMahasiswa();
            toggleJobFields();
            
            // Save confirmation modal
            $('#submit_mahasiswa_edit').on('click', function(e) {
                e.preventDefault();
                
                // Disable hidden fields before submission
                $('form input[type="text"], form select').each(function() {
                    if ($(this).closest('div').is(':hidden') || $(this).is(':hidden')) {
                        $(this).prop('disabled', true);
                    }
                });
                
                $('#save_confirmation_modal').modal('show');
            });
            
            $('#confirm_save_btn').on('click', function() {
                // Submit the form
                $('form').submit();
            });
            
            // Re-enable fields if modal is closed without saving
            $('#save_confirmation_modal').on('hidden.bs.modal', function() {
                $('form input[type="text"], form select').prop('disabled', false);
            });
            
            // IPK Input Validation (Real-time, Friendly)
            function validateIPK(inputId, errorId, submitId) {
                var input = $('#' + inputId);
                var errorDiv = $('#' + errorId);
                var submitBtn = submitId ? $('#' + submitId) : null;
                
                input.on('input', function(e) {
                    var value = this.value;
                    var originalValue = value;
                    var cursorPos = this.selectionStart;
                    
                    // Remove all non-numeric and non-dot characters (prevent letters)
                    value = value.replace(/[^0-9.]/g, '');
                    
                    // Prevent multiple dots
                    var dotIndex = value.indexOf('.');
                    if (dotIndex !== -1) {
                        value = value.substring(0, dotIndex + 1) + value.substring(dotIndex + 1).replace(/\./g, '');
                    }
                    
                    // Enforce format: ONLY 1 digit before dot (1-4), max 2 digits after
                    var parts = value.split('.');
                    
                    // Only allow 1 digit before dot (must be 1-4)
                    if (parts[0].length > 0) {
                        var firstDigit = parts[0].charAt(0);
                        // Only allow digits 1-4
                        if (firstDigit >= '1' && firstDigit <= '4') {
                            parts[0] = firstDigit;
                        } else if (firstDigit === '0' || firstDigit > '4') {
                            // Block 0 or >4 as first digit
                            parts[0] = '';
                            value = '';
                        } else {
                            parts[0] = firstDigit;
                        }
                    }
                    
                    // Only allow max 2 digits after dot
                    if (parts.length > 1 && parts[1].length > 2) {
                        parts[1] = parts[1].substring(0, 2);
                    }
                    
                    value = parts.join('.');
                    
                    // Update input value if changed
                    if (value !== originalValue) {
                        this.value = value;
                        // Restore cursor position
                        var newCursorPos = Math.min(cursorPos, value.length);
                        this.setSelectionRange(newCursorPos, newCursorPos);
                    }
                    
                    // Range validation (1.00 - 4.00)
                    var numValue = parseFloat(value);
                    var isValid = false;
                    
                    if (value === '' || value === '.' || value.length === 0) {
                        // Empty or incomplete - don't show error yet
                        errorDiv.hide();
                        input.removeClass('is-invalid is-valid');
                        isValid = false;
                    } else if (!isNaN(numValue) && value.match(/^[1-4](\.\d{0,2})?$/)) {
                        // Valid format check
                        if (numValue >= 1.00 && numValue <= 4.00) {
                            // Valid range
                            errorDiv.hide();
                            input.removeClass('is-invalid').addClass('is-valid');
                            isValid = true;
                        } else {
                            // Outside range - show error but keep input (friendly UX)
                            errorDiv.show();
                            input.removeClass('is-valid').addClass('is-invalid');
                            isValid = false;
                        }
                    } else {
                        // Invalid format
                        errorDiv.hide();
                        input.removeClass('is-valid is-invalid');
                        isValid = false;
                    }
                    
                    // Disable/enable submit button
                    if (submitBtn) {
                        if (isValid) {
                            submitBtn.prop('disabled', false);
                        } else {
                            submitBtn.prop('disabled', true);
                        }
                    }
                });
                
                // Validate on blur as well
                input.on('blur', function() {
                    var value = this.value;
                    var numValue = parseFloat(value);
                    
                    if (value && !isNaN(numValue) && value.match(/^[1-4](\.\d{1,2})?$/)) {
                        if (numValue < 1.00 || numValue > 4.00) {
                            errorDiv.show();
                            input.removeClass('is-valid').addClass('is-invalid');
                            if (submitBtn) submitBtn.prop('disabled', true);
                        } else {
                            errorDiv.hide();
                            input.removeClass('is-invalid').addClass('is-valid');
                            if (submitBtn) submitBtn.prop('disabled', false);
                        }
                    } else if (value && value !== '') {
                        // Invalid format on blur
                        errorDiv.hide();
                        input.removeClass('is-valid is-invalid');
                        if (submitBtn) submitBtn.prop('disabled', true);
                    }
                });
                
                // Initial validation
                setTimeout(function() {
                    input.trigger('input');
                }, 100);
            }
            
            // Generation (Angkatan) Input Validation - Only allow year numbers
            function validateGeneration(inputId, errorId, submitId) {
                var input = $('#' + inputId);
                var errorDiv = $('#' + errorId);
                var submitBtn = submitId ? $('#' + submitId) : null;
                
                input.on('input', function(e) {
                    var value = this.value;
                    var originalValue = value;
                    var cursorPos = this.selectionStart;
                    
                    // Remove all non-numeric characters (prevent letters, symbols, decimals)
                    value = value.replace(/[^0-9]/g, '');
                    
                    // Limit to 4 digits (year format)
                    if (value.length > 4) {
                        value = value.substring(0, 4);
                    }
                    
                    // Update input value if changed
                    if (value !== originalValue) {
                        this.value = value;
                        // Restore cursor position
                        var newCursorPos = Math.min(cursorPos, value.length);
                        this.setSelectionRange(newCursorPos, newCursorPos);
                    }
                    
                    // Validate year format (4 digits, reasonable range 1900-2099)
                    var isValid = false;
                    
                    if (value === '' || value.length === 0) {
                        // Empty - don't show error yet
                        errorDiv.hide();
                        input.removeClass('is-invalid is-valid');
                        isValid = false;
                    } else if (value.length === 4) {
                        var yearValue = parseInt(value);
                        if (yearValue >= 1900 && yearValue <= 2099) {
                            // Valid year format
                            errorDiv.hide();
                            input.removeClass('is-invalid').addClass('is-valid');
                            isValid = true;
                        } else {
                            // Invalid year range
                            errorDiv.show();
                            input.removeClass('is-valid').addClass('is-invalid');
                            isValid = false;
                        }
                    } else {
                        // Incomplete (less than 4 digits) - don't show error yet
                        errorDiv.hide();
                        input.removeClass('is-invalid is-valid');
                        isValid = false;
                    }
                    
                    // Disable/enable submit button
                    if (submitBtn) {
                        if (isValid) {
                            submitBtn.prop('disabled', false);
                        } else {
                            submitBtn.prop('disabled', true);
                        }
                    }
                });
                
                // Validate on blur as well
                input.on('blur', function() {
                    var value = this.value;
                    
                    if (value && value.length === 4) {
                        var yearValue = parseInt(value);
                        if (yearValue >= 1900 && yearValue <= 2099) {
                            errorDiv.hide();
                            input.removeClass('is-invalid').addClass('is-valid');
                            if (submitBtn) submitBtn.prop('disabled', false);
                        } else {
                            errorDiv.show();
                            input.removeClass('is-valid').addClass('is-invalid');
                            if (submitBtn) submitBtn.prop('disabled', true);
                        }
                    } else if (value && value !== '') {
                        // Invalid format on blur
                        errorDiv.show();
                        input.removeClass('is-valid').addClass('is-invalid');
                        if (submitBtn) submitBtn.prop('disabled', true);
                    }
                });
                
                // Initial validation
                setTimeout(function() {
                    input.trigger('input');
                }, 100);
            }
            
            // Initialize IPK validation for edit form
            validateIPK('gpa_edit', 'gpa_edit_error', 'submit_mahasiswa_edit');
            validateGeneration('generation_edit', 'generation_edit_error', 'submit_mahasiswa_edit');
        });
    </script>
@endpush
