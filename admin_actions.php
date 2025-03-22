<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'new_post') {
        // Lógica para añadir un nuevo artículo
        $title = $_POST['title'];
        $content = $_POST['content'];
        $date = date("Y-m-d H:i:s");

        $new_post = "Título: " . $title . "\nFecha: " . $date . "\n" . $content . "\n\n";

        $file = fopen("posts.txt", "a");
        if (fwrite($file, $new_post)) {
            echo "Artículo publicado con éxito.";
        } else {
            echo "Error al publicar el artículo.";
        }
        fclose($file);
    } elseif ($action === 'delete_post') {
        // Lógica para eliminar un artículo
        $title_to_delete = $_GET['title'];
        $file = fopen("posts.txt", "r");
        $new_content = "";
        if ($file) {
            while (($line = fgets($file)) !== false) {
                if (strpos($line, "Título: " . $title_to_delete) === 0) {
                    while (($line = fgets($file)) !== false && trim($line) !== "") {
                        // Saltar líneas del artículo a eliminar
                    }
                } else {
                    $new_content .= $line;
                }
            }
            fclose($file);
            $file = fopen("posts.txt", "w");
            fwrite($file, $new_content);
            fclose($file);
            echo "Artículo eliminado con éxito.";
        } else {
            echo "Error al eliminar el artículo.";
        }
    } elseif ($action === 'update_post') {
        // Lógica para actualizar un artículo
        $title_to_update = $_GET['title'];
        $new_title = $_POST['new_title'];
        $new_content = $_POST['new_content'];
        $date = date("Y-m-d H:i:s");

        $file = fopen("posts.txt", "r");
        $new_file_content = "";
        if ($file) {
            while (($line = fgets($file)) !== false) {
                if (strpos($line, "Título: " . $title_to_update) === 0) {
                    $new_file_content .= "Título: " . $new_title . "\nFecha: " . $date . "\n" . $new_content . "\n\n";
                    while (($line = fgets($file)) !== false && trim($line) !== "") {
                        // Saltar líneas del artículo antiguo
                    }
                } else {
                    $new_file_content .= $line;
                }
            }
            fclose($file);
            $file = fopen("posts.txt", "w");
            fwrite($file, $new_file_content);
            fclose($file);
            echo "Artículo actualizado con éxito.";
        } else {
            echo "Error al actualizar el artículo.";
        }
    } elseif ($action === 'update_plans') {
        // Lógica para actualizar los planes existentes
        $plans_file = fopen("plans.txt", "r+");
        $new_plans_content = "";
        if ($plans_file) {
            while (($line = fgets($plans_file)) !== false) {
                if (strpos($line, "Plan:") === 0) {
                    $plan_name = trim(str_replace("Plan:", "", $line));
                    $new_price = $_POST['plan_price_' . urlencode($plan_name)];
                    $new_vcores = $_POST['plan_vcores_' . urlencode($plan_name)];
                    $new_ram = $_POST['plan_ram_' . urlencode($plan_name)];
                    $new_storage = $_POST['plan_storage_' . urlencode($plan_name)];
                    $new_description = $_POST['plan_description_' . urlencode($plan_name)];

                    $new_plans_content .= "Plan: " . $plan_name . "\nPrice: " . $new_price . "\nvCores: " . $new_vcores . "\nRAM: " . $new_ram . "\nStorage: " . $new_storage . "\nDescription: " . $new_description . "\n\n";
                    while (($line = fgets($plans_file)) !== false && trim($line) !== "") {
                        // Saltar líneas del plan antiguo
                    }
                } else {
                    $new_plans_content .= $line;
                }
            }
            ftruncate($plans_file, 0);
            fwrite($plans_file, $new_plans_content);
            fclose($plans_file);
            echo "Planes actualizados con éxito.";
        } else {
            echo "Error al actualizar los planes.";
        }
    } elseif ($action === 'add_new_plan') {
        // Lógica para añadir un nuevo plan
        $plan_name = $_POST['plan_name'];
        $plan_price = $_POST['plan_price'];
        $plan_vcores = $_POST['plan_vcores'];
        $plan_ram = $_POST['plan_ram'];
        $plan_storage = $_POST['plan_storage'];
        $plan_description = $_POST['plan_description'];

        $new_plan = "Plan: " . $plan_name . "\nPrice: " . $plan_price . "\nvCores: " . $plan_vcores . "\nRAM: " . $plan_ram . "\nStorage: " . $plan_storage . "\nDescription: " . $plan_description . "\n\n";

        $plans_file = fopen("plans.txt", "a");
        if (fwrite($plans_file, $new_plan)) {
            echo "Plan añadido con éxito.";
        } else {
            echo "Error al añadir el plan.";
        }
        fclose($plans_file);
    }
}
?>