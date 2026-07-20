@extends('admin.layouts.app')

@section('title', 'New Article')

@section('content')
<form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
  @include('admin.articles._form')
</form>
@endsection
