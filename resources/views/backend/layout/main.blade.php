<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BhopalPlush</title>
    @include('backend.layout.css')
</head>
<body>
    <div class="container-scroller">
        @include('backend.layout.navbar')
        @include('backend.layout.sidenav')
        <div class="container-fluid page-body-wrapper">
    @yield('contain')
        </div>
      
</div>    
</body>
@include('backend.layout.script')
</html>