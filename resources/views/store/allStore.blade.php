<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Stores</title>
    @include('CDNs.headercdns')
</head>
<body>
    @include('Shared.navbar')
    @include('Shared.sidebar')

    <div class="content-wrapper text-center">
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
                        <form action="{{route('stores.destroy', $store->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @include('Shared.footer')
    @include('CDNs.footercdns')
</body>
</html>
