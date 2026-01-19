<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Employee;
use App\Models\Mahasiswa;
use App\Models\Pmb;
use App\Traits\ResponseAPI;

class DashboardController extends Controller
{
    use ResponseAPI;
    public function index()
    {
        if (auth()->user()->hasRole('kaprodi')) {
            $totalMahasiswa = Mahasiswa::where('prodi', auth()->user()->prodi)
                ->count();
            $totalPegawai = Employee::where('prodi', auth()->user()->prodi)
                ->count();
            $totalPenerimaanMahasiswaBaru = Pmb::where('prodi', auth()->user()->prodi)
                ->count();
            $totalAlumni = Alumni::where('prodi', auth()->user()->prodi)
                ->count();
        } else {
            $totalMahasiswa = Mahasiswa::count();
            $totalPegawai = Employee::count();
            $totalPenerimaanMahasiswaBaru = Pmb::count();
            $totalAlumni = Alumni::count();
        }

        // total mahasiswa prodi
        $totalMahasiswaSIII = Mahasiswa::where('prodi', 'Sistem Informasi Industri Otomotif')->count();
        $totalMahasiswaTRO = Mahasiswa::where('prodi', 'Teknik Rekayasa Otomotif')->count();
        $totalMahasiswaABO = Mahasiswa::where('prodi', 'Administrasi Bisnis Otomotif')->count();
        $totalMahasiswaTIO = Mahasiswa::where('prodi', 'Teknik Industri Otomotif')->count();
        $totalMahasiswaTKP = Mahasiswa::where('prodi', 'Teknik Kimia Polimer')->count();

        // chart status mahasiswa
        if (auth()->user()->hasRole('kaprodi')) {
            $mahasiswaAktif = Mahasiswa::where('status', 'aktif')
                ->where('prodi', auth()->user()->prodi)
                ->count();
            $mahasiswaCuti = Mahasiswa::where('status', 'cuti')
                ->where('prodi', auth()->user()->prodi)
                ->count();
            $mahasiswaMengundurkanDiri = Mahasiswa::where('status', 'mengundurkan diri')
                ->where('prodi', auth()->user()->prodi)
                ->count();
            $mahasiswaLulus = Mahasiswa::where('status', 'mengundurkan lulus')
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
            'mahasiswaLulus' => $mahasiswaLulus,
            'pegawaiNIDN' => $pegawaiNIDN,
            'pegawaiNITK' => $pegawaiNITK,
            'pegawaiNIDK' => $pegawaiNIDK,
        ];

        return $this->success('Dashboard berhasil diambil', $data);
    }
}
