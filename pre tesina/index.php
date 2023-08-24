<?php
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

$conn = new mysqli('localhost', 'usuario', 'contrasena', 'mi_base_de_datos');

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

$sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$nombre', '$email', '$contrasena')";

if ($conn->query($sql) === TRUE) {
    // Enviar correo de notificación al usuario
    mail($email, 'Registro exitoso', 'Te has registrado en nuestro sitio web.');
    
    echo 'Registro exitoso. Se ha enviado una notificación a tu correo.';
} else {
    echo 'Error al registrar: ' . $conn->error;
}

$conn->close();
?>
<?php
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$token = bin2hex(random_bytes(16)); // Generar un token único para confirmación de correo

$conn = new mysqli('localhost', 'usuario', 'contrasena', 'mi_base_de_datos');

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

$sql = "INSERT INTO usuarios (nombre, email, contrasena, token, confirmado) VALUES ('$nombre', '$email', '$contrasena', '$token', 0)";

if ($conn->query($sql) === TRUE) {
    // Enviar correo de confirmación con enlace al token
    $confirm_link = "http://tudominio.com/confirmar.php?token=$token";
    $message = "Haz clic en el siguiente enlace para confirmar tu correo electrónico:\n\n$confirm_link";
    mail($email, 'Confirmar registro', $message);

    echo 'Registro exitoso. Se ha enviado un enlace de confirmación a tu correo.';
} else {
    echo 'Error al registrar: ' . $conn->error;
}

$conn->close();


$token = $_GET['token'];

$conn = new mysqli('localhost', 'usuario', 'contrasena', 'mi_base_de_datos');

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

$sql = "UPDATE usuarios SET confirmado = 1 WHERE token = '$token'";

if ($conn->query($sql) === TRUE) {
    echo 'Correo electrónico confirmado correctamente.';
} else {
    echo 'Error al confirmar el correo electrónico: ' . $conn->error;
}

$conn->close();

?>