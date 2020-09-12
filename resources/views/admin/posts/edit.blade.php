@extends('varbox::layouts.default')

@section('title', $title)

@section('content')
@include('admin.posts._form', ['url' => route('admin.posts.update', ['post' => $item->id])])
@endsection