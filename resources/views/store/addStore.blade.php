<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Store</title>
    @include('CDNs.headercdns')
</head>
<body>
    @include('Shared.navbar')
    @include('Shared.sidebar')
    <div class="nav-item">
        <section class="content-wrapper nav-link active">
            <h1 class="text-center pt-4">Add a Store</h1>
            <div class="mt-5 container-fluid">
                <form method="post" action="{{route('stores.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="inputStoreName" class="form-label">Store Name</label>
                        <input type="text" name="name" class="form-control" id="inputStoreName">
                    </div>
                    <div class="mb-3">
                        <label for="inputContact" class="form-label">Contact Number</label>
                        <input type="number" name="contact_number" class="form-control" id="inputContact">
                    </div>
                    <div class="mb-3">
                        <label for="inputDesc" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="inputDesc">
                    </div>
                    <div class="mb-3">
                        <label for="inputRegion" class="form-label">Region</label>
                        <input type="number" name="region" class="form-control" id="inputRegion">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </div>
    @include('Shared.footer')
    @include('CDNs.footercdns')
</body>
</html>
