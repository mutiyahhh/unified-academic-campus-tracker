<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Models\Akreditas;
use App\Models\Mahasiswa;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    use ResponseAPI;
    public function __construct()
    {
        $this->middleware('jwt.auth')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if(auth()->user()->hasRole('admin')) {
                $mahasiswa = Mahasiswa::orderBy('id', 'asc')->get();
            } else {
                $mahasiswa = Mahasiswa::where('prodi', auth()->user()->prodi)->orderBy('id', 'asc')->get();
            }
            return $this->success('Mahasiswa berhasil diambil', $mahasiswa);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), $th->getCode());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MahasiswaRequest $request)
    {
        try {
            $mahasiswa = Mahasiswa::create($request->validated());
            return $this->success('Mahasiswa berhasil ditambahkan', $mahasiswa);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), $th->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            return $this->success('Mahasiswa berhasil diambil', $mahasiswa);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), $th->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->update($request->validated());
            return $this->success('Mahasiswa berhasil diupdate', $mahasiswa);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), $th->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->delete();
            return $this->success('Mahasiswa berhasil dihapus', $mahasiswa);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), $th->getCode());
        }
    }
}
