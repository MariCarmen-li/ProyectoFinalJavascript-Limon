
<?php
// Conexión a la base de datos (asegúrate de tener los detalles de conexión correctos)
$servername = "localhost:3310";
$username = "root";
$password = "";
$dbname = "archivos_pdf";
$conn = new mysqli($servername, $username, $password, $dbname);


// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Procesar el archivo recibido
$fileName = $_POST['fileName'];
$pdfFile = $_FILES['pdfFile'];

// Obtener la información del archivo
$fileTmpPath = $pdfFile['tmp_name'];
$fileName = basename($pdfFile['name']);
$fileSize = $pdfFile['size'];

// Guardar el archivo en una carpeta (opcional)
$uploadDirectory = 'Tareas/' . $fileName;
move_uploaded_file($fileTmpPath, $uploadDirectory);

// Guardar la información en la base de datos
$sql = "INSERT INTO archivos_pdf (nombre, ruta) VALUES ('$fileName', '$uploadDirectory')";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('El archivo se ha enviado al profesor exitosamente para su revisión, espere su calificacion.');</script>";
    header("refresh:0.1; url=Vistatabalumno.html");
} else {
    echo "<script>alert('Error al enviar la tarea al profesor, hay un problema en la base de datos: " . $conn->error . "');</script>";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>