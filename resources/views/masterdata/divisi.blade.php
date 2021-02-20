@extends('layouts.master')
@section('title','Laravel')
@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <h4>Setup Aplikasi</h4>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add</button>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-primary alert-dismissible show fade">
                        <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        {{ session('message')}}
                        </div>
                    </div>
                @endif
                <table class="table table-striped table-bordered table-sm">
                    
                        <tr>
                            <th>No</th>
                            <th>Divisi</th>
                            <th>Action</th>
                        </tr>
                    @foreach ($data as $no => $dt )
                    <tr>
                        <td>{{ $no+1}}</td>
                        <td>{{ $dt->nama }}</td>  
                        <td>
                            <a href="#" data-id="{{$dt->id}}" class="badge badge-warning btn-edit"><i class="far fa-edit"></i> Edit</a>
                            <a href="#" data-id="{{$dt->id}}" class="badge badge-danger swal-confirm">
                            <form action="{{ route('divisi.destroy', $dt->id) }}" id="delete{{ $dt->id }}" method="POST">
                                @csrf
                                @method('delete')
                            </form>
                            Delete
                            </a> 
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('divisi.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Divisi</label>
                            <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror" value="{{ old('nama')}}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>  
                            @enderror        
                        </div>
                    </div> 
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save </button>
            </div>
        </div>
        </form>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form action="{{ route('divisi.store') }}" method="POST" id="form-edit">
                @csrf
                <div class="modal-body">
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-update">Save </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@endsection
@push('page-scripts')
<script src="{{asset('assets/node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>
@endpush

@push('after-script') 
<script>
    $(".swal-confirm").click(function(e) {
        id = e.target.dataset.id;
        swal({
            title: 'Yakin akan menghapus ? ',
            text: 'data dihapus permanent',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            // swal('Poof! Your imaginary file has been deleted!', {
            //   icon: 'success',
            // });
            $(`#delete${id}`).submit();
            } else {
                // swal('Your imaginary file is safe!');
            }
        });
    });
    @if($errors->any())
        $('#exampleModal').modal('show')
    @endif
    $('.btn-edit').on('click',function(e){
        console.log($(this).data('id'))
        let id= $(this).data('id')
        $.ajax({
            url:`/master-data/divisi/${id}/edit`,
            method:"GET",
            success: function(data){
               // console.log(data)
                $('#modal-edit').find('.modal-body').html(data)
                $('#modal-edit').modal('show')
            },
            error:function(error){
                console.log(error)
            }
        })
    });
    $('.btn-update').on('click',function(){
        // console.log($(this).data('id'))
        let id = $('#form-edit').find('#id_data').val()
        let formData = $('#form-edit').serialize()
        console.log(formData)
        // console.log(id)
        $.ajax({
            url:`/master-data/divisi/${id}`,
            method:"PATCH",
            data: formData,
            success: function(data){
                // console.log(data)
                // $('#modal-edit').find('.modal-body').html(data)
                $('#modal-edit').modal('hide')
                window.location.assign('/master-data/divisi')
            },
            error:function(err){
                console.log(err.responseJSON)
                let err_log = err.responseJSON.errors
                if(err.status == 422){
                    if(typeof(err_log.nama) !== 'undefined'){
                    $('#modal-edit').find('[name="nama"]').prev().html('<span style="color:red">Divisi '+err_log.nama[0]+' </span>')
                    }else{
                        $('#modal-edit').find('[name="nama"]').prev().html('<span>Divisi  </span>')
                    }
                    // jumlah_hari_kerja
                }
            }
        })
    });
</script>
@endpush