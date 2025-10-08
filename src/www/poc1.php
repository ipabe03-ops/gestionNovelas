<?php
// Incluir la configuración de conexión.
include 'configuracion.php';

// Consulta SQL para obtener las novelas con sus autores y editoriales.
$sql = "
    SELECT 
        n.titulo AS 'Título',
        a.nombreAutor AS 'Autor',
        e.nombreEditorial AS 'Editorial',
        n.fechaPublicacion AS 'Año de publicación'
    FROM Novela n
    INNER JOIN Autor a ON n.id_autor = a.id_autor
    INNER JOIN Editorial e ON n.id_editorial = e.id_editorial
";
/* Ejecutamos la consulta usando el metodo query del objeto $conexion (creado en configuracion.php) 
para enviar la consulta MySQL y guardar el resultado en la variable $resultado. */

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba de Concepto - gestionNovelas</title>
    <link rel="stylesheet" href="\gestionNovelas\bocetos\styles.css"> 
</head>
<body>

<!-- Encabezado de la página -->
<header>
    <h1>Listado de Novelas de Ciencia Ficción</h1>
</header>

<!-- Contenido principal -->
<main>
    <div class="contenido-tabla">
        <?php
        if ($resultado && $resultado->num_rows > 0) {
            echo "<table>";
            echo "<thead><tr><th>Título</th><th>Autor</th><th>Editorial</th><th>Año de publicación</th></tr></thead>";
            echo "<tbody>";

            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila['Título']. "</td>";
                echo "<td>" . $fila['Autor'] . "</td>";
                echo "<td>" . $fila['Editorial'] . "</td>";
                echo "<td>" . $fila['Año de publicación'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p style='text-align:center;'>No hay resultados en la base de datos.</p>";
        }

        $conexion->close();
        ?>
    </div>
</main>

</body>
</html>
