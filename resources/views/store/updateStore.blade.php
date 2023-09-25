<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('CDNs.headercdns')
</head>
<body>
@include('Shared.navbar')
@include('Shared.sidebar')
<section class="content-wrapper">
    <h1 class="text-center pt-4">Update the Store</h1>
    <div class="mt-5 container-fluid">
        <form method="post" action="{{route('stores.update', $store->id)}}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="inputStoreName" class="form-label">Store Name</label>
                <input value="{{$store->name}}" type="text" name="name" class="form-control" id="inputStoreName">
            </div>
            <div class="mb-3">
                <label for="inputContact" class="form-label">Contact Number</label>
                <input value="{{$store->contact_number}}"  type="number" name="contact_number" class="form-control" id="inputContact">
            </div>
            <div class="mb-3">
                <label for="inputDesc" class="form-label">Description</label>
                <input value="{{$store->description}}"  type="text" name="description" class="form-control" id="inputDesc">
            </div>
            <div class="mb-3">
                <label for="inputRegion" class="form-label">Region</label>
                <input value="{{$store->region}}"  type="number" name="region" class="form-control" id="inputRegion">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>
@include('Shared.footer')
@include('CDNs.footercdns')
</body>
</html>
