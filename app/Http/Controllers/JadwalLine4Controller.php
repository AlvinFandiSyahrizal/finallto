<?php

namespace App\Http\Controllers;

use App\Models\JadwalLine4;
use Carbon\Carbon;
use App\Models\Line4;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JadwalLine4Controller extends Controller
{
    public function index(): view
    {
        $jadwal_line4s = JadwalLine4::orderBy('Tanggal')->orderBy('Jam')->get();
        $line4Data = Line4::pluck('FlangeNon', 'PartNumber');

        return view('jadwalline4.jadwalline4', compact('jadwal_line4s', 'line4Data'));
    }



    public function create(): view
    {
        $line3Data = Line4::pluck('FlangeNon', 'PartNumber');
        return view('jadwalline4.create', compact('line4Data'));
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

            JadwalLine4::create([
                'Jam' => $jam->format('H:i:s'),
                'Tanggal' => Carbon::parse($request->Tanggal),
                'PartNumber' => $request->PartNumber,
                'FlangeNon' => $request->FlangeNon,
                'Quantity' => $quantityToCreate,
            ]);

            if ($remainingQuantity > 0) {
                $jam->addSeconds(420);
            }
        }

        return redirect()->route('jadwalline4.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show($id): view
    {
        $jadwal_line4 = JadwalLine4::findOrFail($id);
        return view('jadwalline4.show', compact('jadwal_line4'));
    }

    public function edit($id): View
    {
        $jadwal_line4 = JadwalLine4::findOrFail($id);
        return view('jadwalline4.edit', compact('jadwal_line4'));
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

        $jadwal_line4 = JadwalLine4::findOrFail($id);

        $jadwal_line4->update([
            'Jam' => $request->Jam,
            'Tanggal' => Carbon::parse($request->Tanggal),
            'PartNumber' => $request->PartNumber,
            'FlangeNon' => $request->FlangeNon,
            'Quantity' => $request->Quantity,
        ]);

        return redirect()->route('jadwalline4.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $jadwal_line4 = JadwalLine4::findOrFail($id);
        $jadwal_line4->delete();
        return redirect()->route('jadwalline4.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function getFlangeNonFromLine2s($partNumber)
    {

        $flangeNon = Line4::where('part_number', $partNumber)->first()->flangeNon;

        return response()->json(['flangeNon' => $flangeNon]);
    }

}
