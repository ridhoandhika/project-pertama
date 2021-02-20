@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
    <div class="title m-b-md">
        <x-alert type="success" judul="informasi" :isipesan="$isipesan" />
        {{-- ini isi content

  {{Auth::user()->name}} --}}
    </div>



@endsection
@push('page-scripts')

@endpush
