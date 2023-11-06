<?php

namespace App\Http\Controllers;

use App\Models\JadwalLine;
use App\Models\JadwalLine2;
use App\Models\JadwalLine3;
use App\Models\JadwalLine4;
use App\Models\Line2;
use App\Models\Line3;
use App\Models\Line4;

use Illuminate\Http\Request;

class JadwalLineController extends Controller
{
    // Menampilkan semua data JadwalLine
    public function index()
    {

        $jadwal_line2s = JadwalLine2::all();
        $jadwal_line3s = JadwalLine3::all();
        $jadwal_line4s = JadwalLine4::all();
        $line2Data = Line2::pluck('PartNumber', 'PartNumber');
        $line3Data = Line3::pluck('PartNumber', 'PartNumber');
        $line4Data = Line4::pluck('PartNumber', 'PartNumber');
        $jadwalLines = JadwalLine::all(); // Mengambil semua data JadwalLine
        return view('jadwalline.jadwalline', compact('jadwalLines', 'jadwal_line2s','jadwal_line3s', 'jadwal_line4s', 'line2Data', 'line3Data', 'line4Data'));
    }

    // Menampilkan form untuk membuat JadwalLine baru
    public function create()
    {
        return view('jadwalline.create');
    }

    // Menyimpan JadwalLine baru ke database
    public function store(Request $request)
    {
        // Validasi data input sesuai kebutuhan Anda

        JadwalLine::create($request->all());

        return redirect()->route('jadwallines.index')
            ->with('success', 'JadwalLine berhasil ditambahkan.');
    }

    // Menampilkan detail JadwalLine
    public function show(JadwalLine $jadwalLine)
    {
        return view('jadwalline.show', compact('jadwalLine'));
    }

    // Menampilkan form untuk mengedit JadwalLine
    public function edit(JadwalLine $jadwalLine)
    {
        return view('jadwalline.edit', compact('jadwalLine'));
    }

    // Memperbarui JadwalLine yang ada di database
    public function update(Request $request, JadwalLine $jadwalLine)
    {
        // Validasi data input sesuai kebutuhan Anda

        $jadwalLine->update($request->all());

        return redirect()->route('jadwallines.index')
            ->with('success', 'JadwalLine berhasil diperbarui.');
    }

    // Menghapus JadwalLine dari database
    public function destroy(JadwalLine $jadwalLine)
    {
        $jadwalLine->delete();

        return redirect()->route('jadwallines.index')
            ->with('success', 'JadwalLine berhasil dihapus.');
    }
}
