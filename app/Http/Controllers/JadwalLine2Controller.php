<?php

namespace App\Http\Controllers;

use App\Models\JadwalLine2;
use Carbon\Carbon;
use App\Models\Line2;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JadwalLine2Controller extends Controller
{
    public function index(): view
    {
        $jadwal_line2s = JadwalLine2::orderBy('Tanggal')->orderBy('Jam')->get();
        $line2Data = Line2::pluck('FlangeNon', 'PartNumber');

        return view('jadwalline2.jadwalline2', compact('jadwal_line2s', 'line2Data'));
    }

    public function create(): view
    {
        $line2Data = Line2::pluck('FlangeNon', 'PartNumber');
        return view('jadwalline2.create', compact('line2Data'));
    }

    public function store(Request $request): RedirectResponse
    {
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

            if ($remainingQuantity > 0) {
                $jam->addSeconds(360); // 6 menit / 20 quantity
            }
        }

        return redirect()->route('jadwalline2.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show($id): view
    {
        $jadwal_line2 = JadwalLine2::findOrFail($id);
        return view('jadwalline2.show', compact('jadwal_line2'));
    }

    public function edit($id): View
    {
        $jadwal_line2 = JadwalLine2::findOrFail($id);
        return view('jadwalline2.edit', compact('jadwal_line2'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
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

        return redirect()->route('jadwalline2.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $jadwal_line2 = JadwalLine2::findOrFail($id);
        $jadwal_line2->delete();
        return redirect()->route('jadwalline2.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


    public function getFlangeNonFromLine2s($partNumber)
    {

        $flangeNon = Line2::where('part_number', $partNumber)->first()->flangeNon;

        return response()->json(['flangeNon' => $flangeNon]);
    }

}
