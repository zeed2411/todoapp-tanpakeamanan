{{-- views\layouts\default.blade.php --}}
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset("assets\css\bootstrap.min.css") }}" rel="stylesheet">
    @yield("style")
  </head>
  <body class="d-flex flex-column h-100">
    @include("include.header") 
    @yield("content")
    @include("include.footer")

   <script src="{{ asset("assets\js\bootstrap.min.js") }}"></script>
  </body>
</html>
