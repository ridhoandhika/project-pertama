<div class="row">
    <div class="col-md-12">
        <input type="hidden" name="id" value="{{ $divisi->id }}" id="id_data">
        <div class="form-group">
            <label>Divisi</label>
            <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror"
                value="{{ old('nama', $divisi->nama) }}">
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
