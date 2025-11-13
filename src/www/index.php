<?php
// Incluir la configuración de conexión a la base de datos.
require_once 'configuracion.php';

// Consulta SQL para obtener novelas con autores y editoriales.
$sql = "
    SELECT 
        n.titulo AS 'Título',
        a.nombre AS 'Autor',
        e.nombre AS 'Editorial',
        n.fechaPublicacion AS 'Año de publicación'
    FROM Novela n
    INNER JOIN Autor a ON n.id_autor = a.id_autor
    INNER JOIN Editorial e ON n.id_editorial = e.id_editorial
";

// Ejecutamos la consulta.
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Novelas</title>
    <link rel="stylesheet" href="./css/styles.css"> <!-- Enlace al CSS. -->
<!-- Enlace al CSS. -->
</head>
<body>

<header>
    <h1>Listado de Novelas de Ciencia Ficción</h1>
</header>

<main>
    <div class="contenido-tabla">
        <?php 
        // Comprobamos si hay resultados.
        if ($resultado && $resultado->num_rows > 0) { 
    // Abrimos la tabla.
    echo "<table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                    <th>Año de publicación</th>
                </tr>
            </thead>
            <tbody>";

    // Recorremos cada fila de resultados.
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['Título'] . "</td>";
        echo "<td>" . $fila['Autor'] . "</td>";
        echo "<td>" . $fila['Editorial'] . "</td>";
        echo "<td>" . $fila['Año de publicación'] . "</td>";
        echo "</tr>";
    }

        // Cerramos tbody y table.
        echo "</tbody>
        </table>";
        
    } else {
        echo "<p style='text-align:center;'>No hay resultados en la base de datos.</p>";
    }


?>
    </div>
</main>

<!-- Botón para añadir un nuevo libro. -->
<a href="libro_alta.php" class="btn-AddLibro">Añadir nuevo libro</a>

</body>
</html>
