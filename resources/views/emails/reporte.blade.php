<!DOCTYPE html>
<html>
<head>
 <title>Laravel 10 Send Email Example</title>
</head>
<body>
 
    <h1>Hola</h1>
    <p>Se ah registrado un nuevo usuario</p>
    <p style="color:#6972FF; ">te enviamos el reporte de usuario registrado por pais</p>
    <table>
        <thead>
            <tr>
                <th>Pais</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $key => $value)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
 
</body>
</html> 