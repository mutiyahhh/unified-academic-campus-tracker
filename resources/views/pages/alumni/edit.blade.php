@extends('layouts.master')
@section('title', 'ALUMNI')
@section('page-title', 'EDIT DATA ALUMNI')
@section('breadcrumb', 'ALUMNI')

@section('content')
    @include('partials.alert')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('alumni.update', $alumni->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="name" class="required form-label">Program Studi</label>
                            <select class="form-select" name="prodi" data-control="select2" data-placeholder="Pilih Program Studi">
                                <option></option>
                                @foreach ($akreditas as $akreditas)
                                    <option value="{{ $akreditas->name }}"
                                        {{ $alumni->prodi == $akreditas->name ? 'selected' : '' }}>
                                        {{ $akreditas->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="nim" class="required form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="Masukan NIM Alumni"
                                required value="{{ $alumni->nim }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="name" class="required form-label">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Alumni"
                                required value="{{ $alumni->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="gender" class="required form-label">Jenis Kelamin</label>
                            <select class="form-select" name="gender" data-control="select2"
                                data-placeholder="Pilih Jenis Kelamin">
                                <option></option>
                                <option value="woman" {{ $alumni->gender == 'women' ? 'selected' : '' }}>Perempuan
                                </option>
                                <option value="men" {{ $alumni->gender == 'men' ? 'selected' : '' }}>Laki-Laki
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="birth_place" class="required form-label">Tempat Lahir</label>
                            <input type="text" name="birth_place" class="form-control" placeholder="Masukan Tempat Lahir"
                                required value="{{ $alumni->birth_place }}">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="birth_date" class="required form-label">Tanggal Lahir</label>
                            <input class="form-control" name="birth_date" placeholder="Masukan Tanggal Lahir"
                                id="kt_datepicker_1" required value="{{ $alumni->birth_date }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="address" class="required form-label">Alamat</label>
                            <input type="text" name="address" class="form-control" placeholder="Masukan Alamat"
                                required value="{{ $alumni->address }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="religion" class="required form-label">Agama</label>
                            <select class="form-select" name="religion" data-control="select2"
                                data-placeholder="Pilih Agama" >
                                <option></option>
                                <option value="Islam" {{ $alumni->religion == 'Islam' ? 'selected' : '' }}>Islam
                                </option>
                                <option value="Kristen" {{ $alumni->religion == 'Kristen' ? 'selected' : '' }}>Kristen
                                </option>
                                <option value="Katolik" {{ $alumni->religion == 'Katolik' ? 'selected' : '' }}>Katolik
                                </option>
                                <option value="Hindu" {{ $alumni->religion == 'Hindu' ? 'selected' : '' }}>Hindu
                                </option>
                                <option value="Budha" {{ $alumni->religion == 'Budha' ? 'selected' : '' }}>Budha
                                </option>
                                <option value="Konghucu" {{ $alumni->religion == 'Konghucu' ? 'selected' : '' }}>
                                    Konghucu</option>
                                <option value="Lainnya" {{ $alumni->religion == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="blood_type" class="required form-label">Golongan Darah</label>
                            <select class="form-select" name="blood_type" data-control="select2"
                                data-placeholder="Pilih Golongan Darah" >
                                <option></option>
                                <option value="A" {{ $alumni->blood_type == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $alumni->blood_type == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ $alumni->blood_type == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ $alumni->blood_type == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="entry_year" class="required form-label">Tahun Masuk</label>
                            <input type="text" name="entry_year" class="form-control"
                                placeholder="Masukan Tahun Masuk" required value="{{ $alumni->entry_year }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="graduation_year" class="required form-label">Tahun Lulus</label>
                            <input type="text" name="graduation_year" class="form-control"
                                placeholder="Masukan Tahun Lulus" required value="{{ $alumni->graduation_year }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="work_status" class="required form-label">Status Pekerjaan</label>
                            <select class="form-select" name="work_status" data-control="select2" data-placeholder="Pilih Status Pekerjaan" >
                                <option></option>
                                <option value="bekerja" {{ $alumni->work_status == 'bekerja' ? 'selected' : '' }}>Bekerja</option>
                                <option value="tidak bekerja" {{ $alumni->work_status == 'tidak bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="work_waiting_time" class="required form-label">Waktu Tunggu Kerja</label>
                            <input type="text" name="work_waiting_time" class="form-control"
                                placeholder="Masukan Waktu Tunggu Kerja" required
                                value="{{ $alumni->work_waiting_time }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="institution_name" class="required form-label">Nama Institusi</label>
                            <input type="text" name="institution_name" class="form-control"
                                placeholder="Masukan Nama Institusi" required value="{{ $alumni->institution_name }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="job_according_major" class="required form-label">Pekerjaan Sesuai Jurusan</label>
                            <select class="form-select" name="job_according_major" data-control="select2" data-placeholder="Pilih Pekerjaan Sesuai Jurusan" >
                                <option></option>
                                <option value="sesuai" {{ $alumni->job_according_major == 'sesuai' ? 'selected' : '' }}>Sesuai</option>
                                <option value="tidak sesuai" {{ $alumni->job_according_major == 'tidak sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
@push('addon-script')
    <script>
        $("#kt_datepicker_1").flatpickr();
    </script>
@endpush
