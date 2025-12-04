<?php
// views/editarPlaylistView.php
?>

<!-- Breadcrumb -->
<nav class="breadcrumb">
    <a href="index.php">Inicio</a>
    <span>/</span>
    <a href="playlist.php">Playlist</a>
    <span>/</span>
    <span class="current">Editar playlist</span>
</nav>

<h1 class="page-title">Editar Playlist</h1>

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
                Si no seleccionas una nueva imagen, se mantendrá la actual (o la tarjeta gris por defecto).
            </p>

            <?php if (!empty($currentImagePath)): ?>
                <div style="margin-top: 10px;">
                    <span style="font-size: 0.85rem; color: #666;">Imagen actual:</span>
                    <div style="margin-top: 5px; width: 120px; height: 120px; border-radius: 8px; overflow: hidden; background: #eee;">
                        <img src="<?= htmlspecialchars($currentImagePath) ?>" alt="Imagen actual"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Canciones de la playlist -->
        <div class="form-group">
            <label class="form-label">Canciones en la playlist</label>
            <p style="font-size: 0.85rem; color: #666; margin-bottom: 8px;">
                Marca las canciones que quieres que formen parte de esta playlist.
            </p>

            <?php if (empty($allSongs)): ?>
                <p style="font-size: 0.9rem; color: #999;">
                    No hay canciones registradas en el sistema. Primero agrega canciones en la sección
                    <strong>Canciones</strong>.
                </p>
            <?php else: ?>
                <div class="songs-checkbox-list">
                    <?php foreach ($allSongs as $song): ?>
                        <?php
                            $checked = in_array((int)$song['id'], $playlistSongIds, true) ? 'checked' : '';
                            $label   = $song['title'];
                            if (!empty($song['artist'])) {
                                $label .= ' - ' . $song['artist'];
                            }
                        ?>
                        <label class="checkbox-item">
                            <input
                                type="checkbox"
                                name="songs[]"
                                value="<?= (int)$song['id'] ?>"
                                <?= $checked ?>
                            >
                            <span><?= htmlspecialchars($label) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
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
                Guardar cambios
            </button>
        </div>
    </form>
</div>
