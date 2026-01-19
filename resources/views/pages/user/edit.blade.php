@extends('layouts.master')
@section('title', 'USER')
@section('page-title', 'EDIT DATA USER')
@section('breadcrumb', 'USER')

@section('content')
    @include('partials.alert')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="post">
                @method('PUT')
                @csrf
                {{-- Program Studi field removed --}}
                {{-- Hidden field to preserve existing prodi value --}}
                <input type="hidden" name="prodi" value="{{ $user->prodi }}">
                <div class="row">
                    <div class="mb-6">
                        <label for="role" class="required form-label">Role</label>
                        <select class="form-select" name="role" id="role" data-control="select2" data-placeholder="Pilih Role">
                            <option></option>
                            @foreach ($role as $role)
                                <option value="{{ $role->name }}"
                                    {{ $user->roles[0]->name == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-6">
                        <label for="name" class="required form-label">Nama</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukan Nama User" required
                            value="{{ $user->name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-6">
                        <label for="email" class="required form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukan Email" required
                            value="{{ $user->email }}">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-6">
                        <label for="password" class="required form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukan Password"
                            required value="{{ $user->password }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
