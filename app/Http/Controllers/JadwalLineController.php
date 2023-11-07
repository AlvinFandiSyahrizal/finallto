<?php

namespace App\Http\Controllers;

use App\Models\JadwalLine;
use Carbon\Carbon;
use App\Models\JadwalLine2;
use App\Models\JadwalLine3;
use App\Models\JadwalLine4;
use App\Models\Line2;
use App\Models\Line3;
use App\Models\Line4;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class JadwalLineController extends Controller
{
    // Menampilkan semua data JadwalLine
    public function index()
    {

        $jadwal_line2s = JadwalLine2::orderBy('Tanggal')->orderBy('Jam')->get();
        $jadwal_line3s = JadwalLine3::orderBy('Tanggal')->orderBy('Jam')->get();
        $jadwal_line4s = JadwalLine4::orderBy('Tanggal')->orderBy('Jam')->get();
        $line2Data = Line2::pluck('FlangeNon', 'PartNumber');
        $line3Data = Line3::pluck('FlangeNon', 'PartNumber');
        $line4Data = Line4::pluck('FlangeNon', 'PartNumber');
        $jadwalLines = JadwalLine::all(); // Mengambil semua data JadwalLine
        return view('jadwalline.jadwalline', compact('jadwalLines', 'jadwal_line2s','jadwal_line3s', 'jadwal_line4s', 'line2Data', 'line3Data', 'line4Data'));
    }

    // Menampilkan form untuk membuat JadwalLine baru
    // public function create()
    // {
    //     return view('jadwalline.create');
    // }

    public function create(): view
{
    $line2Data = Line2::pluck('FlangeNon', 'PartNumber');
    $line3Data = Line3::pluck('FlangeNon', 'PartNumber');
    $line4Data = Line4::pluck('FlangeNon', 'PartNumber');
    return view('jadwalline.create', compact('line2Data', 'line3Data', 'line4Data'));
}


    // Menyimpan JadwalLine baru ke database
    public function store(Request $request): RedirectResponse
    {
        // Validasi data input sesuai kebutuhan Anda
        $request->validate([
            'Jam' => 'required',
            'Tanggal' => 'required|date',
            'PartNumber' => 'required',
            'FlangeNon' => 'required',
            'Quantity' => 'required|numeric|min:0',
        ]);
        $remainingQuantity = $request->Quantity;
        $jam = Carbon::parse($request->Jam); // Menggunakan jam yang diberikan

        while ($remainingQuantity > 0) {
            if ($remainingQuantity > 20) {
                $quantityToCreate = 20;
                $remainingQuantity -= 20;
            } else {
                $quantityToCreate = $remainingQuantity;
                $remainingQuantity = 0;
            }

            JadwalLine2::create([
                'Jam' => $jam->format('H:i:s'),
                'Tanggal' => Carbon::parse($request->Tanggal),
                'PartNumber' => $request->PartNumber,
                'FlangeNon' => $request->FlangeNon,
                'Quantity' => $quantityToCreate,
            ]);
            JadwalLine3::create([
                'Jam' => $jam->format('H:i:s'),
                'Tanggal' => Carbon::parse($request->Tanggal),
                'PartNumber' => $request->PartNumber,
                'FlangeNon' => $request->FlangeNon,
                'Quantity' => $quantityToCreate,
            ]);
            JadwalLine4::create([
                'Jam' => $jam->format('H:i:s'),
                'Tanggal' => Carbon::parse($request->Tanggal),
                'PartNumber' => $request->PartNumber,
                'FlangeNon' => $request->FlangeNon,
                'Quantity' => $quantityToCreate,
            ]);

            if ($remainingQuantity > 0) {
                $jam->addSeconds(360); // 6 menit / 20 quantity
            }
        }
        return redirect()->route('jadwallines.index')
            ->with('success', 'JadwalLine berhasil ditambahkan.');
    }

    // Menampilkan detail JadwalLine
    // public function show($id): view
    // {
    //     $jadwal_line2 = JadwalLine2::findOrFail($id);
    //     $jadwal_line3 = JadwalLine2::findOrFail($id);
    //     $jadwal_line4 = JadwalLine2::findOrFail($id);
    //     return view('jadwalline.show', compact('jadwalLines', 'jadwal_line2s','jadwal_line3s', 'jadwal_line4s', 'line2Data', 'line3Data', 'line4Data'));
    // }
    public function show($id): view
{
    $jadwalLine = JadwalLine::findOrFail($id);
    return view('jadwalline.show', compact('jadwalLine'));
}


    // Menampilkan form untuk mengedit JadwalLine
    // public function edit($id): View
    // {
    //     $jadwal_line2 = JadwalLine2::findOrFail($id);
    //     $jadwal_line3 = JadwalLine3::findOrFail($id);
    //     $jadwal_line4 = JadwalLine4::findOrFail($id);
    //     return view('jadwalline.edit', compact('jadwalLines', 'jadwal_line2s','jadwal_line3s', 'jadwal_line4s', 'line2Data', 'line3Data', 'line4Data'));
    // }
    public function edit($id): View
{
    $jadwalLine = JadwalLine::findOrFail($id);
    return view('jadwalline.edit', compact('jadwalLine'));
}

    // Memperbarui JadwalLine yang ada di database
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi data input sesuai kebutuhan Anda

        $request->validate([
            'Jam' => 'required|date_format:H:i',
            'Tanggal' => 'required|date',
            'PartNumber' => 'required',
            'FlangeNon' => 'required',
            'Quantity' => 'required|numeric|min:0',
        ]);

        $jadwal_line2 = JadwalLine2::findOrFail($id);

        $jadwal_line2->update([
            'Jam' => $request->Jam,
            'Tanggal' => Carbon::parse($request->Tanggal),
            'PartNumber' => $request->PartNumber,
            'FlangeNon' => $request->FlangeNon,
            'Quantity' => $request->Quantity,
        ]);

        $jadwal_line3 = JadwalLine3::findOrFail($id);

        $jadwal_line3->update([
            'Jam' => $request->Jam,
            'Tanggal' => Carbon::parse($request->Tanggal),
            'PartNumber' => $request->PartNumber,
            'FlangeNon' => $request->FlangeNon,
            'Quantity' => $request->Quantity,
        ]);
        $jadwal_line4 = JadwalLine4::findOrFail($id);

        $jadwal_line4->update([
            'Jam' => $request->Jam,
            'Tanggal' => Carbon::parse($request->Tanggal),
            'PartNumber' => $request->PartNumber,
            'FlangeNon' => $request->FlangeNon,
            'Quantity' => $request->Quantity,
        ]);

        return redirect()->route('jadwallines.index')
            ->with('success', 'JadwalLine berhasil diperbarui.');
    }

    // Menghapus JadwalLine dari database
    public function destroy($id): RedirectResponse
    {
        $jadwal_line2 = JadwalLine2::findOrFail($id);
        $jadwal_line2->delete();
        $jadwal_line3 = JadwalLine3::findOrFail($id);
        $jadwal_line3->delete();
        $jadwal_line4 = JadwalLine4::findOrFail($id);
        $jadwal_line4->delete();

        return redirect()->route('jadwallines.index')
            ->with('success', 'JadwalLine berhasil dihapus.');
    }

       // Method untuk mengambil Flange/Non dari Line2, Line3, dan Line4
       public function getFlangeNonFromLines($partNumber)
       {
           $flangeNon2 = Line2::where('PartNumber', $partNumber)->first()->FlangeNon;
           $flangeNon3 = Line3::where('PartNumber', $partNumber)->first()->FlangeNon;
           $flangeNon4 = Line4::where('PartNumber', $partNumber)->first()->FlangeNon;

           return response()->json([
               'flangeNon2' => $flangeNon2,
               'flangeNon3' => $flangeNon3,
               'flangeNon4' => $flangeNon4,
           ]);
       }

       // Method untuk mendapatkan daftar Part Number berdasarkan Line
       public function getPartNumbers(Request $request): JsonResponse
       {
           $line = $request->input('line');
           $partNumbers = [];
           $flangeNonData = [];

           if ($line === 'Line2') {
               $partNumbers = Line2::pluck('PartNumber', 'PartNumber');
               $flangeNonData = Line2::pluck('FlangeNon', 'PartNumber');
           } elseif ($line === 'Line3') {
               $partNumbers = Line3::pluck('PartNumber', 'PartNumber');
               $flangeNonData = Line3::pluck('FlangeNon', 'PartNumber');
           } elseif ($line === 'Line4') {
               $partNumbers = Line4::pluck('PartNumber', 'PartNumber');
               $flangeNonData = Line4::pluck('FlangeNon', 'PartNumber');
           }

           return response()->json(['partNumbers' => $partNumbers, 'flangeNonData' => $flangeNonData]);
       }



}
