<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Divisi;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data_barang = DB::table('data_barang')->paginate(5);
        $data = Divisi::get();
        return view('masterdata/divisi',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $setup = new Setup;
        // $setup->nama_aplikasi = $request->nama_aplikasi;
        // $setup->jumlah_hari_kerja = $request->jumlah_hari_kerja;
        $this->_validation($request);
        Divisi::create($request->all());

        // $setup->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //cara pertama
    // public function edit($id)
    //cara ke 2
    public function edit(Divisi $divisi)
    {
        //cara pertama
        // $setup = Setup::find($id);
        // return view('konfigurasi.setup-edit',['setup' => $setup]);
        return view('masterdata.divisi-edit',compact('divisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    private function _validation(Request $request){
        $validation = $request->validate([
            'nama' => 'required|max:100|min:3',
            
        ],[
            // 'kode_barang.unique' => 'Kode sudah ada',
            'nama.required' => 'Nama Harus diisi!!!',
            'nama.min' => 'minimal 3 digit',
            'nama.max' => 'miximal 100 digit', 
            
        ]);
    }
    public function update(Request $request, $id)
    {
        $this->_validation($request);
        Divisi::where('id', $id)->update(['nama' => $request->nama]);

        // return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       /* $divisi = Divisi::find(1);

        $divisi->delete();
        return redirect()->back();*/
        Divisi::destroy($id);
        return redirect()->route('divisi.index');
    }
}
