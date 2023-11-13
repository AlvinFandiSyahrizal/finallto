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
    // public function store(Request $request): RedirectResponse
    // {
    //     // Validasi data input sesuai kebutuhan Anda
    //     $request->validate([
    //         'Jam' => 'required',
    //         'Tanggal' => 'required|date',
    //         'PartNumber' => 'required',
    //         'FlangeNon' => 'required',
    //         'Quantity' => 'required|numeric|min:0',
    //     ]);
    //     $remainingQuantity = $request->Quantity;
    //     $jam = Carbon::parse($request->Jam); // Menggunakan jam yang diberikan

    //     while ($remainingQuantity > 0) {
    //         if ($remainingQuantity > 20) {
    //             $quantityToCreate = 20;
    //             $remainingQuantity -= 20;
    //         } else {
    //             $quantityToCreate = $remainingQuantity;
    //             $remainingQuantity = 0;
    //         }

    //         JadwalLine2::create([
    //             'Jam' => $jam->format('H:i:s'),
    //             'Tanggal' => Carbon::parse($request->Tanggal),
    //             'PartNumber' => $request->PartNumber,
    //             'FlangeNon' => $request->FlangeNon,
    //             'Quantity' => $quantityToCreate,
    //         ]);
    //         JadwalLine3::create([
    //             'Jam' => $jam->format('H:i:s'),
    //             'Tanggal' => Carbon::parse($request->Tanggal),
    //             'PartNumber' => $request->PartNumber,
    //             'FlangeNon' => $request->FlangeNon,
    //             'Quantity' => $quantityToCreate,
    //         ]);
    //         JadwalLine4::create([
    //             'Jam' => $jam->format('H:i:s'),
    //             'Tanggal' => Carbon::parse($request->Tanggal),
    //             'PartNumber' => $request->PartNumber,
    //             'FlangeNon' => $request->FlangeNon,
    //             'Quantity' => $quantityToCreate,
    //         ]);

    //         if ($remainingQuantity > 0) {
    //             $jam->addSeconds(360); // 6 menit / 20 quantity
    //         }
    //     }
    //     return redirect()->route('jadwallines.index')
    //         ->with('success', 'JadwalLine berhasil ditambahkan.');
    // }
    public function store(Request $request): RedirectResponse
{
    // Validasi data input sesuai kebutuhan Anda
    $request->validate([
        'Line' => 'required|in:Line2,Line3,Line4', // Pastikan Anda memiliki input 'Line'
        'Jam' => 'required|date_format:H:i',
        'Tanggal' => 'required|date',
        'PartNumber' => 'required',
        'FlangeNon' => 'required',
        'Quantity' => 'required|numeric|min:0',
    ]);

    $line = $request->input('Line'); // Ambil nilai 'Line' dari input

    $remainingQuantity = $request->input('Quantity');
    $jam = now();

    while ($remainingQuantity > 0) {
        if ($remainingQuantity > 20) {
            $quantityToCreate = 20;
            $remainingQuantity -= 20;
        } else {
            $quantityToCreate = $remainingQuantity;
            $remainingQuantity = 0;
        }

        // Buat data untuk masing-masing Line
        $lineData = [
            'Jam' => $jam,
            'Tanggal' => $request->input('Tanggal'),
            'PartNumber' => $request->input('PartNumber'),
            'FlangeNon' => $request->input('FlangeNon'),
            'Quantity' => $quantityToCreate,
        ];

        // Simpan data ke dalam tabel yang sesuai
        if ($line === 'Line2') {
            JadwalLine2::create($lineData);
        } elseif ($line === 'Line3') {
            JadwalLine3::create($lineData);
        } elseif ($line === 'Line4') {
            JadwalLine4::create($lineData);
        }

        if ($remainingQuantity > 0) {
            $jam = $jam->addMinutes(6); // Tambahkan 6 menit ke jam untuk quantity selanjutnya
        }
    }

    return redirect()->route('jadwallines.index')->with('success', 'JadwalLine berhasil ditambahkan.');
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
    //    public function getFlangeNonFromLines($partNumber)
    //    {
    //        $flangeNon2 = Line2::where('PartNumber', $partNumber)->first()->FlangeNon;
    //        $flangeNon3 = Line3::where('PartNumber', $partNumber)->first()->FlangeNon;
    //        $flangeNon4 = Line4::where('PartNumber', $partNumber)->first()->FlangeNon;

    //        return response()->json([
    //            'flangeNon2' => $flangeNon2,
    //            'flangeNon3' => $flangeNon3,
    //            'flangeNon4' => $flangeNon4,
    //        ]);
    //    }

       // Method untuk mendapatkan daftar Part Number berdasarkan Line
    //    public function getPartNumbers(Request $request)
    //    {
    //        $line = $request->input('line');
    //        $partNumbers = [];
    //        $flangeNonData = [];

    //        if ($line === 'Line2' || $line === 'Line3' || $line === 'Line4') {
    //            // Ganti Line2, Line3, Line4 dengan model dan kolom yang sesuai
    //            $partNumbers = Line2::where('Line', $line)->pluck('PartNumber', 'PartNumber');
    //            $flangeNonData = Line2::where('Line', $line)->pluck('FlangeNon', 'PartNumber');
    //        }

    //        return response()->json(['partNumbers' => $partNumbers, 'flangeNonData' => $flangeNonData]);
    //    }
    // public function getPartNumbers(Request $request)
    // {
    //     $selectedLine = $request->input('Line');

    //     $partNumbers = [];

    //     if ($selectedLine === 'Line2') {
    //         $partNumbers = Line2::pluck('PartNumber', 'PartNumber');
    //     } elseif ($selectedLine === 'Line3') {
    //         $partNumbers = Line3::pluck('PartNumber', 'PartNumber');
    //     } elseif ($selectedLine === 'Line4') {
    //         $partNumbers = Line4::pluck('PartNumber', 'PartNumber');
    //     }

    //     return response()->json(['partNumbers' => $partNumbers]);
    // }

    public function getPartNumbers(Request $request)
    {
        $selectedLine = $request->input('Line');
        // Tambahkan logika untuk mengambil Part Numbers berdasarkan Line yang dipilih
        $partNumbers = ['PartNumber1', 'PartNumber2', 'PartNumber3']; // Ganti ini dengan data sesuai logika Anda

        return response()->json(['partNumbers' => $partNumbers]);
    }


    public function getFlangeNonFromLines(Request $request)
    {
        $selectedPartNumber = $request->input('partNumber');
        // Tambahkan logika untuk mengambil Flange/Non berdasarkan Part Number yang dipilih
        $flangeNon = 'Flange'; // Ganti ini dengan data sesuai logika Anda

        return response()->json(['flangeNon' => $flangeNon]);
    }

    public function submitJadwalLine(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'Line' => 'required|in:Line2,Line3,Line4',
            'Jam' => 'required',
            'Tanggal' => 'required',
            'PartNumber' => 'required',
            'Quantity' => 'required|integer|min:0',
        ]);

        $line = $validatedData['Line'];
        $partNumber = $validatedData['PartNumber'];

        // Implementasikan logika pengecekan apakah Part Number sesuai dengan Line di sini
        if (!$this->isPartNumberValidForLine($partNumber, $line)) {
            return response()->json(['message' => 'Part Number tidak sesuai dengan Line yang dipilih.'], 400);
        }

        // Lanjutkan dengan menyimpan data jika semuanya valid
        if ($line === 'Line2') {
            JadwalLine2::create($validatedData);
        } elseif ($line === 'Line3') {
            JadwalLine3::create($validatedData);
        } elseif ($line === 'Line4') {
            JadwalLine4::create($validatedData);
        } else {
            return response()->json(['message' => 'Line tidak valid.'], 400);
        }

        return response()->json(['message' => 'Jadwal Line berhasil disimpan.']);
    }

    // Di dalam controller atau file yang sesuai
    public function simpanJadwal(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'Line' => 'required|in:Line2,Line3,Line4', // Pastikan Line adalah salah satu dari Line2, Line3, atau Line4
            'Jam' => 'required',
            'Tanggal' => 'required',
            'PartNumber' => 'required',
            'FlangeNon' => 'required',
            'Quantity' => 'required|integer|min:0',
        ]);

        // Ambil data dari permintaan
        $line = $request->input('Line');
        $jam = $request->input('Jam');
        $tanggal = $request->input('Tanggal');
        $partNumber = $request->input('PartNumber');
        $flangeNon = $request->input('FlangeNon');
        $quantity = $request->input('Quantity');

        // Tentukan tindakan berdasarkan nilai "Line"
        if ($line === 'Line2') {
            // Simpan data ke dalam tabel jadwal Line 2
            JadwalLine2::create([
                'Jam' => $jam,
                'Tanggal' => $tanggal,
                'PartNumber' => $partNumber,
                'FlangeNon' => $flangeNon,
                'Quantity' => $quantity,
            ]);
        } elseif ($line === 'Line3') {
            // Simpan data ke dalam tabel jadwal Line 3
            JadwalLine3::create([
                'Jam' => $jam,
                'Tanggal' => $tanggal,
                'PartNumber' => $partNumber,
                'FlangeNon' => $flangeNon,
                'Quantity' => $quantity,
            ]);
        } elseif ($line === 'Line4') {
            // Simpan data ke dalam tabel jadwal Line 4
            JadwalLine4::create([
                'Jam' => $jam,
                'Tanggal' => $tanggal,
                'PartNumber' => $partNumber,
                'FlangeNon' => $flangeNon,
                'Quantity' => $quantity,
            ]);
        }

        return response()->json(['message' => 'Jadwal berhasil disimpan']);
    }



   }
