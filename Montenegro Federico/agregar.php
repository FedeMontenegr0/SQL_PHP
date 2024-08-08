<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CÓRDOBA ELECTRÓNICA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<?php
include 'db.php';

// Inicializar variables
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $material = $_POST["material"];
    $descripcion = $_POST["descripcion"];
    $estado = $_POST["estado"];

    $sql = "INSERT INTO COMPONENTES (material, descripcion, estado) VALUES ('$material', '$descripcion', $estado)";

    if ($conn->query($sql) === TRUE) {
        // Nuevo registro creado exitosamente
        $mensaje = "Nuevo registro creado exitosamente";
    } else {
        $mensaje = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<body>

    <?php include 'views/header.php'; ?>

    <div class="container mt-4 mb-4">
        <h1 class="h2 text-center">Agregar componente</h1>
    </div>

    <div class="container">
        <form method="post" action="agregar.php">
            <div class="form-group">                
                <input type="text" placeholder="Ingrese Material" class="form-control" id="material" name="material" required>
            </div>
            <div class="form-group">                
                <input type="text" placeholder="Ingrese Descripción" class="form-control" id="descripcion" name="descripcion" required>
            </div>
            <div class="form-group">                
                <input type="number" placeholder="Ingrese Estado" class="form-control" id="estado" name="estado" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-outline-primary">Guardar</button>
                <a href="abm.php" class="btn btn-outline-secondary ml-2">Cancelar</a>
            </div>
        </form>
    </div>

    <?php include 'views/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script para mostrar un aviso en el navegador y redireccionar -->
    <script>
        // Mostrar un aviso si el mensaje no está vacío
        <?php if (!empty($mensaje)) { ?>
            alert('<?php echo $mensaje; ?>');
            // Redireccionar a abm.php al cerrar el mensaje
            window.location.href = 'abm.php';
        <?php } ?>
    </script>

</body>

</html>