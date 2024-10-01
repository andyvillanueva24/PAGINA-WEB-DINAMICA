<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario_dinamico_bd";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificación del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errores = [];

    $experiencia_laboral = isset($_POST['experiencia_laboral']) ? $_POST['experiencia_laboral'] : [];
    $formacion = isset($_POST['formacion']) ? $_POST['formacion'] : [];
    $idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
    $aptitudes = isset($_POST['aptitudes']) ? $_POST['aptitudes'] : [];

    // Simulación de usuario (puedes ajustar esto a partir de los datos reales del formulario)
    $usuario_id = 1; // Puedes hacer que este valor sea dinámico si tienes un sistema de usuarios.

    // Validar que las secciones no estén vacías
    if (empty($experiencia_laboral)) {
        $errores[] = "La sección de experiencia laboral está vacía.";
    }
    if (empty($formacion)) {
        $errores[] = "La sección de formación está vacía.";
    }
    if (empty($idiomas)) {
        $errores[] = "La sección de idiomas está vacía.";
    }
    if (empty($aptitudes)) {
        $errores[] = "La sección de aptitudes está vacía.";
    }

    // Insertar datos en la base de datos si no hay errores
    if (empty($errores)) {
        // Insertar experiencia laboral
        foreach ($experiencia_laboral as $experiencia) {
            $stmt = $conn->prepare("INSERT INTO experiencia_laboral (usuario_id, descripcion) VALUES (?, ?)");
            $stmt->bind_param("is", $usuario_id, $experiencia);
            $stmt->execute();
        }

        // Insertar formación
        foreach ($formacion as $formacion_item) {
            $stmt = $conn->prepare("INSERT INTO formacion (usuario_id, descripcion) VALUES (?, ?)");
            $stmt->bind_param("is", $usuario_id, $formacion_item);
            $stmt->execute();
        }

        // Insertar idiomas
        foreach ($idiomas as $idioma) {
            $stmt = $conn->prepare("INSERT INTO idiomas (usuario_id, descripcion) VALUES (?, ?)");
            $stmt->bind_param("is", $usuario_id, $idioma);
            $stmt->execute();
        }

        // Insertar aptitudes
        foreach ($aptitudes as $aptitud) {
            $stmt = $conn->prepare("INSERT INTO aptitudes (usuario_id, descripcion) VALUES (?, ?)");
            $stmt->bind_param("is", $usuario_id, $aptitud);
            $stmt->execute();
        }

        echo "<h3>Datos guardados exitosamente en la base de datos.</h3>";
    } else {
        // Mostrar errores
        foreach ($errores as $error) {
            echo "<p class='error'>$error</p>";
        }
    }

    $conn->close();
}
?>
