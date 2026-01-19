<?php

namespace App\Http\Controllers;

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
        return view('pages.akreditas.index');
    }

    public function data()
    {
        try {
            if(auth()->user()->hasRole(['admin', 'manajemen'])) {
                $akreditas = Akreditas::orderBy('id', 'asc')->get();
            } else {
                $akreditas = Akreditas::where('name', auth()->user()->prodi)->orderBy('id', 'asc')->get();
            }
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
            Akreditas::create($request->validated());
            return redirect()->route('akreditas.index')->with('success', 'Data akreditasi berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('akreditas.index')->withErrors($th->getMessage());
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
        try {
            $akreditas = Akreditas::findOrFail($id);
            return view('pages.akreditas.edit', compact('akreditas'));
        } catch (\Throwable $th) {
            return redirect()->route('akreditas.index')->withErrors($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $akreditas = Akreditas::findOrFail($id);
            $akreditas->update($request->all());
            return redirect()->route('akreditas.index')->with('success', 'Data akreditasi berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
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
            return redirect()->route('akreditas.index')->with('success', 'Data akreditasi berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('akreditas.index')->withErrors($th->getMessage());
        }
    }
}
