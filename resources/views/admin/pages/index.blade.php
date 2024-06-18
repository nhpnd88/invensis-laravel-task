@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pages</h1>
        <a href="{{ route('pages.create') }}" class="btn btn-primary">Add Page</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Currency</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->type }}</td>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->product }}</td>
                        <td>
                        <img style="display:block;width:50%;height:50%;" src="{{ asset('storage/'.$page->image) }}" alt="" title=""></a>
                        </td>
                        <td>{{ $page->description }}</td>
                        <td>{{ $page->price }}</td>
                        <td>{{ $page->currency }}</td>
                        <td>
                            <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('pages.destroy', $page->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
