<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @include('CDNs.headercdns')
</head>
<body>
    @include('Shared.navbar')
    @include('Shared.sidebar')

    <div class="h-100 content-wrapper d-flex justify-content-center align-items-center">
        <h1 class="font-weight-bolder">Welcome to the dashboard</h1>
    </div>

    @include('Shared.footer')
    @include('CDNs.footercdns')
</body>
</html>
