<?php
// Incluir la configuración de conexión.
require_once 'configuracion.php';

// Consulta SQL para obtener las novelas con sus autores y editoriales.
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

$resultado = $conexion->query($sql); // Ejecutamos la consulta y guardamos el resultado en $resultado.
?>
<!-- Comenzamos a crear la estructura HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Novelas</title>
    <link rel="stylesheet" href="\gestionNovelas\bocetos\styles.css"> <!-- Enlace al archivo CSS del estilo -->
</head>
<body>

<header>
    <h1>Listado de Novelas de Ciencia Ficción</h1>
</header>
<!-- Contenido principal donde se mostrará la tabla de novelas -->
<main>
    <div class="contenido-tabla">
        <?php if ($resultado && $resultado->num_rows > 0): ?> <!-- Verificamos si hay resultados devueltos y que filas -->
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Año de publicación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()): ?> <!-- Iteramos sobre cada fila del resultado devolviendo un array asociativo donde las claves son los nombres de los alias definidos en la consulta sql anterior -->
                        <tr>
                            <td><?= $fila['Título'] ?></td>
                            <td><?= $fila['Autor']?></td>
                            <td><?= $fila['Editorial']?></td>
                            <td><?= $fila['Año de publicación']?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style='text-align:center;'>No hay resultados en la base de datos.</p> <!-- Si no hay resultados sale este mensaje -->
        <?php endif; ?>
        <?php $conexion->close(); ?>
    </div>

</main>

<a href="libro_alta.php" class="btn-AddLibro">Añadir nuevo libro</a> <!-- Botón para añadir un nuevo libro -->

</body>
</html>
