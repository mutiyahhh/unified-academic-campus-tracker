<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AkreditasRequest;
use App\Models\Akreditas;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class AkreditasController extends Controller
{
    use ResponseAPI;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $akreditas = Akreditas::orderBy('id', 'asc')->get();
            return $this->success('Data akreditas berhasil diambil', $akreditas);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
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
    public function store(AkreditasRequest $request)
    {
        try {
            $akreditas = Akreditas::create($request->validated());
            return $this->success('Data akreditas berhasil ditambahkan', $akreditas);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $akreditas = Akreditas::findOrFail($id);
            return $this->success('Data akreditas berhasil diambil', $akreditas);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
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
            $akreditas = Akreditas::findOrFail($id);
            $akreditas->update($request->all());
            return $this->success('Data akreditas berhasil diubah', $akreditas);
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
            $akreditas = Akreditas::findOrFail($id);
            $akreditas->delete();
            return $this->success('Data akreditas berhasil dihapus', $akreditas);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
