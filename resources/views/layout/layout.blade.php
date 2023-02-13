<!DOCTYPE html>
<html>
<head>
  
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://apis.google.com/js/platform.js" async defer></script>
<title>@yield('title','ANDREA')</title>
</head>
<body>
  @include('layout.nav')
  <div class="container mt-2">
    <div class="row">
    <div class="col-lg-12 margin-tb">
  @yield('content')
 
    </div>
    </div>
  </div> 
  @include('layout.footer')

  <script src={{ asset('js/app.js')}}></script>
  @yield('js')
</body>
</html>