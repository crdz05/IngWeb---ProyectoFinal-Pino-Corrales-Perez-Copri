<?php
// ayuda.php → Página de ayuda

require __DIR__ . '/config/db.php';   // <- IMPORTANTE para que el header tenga $pdo

$pageTitle  = 'Ayuda - App Musical';
$activePage = 'ayuda';

// Cargar layout MVC
require __DIR__ . '/views/partials/header.php';
require __DIR__ . '/views/ayudaView.php';   // tu contenido de ayuda
require __DIR__ . '/views/partials/footer.php';
