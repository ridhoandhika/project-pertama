@extends('layouts.master')
@section('title','Laravel')
@section('content')
<div class="title m-b-md">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                  <h4>HTML5 Form Basic</h4>
                </div>
                <div class="card-body">
                    
                  {{-- <div class="alert alert-info">
                    <b>Note!</b> Not all browsers support HTML5 type input.
                  </div> --}}
                    <form action="{{ route('crud.update',$data_barang->id)}}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" value="{{ old('kode_barang', $data_barang->kode_barang)}}">   
                                    @error('kode_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>  
                                    @enderror                            
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control  @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang', $data_barang->nama_barang)}}">
                                    @error('nama_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>  
                                    @enderror        
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit">Simpan</button>
                            <button class="btn btn-secondary" type="reset">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('page-scripts')

@endpush