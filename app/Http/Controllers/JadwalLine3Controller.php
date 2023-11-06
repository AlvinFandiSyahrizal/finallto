<?php

namespace App\Http\Controllers;

use App\Models\JadwalLine3;
use Carbon\Carbon;
use App\Models\Line3;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JadwalLine3Controller extends Controller
{
    public function index(): view
    {
        $jadwal_line3s = JadwalLine3::orderBy('Tanggal')->orderBy('Jam')->get();
        $line3Data = Line3::pluck('FlangeNon', 'PartNumber');

        return view('jadwalline3.jadwalline3', compact('jadwal_line3s', 'line3Data'));
    }



    public function create(): view
    {
        $line3Data = Line3::pluck('FlangeNon', 'PartNumber');
        return view('jadwalline3.create', compact('line3Data'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'Jam' => 'required',
            'Tanggal' => 'required|date',
            'PartNumber' => 'required',
            'Quantity' => 'required|numeric|min:0',
        ]);

        // Periksa apakah FlangeNon disertakan dalam permintaan
        if ($request->has('FlangeNon')) {
            $request->validate([
                'FlangeNon' => 'numeric|min:0',
            ]);
            $flangeNon = $request->FlangeNon;
        } else {
            // Jika tidak disertakan, set FlangeNon ke null
            $flangeNon = null;
        }

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

            JadwalLine3::create([
                'Jam' => $jam->format('H:i:s'),
                'Tanggal' => Carbon::parse($request->Tanggal),
                'PartNumber' => $request->PartNumber,
                'FlangeNon' => $flangeNon,
                'Quantity' => $quantityToCreate,
            ]);

            if ($remainingQuantity > 0) {
                $jam->addSeconds(420);
            }
        }

        return redirect()->route('jadwalline3.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }





    public function show($id): view
    {
        $jadwal_line3 = JadwalLine3::findOrFail($id);
        return view('jadwalline3.show', compact('jadwal_line3'));
    }

    public function edit($id): View
    {
        $jadwal_line3 = JadwalLine3::findOrFail($id);
        return view('jadwalline3.edit', compact('jadwal_line3'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'Jam' => 'required|date_format:H:i',
            'Tanggal' => 'required|date',
            'PartNumber' => 'required',
            'FlangeNon' => 'required|numeric|min:0',
            'Quantity' => 'required|numeric|min:0',
        ]);

        $jadwal_line3 = JadwalLine3::findOrFail($id);

        $jadwal_line3->update([
            'Jam' => $request->Jam,
            'Tanggal' => Carbon::parse($request->Tanggal),
            'PartNumber' => $request->PartNumber,
            'FlangeNon' => $request->FlangeNon,
            'Quantity' => $request->Quantity,
        ]);

        return redirect()->route('jadwalline3.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $jadwal_line3 = JadwalLine3::findOrFail($id);
        $jadwal_line3->delete();
        return redirect()->route('jadwalline3.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function getFlangeNon($partNumber)
{
    $flangeNon = Line3::where('PartNumber', $partNumber)->first();
    return response()->json($flangeNon);
}

}
