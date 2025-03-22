<?php
$titulo = "Nuestros Servicios";
include 'includes/header.php';
?>

<section id="servicios-detalles" class="services-section">
    <div class="container">
        <h2>Elige tu servicio</h2>
        <?php
        $services_file = fopen("services.txt", "r");
        if ($services_file) {
            while (($line = fgets($services_file)) !== false) {
                if (strpos($line, "Service:") === 0) {
                    $service_name = trim(str_replace("Service:", "", $line));
                    $service_image = trim(str_replace("Image:", "", fgets($services_file)));
                    $service_description = "";
                    while (($line = fgets($services_file)) !== false && trim($line) !== "") {
                        $service_description .= $line;
                    }

                    echo "<article class='service-item'>";
                    echo "<img src='" . $service_image . "' alt='" . $service_name . "' class='service-image'>";
                    echo "<h3>" . $service_name . "</h3>";
                    echo "<p>" . $service_description . "</p>";
                    echo "<a href='#' class='btn btn-secondary'>Más información</a>";
                    echo "</article>";
                }
            }
            fclose($services_file);
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>