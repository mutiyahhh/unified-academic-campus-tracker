<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use ResponseAPI;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if(auth()->user()->hasRole('admin')) {
                $pegawai = Employee::orderBy('id', 'asc')->get();
            } else {
                $pegawai = Employee::where('prodi', auth()->user()->prodi)->orderBy('id', 'asc')->get();
            }
            return $this->success('Data berhasil diambil', $pegawai);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
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
    public function store(Request $request)
    {
        try {
            $pegawai = Employee::create($request->all());
            return $this->success('Data berhasil ditambahkan', $pegawai);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
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
            $pegawai = Employee::findOrFail($id);
            $pegawai->update($request->all());
            return $this->success('Data berhasil diubah', $pegawai);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $pegawai = Employee::findOrFail($id);
            $pegawai->delete();
            return $this->success('Data berhasil dihapus', $pegawai);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
