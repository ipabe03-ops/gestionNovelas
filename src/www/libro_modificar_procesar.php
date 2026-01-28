<?php
// Recibimos los datos del formulario y actualizamos el libro en la base de datos.

// Importamos el archivo de configuración que contiene la conexión a la BD.
require_once 'configuracion.php';

// Iniciamos la sesión para poder guardar mensajes entre páginas.
session_start();

try {
    // Comprobamos que el formulario envió todos los campos necesarios.
    if (!isset($_POST['id_novela'], $_POST['titulo'], $_POST['id_autor'], $_POST['id_editorial'], $_POST['fecha_publicacion'])) {
        // Lanzamos excepción si falta algún dato
        throw new Exception("ERROR: Faltan datos del formulario.");
    }

    // Recogemos los datos del formulario.

    // El id_novela viene en un campo oculto y sirve para saber qué libro modificar.
    $id_novela = intval($_POST['id_novela']); 
    $titulo = $_POST['titulo'];

    /* El autor y la editorial ya no vienen como texto,
    sino como el ID seleccionado en las listas desplegables.*/
    $id_autor = intval($_POST['id_autor']);
    $id_editorial = intval($_POST['id_editorial']);

    // Fecha de publicación.
    $fecha = $_POST['fecha_publicacion'];

    // Construimos la consulta de modificación.
    $sql = "
        UPDATE Novela 
        SET 
            titulo = '$titulo',
            id_autor = $id_autor,
            id_editorial = $id_editorial,
            fechaPublicacion = '$fecha'
        WHERE id_novela = $id_novela
    ";

    // Ejecutamos la consulta y lanzamos excepción si falla
    if ($conexion->query($sql) !== TRUE) {
        throw new Exception("No se pudo modificar el libro en la base de datos.");
    }

    // Si la actualización fue correcta, guardamos un mensaje de éxito.
    $_SESSION['mensaje'] = "Libro modificado correctamente.";

} catch (Exception $e) {
    // Capturamos cualquier error y lo mostramos de forma "usable" al usuario.
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
}

// Redirigimos a la página principal.
header("Location: index.php");
exit;
?>

