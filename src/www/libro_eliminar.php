<!-- Archivo para eliminar una novela -->
<?php
require_once 'configuracion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convertimos a entero para seguridad

    $sql = "DELETE FROM novela WHERE id_novela = $id"; // Consulta para eliminar la novela

    if ($conexion->query($sql) === TRUE) {
        session_start(); // Iniciamos la sesión.
        $_SESSION['mensaje'] = "La novela se eliminó correctamente."; // Guardamos el mensaje en la sesión, esta se queda en el servidor mientras el usuario navega.
        header("Location: index.php"); // Redirigimos a index.php.
        exit();
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }
} else {
    echo "ID no especificado.";
}
?>

