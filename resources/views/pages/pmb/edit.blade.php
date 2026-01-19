@extends('layouts.master')
@section('title', 'PMB')
@section('page-title', 'EDIT DATA PENERIMAAN MAHASISWA BARU')
@section('breadcrumb', 'PMB')

@section('content')
    @include('partials.alert')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pmb.update', $pmb->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="mb-6">
                        <label for="prodi" class="required form-label">Program Studi</label>
                        <select class="form-select" name="prodi" data-control="select2" data-placeholder="Pilih Program Studi"
                            data-dropdown-parent="#kt_modal_1">
                            <option></option>
                            @foreach ($akreditas as $akreditas)
                                <option value="{{ $akreditas->name }}"
                                    {{ $pmb->prodi == $akreditas->name ? 'selected' : '' }}>
                                    {{ $akreditas->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-6">
                        <label for="year" class="required form-label">Tahun Penerimaan</label>
                        <input type="text" name="year" class="form-control" placeholder="Masukan Tahun Penerimaan" required value="{{ $pmb->year }}">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-6">
                        <label for="number_of_registrants" class="required form-label">Jumlah Pendaftar</label>
                        <input type="text" name="number_of_registrants" class="form-control"
                            placeholder="Masukan Jumlah Pendaftar" required value="{{ $pmb->number_of_registrants }}">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-6">
                        <label for="quota_accepted" class="required form-label">Kuota Diterima</label>
                        <input type="text" name="quota_accepted" class="form-control"
                            placeholder="Masukan Kuota Diterima" required value="{{ $pmb->quota_accepted }}">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-6">
                        <label for="re_registration" class="required form-label">Pendaftar Ulang</label>
                        <input type="text" name="re_registration" class="form-control"
                            placeholder="Masukan Jumlah Pendaftar Ulang" required value="{{ $pmb->re_registration }}">
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
