@extends('layouts.master')
@section('title','Laravel')
@section('content')
<div class="title m-b-md">
  ini isi content

  {{Auth::user()->name}}
</div>



@endsection
@push('page-scripts')

@endpush