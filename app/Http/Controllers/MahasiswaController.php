<?php

namespace App\Http\Controllers;

use App\Http\Requests\MahasiswaRequest;
use App\Models\Akreditas;
use App\Models\Mahasiswa;
use App\Models\Alumni;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    use ResponseAPI;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akreditas = Akreditas::orderBy('id', 'asc')->get();
        return view('pages.mahasiswa.index', compact('akreditas'));
    }

    public function data()
    {
        try {
            if(auth()->user()->hasRole(['admin', 'manajemen'])) {
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
            $data = $request->validated();
            
            // Auto-fill defaults based on status
            if (isset($data['status'])) {
                $status = strtolower($data['status']);
                
                // Status = Lulus: Auto-set all to "Sudah Terlaksana"
                if ($status === 'lulus') {
                    $data['prakerin_status'] = 'sudah terlaksana';
                    $data['seminar_status'] = 'sudah terlaksana';
                    $data['meeting_status'] = 'sudah terlaksana';
                }
                // Status = Cuti or Mengundurkan Diri: Auto-set all to defaults
                elseif ($status === 'cuti' || $status === 'mengundurkan diri') {
                    $data['prakerin_status'] = $data['prakerin_status'] ?? 'belum terlaksana';
                    $data['seminar_status'] = $data['seminar_status'] ?? 'belum terlaksana';
                    $data['meeting_status'] = $data['meeting_status'] ?? 'belum terlaksana';
                }
                // Status = Aktif: Set defaults for hidden fields
                elseif ($status === 'aktif') {
                    // Set default for prakerin if not set
                    $data['prakerin_status'] = $data['prakerin_status'] ?? 'belum terlaksana';
                    $prakerinStatus = strtolower($data['prakerin_status']);
                    
                    // IMPORTANT: If Prakerin = "Belum Terlaksana" OR "Sedang Terlaksana"
                    // Auto-set all subsequent fields to defaults
                    if ($prakerinStatus === 'belum terlaksana' || $prakerinStatus === 'sedang terlaksana') {
                        $data['seminar_status'] = 'belum terlaksana';
                        $data['meeting_status'] = 'belum terlaksana';
                        $data['work_status'] = $data['work_status'] ?? 'belum bekerja';
                    } elseif ($prakerinStatus === 'sudah terlaksana') {
                        // If prakerin is "sudah terlaksana", check seminar status
                        // If seminar is not "sudah terlaksana", auto-set meeting to "belum terlaksana"
                        if (!isset($data['seminar_status']) || strtolower($data['seminar_status']) !== 'sudah terlaksana') {
                            $data['meeting_status'] = 'belum terlaksana';
                        }
                        // If meeting is not "sudah terlaksana", auto-set work_status to "belum bekerja"
                        if (!isset($data['meeting_status']) || strtolower($data['meeting_status']) !== 'sudah terlaksana') {
                            $data['work_status'] = $data['work_status'] ?? 'belum bekerja';
                        }
                    }
                }
            }
            
            $mahasiswa = Mahasiswa::create($data);
            
            // Auto-create Alumni when status is "Lulus" or when meeting_status is "sudah terlaksana"
            if (isset($data['status']) && (strtolower($data['status']) === 'lulus' || 
                (strtolower($data['status']) === 'aktif' && isset($data['meeting_status']) && strtolower($data['meeting_status']) === 'sudah terlaksana'))) {
                $this->createAlumniFromMahasiswa($mahasiswa, $data);
            }
            
            return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('mahasiswa.index')->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            return response()->json($mahasiswa);
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
            $mahasiswa = Mahasiswa::findOrFail($id);
            $akreditas = Akreditas::orderBy('id', 'asc')->get();
            return view('pages.mahasiswa.edit', compact('mahasiswa', 'akreditas'));
        } catch (\Throwable $th) {
            return redirect()->route('mahasiswa.index')->withErrors($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MahasiswaRequest $request, string $id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $oldStatus = $mahasiswa->status;
            $data = $request->validated();
            
            // Auto-fill defaults based on status
            if (isset($data['status'])) {
                $status = strtolower($data['status']);
                
                // Status = Lulus: Auto-set all to "Sudah Terlaksana"
                if ($status === 'lulus') {
                    $data['prakerin_status'] = 'sudah terlaksana';
                    $data['seminar_status'] = 'sudah terlaksana';
                    $data['meeting_status'] = 'sudah terlaksana';
                }
                // Status = Cuti or Mengundurkan Diri: Auto-set all to defaults
                elseif ($status === 'cuti' || $status === 'mengundurkan diri') {
                    $data['prakerin_status'] = $data['prakerin_status'] ?? 'belum terlaksana';
                    $data['seminar_status'] = $data['seminar_status'] ?? 'belum terlaksana';
                    $data['meeting_status'] = $data['meeting_status'] ?? 'belum terlaksana';
                }
                // Status = Aktif: Set defaults for hidden fields
                elseif ($status === 'aktif') {
                    // Set default for prakerin if not set
                    $data['prakerin_status'] = $data['prakerin_status'] ?? 'belum terlaksana';
                    $prakerinStatus = strtolower($data['prakerin_status']);
                    
                    // IMPORTANT: If Prakerin = "Belum Terlaksana" OR "Sedang Terlaksana"
                    // Auto-set all subsequent fields to defaults
                    if ($prakerinStatus === 'belum terlaksana' || $prakerinStatus === 'sedang terlaksana') {
                        $data['seminar_status'] = 'belum terlaksana';
                        $data['meeting_status'] = 'belum terlaksana';
                        $data['work_status'] = $data['work_status'] ?? 'belum bekerja';
                    } elseif ($prakerinStatus === 'sudah terlaksana') {
                        // If prakerin is "sudah terlaksana", check seminar status
                        // Set default for seminar if not set
                        $data['seminar_status'] = $data['seminar_status'] ?? 'belum terlaksana';
                        $seminarStatus = strtolower($data['seminar_status']);
                        
                        // If seminar is not "sudah terlaksana", auto-set meeting to "belum terlaksana"
                        if ($seminarStatus !== 'sudah terlaksana') {
                            $data['meeting_status'] = 'belum terlaksana';
                        } else {
                            // If seminar is "sudah terlaksana", check meeting status
                            // Set default for meeting if not set
                            $data['meeting_status'] = $data['meeting_status'] ?? 'belum terlaksana';
                            $meetingStatus = strtolower($data['meeting_status']);
                            
                            // If meeting is not "sudah terlaksana", auto-set work_status to "belum bekerja"
                            if ($meetingStatus !== 'sudah terlaksana') {
                                $data['work_status'] = $data['work_status'] ?? 'belum bekerja';
                            }
                        }
                    }
                }
            }
            
            $mahasiswa->update($data);
            
            // Auto-create/update Alumni when status is "Lulus" or when meeting_status is "sudah terlaksana"
            $shouldCreateAlumni = false;
            if (isset($data['status']) && strtolower($data['status']) === 'lulus') {
                $shouldCreateAlumni = true;
            } elseif (isset($data['status']) && strtolower($data['status']) === 'aktif' && 
                      isset($data['meeting_status']) && strtolower($data['meeting_status']) === 'sudah terlaksana') {
                $shouldCreateAlumni = true;
            }
            
            if ($shouldCreateAlumni) {
                $this->createOrUpdateAlumniFromMahasiswa($mahasiswa, $data);
            }
            
            return redirect()->route('mahasiswa.edit', $id)->with('success', 'Data mahasiswa berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
    
    /**
     * Create Alumni from Mahasiswa data
     */
    private function createAlumniFromMahasiswa($mahasiswa, $data)
    {
        // Check if alumni already exists
        $alumni = Alumni::where('nim', $mahasiswa->nim)->first();
        
        if (!$alumni) {
            $alumniData = [
                'name' => $mahasiswa->name,
                'nim' => $mahasiswa->nim,
                'gender' => $mahasiswa->gender,
                'birth_place' => $mahasiswa->birth_place,
                'birth_date' => $mahasiswa->birth_date,
                'religion' => $mahasiswa->religion,
                'address' => $mahasiswa->address,
                'blood_type' => $mahasiswa->blood_type,
                'prodi' => $mahasiswa->prodi,
                'entry_year' => $mahasiswa->generation ?? date('Y'),
                'graduation_year' => date('Y'),
                'work_status' => $data['work_status'] ?? 'belum bekerja',
                'work_waiting_time' => $data['work_waiting_time'] ?? '',
                'institution_name' => $data['institution_name'] ?? '',
                'job_according_major' => $data['job_according_major'] ?? '',
            ];
            
            Alumni::create($alumniData);
        }
    }
    
    /**
     * Create or Update Alumni from Mahasiswa data
     */
    private function createOrUpdateAlumniFromMahasiswa($mahasiswa, $data)
    {
        $alumni = Alumni::where('nim', $mahasiswa->nim)->first();
        
        $alumniData = [
            'name' => $mahasiswa->name,
            'nim' => $mahasiswa->nim,
            'gender' => $mahasiswa->gender,
            'birth_place' => $mahasiswa->birth_place,
            'birth_date' => $mahasiswa->birth_date,
            'religion' => $mahasiswa->religion,
            'address' => $mahasiswa->address,
            'blood_type' => $mahasiswa->blood_type,
            'prodi' => $mahasiswa->prodi,
            'entry_year' => $mahasiswa->generation ?? date('Y'),
            'graduation_year' => $alumni ? $alumni->graduation_year : date('Y'),
            'work_status' => $data['work_status'] ?? ($alumni ? $alumni->work_status : 'belum bekerja'),
            'work_waiting_time' => $data['work_waiting_time'] ?? ($alumni ? $alumni->work_waiting_time : ''),
            'institution_name' => $data['institution_name'] ?? ($alumni ? $alumni->institution_name : ''),
            'job_according_major' => $data['job_according_major'] ?? ($alumni ? $alumni->job_according_major : ''),
        ];
        
        if ($alumni) {
            $alumni->update($alumniData);
        } else {
            Alumni::create($alumniData);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
