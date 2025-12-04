<?php
// Recibimos los datos del formulario y actualizamos el libro en la base de datos.

// Importamos el archivo de configuración que contiene la conexión a la base de datos.
require_once 'configuracion.php';

// Iniciamos una sesión para guardar mensajes entre páginas.
session_start();

// Comprobamos que el formulario envió todos los campos.
if (!isset($_POST['id_novela'], $_POST['titulo'], $_POST['autor'], $_POST['editorial'], $_POST['fecha_publicacion'])) {
    // Si falta algún dato, guardamos un mensaje de error en la sesión.
    $_SESSION['mensaje'] = "ERROR: Faltan datos del formulario.";
    // Redirigimos al usuario a la página de inicio.
    header("Location: index.php");
}

// Recogemos los datos que envió el formulario desde $_POST.
// Cojemos el id_novela oculto para saber qué libro modificar.
$id_novela = $_POST['id_novela'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editorial = $_POST['editorial'];
$fecha = $_POST['fecha_publicacion'];


// El usuario escribió el nombre del autor, pero en la BD necesitamos su ID.
// Hacemos una búsqueda en la tabla Autor para obtener su ID.

$result_autor = $conexion->query("SELECT id_autor FROM Autor WHERE nombre = '$autor' ");


// Comprobamos si encontramos el autor
if ($result_autor->num_rows === 0) {
    // num_rows cuenta cuántas filas devolvió la búsqueda.
    // Si num_rows es 0, significa que no existe ese autor.
    $_SESSION['mensaje'] = "ERROR: No existe un autor con ese nombre.";
    header("Location: index.php");
    exit;
}

// Si sí existe, sacamos el ID del autor del resultado.
// fetch_assoc() convierte la fila en un array asociativo.
$id_autor = $result_autor->fetch_assoc()['id_autor'];


// Igual que con el autor, buscamos el ID de la editorial por su nombre.

$result_editorial = $conexion->query("SELECT id_editorial FROM Editorial WHERE nombre = '$editorial' ");

// Comprobamos si encontramos la editorial.
if ($result_editorial->num_rows === 0) {
    $_SESSION['mensaje'] = "ERROR: No existe una editorial con ese nombre.";
    header("Location: index.php");
    exit;
}

// Si existe, sacamos su ID.
$id_editorial = $result_editorial->fetch_assoc()['id_editorial'];

// Ahora que tenemos todos los datos necesarios, actualizamos la novela.
// UPDATE modifica los datos de un registro que ya existe.

$sql = " UPDATE Novela SET titulo = '$titulo', id_autor = $id_autor, id_editorial = $id_editorial, fechaPublicacion = '$fecha' WHERE id_novela = $id_novela";

// Ejecutamos la consulta y comprobamos si funcionó.
if ($conexion->query($sql)) {
    // Si la actualización fue exitosa.
    $_SESSION['mensaje'] = "Libro modificado correctamente.";
} else {
    // Si hubo algún error en la actualización.
    $_SESSION['mensaje'] = "Error al modificar: " . $conexion->error;
}

// Redirigimos al usuario a la página principal.
// El mensaje guardado en $_SESSION se mostrará allí.
header("Location: index.php");
?>
