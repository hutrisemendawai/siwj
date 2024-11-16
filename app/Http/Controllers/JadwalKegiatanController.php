<?php

// app/Http/Controllers/JadwalKegiatanController.php

namespace App\Http\Controllers;
use App\Models\JadwalKegiatan;
use Illuminate\Http\Request;

class JadwalKegiatanController extends Controller
{
    public function index()
    {
        $jadwalKegiatans = JadwalKegiatan::orderBy('tahun_ajaran', 'desc')
                            ->orderBy('date')
                            ->get();
        return view('jadwal-kegiatan.index', compact('jadwalKegiatans'));
    }

    public function create()
    {
        return view('jadwal-kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'tahun_ajaran' => 'required|string|max:10',
        ]);

        JadwalKegiatan::create($request->only('title', 'description', 'date', 'tahun_ajaran'));

        return redirect()->route('jadwal-kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function edit(JadwalKegiatan $jadwalKegiatan)
    {
        return view('jadwal-kegiatan.edit', compact('jadwalKegiatan'));
    }

    public function update(Request $request, JadwalKegiatan $jadwalKegiatan)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'tahun_ajaran' => 'required|string|max:10',
        ]);

        $jadwalKegiatan->update($request->only('title', 'description', 'date', 'tahun_ajaran'));

        return redirect()->route('jadwal-kegiatan.index')->with('success', 'Kegiatan berhasil diubah');
    }

        public function show($id)
    {
        $jadwalKegiatan = JadwalKegiatan::findOrFail($id);
        return view('jadwal-kegiatan.show', compact('jadwalKegiatan'));
    }
    
    public function destroy(JadwalKegiatan $jadwalKegiatan)
    {
        $jadwalKegiatan->delete();

        return redirect()->route('jadwal-kegiatan.index')->with('success', 'Kegiatan berhasil dihapus');
    }


}
