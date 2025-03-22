<?php
$titulo = "Hosting de Servidores de Juegos y Aplicaciones";
include 'includes/header.php';
?>

<section id="hero" class="hero-section">
    <div class="container">
        <h2>Servidores de alto rendimiento para tus juegos y aplicaciones</h2>
        <p>Minecraft, Python, GTA, FiveM y más. ¡Elige tu plan!</p>
        <a href="servicios.php" class="btn btn-primary">Ver planes</a>
    </div>
</section>

<section id="servicios-destacados" class="services-section">
    <div class="container">
        <h2>Servicios destacados</h2>
        <article class="service-item">
            <img src="images/minecraft.jpg" alt="Minecraft" class="service-image">
            <h3>Minecraft</h3>
        </article>
        <article class="service-item">
            <img src="images/python.jpg" alt="Python" class="service-image">
            <h3>Python</h3>
        </article>
        <article class="service-item">
            <img src="images/gta.jpg" alt="GTA" class="service-image">
            <h3>GTA</h3>
        </article>
        <article class="service-item">
            <img src="images/fivem.jpg" alt="FiveM" class="service-image">
            <h3>FiveM</h3>
        </article>
    </div>
</section>

<section id="planes" class="plans-section">
    <div class="container">
        <h2>Elige el plan perfecto para tu servidor</h2>
        <div class="plans-grid">
            <div class="plan-card">
                <h3>Plan 1 - Básico</h3>
                <p class="price">1.25€ / mes</p>
                <ul>
                    <li><strong>vCores:</strong> 0.5</li>
                    <li><strong>RAM:</strong> 1.5GB</li>
                    <li><strong>Almacenamiento:</strong> 25GB</li>
                    <li>Ideal para BungeeCord y Python</li>
                </ul>
                <a href="https://discord.moonhosting.es" class="btn btn-primary">Contratar</a>
            </div>
            <div class="plan-card">
                <h3>Plan 2 - Estándar</h3>
                <p class="price">4.25€ / mes</p>
                <ul>
                    <li><strong>vCores:</strong> 1.5</li>
                    <li><strong>RAM:</strong> 4GB</li>
                    <li><strong>Almacenamiento:</strong> 50GB</li>
                    <li>Ideal para Minecraft y GTA (mods ligeros)</li>
                </ul>
                <a href="https://discord.moonhosting.es" class="btn btn-primary">Contratar</a>
            </div>
            <div class="plan-card">
                <h3>Plan 3 - Avanzado</h3>
                <p class="price">6.25€ / mes</p>
                <ul>
                    <li><strong>vCores:</strong> 3</li>
                    <li><strong>RAM:</strong> 6GB</li>
                    <li><strong>Almacenamiento:</strong> 75GB</li>
                    <li>Ideal para FiveM y GTA (mods pesados)</li>
                </ul>
                <a href="https://discord.moonhosting.es" class="btn btn-primary">Contratar</a>
            </div>
            <div class="plan-card">
                <h3>Plan 4 - Premium</h3>
                <p class="price">8€ / mes</p>
                <ul>
                    <li><strong>vCores:</strong> 4</li>
                    <li><strong>RAM:</strong> 8GB</li>
                    <li><strong>Almacenamiento:</strong> 100GB</li>
                    <li>Ideal para servidores grandes y exigentes</li>
                </ul>
                <a href="https://discord.moonhosting.es" class="btn btn-primary">Contratar</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>