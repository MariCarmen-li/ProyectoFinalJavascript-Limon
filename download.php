<?php
// Conexión a la base de datos (asegúrate de tener los detalles de conexión correctos)
$servername = "localhost:3310";
$username = "root";
$password = "";
$dbname = "archivos_pdf";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtener el ID del archivo a descargar
$fileId = $_GET['id'];

// Obtener la información del archivo desde la base de datos
$sql = "SELECT * FROM archivos_pdf WHERE id = $fileId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $filePath = $row['ruta'];

    // Descargar el archivo
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
    readfile($filePath);
} else {
    echo "El archivo no existe.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>