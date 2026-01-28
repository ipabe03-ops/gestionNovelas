<?php
// Incluimos la configuración de conexión a la base de datos.
require_once 'configuracion.php';

// Iniciamos sesión para guardar mensajes entre páginas
session_start();

// Procesamos el formulario solo si se envió por POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recogemos los datos enviados por el formulario.
    // El título es un texto.
    $titulo = $_POST['titulo'];

    // Los select de autor y editorial nos envían directamente los IDs correspondientes.
    $id_autor = $_POST['autor'];       // ID del autor seleccionado
    $id_editorial = $_POST['editorial']; // ID de la editorial seleccionada

    // Fecha completa de publicación en formato YYYY-MM-DD.
    $fecha = $_POST['fecha_publicacion'];

    // Intentamos insertar el nuevo libro en la base de datos con try-catch para manejar errores.
    try {
        // Validamos que todos los campos estén completos.
        if (!$titulo || !$id_autor || !$id_editorial || !$fecha) {
            // Lanzamos excepción si falta algún dato.
            throw new Exception("Por favor completa todos los campos del formulario.");
        }

        // Creamos la consulta SQL para insertar el nuevo libro en la base de datos.
        $sql = "INSERT INTO Novela (titulo, fechaPublicacion, id_autor, id_editorial)
                VALUES ('$titulo', '$fecha', $id_autor, $id_editorial)";

        // Ejecutamos la consulta y lanzamos excepción si falla
        if (!$conexion->query($sql)) {
            throw new Exception("No se pudo agregar el libro. Error en la base de datos.");
        }

        // Si todo salió bien, guardamos mensaje de éxito
        $_SESSION['mensaje'] = "Libro agregado correctamente.";
        header("Location: index.php");
        exit();

    } catch (Exception $e) {
        // Capturamos cualquier error y lo mostramos de forma "usable" al usuario
        $_SESSION['mensaje'] = "Error: " . $e->getMessage();
        header("Location: libro_alta.php");
        exit();
    }

} else {
    // Si se accede directamente al archivo sin enviar el formulario.
    echo "Acceso no permitido.";
}
?>

