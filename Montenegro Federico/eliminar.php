

<?php
// Verificar si se ha enviado el ID a eliminar
if (isset($_POST['id'])) {
    // Obtener el ID del formulario
    $id = $_POST['id'];

    // Incluir archivo de conexión a la base de datos
    include 'db.php';

    // Query para eliminar el registro del ID específico
    $sql = "DELETE FROM COMPONENTES WHERE idmaterial = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redireccionar de vuelta a abm.php después de eliminar
        header("Location: abm.php");
        exit();
    } else {
        echo "Error al intentar eliminar el registro: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Si no se ha enviado el ID, redireccionar a abm.php
    header("Location: abm.php");
    exit();
}
?>
