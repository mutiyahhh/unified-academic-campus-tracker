<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Employee;
use App\Models\Mahasiswa;
use App\Models\Pmb;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasRole('kaprodi')) {
            $totalMahasiswa = Mahasiswa::where('prodi', auth()->user()->prodi)
            ->count();
        } else {
            $totalMahasiswa = Mahasiswa::count();
        } 
        if(auth()->user()->hasRole('kaprodi')) {
            $totalPegawai = Employee::where('prodi', auth()->user()->prodi)
            ->count();
        } else {
            $totalPegawai = Employee::count();
        } 
        if(auth()->user()->hasRole('kaprodi')) {
            $totalPenerimaanMahasiswaBaru = Pmb::where('prodi', auth()->user()->prodi)
            ->count();
        } else {
            $totalPenerimaanMahasiswaBaru = Pmb::count();
        }
        if(auth()->user()->hasRole('kaprodi')) {
            $totalAlumni = Alumni::where('prodi', auth()->user()->prodi)
            ->count();
        } else {
            $totalAlumni = Alumni::count();
        }

        // total mahasiswa prodi
        $totalMahasiswaSIII = Mahasiswa::where('prodi', 'Sistem Informasi Industri Otomotif')->count();
        $totalMahasiswaTRO = Mahasiswa::where('prodi', 'Teknologi Rekayasa Otomotif')->count();
        $totalMahasiswaABO = Mahasiswa::where('prodi', 'Administrasi Bisnis Otomotif')->count();
        $totalMahasiswaTIO = Mahasiswa::where('prodi', 'Teknik Industri Otomotif')->count();
        $totalMahasiswaTKP = Mahasiswa::where('prodi', 'Teknik Kimia Polimer')->count();

        // chart status mahasiswa
        if(auth()->user()->hasRole('kaprodi')) {
            $mahasiswaAktif = Mahasiswa::where('status', 'aktif')
            ->where('prodi', auth()->user()->prodi)
            ->count();
            $mahasiswaCuti = Mahasiswa::where('status', 'cuti')
            ->where('prodi', auth()->user()->prodi)
            ->count();
            $mahasiswaMengundurkanDiri = Mahasiswa::where('status', 'mengundurkan diri')
            ->where('prodi', auth()->user()->prodi)
            ->count();
            $mahasiswaLulus = Mahasiswa::where('status', 'lulus')
            ->where('prodi', auth()->user()->prodi)
            ->count();
        } else {
            $mahasiswaAktif = Mahasiswa::where('status', 'aktif')->count();
            $mahasiswaCuti = Mahasiswa::where('status', 'cuti')->count();
            $mahasiswaMengundurkanDiri = Mahasiswa::where('status', 'mengundurkan diri')->count();
            $mahasiswaLulus = Mahasiswa::where('status', 'lulus')->count();
        }
        

        // chart status pegawai
        $pegawaiNIDN = Employee::where('card_number_status', 'NIDN')->count();
        $pegawaiNITK = Employee::where('card_number_status', 'NITK')->count();
        $pegawaiNIDK = Employee::where('card_number_status', 'NIDK')->count();

        // Alumni employment stats
        $alumniBekerja = Alumni::where('work_status', 'bekerja')->count();
        $alumniBelumBekerja = Alumni::where('work_status', 'belum bekerja')->count();
        $alumniTidakBekerja = Alumni::where('work_status', 'tidak bekerja')->count();
        
        // Job vs Major comparison (only for alumni who are working)
        $alumniSesuaiJurusan = Alumni::where('work_status', 'bekerja')
            ->where('job_according_major', 'ya')
            ->count();
        $alumniTidakSesuaiJurusan = Alumni::where('work_status', 'bekerja')
            ->where('job_according_major', 'tidak')
            ->count();
        
        // Academic progress stats (for active students)
        if(auth()->user()->hasRole('kaprodi')) {
            $prakerinSudah = Mahasiswa::where('status', 'aktif')
                ->where('prodi', auth()->user()->prodi)
                ->where('prakerin_status', 'sudah terlaksana')->count();
            $prakerinBelum = Mahasiswa::where('status', 'aktif')
                ->where('prodi', auth()->user()->prodi)
                ->where('prakerin_status', '!=', 'sudah terlaksana')->count();
            
            $seminarSudah = Mahasiswa::where('status', 'aktif')
                ->where('prodi', auth()->user()->prodi)
                ->where('seminar_status', 'sudah terlaksana')->count();
            $seminarBelum = Mahasiswa::where('status', 'aktif')
                ->where('prodi', auth()->user()->prodi)
                ->where('seminar_status', '!=', 'sudah terlaksana')->count();
            
            $sidangSudah = Mahasiswa::where('status', 'aktif')
                ->where('prodi', auth()->user()->prodi)
                ->where('meeting_status', 'sudah terlaksana')->count();
            $sidangBelum = Mahasiswa::where('status', 'aktif')
                ->where('prodi', auth()->user()->prodi)
                ->where('meeting_status', '!=', 'sudah terlaksana')->count();
        } else {
            $prakerinSudah = Mahasiswa::where('status', 'aktif')
                ->where('prakerin_status', 'sudah terlaksana')->count();
            $prakerinBelum = Mahasiswa::where('status', 'aktif')
                ->where('prakerin_status', '!=', 'sudah terlaksana')->count();
            
            $seminarSudah = Mahasiswa::where('status', 'aktif')
                ->where('seminar_status', 'sudah terlaksana')->count();
            $seminarBelum = Mahasiswa::where('status', 'aktif')
                ->where('seminar_status', '!=', 'sudah terlaksana')->count();
            
            $sidangSudah = Mahasiswa::where('status', 'aktif')
                ->where('meeting_status', 'sudah terlaksana')->count();
            $sidangBelum = Mahasiswa::where('status', 'aktif')
                ->where('meeting_status', '!=', 'sudah terlaksana')->count();
        }
        
        // Combined Cuti/Mengundurkan Diri
        $mahasiswaCutiMengundurkan = $mahasiswaCuti + $mahasiswaMengundurkanDiri;

        $PMB = Pmb::select(
            'prodi',
            'year',
            DB::raw('SUM(number_of_registrants) as total_registrants'),
            DB::raw('SUM(re_registration) as total_re_registration'),
            DB::raw('SUM(quota_accepted) as total_quota_accepted')
        )
        ->groupBy('prodi', 'year')
        ->get();
    

        

        $data = [
            'totalMahasiswa' => $totalMahasiswa,
            'totalPegawai' => $totalPegawai,
            'totalPenerimaanMahasiswaBaru' => $totalPenerimaanMahasiswaBaru,
            'totalAlumni' => $totalAlumni,
            'totalMahasiswaSIII' => $totalMahasiswaSIII,
            'totalMahasiswaTRO' => $totalMahasiswaTRO,
            'totalMahasiswaABO' => $totalMahasiswaABO,
            'totalMahasiswaTIO' => $totalMahasiswaTIO,
            'totalMahasiswaTKP' => $totalMahasiswaTKP,
            'mahasiswaAktif' => $mahasiswaAktif,
            'mahasiswaCuti' => $mahasiswaCuti,
            'mahasiswaMengundurkanDiri' => $mahasiswaMengundurkanDiri,
            'mahasiswaCutiMengundurkan' => $mahasiswaCutiMengundurkan,
            'mahasiswaLulus' => $mahasiswaLulus,
            'pegawaiNIDN' => $pegawaiNIDN,
            'pegawaiNITK' => $pegawaiNITK,
            'pegawaiNIDK' => $pegawaiNIDK,
            // Academic progress
            'prakerinSudah' => $prakerinSudah,
            'prakerinBelum' => $prakerinBelum,
            'seminarSudah' => $seminarSudah,
            'seminarBelum' => $seminarBelum,
            'sidangSudah' => $sidangSudah,
            'sidangBelum' => $sidangBelum,
            // Alumni employment
            'alumniBekerja' => $alumniBekerja,
            'alumniBelumBekerja' => $alumniBelumBekerja,
            'alumniTidakBekerja' => $alumniTidakBekerja,
            // Job vs Major
            'alumniSesuaiJurusan' => $alumniSesuaiJurusan,
            'alumniTidakSesuaiJurusan' => $alumniTidakSesuaiJurusan,
            'PMB' => $PMB
        ];

        return view('pages.dashboard', compact('data'));
    }
}