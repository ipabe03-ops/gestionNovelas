<!-- Archivo para eliminar una novela -->
<?php
require_once 'configuracion.php';

try {
    // Comprobamos que se haya recibido un ID por GET.
    if (!isset($_GET['id'])) {
        // Lanzamos excepción si no se especificó el ID
        throw new Exception("ID no especificado.");
    }

    // Convertimos a entero para seguridad.
    $id = intval($_GET['id']);

    // Consulta para eliminar la novela.
    $sql = "DELETE FROM Novela WHERE id_novela = $id";

    // Ejecutamos la consulta y lanzamos excepción si falla
    if ($conexion->query($sql) !== TRUE) {
        throw new Exception("Error al eliminar la novela de la base de datos.");
    }

    // Iniciamos la sesión para guardar mensajes entre páginas.
    session_start();

    // Guardamos el mensaje de éxito en la sesión.
    $_SESSION['mensaje'] = "La novela se eliminó correctamente."; 

    // Redirigimos a index.php.
    header("Location: index.php"); 
    exit();

} catch (Exception $e) {
    // Iniciamos la sesión si no estaba iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Guardamos el mensaje de error de forma "usable" para el usuario
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    header("Location: index.php");
    exit();
}
?>


