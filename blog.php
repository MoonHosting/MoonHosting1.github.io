<?php
$titulo = "Blog - Tu Hosting Web";
include 'includes/header.php';

// Leer los artículos del archivo de texto
$file = fopen("posts.txt", "r");
if ($file) {
    while (($line = fgets($file)) !== false) {
        if (strpos($line, "Título:") === 0) {
            $title = trim(str_replace("Título:", "", $line));
            $date = trim(str_replace("Fecha:", "", fgets($file)));
            $content = "";
            while (($line = fgets($file)) !== false && trim($line) !== "") {
                $content .= $line;
            }
            echo "<article class='blog-post'>";
            echo "<h3>" . $title . "</h3>";
            echo "<p>" . substr(strip_tags($content), 0, 200) . "...</p>";
            echo "<a href='post.php?title=" . urlencode($title) . "' class='btn btn-secondary'>Leer más</a>";
            echo "</article>";
        }
    }
    fclose($file);
} else {
    echo "No hay artículos publicados.";
}
?>

<?php include 'includes/footer.php'; ?>