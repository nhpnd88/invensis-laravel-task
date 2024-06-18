@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Pages</h1>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Type</th>
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
                        <td>{{ $page->product }}</td>
                        <td>
                        <img style="display:block;width:50%;height:50%;" src="{{ asset('storage/'.$page->image) }}" alt="" title=""></a>


                        </td>
                        <td>{{ $page->description }}</td>
                        <td>{{ $page->price }}</td>
                        <td>{{ $page->currency }}</td>
                        <td>
                            <a href="{{ route('payment', $page->id) }}" class="btn btn-warning">Payment</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
