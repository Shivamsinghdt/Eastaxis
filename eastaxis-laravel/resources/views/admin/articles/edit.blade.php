@extends('admin.layouts.app')

@section('title', 'Edit Article')

@section('content')
<form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data">
  @include('admin.articles._form')
</form>
@endsection
