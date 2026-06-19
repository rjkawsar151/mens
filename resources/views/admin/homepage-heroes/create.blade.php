@extends('layouts.admin')

@section('title', 'Create Homepage Hero')
@section('page_title', 'Create Homepage Hero')

@section('admin_content')
<form action="{{ url('/admin/homepage-heroes') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @include('admin.homepage-heroes._form', ['method' => 'POST'])
</form>
@endsection
