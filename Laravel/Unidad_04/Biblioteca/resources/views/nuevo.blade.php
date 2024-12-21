<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo Prestamo</title>
</head>
<body>
    <h1>CREAR PRESTAMO</h1>
    <form action="{{route('crearPrestamo')}}" method="post">
        @csrf
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" value="{{date('Y-m-d')}}"/>
        <br>
        <label>Selecciona Libro</label>
        <select name="libro" id="libro">
            @foreach ($libros as $libro)
                <option value="{{$libro->id}}" {{old('libro') == $libro->id ? 'selected' : ''}}>{{$libro->titulo}}</option>
            @endforeach
        </select>
        <br>
        <label for="cliente">Cliente</label>
        <input type="text" name="cliente" value="{{old('cliente')}}" placeholder="Introduce el Nombre del Cliente">
        <br>
        <button type="submit">Crear</button>
        @error('fecha')
            <p style="color: red">ERROR. Rellena Fecha</p>
        @enderror
        @error('libro')
            <p style="color: red">ERROR. Rellena Hora</p>
        @enderror
        @error('cliente')
            <p style="color: red">ERROR. Rellena Cliente</p>
        @enderror
    </form>
    @if (session('mensaje'))
        <p style="color: red">{{session('mensaje')}}</p>
    @endif
</body>
</html>