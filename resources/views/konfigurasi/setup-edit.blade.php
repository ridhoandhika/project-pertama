<div class="row">
    <div class="col-md-12">
    <input type="hidden" name="id" value="{{ $setup->id}}" id="id_data" >
        <div class="form-group">
            <label>Nama Aplikasi</label>
            <input type="text" name="nama_aplikasi" class="form-control  @error('nama_aplikasi') is-invalid @enderror" value="{{ old('nama_aplikasi', $setup->nama_aplikasi)}}">
            @error('nama_aplikasi')
                <div class="invalid-feedback">{{ $message }}</div>  
            @enderror        
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label >Hari Kerja</label>
        <input type="text" name="jumlah_hari_kerja" class="form-control @error('jumlah_hari_kerja') is-invalid @enderror" value="{{ old('jumlah_hari_kerja',$setup->jumlah_hari_kerja)}}">   
            @error('jumlah_hari_kerja')
                <div class="invalid-feedback">{{ $message }}</div>  
            @enderror                            
        </div>
    </div>
    
</div>