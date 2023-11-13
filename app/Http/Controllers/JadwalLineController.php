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
        $jadwalLines = JadwalLine::all();

        return view('jadwalline.jadwalline', compact('jadwalLines', 'jadwal_line2s', 'jadwal_line3s', 'jadwal_line4s', 'line2Data', 'line3Data', 'line4Data'));
    }


    public function create(): view
    {
        $line2Data = Line2::pluck('FlangeNon', 'PartNumber');
        $line3Data = Line3::pluck('FlangeNon', 'PartNumber');
        $line4Data = Line4::pluck('FlangeNon', 'PartNumber');

        return view('jadwalline.create', compact('line2Data', 'line3Data', 'line4Data'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'Line' => 'required|in:Line2,Line3,Line4',
            'Jam' => 'required|date_format:H:i',
            'Tanggal' => 'required|date',
            'PartNumber' => 'required',
            'FlangeNon' => 'required',
            'Quantity' => 'required|numeric|min:0',
        ]);

        $line = $request->input('Line');
        $remainingQuantity = $request->input('Quantity');
        $jam = Carbon::parse($request->input('Jam'));

        while ($remainingQuantity > 0) {
            $quantityToCreate = min(20, $remainingQuantity);
            $remainingQuantity -= $quantityToCreate;

            $lineData = [
                'Jam' => $jam,
                'Tanggal' => $request->input('Tanggal'),
                'PartNumber' => $request->input('PartNumber'),
                'FlangeNon' => $request->input('FlangeNon'),
                'Quantity' => $quantityToCreate,
            ];

            $this->createJadwalLine($line, $lineData);

            if ($remainingQuantity > 0) {
                $jam = $jam->addMinutes(6);
            }
        }

        return redirect()->route('jadwallines.index')->with('success', 'JadwalLine berhasil ditambahkan.');
    }

    private function createJadwalLine($line, $data)
    {
        $jadwalLine = null;

        if ($line === 'Line2') {
            $jadwalLine = new JadwalLine2($data);
        } elseif ($line === 'Line3') {
            $jadwalLine = new JadwalLine3($data);
        } elseif ($line === 'Line4') {
            $jadwalLine = new JadwalLine4($data);
        } else {
            // Tindakan yang sesuai jika Line tidak valid
            return; // atau throw new \InvalidArgumentException('Line tidak valid.');
        }

        if ($jadwalLine) {
            $jadwalLine->save();
        }
    }

    public function show($id): view
{
    $jadwalLine = JadwalLine::findOrFail($id);
    return view('jadwalline.show', compact('jadwalLine'));
}


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

        $line = $request->input('Line');
        $jadwalLine = null;

        if ($line === 'Line2') {
            $jadwalLine = JadwalLine2::findOrFail($id); // Use the correct model
        } elseif ($line === 'Line3') {
            $jadwalLine = JadwalLine3::findOrFail($id); // Use the correct model
        } elseif ($line === 'Line4') {
            $jadwalLine = JadwalLine4::findOrFail($id); // Use the correct model
        }


        if ($jadwalLine) {
            $jadwalLine->update([
                'Jam' => $request->Jam,
                'Tanggal' => Carbon::parse($request->Tanggal),
                'PartNumber' => $request->PartNumber,
                'FlangeNon' => $request->FlangeNon,
                'Quantity' => $request->Quantity,
            ]);

            return redirect()->route('jadwallines.index')
                ->with('success', 'JadwalLine berhasil diperbarui.');
        } else {
            // Tindakan yang sesuai jika Line tidak valid
            return redirect()->route('jadwallines.index')
                ->with('error', 'Line tidak valid.');
        }
    }


    // Menghapus JadwalLine dari database
    public function destroy($id): RedirectResponse
    {
        $jadwal_line2 = JadwalLine2::findOrFail($id); // Use the correct model
        $jadwal_line2->delete();

        $jadwal_line3 = JadwalLine3::findOrFail($id); // Use the correct model
        $jadwal_line3->delete();

        $jadwal_line4 = JadwalLine4::findOrFail($id); // Use the correct model
        $jadwal_line4->delete();

        return redirect()->route('jadwallines.index')
            ->with('success', 'JadwalLine berhasil dihapus.');
    }
    public function getPartNumbers(Request $request)
    {
        $selectedLine = $request->input('Line');
        // Add your logic to fetch Part Numbers based on the selected Line
        $partNumbers = ['PartNumber1', 'PartNumber2', 'PartNumber3']; // Replace with your actual data

        return response()->json(['partNumbers' => $partNumbers]);
    }

    public function getFlangeNonFromLines(Request $request)
    {
        $selectedPartNumber = $request->input('partNumber');
        // Add your logic to fetch Flange/Non based on the selected Part Number
        $flangeNon = 'Flange'; // Replace with your actual data

        return response()->json(['flangeNon' => $flangeNon]);
    }

    public function simpanJadwalLine(Request $request): JsonResponse
    {
        // Validasi data jika diperlukan
        $this->validate($request, [
            'Line' => 'required|in:Line2,Line3,Line4',
            'Jam' => 'required|date_format:H:i',
            'Tanggal' => 'required|date',
            'PartNumber' => 'required',
            'FlangeNon' => 'required',
            'Quantity' => 'required|numeric|min:0',
            // Tambahkan validasi sesuai kebutuhan
        ]);

        // Ambil data dari permintaan
        $line = $request->input('Line');
        $data = $request->only(['Jam', 'Tanggal', 'PartNumber', 'FlangeNon', 'Quantity']);

        // Simpan data ke dalam tabel jadwal Line yang sesuai
        try {
            if ($line === 'Line2') {
                JadwalLine2::create($data);
            } elseif ($line === 'Line3') {
                JadwalLine3::create($data);
            } elseif ($line === 'Line4') {
                JadwalLine4::create($data);
            } else {
                throw new \InvalidArgumentException('Line tidak valid.');
            }

            return response()->json(['message' => "Jadwal $line berhasil disimpan."]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }



   }
