@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $page->title }}</h1>
    @if ($page->image)
        <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->title }}">
    @endif
    <p>{{ $page->description }}</p>
</div>
@endsection

