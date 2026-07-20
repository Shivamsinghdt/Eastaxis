@extends('admin.layouts.app')

@section('title', 'Edit Program')

@section('content')
<form method="POST" action="{{ route('admin.programs.update', $program) }}">
  @include('admin.programs._form')
</form>
@endsection
