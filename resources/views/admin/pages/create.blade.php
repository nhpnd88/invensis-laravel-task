<!-- resources/views/pages/create.blade.php and resources/views/pages/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($page) ? 'Edit Page' : 'Add Page' }}</h1>
        <form action="{{ isset($page) ? route('pages.update', $page->id) : route('pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($page))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="type">Page Type</label>
                <div>
                    <input type="radio" name="type" value="Normal Page" {{ (isset($page) && $page->type == 'Normal Page') ? 'checked' : '' }}> Normal Page
                    <input type="radio" name="type" value="Payment Page" {{ (isset($page) && $page->type == 'Payment Page') ? 'checked' : '' }}> Payment Page
                </div>
            </div>

            <div id="normalPageFields" style="{{ isset($page) && $page->type == 'Normal Page' ? '' : 'display: none;' }}">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $page->title ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" value="{{ $page->image ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control">{{ $page->description ?? '' }}</textarea>
                </div>
            </div>

            <div id="paymentPageFields" style="{{ isset($page) && $page->type == 'Payment Page' ? '' : 'display: none;' }}">
                <div class="form-group">
                    <label for="product">Product</label>
                    <input type="text" name="product" class="form-control" value="{{ $page->product ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control">{{ $page->description ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ $page->price ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="currency">Currency</label>
                    <input type="text" name="currency" class="form-control" value="{{ $page->currency ?? '' }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($page) ? 'Update' : 'Add' }}</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const normalPageFields = document.getElementById('normalPageFields');
            const paymentPageFields = document.getElementById('paymentPageFields');
            const radioButtons = document.querySelectorAll('input[name="type"]');

            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'Normal Page') {
                        normalPageFields.style.display = 'block';
                        paymentPageFields.style.display = 'none';
                    } else {
                        normalPageFields.style.display = 'none';
                        paymentPageFields.style.display = 'block';
                    }
                });
            });
        });
    </script>
@endsection
