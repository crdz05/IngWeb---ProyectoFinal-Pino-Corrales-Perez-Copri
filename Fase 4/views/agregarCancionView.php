<?php
// views/agregarCancionView.php
?>

<!-- Breadcrumb -->
<nav class="breadcrumb">
    <a href="index.php">Inicio</a>
    <span>/</span>
    <a href="canciones.php">Canciones</a>
    <span>/</span>
    <span class="current">Agregar canción</span>
</nav>

<h1 class="page-title">Agregar Canción</h1>

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
                placeholder="Título de la canción"
                value="<?= htmlspecialchars($oldData['titulo']) ?>"
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
                placeholder="Nombre del artista o banda"
                value="<?= htmlspecialchars($oldData['artista']) ?>"
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
                    $selected = ($oldData['genero'] === $value) ? 'selected' : '';
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
                placeholder="Año de lanzamiento"
                value="<?= htmlspecialchars($oldData['ano']) ?>"
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
                placeholder="Nombre del álbum (opcional)"
                value="<?= htmlspecialchars($oldData['album']) ?>"
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
                placeholder="Ejemplo: 03:45"
                value="<?= htmlspecialchars($oldData['duracion']) ?>"
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
                Si no seleccionas una imagen, se mostrará la tarjeta gris por defecto.
            </p>
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
                Guardar canción
            </button>
        </div>
    </form>
</div>
