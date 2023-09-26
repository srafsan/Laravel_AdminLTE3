@extends('master')
@section('title', 'Store Lists')

@section('content')
    <h1 class="py-3">All Stores</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Contact Number</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $store)
            <tr>
                <th scope="row">{{$store->id}}</th>
                <td>{{$store->name}}</td>
                <td>{{$store->contact_number}}</td>
                <td>{{$store->description}}</td>
                <td class="d-flex justify-content-center gap-2">
                    <a href="{{route('updateStore', $store->id)}}">
                        <button class="btn btn-outline-primary">Update</button>
                    </a>
                    <button data-id="{{$store->id}}" class="btn btn-danger deleteStoreBtn">Delete</button>
{{--                    <form action="{{route('stores.destroy', $store->id)}}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                    </form>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
