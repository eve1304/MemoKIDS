<?php
// Conexión a la base de datos
$con = mysqli_connect('localhost', 'root1', 'root', 'proyecto');

// Verificar conexión
if (!$con) {
    http_response_code(500);
    echo "Error al conectar a la base de datos.";
    exit;
}

// Capturar datos del formulario
$nombre = $_POST["nombre"] ?? '';
$apellidos = $_POST["apellidos"] ?? '';
$edad = $_POST["edad"] ?? '';
$grado = $_POST["grado"] ?? '';
$grupo = $_POST["grupo"] ?? '';
$contraseña = $_POST["contraseña"] ?? '';

// Encriptar la contraseña
$contraseña_encriptada = password_hash($contraseña, PASSWORD_BCRYPT);

// Crear la consulta SQL
$sql = "INSERT INTO docentes (nombre, apellidos, edad, grado, grupo, contraseña) VALUES ('$nombre', '$apellidos', '$edad', '$grado', '$grupo', '$contraseña_encriptada')";

// Ejecutar la consulta
if (mysqli_query($con, $sql)) {
    echo "Datos registrados correctamente:\nNombre: $nombre\nApellidos: $apellidos\nEdad: $edad\nGrado: $grado\nGrupo: $grupo";
} else {
    http_response_code(500);
    echo "Error al registrar los datos: " . mysqli_error($con);
}

// Cerrar conexión
mysqli_close($con);
?>
