<?php
require_once 'configuracion.php';

// Procesar el formulario cuando se envíe.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   $titulo = $_POST['titulo'];
    $id_autor = $_POST['autor'];
    $id_editorial = $_POST['editorial'];
    $fecha = $_POST['fecha_publicacion'];

    // Validacion de los datos.
    if ($titulo && $id_autor && $id_editorial && $fecha) {

        // Insertar el nuevo libro en la base de datos.
        $sql = "INSERT INTO novela (titulo, fechaPublicacion, id_autor, id_editorial)
            VALUES ('$titulo', '$fecha', $id_autor, $id_editorial)";

        // Ejecutar la consulta y verificar si fue exitosa.
        if ($conexion->query($sql)) {
            // Si funciona redirigir a index.php con mensaje.
            header("Location: index.php?msg=Libro agregado correctamente.");
            exit();
        } else {
            // Si no funciona volver a libro_alta.php con mensaje.
            header("Location: libro_alta.php?msg=Error al agregar el libro: " .$conexion->error);
            exit();
        }

    } else {
        // si faltan los datos, volver a libro_alta.php con mensaje.
        header("Location: libro_alta.php?msg=Por favor completa todos los campos.");
        exit();
    }


} else {
    echo "Acceso no permitido.";
}

?>