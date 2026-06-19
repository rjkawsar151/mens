@extends('layouts.admin')

@section('title', 'Edit Homepage Hero')
@section('page_title', 'Edit Homepage Hero')

@section('admin_content')
<form action="{{ url('/admin/homepage-heroes/' . $hero->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @include('admin.homepage-heroes._form', ['method' => 'PUT'])
</form>
@endsection
