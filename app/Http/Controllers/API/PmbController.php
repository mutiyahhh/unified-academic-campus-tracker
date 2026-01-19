<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PmbRequest;
use App\Models\Pmb;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class PmbController extends Controller
{
    use ResponseAPI;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if(auth()->user()->hasRole('admin')) {
                $pmb = Pmb::orderBy('id', 'desc')->get();
            } else {
                $pmb = Pmb::where('prodi', auth()->user()->prodi)->orderBy('id', 'desc')->get();
            }
            return $this->success('Data PMB berhasil diambil', $pmb);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 401);
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
    public function store(PmbRequest $request)
    {
        try {
            $pmb = Pmb::create($request->validated());
            return $this->success('Data PMB berhasil ditambahkan', $pmb);
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
            $pmb = Pmb::findOrFail($id);
            return $this->success('Data PMB berhasil diambil', $pmb);
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
            $pmb = Pmb::findOrFail($id);
            $pmb->update($request->all());
            return $this->success('Data PMB berhasil diubah', $pmb);
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
            $pmb = Pmb::findOrFail($id);
            $pmb->delete();
            return $this->success('Data PMB berhasil dihapus', $pmb);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), $th->getCode());
        }
    }
}
