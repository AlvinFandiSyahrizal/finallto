<?php

namespace App\Http\Controllers;

use App\Models\Line2;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class Line2Controller extends Controller
{
    public function index(): View
    {
        $line2s = Line2::latest()->paginate(50);
        return view('line2.line2', compact('line2s'));

    }

    public function create(): View
    {
        return view('line2.create2');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'PartNumber' => 'required',
            'Assy' => 'required',
            'FlangeNon' => 'required|numeric|min:0',
            'Wclutch' => 'required',
        ]);

        Line2::create([
            'PartNumber' => $request->PartNumber,
            'Assy' => $request->Assy,
            'FlangeNon' => $request->FlangeNon,
            'Wclutch' => $request->Wclutch,
        ]);

        return redirect()->route('line2s.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $line2s = Line2::findOrFail($id);
        return view('line2.edit2', compact('line2s'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'PartNumber' => 'required',
            'Assy' => 'required',
            'FlangeNon' => 'required|numeric|min:0',
            'Wclutch' => 'required',
        ]);

        $line2s = Line2::findOrFail($id);

        $line2s->update([
            'PartNumber' => $request->PartNumber,
            'Assy' => $request->Assy,
            'FlangeNon' => $request->FlangeNon,
            'Wclutch' => $request->Wclutch,
        ]);

        return redirect()->route('line2s.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $line2s = Line2::findOrFail($id);
        $line2s->delete();
        return redirect()->route('line2s.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
