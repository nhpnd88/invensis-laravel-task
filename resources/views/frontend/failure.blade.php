@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $page->title }}</h1>
    @if ($page->image_url)
        <img src="{{ $page->image_url }}" alt="{{ $page->title }}">
    @endif
    <p>{{ $page->description }}</p>
    <p>Payment failed. Please try again.</p>
</div>
@endsection


