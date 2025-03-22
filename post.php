<?php
$titulo = "Artículo - Tu Hosting Web";
include 'includes/header.php';

$post_title = $_GET['title'];

// Leer los artículos del archivo de texto
$file = fopen("posts.txt", "r");
if ($file) {
    while (($line = fgets($file)) !== false) {
        if (strpos($line, "Título: " . $post_title) === 0) {
            $title = trim(str_replace("Título:", "", $line));
            $date = trim(str_replace("Fecha:", "", fgets($file)));
            $content = "";
            while (($line = fgets($file)) !== false && trim($line) !== "") {
                $content .= $line;
            }
            echo "<article class='blog-post'>";
            echo "<h3>" . $title . "</h3>";
            echo "<p>" . $content . "</p>";
            echo "</article>";
            break;
        }
    }
    fclose($file);
} else {
    echo "Artículo no encontrado.";
}
?>

<?php include 'includes/footer.php'; ?>