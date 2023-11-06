<?php

namespace App\Http\Controllers;

use App\Models\Line0;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class Line0Controller extends Controller
{
      /**
       * index.
       *
       * @return \Illuminate\View\View
       */
      public function index(): View // Perbaiki tipe kembalian.
      {
          //get posts.
          $line0s = Line0::latest()->paginate(50);
          //render view with posts.
          return view('line0.line0', compact('line0s'));
      }

      /**
       * create.
       *
       * @return \Illuminate\View\View
       */
      public function create(): View
      {
          return view('line0.create0');
      }

      /**
       * store.
       *
       * @param  mixed  $request
       *
       * @return \Illuminate\Http\RedirectResponse
       */
      public function store(Request $request): RedirectResponse
      {
          //validate form.
          $this->validate($request, [
              'Tanggal' => 'required|date',
              'PartNumber' => 'required',
              'FlangeNon' => 'required',
              'Quantity' => 'required|numeric',

          ]);

          // Buat data Line0.
          Line0::create([
              'Tanggal' => $request->Tanggal,
              'PartNumber' => $request->PartNumber,
              'FlangeNon' => $request->FlangeNon,
              'Quantity' => $request->Quantity,
          ]);
          //redirect to index.
          return redirect()->route('line0.line0')->with(['success' => 'Data Berhasil Disimpan!']);
      }

      /**
       * edit.
       *
       * @param  mixed  $id
       *
       * @return \Illuminate\View\View
       */
      public function edit(string $id): View
      {
          //get post by ID.
          $line0s = Line0::findOrFail($id);

          //render view with post.
          return view('line0.edit0', compact('line0s'));
      }

      /**
       * update.
       *
       * @param  mixed  $request
       * @param  mixed  $id
       *
       * @return \Illuminate\Http\RedirectResponse
       */
      public function update(Request $request, $id): RedirectResponse // Perbaiki tipe kembalian.
      {
        //validate form.
        $this->validate($request, [
            'Tanggal' => 'required|date',
            'PartNumber' => 'required',
            'FlangeNon' => 'required',
            'Quantity' => 'required|numeric',

        ]);

        // Update data Line2.
        Line0::where('id', $id)
            ->update([
                'Tanggal' => $request->Tanggal,
                'PartNumber' => $request->PartNumber,
                'FlangeNon' => $request->FlangeNon,
                'Quantity' => $request->Quantity,
            ]);

        //redirect to index.
        return redirect()->route('line0.line0')->with(['success' => 'Data Berhasil Diperbarui!']);
    }
         /**
     * destroy
     *
     * @param  mixed $line0s
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $line0s = Line0::findOrFail($id);

        //delete post
        $line0s->delete();

        //redirect to index
        return redirect()->route('line0s.line0')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
