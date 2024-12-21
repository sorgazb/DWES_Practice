<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar Prestamo</title>
</head>
<body>
    <h1>MODIFICAR PRESTAMO</h1>
    <form action="{{route('modificarPrestamo',$prestamo->id)}}" method="post">
        @method('PUT')
        @csrf
        <label for="id">ID</label>
        <input type="text" name="" value="{{$prestamo->id}}" readonly>
        <br>
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" value="{{$prestamo->fecha}}">
        <br>
        <label for="libro">Libro</label>
        <input type="text" value="{{$prestamo->libro_id}}" readonly>
        <br>
        <label for="cliente">Cliente</label>
        <input type="text" name="cliente" value="{{$prestamo->nombreCliente}}">
        <br>
        <label for="fechaDevolucion">Fecha Devolucion</label>
        <input type="date" name="fechaDevolucion" value="{{date('Y-m-d')}}"/>
        <br>
        <button type="submit">Modificar</button>
    </form>
    <button><a href="{{route('verPrestamos')}}">Cancelar</a></button>
    @if (session('mensaje'))
        <p style="color: red">{{session('mensaje')}}</p>
    @endif
</body>
</html>