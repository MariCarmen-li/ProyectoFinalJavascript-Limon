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

// Obtener el nombre del archivo a buscar
$fileName = $_POST['fileName'];

// Buscar en la base de datos por el nombre del archivo
$sql = "SELECT * FROM archivos_pdf WHERE nombre = '$fileName'";
$result = $conn->query($sql);

// Mostrar los resultados
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $fileId = $row['id'];
        $filePath = $row['ruta'];
        echo "<br><a href='download.php?id=$fileId'>$fileName</a><br>";
        /*echo "<br><a href='download.php?id=$fileId'>Descargar Tarea</a><br>";*/
    }   
} else {
    echo "<br>No se encontraron archivos con ese nombre.<br> Vuelve a intentarlo";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>