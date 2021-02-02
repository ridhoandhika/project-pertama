<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    //method menampilkan data 
    public function index()
    {
        $data_barang = DB::table('data_barang')->paginate(5);
        
        return view('crud',['data_barang' => $data_barang]);
    }
    //method menampilkan form tambah data
    public function add()
    {
           
           return view('crudadd');
    }

    public function save(Request $request)
    {
        //panggil private validation
       $this->_validation($request);

       //prosess simpan
        DB::table('data_barang')->insert([
            ['kode_barang' => $request->kode_barang, 'nama_barang' => $request->nama_barang],
            // ['kode_barang' => $request->kode_barang.'xx', 'nama_barang' => $request->nama_barang.'xx'],
           
        ]);
        return redirect()->route('crud')->with('message','Data tersimpan');
    }
    private function _validation(Request $request){
        $validation = $request->validate([
            'kode_barang' => 'required|max:10|min:3',
            'nama_barang' => 'required|max:100|min:3'
        ],[
            'kode_barang.unique' => 'Kode sudah ada',
            'kode_barang.required' => 'Harus diisi!!!',
            'kode_barang.min' => 'minimal 3 digit',
            'nama_barang.required' => 'Harus diisi!!!',
            'nama_barang.min' => 'minimal 3 digit',
        ]);
    }
    public function edit($id)
    {
        //ambil data id yang akan di edit
       $data_barang = DB::table('data_barang')
        ->where('id', $id)
            ->first();

        return view ('crudedit',['data_barang' => $data_barang]);
    }

    public function delete($id)
    {
        DB::table('data_barang')
            ->where('id', $id)
                ->delete();

        return redirect()->back()->with('message','Data terhapus');
    }
    public function update(Request $request, $id)
    {
        //panggil private validation
        $this->_validation($request);

        //proses update berdasarkan id
        DB::table('data_barang')->where('id', $id)->update([
                    'kode_barang' => $request->kode_barang,
                    'nama_barang' => $request->nama_barang
                ]);

        return redirect()->route('crud')->with('message','data terupdate'); 
    }
}
