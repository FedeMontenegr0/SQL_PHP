<?php
// Verificar si se ha proporcionado un ID válido
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Incluir archivo de conexión a la base de datos
    include 'db.php';

    // Query para seleccionar el registro específico basado en el ID
    $sql = "SELECT * FROM COMPONENTES WHERE idmaterial = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener los datos del registro
        $row = $result->fetch_assoc();
        $id = $row["idmaterial"];
        $material = $row["material"];
        $descripcion = $row["descripcion"];
        $estado = $row["estado"];
    } else {
        // Si no se encuentra el registro, redirigir a abm.php o mostrar un mensaje de error
        header("Location: abm.php");
        exit();
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se proporciona un ID, redirigir a abm.php
    header("Location: abm.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CÓRDOBA ELECTRÓNICA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
    <?php include 'views/header.php'; ?>

    <div class="container mt-4 mb-4">
        <h1 class="h2 text-center">Modificar componente</h1>
    </div>

    <div class="container">
    <form action="guardar_modificacion.php" method="POST">
                    <div class="form-group">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo $id; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="material">Material:</label>
                        <input type="text" class="form-control" id="material" name="material" value="<?php echo $material; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $estado; ?>" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                        <a href="abm.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </div>
                </form>
    </div>



    <?php include 'views/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
