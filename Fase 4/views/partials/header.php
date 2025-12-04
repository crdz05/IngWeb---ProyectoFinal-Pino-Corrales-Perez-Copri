<?php
// views/partials/header.php

// Obtener avatar para mostrarlo en la esquina superior derecha
$headerAvatar = null;

if (isset($pdo)) {
    require_once __DIR__ . '/../../models/UserModel.php';

    try {
        $profileHeader = getUserProfile($pdo);
        $headerAvatar  = $profileHeader['avatar_path'] ?? null;
    } catch (Throwable $e) {
        $headerAvatar = null; // por si hay algún problema, no romper el header
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'App Musical') ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <!-- LOGO ESTÁTICO: ahora con imagen -->
    <div class="logo">
        <img src="images/logo.png" alt="Logo de la aplicación">
    </div>

    <!-- Navegación principal -->
    <nav>
        <a href="index.php"     class="<?= ($activePage ?? '') === 'inicio'    ? 'active' : '' ?>">Inicio</a>
        <a href="canciones.php" class="<?= ($activePage ?? '') === 'canciones' ? 'active' : '' ?>">Canciones</a>
        <a href="playlist.php"  class="<?= ($activePage ?? '') === 'playlist'  ? 'active' : '' ?>">Playlist</a>
        <a href="perfil.php"    class="<?= ($activePage ?? '') === 'perfil'    ? 'active' : '' ?>">Perfil</a>
        <a href="ayuda.php"     class="<?= ($activePage ?? '') === 'ayuda'     ? 'active' : '' ?>">Ayuda</a>
    </nav>

    <!-- USER DROPDOWN MENU -->
    <div class="user-menu-container">
        <div class="user-profile" onclick="toggleUserMenu()">
            <!-- Avatar en la esquina superior derecha -->
            <div
                class="user-avatar"
                <?php if (!empty($headerAvatar)): ?>
                    style="background-image: url('<?= htmlspecialchars($headerAvatar) ?>');
                           background-size: cover;
                           background-position: center;"
                <?php endif; ?>
            ></div>
            <span class="user-name">Usuario</span>
        </div>

        <div id="userDropdown" class="user-dropdown">
            <a href="perfil.php">Editar Perfil</a>
        </div>
    </div>
</header>

<main class="main-content">

