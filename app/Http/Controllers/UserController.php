<?php

namespace App\Http\Controllers;

use App\Models\Akreditas;
use App\Models\User;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use ResponseAPI;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akreditas = Akreditas::orderBy('id', 'asc')->get();
        $role = Role::orderBy('id', 'asc')->get();
        return view('pages.user.index', compact('akreditas', 'role'));
    }

    public function data()
    {
        try {
            if(auth()->user()->hasRole('admin')) {
                $users = User::with('roles')->get();
            } else {
                $users = User::where('prodi', auth()->user()->prodi)->with('roles')->get();
            }
            $users = User::with('roles')->get();
            return $this->success('Users retrieved successfully', $users);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
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
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'prodi' => $request->prodi ?? null, // Allow null if not provided
                'password' => bcrypt($request->password),
            ]);

            // assign role
            $user->assignRole($request->role);

            return redirect()->route('user.index')->with('success', 'User berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->withErrors($e->getMessage());
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
            $user = User::with('roles')->findOrFail($id);
            $akreditas = Akreditas::orderBy('id', 'asc')->get();
            $role = Role::orderBy('id', 'asc')->get();
            return view('pages.user.edit', compact('user', 'akreditas', 'role'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            // Preserve existing prodi value if not provided (field is hidden)
            $prodi = $request->prodi ?? $user->prodi;
            
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'prodi' => $prodi, // Use existing value if not provided
            ]);

            $user->syncRoles($request->role);

            return redirect()->route('user.index')->with('success', 'User berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->withErrors('Data gagal dihapus');
        }
    }
}
