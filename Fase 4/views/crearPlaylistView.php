<?php
// views/crearPlaylistView.php
?>

<!-- Breadcrumb -->
<nav class="breadcrumb">
    <a href="index.php">Inicio</a>
    <span>/</span>
    <a href="playlist.php">Playlist</a>
    <span>/</span>
    <span class="current">Crear playlist</span>
</nav>

<h1 class="page-title">Crear Playlist</h1>

<div class="form-container">

    <?php if (!empty($errors)): ?>
        <ul style="color: red; margin-bottom: 15px;">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form class="playlist-form" method="post" action="" enctype="multipart/form-data">
        <!-- Nombre -->
        <div class="form-group">
            <label for="nombre" class="form-label">Nombre de la playlist</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                class="form-input"
                placeholder="Ejemplo: Rock para estudiar"
                value="<?= htmlspecialchars($formData['nombre']) ?>"
            >
        </div>

        <!-- Descripción -->
        <div class="form-group">
            <label for="descripcion" class="form-label">Descripción (opcional)</label>
            <textarea
                id="descripcion"
                name="descripcion"
                class="form-textarea"
                placeholder="Breve descripción de la playlist"
                rows="3"
            ><?= htmlspecialchars($formData['descripcion']) ?></textarea>
        </div>

        <!-- Imagen -->
        <div class="form-group">
            <label for="imagen" class="form-label">Imagen de la playlist (opcional)</label>
            <input
                type="file"
                id="imagen"
                name="imagen"
                class="form-input"
                accept="image/*"
            >
            <p style="font-size: 0.85rem; color: #666; margin-top: 4px;">
                Si no seleccionas una imagen, se mostrará la tarjeta gris por defecto.
            </p>
        </div>

        <!-- Botones -->
        <div class="form-actions">
            <button
                type="button"
                class="btn-cancel"
                onclick="window.location.href='playlist.php'"
            >
                Cancelar
            </button>

            <button type="submit" class="btn-submit">
                Guardar playlist
            </button>
        </div>
    </form>
</div>
