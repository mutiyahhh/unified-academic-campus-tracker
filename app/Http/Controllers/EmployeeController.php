<?php

namespace App\Http\Controllers;

use App\Models\Akreditas;
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
        $akreditas = Akreditas::all();
        return view('pages.pegawai.index', compact('akreditas'));
    }

    public function data()
    {
        try {
            if(auth()->user()->hasRole(['admin', 'manajemen'])) {
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
            Employee::create($request->all());
            return redirect()->route('pegawai.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('pegawai.index')->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $pegawai = Employee::findOrFail($id);
            return response()->json($pegawai);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), $th->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $pegawai = Employee::findOrFail($id);
            $akreditas = Akreditas::all();
            return view('pages.pegawai.edit', compact('akreditas', 'pegawai'));
        } catch (\Throwable $th) {
            return redirect()->route('pegawai.index')->withErrors($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $pegawai = Employee::findOrFail($id);
            $pegawai->update($request->all());
            return redirect()->route('pegawai.index')->with('success', 'Data berhasil diubah');
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
            $pegawai = Employee::findOrFail($id);
            $pegawai->delete();
            return redirect()->route('pegawai.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
}
