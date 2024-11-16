<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalKelas;

class JadwalKelasController extends Controller
{
    // Display a listing of the schedules with optional search
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jadwalKelas = JadwalKelas::when($search, function ($query, $search) {
            $query->where('nama_mata_kuliah', 'like', "%{$search}%")
                  ->orWhere('dosen_pengajar_1', 'like', "%{$search}%")
                  ->orWhere('dosen_pengajar_2', 'like', "%{$search}%");
        })->get();
    
        $hari = null;
    
        return view('jadwal-kelas.index', compact('jadwalKelas', 'hari'));
    }

    // Show schedules filtered by a specific day
    public function showByDay($hari)
    {
        $jadwalKelas = JadwalKelas::where('hari', $hari)->get();
        return view('jadwal-kelas.index', compact('jadwalKelas', 'hari'));
    }

    // Show the form for creating a new schedule
    public function create()
    {
        return view('jadwal-kelas.create');
    }

    // Store a newly created schedule in the database
    public function store(Request $request)
    {
        $request->validate([
            'nama_mata_kuliah' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'dosen_pengajar_1' => 'required|string|max:255',
            'dosen_pengajar_2' => 'nullable|string|max:255',
            'jumlah_sks' => 'required|integer|min:1',
            'ruangan' => 'required|string|max:50',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat',
        ]);

        JadwalKelas::create($request->all());

        return redirect()->route('jadwal-kelas.index')
                         ->with('success', 'Jadwal kelas berhasil ditambahkan.');
    }

    // Show the form for editing the specified schedule
    public function edit($id)
    {
        $jadwalKelas = JadwalKelas::findOrFail($id);
        return view('jadwal-kelas.edit', compact('jadwalKelas'));
    }

    // Update the specified schedule in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mata_kuliah' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'dosen_pengajar_1' => 'required|string|max:255',
            'dosen_pengajar_2' => 'nullable|string|max:255',
            'jumlah_sks' => 'required|integer|min:1',
            'ruangan' => 'required|string|max:50',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat',
        ]);

        $jadwalKelas = JadwalKelas::findOrFail($id);
        $jadwalKelas->update($request->all());

        return redirect()->route('jadwal-kelas.index')
                         ->with('success', 'Jadwal kelas berhasil diperbarui.');
    }

    // Remove the specified schedule from the database
    public function destroy($id)
    {
        $jadwalKelas = JadwalKelas::findOrFail($id);
        $jadwalKelas->delete();

        return redirect()->route('jadwal-kelas.index')
                         ->with('success', 'Jadwal kelas berhasil dihapus.');
    }
}
