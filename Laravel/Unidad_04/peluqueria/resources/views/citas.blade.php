<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Citas</title>
</head>
<body>
    <form action="{{route('crearC')}}" method="post">
        @csrf
        <input type="date" name="fecha" value="{{date('Y-m-d')}}"/>
        <input type="time" name="hora" value="{{date('H:i')}}"/>
        <input type="text" name="cliente" placeholder="Nombre Cliente">
        <button type="submit">Crear Cita</button>
        @error('fecha')
            <p style="color: red">ERROR. Rellena Fecha</p>
        @enderror
        @error('hora')
            <p style="color: red">ERROR. Rellena Hora</p>
        @enderror
        @error('cliente')
            <p style="color: red">ERROR. Rellena Cliente</p>
        @enderror
    </form>
    @if (session('mensaje'))
        <p style="color: red">{{session('mensaje')}}</p>
    @endif
    <table border="1px">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        @foreach ($citas as $cita)
        <tr>
            <td>{{$cita->id}}</td>
            <td>{{$cita->cliente}}</td>
            <td>{{$cita->fecha}}</td>
            <td>{{$cita->hora}}</td>
            <td>{{$cita->total}}</td>
            <td>
                <form action="{{route('crearDetalle',$cita->id)}}" method="get">
                    @csrf
                    <button type="submit" name="detalleC">Detalle</button>
                </form>
                <form action="{{route('borrarC',$cita->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" name="borrarC">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>