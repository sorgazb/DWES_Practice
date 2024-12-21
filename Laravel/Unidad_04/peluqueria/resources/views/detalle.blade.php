<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalle Cita</title>
</head>
<body>
    @if (session('mensaje'))
    <p style="color: red;">{{session('mensaje')}}</p>
    @endif
    <h3>Cliente:{{$cita->cliente}} - Fecha:{{$cita->fecha}} - Hora:{{$cita->hora}}</h3>

    <h3><a href="{{route('verCitas')}}">Volver</a></h3>

    <form action="{{route('aniadirDetalle',$cita->id)}}" method="post">
        @csrf
        <h2>Seleccion Servicio</h2>
        <select name="servicio" id="servicio">
            @foreach ($servicios as $s)
                <option value="{{$s->id}}">{{$s->descripcion}}</option>
            @endforeach
        </select>
        <button type="submit">Añadir</button>
    </form>

    <h3>Servicios Cita</h3>
    @if ($cita->total == 0)
    <form action="{{route('modificarC',$cita->id)}}" method="POST">
        @method('PUT')
        @csrf
        <button type="submit">Finalizar Cita</button>
    </form>
    @endif
    <table border="1px">
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Importe</th>
        </tr>
        @foreach ($cita->obtenerDetalle() as $detalle)
        <tr>
            <td>{{$detalle->id}}</td>
            <td>{{$detalle->servicio->descripcion}}</td>
            <td>{{$detalle->precio}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>