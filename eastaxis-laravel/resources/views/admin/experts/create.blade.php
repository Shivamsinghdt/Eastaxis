@extends('admin.layouts.app')

@section('title', 'New Expert')

@section('content')
<form method="POST" action="{{ route('admin.experts.store') }}" enctype="multipart/form-data">
  @include('admin.experts._form')
</form>
@endsection
