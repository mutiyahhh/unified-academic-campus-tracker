<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlumniRequest;
use App\Models\Akreditas;
use App\Models\Alumni;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    use ResponseAPI;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akreditas = Akreditas::all();
        return view('pages.alumni.index', compact('akreditas'));
    }

    public function data()
    {
        try {
            if(auth()->user()->hasRole(['admin', 'manajemen'])) {
                $alumni = Alumni::orderBy('id', 'asc')->get();
            } else {
                $alumni = Alumni::where('prodi', auth()->user()->prodi)->orderBy('id', 'asc')->get();
            }
            return $this->success('Data alumni berhasil diambil', $alumni);
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
    public function store(AlumniRequest $request)
    {
        try {
            $data = $request->validated();
            Alumni::create($data);
            return redirect()->route('alumni.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('alumni.index')->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $alumni = Alumni::findOrFail($id);
            return response()->json($alumni);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alumni = Alumni::findOrFail($id);
        $akreditas = Akreditas::all();
        return view('pages.alumni.edit', compact('alumni', 'akreditas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $alumni = Alumni::findOrFail($id);
            $alumni->update($request->all());
            return redirect()->route('alumni.index')->with('success', 'Data berhasil diubah');
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
            $alumni = Alumni::findOrFail($id);
            $alumni->delete();
            return redirect()->route('alumni.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
}
