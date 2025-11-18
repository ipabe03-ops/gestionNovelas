<?php
// Incluir configuración de conexión.
require_once 'configuracion.php';

if (isset($_GET['msg'])) {
    $mensaje = $_GET['msg'];
} else {
    $mensaje = '';
}

// Cargar autores y editoriales desde la base de datos.
// Ejecutamos dos consultas para obtener las listas que mostraremos luego en los <select>.
$autores = $conexion->query("SELECT id_autor, nombre FROM Autor ORDER BY nombre ASC");
$editoriales = $conexion->query("SELECT id_editorial, nombre FROM Editorial ORDER BY nombre ASC");

?>

<!-- Parte de HTML para el formulario del alta de libros. -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AltaLibros_Gestión_de_Novelas</title>
    <link rel="stylesheet" href="./css/styles.css"> <!-- Enlace al archivo CSS del estilo -->
</head>
<body>
    <header>
        <h1>Añadir nuevo libro</h1>
    </header>

    <main>
        <section class="formularioAltaLibro">
            <!-- Si $mensaje no está vacio lo mostramos en pantalla.-->
           <?php
                if (!empty($mensaje)) {
                    echo '<p class="mensaje">' . $mensaje . '</p>';
                }
            ?>

            <form method="post" action="libro_alta_procesar.php" accept-charset="UTF-8"> <!-- Formulario para el alta de libros. -->

                <fieldset>

                    <legend>Datos del libro</legend>

                    <!-- 1- input de texto para el titulo. -->
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Título del libro" required>

                    <label for="autor">Autor</label>
                    <!-- 2- select para el autor. -->
                    <select id="autor" name="autor" required>
                        <option hidden>Selecciona un autor</option>
                        <!-- Recorremos los resultados de la consulta $autores y mostramos las opciones dinámicamente. -->

                        <?php
                            while ($fila = $autores->fetch_assoc()) { // fetch_assoc() devuelve un array asociativo con los resultados de la consulta.
                                echo '<option value="' . $fila['id_autor'] . '">' . $fila['nombre'] . '</option>';
                            }
                        ?>

                    </select>

                    <label for="editorial">Editorial</label>
                    <!-- 3- select para la editorial. -->
                    <select id="editorial" name="editorial" required>
                        <option hidden>Selecciona una editorial</option> <!-- hidden es para ocultar la opción por defecto. -->
                        <?php
                            while ($fila = $editoriales->fetch_assoc()) { 
                                echo '<option value="' . $fila['id_editorial'] . '">' . $fila['nombre'] . '</option>';
                            }
                        ?>
                    </select>

                    <label for="fecha_publicacion">Fecha de publicación</label>
                    <!-- 4- input de tipo fecha para la fecha de publicación. -->
                    <input type="date" id="fecha_publicacion" name="fecha_publicacion" required>
                </fieldset>
                <!-- Botones de acción para el formulario. -->
                <div class="acciones-formulario">
                    <button type="submit" class="btn-guardar">Guardar</button> <!-- Botón para enviar el formulario. -->
                    <button type="reset" class="btn-limpiar">Limpiar</button>  <!-- Botón para limpiar los campos del formulario. -->
                    <a href="index.php" class="btn-cancelar">Volver</a>        <!-- Enlace para volver a la página principal. -->
                </div>
            </form>
        </section>
    </main>
</body>
</html>
