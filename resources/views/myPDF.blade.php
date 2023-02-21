<!DOCTYPE html>
<html>
<head>
    <title>factura</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>FACTURA de CUOTA de {{ $name }} </h1>
  
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
      
        <tr>
            <td>{{ $id}}</td>
            <td>{{ $name }}</td>
            <td>{{ $email }}</td>
        </tr>

    </table>

    <table class="table table-bordered">
        <tr>
            <th>concepto</th>
            <th>fecha</th>
            <th>importe</th>
        </tr>
     
        <tr>
            <td>{{ $concepto }}</td>
            <td>{{ $fecha }}</td>
            <td>{{ $importe }} €</td>
        </tr>
    </table>
  
</body>
</html>