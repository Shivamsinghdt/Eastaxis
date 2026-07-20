@extends('admin.layouts.app')

@section('title', 'New Program')

@section('content')
<form method="POST" action="{{ route('admin.programs.store') }}">
  @include('admin.programs._form')
</form>
@endsection
