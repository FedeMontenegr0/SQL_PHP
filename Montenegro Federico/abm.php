<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CÓRDOBA ELECTRÓNICA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include 'views/header.php'; ?>

    <div class="container mt-4 mb-4">
        <h1 class="h2 text-center">Componentes</h1>
    </div>

    <div class="container mb-4">
        <!-- Formulario de búsqueda -->
        <form id="search-form" action="abm.php" method="GET">
            <div class="form-row align-items-end">
                <div class="col-md-4">
                    <label for="search-material">Buscar:</label>
                    <input type="text" placeholder="Material" id="search-material" name="material" class="form-control"
                        value="<?php echo isset($_GET['material']) ? htmlspecialchars($_GET['material']) : ''; ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary mt-2">Consultar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <a href="agregar.php" class="btn btn-outline-success mb-3">Agregar</a>        
        <table class="table text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Material</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Archivo de conexión a la base de datos
                include 'db.php';
                // Consulta SQL base
                $sql = "SELECT * FROM COMPONENTES";
                // Verificar si se envió un parámetro de búsqueda
                if (isset($_GET['material']) && !empty($_GET['material'])) {
                    $searchMaterial = mysqli_real_escape_string($conn, $_GET['material']);
                    $sql .= " WHERE material LIKE '%$searchMaterial%'";
                }
                // Ejecutar la consulta
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // Mostrar cada registro como una fila de la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["idmaterial"] . "</td>";
                        echo "<td>" . $row["material"] . "</td>";
                        echo "<td>" . $row["descripcion"] . "</td>";
                        echo "<td>" . $row["estado"] . "</td>";
                        echo '<td>
                                <a href="modificar.php?id=' . $row["idmaterial"] . '" class="btn btn-sm btn-outline-primary">Modificar</a>
                                <form action="eliminar.php" method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="' . $row["idmaterial"] . '">
                                    <button type="submit" class="btn btn-sm btn-outline-danger ml-2" onclick="return confirm(\'¿Estás seguro que querés eliminar este registro?\')">Eliminar</button>
                                </form>
                              </td>';
                        echo "</tr>";
                    }
                } else {
                    echo '<tr><td colspan="5" class="text-center">No se encontraron registros</td></tr>';
                }
                // Cerrar conexión
                $conn->close();
                ?>
            </tbody>
        </table>        
    </div>

    <?php include 'views/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Detectar cambios en el campo de búsqueda
            $('#search-material').on('input', function() {
                // Obtener el valor del campo de búsqueda
                var searchValue = $(this).val().trim();

                // Si el campo está vacío, enviar el formulario automáticamente
                if (searchValue === '') {
                    $('#search-form').submit();
                }
            });
        });
    </script>
</body>

</html>

    
