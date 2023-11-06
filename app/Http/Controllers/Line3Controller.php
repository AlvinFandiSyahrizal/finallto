<?php

namespace App\Http\Controllers;

use App\Models\Line3; // Perbaiki namespace model

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class Line3Controller extends Controller
{
        /**
     * index
     *
     * @return View
     */
    public function index(): View // Perbaiki tipe kembalian
    {
        //get posts
        $line3s = Line3::latest()->paginate(50);
        //render view with posts
        return view('line3.line3', compact('line3s'));
    }
    /**
     * create
     *
     * @return View
     */
     public function create(): View
     {
         return view('line3.create3');
     }
    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'PartNumber' => 'required',
            'Assy' => 'required',
            'FlangeNon' => 'required|numeric|min:0',
            'Wclutch' => 'required',

        ]);


        // Buat data Line3
        Line3::create([
            'PartNumber' => $request->PartNumber,
            'Assy'       => $request->Assy,
            'FlangeNon'  => $request->FlangeNon,
            'Wclutch'    => $request->Wclutch,
        ]);
        //redirect to index
        return redirect()->route('line3s.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

        /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get post by ID
        $line3s = Line3::findOrFail($id);

        //render view with post
        return view('line3.edit3', compact('line3s'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */

     public function update(Request $request, $id): RedirectResponse
     {
         //validate form
         $this->validate($request, [
            'PartNumber' => 'required',
            'Assy' => 'required',
            'FlangeNon' => 'required|numeric|min:0',
            'Wclutch' => 'required',
         ]);

         //get post by ID
         $line3s = Line3::findOrFail($id);

             //update post with new image
             $line3s->update([
                'PartNumber' => $request->PartNumber,
                'Assy' => $request->Assy,
                'FlangeNon' => $request->FlangeNon,
                'Wclutch' => $request->Wclutch,

             ]);

         //redirect to index
         return redirect()->route('line3s.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
         /**
     * destroy
     *
     * @param  mixed $line3s
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $line3s = Line3::findOrFail($id);

        //delete post
        $line3s->delete();

        //redirect to index
        return redirect()->route('line3s.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }




}
