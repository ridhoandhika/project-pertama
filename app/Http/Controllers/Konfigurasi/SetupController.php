<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Setup;

class SetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data_barang = DB::table('data_barang')->paginate(5);
        $setup = Setup::get();
        return view('konfigurasi/setup',['setup' => $setup]);
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
        Setup::create($request->all());

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
    public function edit(Setup $setup)
    {
        //cara pertama
        // $setup = Setup::find($id);
        // return view('konfigurasi.setup-edit',['setup' => $setup]);
        return view('konfigurasi.setup-edit',compact('setup'));
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
            'nama_aplikasi' => 'required|max:100|min:3',
            'jumlah_hari_kerja' => 'required|numeric|max:31'
        ],[
            // 'kode_barang.unique' => 'Kode sudah ada',
            'nama_aplikasi.required' => 'Nama Harus diisi!!!',
            'nama_aplikasi.min' => 'minimal 3 digit',
            'nama_aplikasi.max' => 'miximal 100 digit', 
            'jumlah_hari_kerja.required' => 'Harus diisi!!!',
            'jumlah_hari_kerja.numeric' => 'Harus angka',
            'jumlah_hari_kerja.max' => 'Angka maximal 31 ',  
        ]);
    }
    public function update(Request $request, $id)
    {
        $this->_validation($request);
        Setup::where('id', $id)->update(['nama_aplikasi' => $request->nama_aplikasi,'jumlah_hari_kerja' => $request->jumlah_hari_kerja]);

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
        //
    }
}
