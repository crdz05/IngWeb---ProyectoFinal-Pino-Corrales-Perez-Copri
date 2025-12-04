<?php
// views/editarCancionView.php
?>

<!-- Breadcrumb -->
<nav class="breadcrumb">
    <a href="index.php">Inicio</a>
    <span>/</span>
    <a href="canciones.php">Canciones</a>
    <span>/</span>
    <span class="current">Editar canción</span>
</nav>

<h1 class="page-title">Editar Canción</h1>

<div class="form-container">
    <?php if (!empty($errors)): ?>
        <ul style="color: red; margin-bottom: 15px;">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form class="song-form" method="post" action="" enctype="multipart/form-data">
        <!-- Título -->
        <div class="form-group">
            <label for="titulo" class="form-label">Título</label>
            <input
                type="text"
                id="titulo"
                name="titulo"
                class="form-input"
                value="<?= htmlspecialchars($formData['titulo']) ?>"
            >
        </div>

        <!-- Artista -->
        <div class="form-group">
            <label for="artista" class="form-label">Artista</label>
            <input
                type="text"
                id="artista"
                name="artista"
                class="form-input"
                value="<?= htmlspecialchars($formData['artista']) ?>"
            >
        </div>

        <!-- Género -->
        <div class="form-group">
            <label for="genero" class="form-label">Género</label>
            <select
                id="genero"
                name="genero"
                class="form-select form-select-filled"
            >
                <?php
                $generos = ['' => 'Selecciona un género', 'Rock' => 'Rock', 'Pop' => 'Pop',
                            'Jazz' => 'Jazz', 'Reggaeton' => 'Reggaeton', 'Electrónica' => 'Electrónica'];
                foreach ($generos as $value => $label):
                    $selected = ($formData['genero'] === $value) ? 'selected' : '';
                ?>
                    <option value="<?= htmlspecialchars($value) ?>" <?= $selected ?>>
                        <?= htmlspecialchars($label) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Año -->
        <div class="form-group">
            <label for="ano" class="form-label">Año</label>
            <input
                type="text"
                id="ano"
                name="ano"
                class="form-input"
                value="<?= htmlspecialchars($formData['ano']) ?>"
            >
        </div>

        <!-- Álbum -->
        <div class="form-group">
            <label for="album" class="form-label">Álbum</label>
            <input
                type="text"
                id="album"
                name="album"
                class="form-input"
                value="<?= htmlspecialchars($formData['album']) ?>"
            >
        </div>

        <!-- Duración -->
        <div class="form-group">
            <label for="duracion" class="form-label">Duración</label>
            <input
                type="text"
                id="duracion"
                name="duracion"
                class="form-input"
                value="<?= htmlspecialchars($formData['duracion']) ?>"
            >
        </div>

        <!-- Imagen -->
        <div class="form-group">
            <label for="imagen" class="form-label">Imagen de la canción (opcional)</label>
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

        <!-- Botones -->
        <div class="form-actions">
            <button
                type="button"
                class="btn-cancel"
                onclick="window.location.href='canciones.php'"
            >
                Cancelar
            </button>

            <button type="submit" class="btn-submit">
                Guardar cambios
            </button>
        </div>
    </form>
</div>
