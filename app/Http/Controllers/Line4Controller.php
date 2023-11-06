<?php

namespace App\Http\Controllers;

use App\Models\Line3; // Perbaiki namespace model
use App\Models\Line4;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class Line4Controller extends Controller
{
        /**
     * index
     *
     * @return View
     */
    public function index(): View // Perbaiki tipe kembalian
    {
        //get posts
        $line4s = Line4::latest()->paginate(50);
        //render view with posts
        return view('line4.line4', compact('line4s'));
    }
    /**
     * create
     *
     * @return View
     */
     public function create(): View
     {
         return view('line4.create4');
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


        // Buat data Line4
        Line4::create([
            'PartNumber' => $request->PartNumber,
            'Assy'       => $request->Assy,
            'FlangeNon'  => $request->FlangeNon,
            'Wclutch'    => $request->Wclutch,
        ]);
        //redirect to index
        return redirect()->route('line4s.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $line4s = Line4::findOrFail($id);

        //render view with post
        return view('line4.edit4', compact('line4s'));
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
         $line4s = Line4::findOrFail($id);

             //update post with new image
             $line4s->update([
                'PartNumber' => $request->PartNumber,
                'Assy' => $request->Assy,
                'FlangeNon' => $request->FlangeNon,
                'Wclutch' => $request->Wclutch,

             ]);

         //redirect to index
         return redirect()->route('line4s.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
         /**
     * destroy
     *
     * @param  mixed $line4s
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $line4s = Line4::findOrFail($id);

        //delete post
        $line4s->delete();

        //redirect to index
        return redirect()->route('line4s.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }




}
