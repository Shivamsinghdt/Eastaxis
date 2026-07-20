@extends('admin.layouts.app')

@section('title', 'Edit Event')

@section('content')
<form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
  @include('admin.events._form')
</form>
@endsection
