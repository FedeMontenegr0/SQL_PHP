<?php
// Incluir archivo de conexión a la base de datos
include 'db.php';

// Variable para mensaje de éxito
$mensaje = "";

// Verificar si se han recibido los datos del formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $id = $_POST['id'];
    $material = $_POST['material'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    // Query para actualizar el registro en la tabla COMPONENTES
    $sql = "UPDATE COMPONENTES SET material='$material', descripcion='$descripcion', estado='$estado' WHERE idmaterial=$id";

    if ($conn->query($sql) === TRUE) {
        // Mensaje de éxito para mostrar en el navegador
        $mensaje = "Registro modificado exitosamente";

        // Mostrar el mensaje y redireccionar después de cerrarlo
        echo '<script>';
        echo 'alert("' . $mensaje . '");';
        echo 'window.location.href = "abm.php";';
        echo '</script>';
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
