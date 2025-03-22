<?php
session_start();

// Datos de inicio de sesión
$admin_email = "admin@moonhosting.es";
$admin_password = "Miguelelguapo2";

// Verificar inicio de sesión
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['admin'] = true;
    } else {
        $error = "Correo electrónico o contraseña incorrectos.";
    }
}

// Cerrar sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit();
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['admin'])) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panel de Administración</title>
        <link rel="stylesheet" href="css/admin.css">
    </head>
    <body>
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            <form method="post">
                <label for="email">Correo electrónico:</label>
                <input type="email" name="email" required><br><br>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" required><br><br>
                <button type="submit" name="login">Iniciar Sesión</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panel de Administración</title>
        <link rel="stylesheet" href="css/admin.css">
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
</head>
<body>
    <div class="admin-container">
        <h2>Panel de Administración</h2>
        <a href="?logout=true">Cerrar sesión</a>

        <h3>Publicar nuevo artículo</h3>
        <form method="post" action="admin_actions.php?action=new_post">
            <label for="title">Título:</label><br>
            <input type="text" name="title" required><br><br>
            <label for="content">Contenido:</label><br>
            <textarea name="content" id="editor"></textarea><br><br>
            <button type="submit">Publicar</button>
        </form>

        <h3>Artículos publicados</h3>
        <?php
        // Leer los artículos del archivo de texto
        $file = fopen("posts.txt", "r");
        if ($file) {
            echo "<ul>";
            while (($line = fgets($file)) !== false) {
                if (strpos($line, "Título:") === 0) {
                    $title = trim(str_replace("Título:", "", $line));
                    echo "<li>";
                    echo $title;
                    echo " <a href='admin.php?action=edit_post&title=" . urlencode($title) . "'>Editar</a>";
                    echo " <a href='admin_actions.php?action=delete_post&title=" . urlencode($title) . "'>Eliminar</a>";
                    echo "</li>";
                }
            }
            echo "</ul>";
            fclose($file);
        } else {
            echo "No hay artículos publicados.";
        }

        // Formulario de edición (si se selecciona un artículo para editar)
        if (isset($_GET['action']) && $_GET['action'] === 'edit_post') {
            $title_to_edit = $_GET['title'];
            $file = fopen("posts.txt", "r");
            if ($file) {
                while (($line = fgets($file)) !== false) {
                    if (strpos($line, "Título: " . $title_to_edit) === 0) {
                        $title = trim(str_replace("Título:", "", $line));
                        $date = trim(str_replace("Fecha:", "", fgets($file)));
                        $content = "";
                        while (($line = fgets($file)) !== false && trim($line) !== "") {
                            $content .= $line;
                        }
                        echo "<h3>Editar artículo: " . $title . "</h3>";
                        echo "<form method='post' action='admin_actions.php?action=update_post&title=" . urlencode($title) . "'>";
                        echo "<label for='title'>Título:</label><br>";
                        echo "<input type='text' name='new_title' value='" . $title . "' required><br><br>";
                        echo "<label for='content'>Contenido:</label><br>";
                        echo "<textarea name='new_content' id='edit_editor'>" . $content . "</textarea><br><br>";
                        echo "<button type='submit'>Guardar cambios</button>";
                        echo "</form>";
                        echo "<script>CKEDITOR.replace('edit_editor');</script>";
                        break;
                    }
                }
                fclose($file);
            }
        }
        ?>

        <h3>Editar Planes</h3>
        <form method="post" action="admin_actions.php?action=update_plans">
            <?php
            // Leer los planes desde un archivo de texto
            $plans_file = fopen("plans.txt", "r");
            if ($plans_file) {
                while (($line = fgets($plans_file)) !== false) {
                    if (strpos($line, "Plan:") === 0) {
                        $plan_name = trim(str_replace("Plan:", "", $line));
                        $plan_price = trim(str_replace("Price:", "", fgets($plans_file)));
                        $plan_vcores = trim(str_replace("vCores:", "", fgets($plans_file)));
                        $plan_ram = trim(str_replace("RAM:", "", fgets($plans_file)));
                        $plan_storage = trim(str_replace("Storage:", "", fgets($plans_file)));
                        $plan_description = "";
                        while (($line = fgets($plans_file)) !== false && trim($line) !== "") {
                            $plan_description .= $line;
                        }

                        echo "<h4>Plan: " . $plan_name . "</h4>";
                        echo "<label for='plan_price_" . urlencode($plan_name) . "'>Precio:</label><br>";
                        echo "<input type='text' name='plan_price_" . urlencode($plan_name) . "' value='" . $plan_price . "' required><br><br>";
                        echo "<label for='plan_vcores_" . urlencode($plan_name) . "'>vCores:</label><br>";
                        echo "<input type='text' name='plan_vcores_" . urlencode($plan_name) . "' value='" . $plan_vcores . "' required><br><br>";
                        echo "<label for='plan_ram_" . urlencode($plan_name) . "'>RAM:</label><br>";
                        echo "<input type='text' name='plan_ram_" . urlencode($plan_name) . "' value='" . $plan_ram . "' required><br><br>";
                        echo "<label for='plan_storage_" . urlencode($plan_name) . "'>Almacenamiento:</label><br>";
                        echo "<input type='text' name='plan_storage_" . urlencode($plan_name) . "' value='" . $plan_storage . "' required><br><br>";
                        echo "<label for='plan_description_" . urlencode($plan_name) . "'>Descripción:</label><br>";
                        echo "<textarea name='plan_description_" . urlencode($plan_name) . "' id='plan_editor_" . urlencode($plan_name) . "'>" . $plan_description . "</textarea><br><br>";
                        echo "<script>CKEDITOR.replace('plan_editor_" . urlencode($plan_name) . "');</script>";
                    }
                }
                fclose($plans_file);
            }
            ?>
            <button type="submit">Guardar cambios</button>
        </