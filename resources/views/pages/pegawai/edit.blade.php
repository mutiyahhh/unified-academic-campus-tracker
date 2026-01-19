@extends('layouts.master')
@section('title', 'PEGAWAI')
@section('page-title', 'EDIT DATA PEGAWAI')
@section('breadcrumb', 'PEGAWAI')

@section('content')
    @include('partials.alert')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pegawai.update', $pegawai->id) }}" method="post">
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
                                        {{ $pegawai->prodi == $akreditas->name ? 'selected' : '' }}>
                                        {{ $akreditas->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="nip" class="required form-label">NIP</label>
                            <input type="text" name="nip" class="form-control" placeholder="Masukan NIP Pegawai"
                                required value="{{ $pegawai->nip }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="name" class="required form-label">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Pegawai"
                                required value="{{ $pegawai->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="gender" class="required form-label">Jenis Kelamin</label>
                            <select class="form-select" name="gender" data-control="select2"
                                data-placeholder="Pilih Jenis Kelamin">
                                <option></option>
                                <option value="women" {{ $pegawai->gender == 'women' ? 'selected' : '' }}>Perempuan
                                </option>
                                <option value="men" {{ $pegawai->gender == 'men' ? 'selected' : '' }}>Laki-Laki
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
                                required value="{{ $pegawai->birth_place }}">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="birth_date" class="required form-label">Tanggal Lahir</label>
                            <input class="form-control" name="birth_date" placeholder="Masukan Tanggal Lahir"
                                id="kt_datepicker_1" required value="{{ $pegawai->birth_date }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="address" class="required form-label">Alamat</label>
                            <input type="text" name="address" class="form-control" placeholder="Masukan Alamat"
                                required value="{{ $pegawai->address }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="religion" class="required form-label">Agama</label>
                            <select class="form-select" name="religion" data-control="select2"
                                data-placeholder="Pilih Agama">
                                <option></option>
                                <option value="Islam" {{ $pegawai->religion == 'Islam' ? 'selected' : '' }}>Islam
                                </option>
                                <option value="Kristen" {{ $pegawai->religion == 'Kristen' ? 'selected' : '' }}>Kristen
                                </option>
                                <option value="Katolik" {{ $pegawai->religion == 'Katolik' ? 'selected' : '' }}>Katolik
                                </option>
                                <option value="Hindu" {{ $pegawai->religion == 'Hindu' ? 'selected' : '' }}>Hindu
                                </option>
                                <option value="Budha" {{ $pegawai->religion == 'Budha' ? 'selected' : '' }}>Budha
                                </option>
                                <option value="Konghucu" {{ $pegawai->religion == 'Konghucu' ? 'selected' : '' }}>
                                    Konghucu</option>
                                <option value="Lainnya" {{ $pegawai->religion == 'Lainnya' ? 'selected' : '' }}>Lainnya
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
                                data-placeholder="Pilih Golongan Darah">
                                <option></option>
                                <option value="A" {{ $pegawai->blood_type == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $pegawai->blood_type == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ $pegawai->blood_type == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ $pegawai->blood_type == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="generation" class="required form-label">Angkatan</label>
                            <input type="text" name="generation" class="form-control"
                                placeholder="Masukan Angkatan" required value="{{ $pegawai->generation }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="education" class="required form-label">Pendidikan</label>
                            <input type="text" name="education" class="form-control"
                                placeholder="Masukan Pendidikan" required value="{{ $pegawai->education }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="work_bond" class="required form-label">Ikatan Kerja</label>
                            <select class="form-select" name="work_bond" data-control="select2"
                                    data-placeholder="Pilih Ikatan Kerja">
                                    <option></option>
                                    <option value="tenaga pendidik" {{ $pegawai->work_bond == 'tenaga pendidik' ? 'selected' : '' }}>Tenaga Pendidik</option>
                                    <option value="dosen tetap" {{ $pegawai->work_bond == 'dosen tetap' ? 'selected' : '' }}>Dosen Tetap</option>
                                    <option value="dosen kontrak" {{ $pegawai->work_bond == 'dosen kontrak' ? 'selected' : '' }}>Dosen Kontrak</option>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="active_status" class="required form-label">Status Keaktifan</label>
                            <select class="form-select" name="active_status" data-control="select2"
                                    data-placeholder="Pilih Status Keaktifan">
                                    <option></option>
                                    <option value="aktif" {{ $pegawai->active_status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="cuti" {{ $pegawai->active_status == 'cuti' ? 'selected' : '' }}>Cuti</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="card_number_status" class="required form-label">Status No Pokok</label>
                            <input type="text" name="card_number_status" class="form-control"
                                placeholder="Masukan status No Pokok" required value="{{ $pegawai->card_number_status }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="phone_number" class="required form-label">No. Telp</label>
                            <input type="text" name="phone_number" class="form-control"
                                placeholder="Masukan No. Telp" required value="{{ $pegawai->phone_number }}">
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
