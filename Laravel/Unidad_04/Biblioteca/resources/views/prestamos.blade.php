<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestamos</title>
</head>
<body>

    <form action="{{route('vistaNuevos')}}" method="get">
        @csrf
        <button type="submit">Nuevo Prestamo</button>
    </form>

    <table border="1px">
        <tr>
            <th>ID</th>
            <th>Fecha de Prestamo</th>
            <th>Titulo del Libro</th>
            <th>Cliente</th>
            <th>Fecha Devolucion</th>
            <th>Accion</th>
        </tr>
        @foreach ($prestamos as $prestamo)
        <tr>
            <td>{{$prestamo->id}}</td>
            <td>{{$prestamo->fecha}}</td>
            <td>{{$prestamo->libro->titulo}}</td>
            <td>{{$prestamo->nombreCliente}}</td>
            <td>{{$prestamo->fechaDevolucion}}</td>
            <td>
                <form action="{{route('vistaModificar',$prestamo->id)}}" method="get">
                    @csrf
                    <button type="submit" name="">Modificar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    @if (session('mensaje'))
        <p style="color: red">{{session('mensaje')}}</p>
    @endif
</body>
</html>