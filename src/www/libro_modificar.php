<?php
    // Importamos el archivo que contiene la conexión a la base de datos.
    // require_once asegura que se cargue solo una vez.
    require_once 'configuracion.php';

    // Comprobamos si llega el ID del libro a modificar.
    if (!isset($_GET['id'])) {
        // Si no hay ID, mostramos error y detenemos el script con die()
        die("ERROR: No se recibió el ID del libro.");
    }

    // Si hay ID, lo guardamos en una variable.
    $id = $_GET['id'];

    // Hacemos una consulta a la BD para obtener los datos del libro.
    // Usamos INNER JOIN para traer también el nombre del autor y editorial.
    $sql = "
        SELECT n.*, a.nombre AS nombre_autor, e.nombre AS nombre_editorial
        FROM Novela n
        INNER JOIN Autor a ON n.id_autor = a.id_autor
        INNER JOIN Editorial e ON n.id_editorial = e.id_editorial
        WHERE n.id_novela = $id
    ";
    // query() ejecuta la consulta SQL y guarda el resultado.
    $resultado = $conexion->query($sql);

    // num_rows cuenta cuántas filas devolvió la consulta.
    if ($resultado->num_rows === 0) {
        // Si num_rows es 0, no existe un libro con ese ID.
        die("ERROR: No existe un libro con ese ID.");
    }

    // fetch_assoc() convierte la fila en un array.
    $libro = $resultado->fetch_assoc();

    // Comprobamos si viene un mensaje en la URL (por ejemplo, de error).
    if (isset($_GET['msg'])) {
        // Si viene un mensaje en la URL, lo guardamos.
        $mensaje = $_GET['msg'];
    } else {
        // Si no viene mensaje, dejamos la variable vacía.
        $mensaje = "";
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Libro</title>    
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>

<header>
    <h1>Modificar libro</h1>
</header>

<main>
    <section class="formularioAltaLibro">
        <?php
            // Si existe un mensaje, lo mostramos en la página.
            if (!empty($mensaje)) {
                echo '<p class="mensaje">'.$mensaje.'</p>';

            }
        ?>
        <form method="post" action="libro_modificar_procesar.php" accept-charset="UTF-8">

            <fieldset>

                <legend>Datos del libro</legend>

                <input type="hidden" name="id_novela" value="<?php echo $libro['id_novela']; ?>">
        
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo $libro['titulo']; ?>" required>
            
                <label for="autor">Autor</label>
                <input type="text" id="autor" name="autor" value="<?php echo $libro['nombre_autor']; ?>" required>
    
                <label for="editorial">Editorial</label>
                <input type="text" id="editorial" name="editorial" value="<?php echo $libro['nombre_editorial']; ?>" required>
               
                <label for="fecha_publicacion">Fecha de publicación</label>
                <input type="date" id="fecha_publicacion" name="fecha_publicacion" value="<?php echo $libro['fechaPublicacion']; ?>" required>

            </fieldset>

            <div class="acciones-formulario">

                <button type="submit" class="btn-guardar">Guardar cambios</button>

                <a href="index.php" class="btn-cancelar">Cancelar</a>
            
            </div>

        </form>
    </section>
</main>

</body>
</html>
