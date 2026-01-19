<?php

namespace App\Http\Controllers;

use App\Http\Requests\PmbRequest;
use App\Models\Akreditas;
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
        $akreditas = Akreditas::orderBy('id', 'desc')->get();
        return view('pages.pmb.index', compact('akreditas'));
    }

    public function data()
    {
        try {
            if(auth()->user()->hasRole(['admin', 'manajemen'])) {
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
            Pmb::create($request->validated());
            return redirect()->route('pmb.index')->with('success', 'Data PMB berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('pmb.index')->withErrors($th->getMessage());
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
        $pmb = Pmb::findOrFail($id);
        $akreditas = Akreditas::orderBy('id', 'desc')->get();
        return view('pages.pmb.edit', compact('pmb', 'akreditas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $pmb = Pmb::findOrFail($id);
            $pmb->update($request->all());
            return redirect()->route('pmb.index')->with('success', 'Data PMB berhasil diubah');
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
            $pmb = Pmb::findOrFail($id);
            $pmb->delete();
            return redirect()->route('pmb.index')->with('success', 'Data PMB berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('pmb.index')->withErrors($th->getMessage());
        }
    }
}
