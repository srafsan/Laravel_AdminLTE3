@extends('master')
@section('title', 'Store Lists')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h1>All Stores</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStoreModal">
            Add Store +
        </button>
    </div>

    <table class="table">
        <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Contact Number</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody id="storeTable" class="text-center">
        @foreach($data as $store)
            <tr>
                <th scope="row">{{$store->id}}</th>
                <td>{{$store->name}}</td>
                <td>{{$store->contact_number}}</td>
                <td>{{$store->description}}</td>
                <td class="d-flex justify-content-center">
                    <button id="updateBtn-{{$store->id}}" data-id="{{$store->id}}" data-toggle="modal" data-target="#updateStoreModal{{$store->id}}" class="btn btn-outline-primary">Update</button>
                    <button id="deleteBtn-{{$store->id}}" data-id="{{$store->id}}"
                            class="btn btn-danger ml-2">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="addStoreModal" tabindex="-1" aria-labelledby="addStoreModalLabel" aria-hidden="true">
        @include('store.addStore')
    </div>
    @foreach($data as $store)
        <div class="modal fade" id="updateStoreModal{{$store->id}}" tabindex="-1" aria-labelledby="updateStoreModalLabel{{$store->id}}" aria-hidden="true">
            @include('store.updateStore', ['store' => $store])
        </div>
    @endforeach

    <!-- Scripts -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Delete Store
            $('[id^=deleteBtn]').click(function () {
                if(confirm("Do you really want to delete?")) {
                    let storeId = $(this).data("id");
                    let element = this;

                    $.ajax({
                        url: `stores/${storeId}`,
                        type: "DELETE",
                        data: {id: storeId},
                        success: function (data) {
                            if (data) {
                                $(element).closest("tr").fadeOut();
                            } else {
                                alert('Not deleted successfully');
                            }
                        }
                    })
                }
            });
        })
    </script>
@endsection
