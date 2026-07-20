@extends('admin.layouts.app')

@section('title', 'New Event')

@section('content')
<form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
  @include('admin.events._form')
</form>
@endsection
