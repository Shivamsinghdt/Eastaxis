@extends('admin.layouts.app')

@section('title', 'Edit Expert')

@section('content')
<form method="POST" action="{{ route('admin.experts.update', $expert) }}" enctype="multipart/form-data">
  @include('admin.experts._form')
</form>
@endsection
