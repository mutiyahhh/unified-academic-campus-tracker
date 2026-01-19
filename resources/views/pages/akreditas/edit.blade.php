@extends('layouts.master')
@section('title', 'AKREDITASI')
@section('page-title', 'EDIT DATA AKREDITASI')
@section('breadcrumb', 'AKREDITASI')

@section('content')
    @include('partials.alert')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('akreditas.update', $akreditas->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="prodi" class="required form-label">Program Studi</label>
                            <input type="text" name="Prodi" class="form-control" placeholder="Masukan Nama Program Studi"
                                value="{{ $akreditas->name }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="university" class="required form-label">Perguruan Tinggi</label>
                            <input type="text" name="university" class="form-control"
                                placeholder="Masukan Perguruan Tinggi" required value="{{ $akreditas->university }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="level" class="required form-label">Strata</label>
                            <input type="text" name="level" class="form-control" placeholder="Masukan Strata" required
                                value="{{ $akreditas->level }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="region" class="required form-label">Wilayah</label>
                            <input type="text" name="region" class="form-control" placeholder="Masukan Wilayah" required
                                value="{{ $akreditas->region }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="sk_number" class="required form-label">No. SK</label>
                            <input type="text" name="sk_number" class="form-control" placeholder="Masukan No. SK" required
                                value="{{ $akreditas->sk_number }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="sk_year" class="required form-label">Tahun SK</label>
                            <input type="text" name="sk_year" class="form-control" placeholder="Masukan Tahun SK"
                                required value="{{ $akreditas->sk_year }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="rank" class="required form-label">Peringkat</label>
                            <input type="text" name="rank" class="form-control" placeholder="Masukan Peringkat"
                                required value="{{ $akreditas->rank }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="expired" class="required form-label">Tanggal KadaluWarsa</label>
                            <input class="form-control" name="expired" placeholder="Masukan Tanggal Kadaluwarsa"
                                id="kt_datepicker_1" required value="{{ $akreditas->expired }}" />
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
