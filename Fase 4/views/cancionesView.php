<?php
// views/cancionesView.php
?>

<!-- Breadcrumb -->
<nav class="breadcrumb">
    <a href="index.php">Inicio</a>
    <span>/</span>
    <a href="canciones.php">Canciones</a>
    <span>/</span>
    <span class="current">Ver canciones</span>
</nav>

<!-- Page Header -->
<div class="page-header">
    <h1 class="page-title">Ver Canciones</h1>
    <button class="btn-primary" onclick="window.location.href='agregar-cancion.php'">
        <img src="icons/plus.svg" alt="Agregar" class="icon">
        Agregar canción
    </button>
</div>

<?php if (!empty($message)): ?>
    <p style="color: green; margin-bottom: 15px;">
        <?= htmlspecialchars($message) ?>
    </p>
<?php endif; ?>

<!-- FORM DE FILTROS -->
<form method="get" action="canciones.php">

    <!-- Barra de búsqueda LARGA + botón afuera a la derecha -->
    <div class="search-filters">
        <!-- Marco de la barra -->
        <div class="search-bar">
            <input
                type="text"
                name="buscar"
                placeholder="Buscar por título o artista"
                class="search-input"
                value="<?= htmlspecialchars($search) ?>"
            >
            <button class="search-icon" type="submit">
                <img src="icons/search.svg" alt="Buscar" class="icon">
            </button>
        </div>

        <!-- Botón separado, con espacio respecto a la barra -->
        <button class="btn-secondary" type="submit" style="margin-left: 10px;">
            Aplicar filtros
        </button>
    </div>

    <!-- Filtros ABAJO (Género, Artista, Año) -->
    <div class="filters-row">
        <!-- Género -->
        <div class="filter-group">
            <label>Género</label>
            <select class="filter-select" name="genero">
                <?php
                $generos = ['Todos', 'Rock', 'Pop', 'Jazz', 'Reggaeton', 'Electrónica'];
                foreach ($generos as $g):
                    $selected = ($genre === $g || ($genre === '' && $g === 'Todos')) ? 'selected' : '';
                ?>
                    <option value="<?= htmlspecialchars($g) ?>" <?= $selected ?>>
                        <?= htmlspecialchars($g) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Artista -->
        <div class="filter-group">
            <label>Artista</label>
            <select class="filter-select" name="artista">
                <option value="Todos">Todos</option>
                <?php foreach ($artistsList as $art): ?>
                    <?php $selected = ($artist === $art) ? 'selected' : ''; ?>
                    <option value="<?= htmlspecialchars($art) ?>" <?= $selected ?>>
                        <?= htmlspecialchars($art) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Año -->
        <div class="filter-group">
            <label>Año</label>
            <select class="filter-select" name="ano">
                <option value="Todos">Todos</option>
                <?php foreach ($yearsList as $y): ?>
                    <?php $selected = ((string)$year === (string)$y) ? 'selected' : ''; ?>
                    <option value="<?= htmlspecialchars($y) ?>" <?= $selected ?>>
                        <?= htmlspecialchars($y) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</form>

<!-- Songs Grid -->
<div class="songs-grid">
    <?php if (empty($canciones)): ?>
        <p>No hay canciones que coincidan con los filtros.</p>
    <?php else: ?>
        <?php foreach ($canciones as $c): ?>
            <div class="song-card">
                <?php if (!empty($c['image_path'])): ?>
                    <div class="song-card-image"
                         style="background-image: url('<?= htmlspecialchars($c['image_path']) ?>');
                                background-size: cover;
                                background-position: center;">
                    </div>
                <?php else: ?>
                    <!-- Cuadro gris por defecto -->
                    <div class="song-card-image"></div>
                <?php endif; ?>

                <h3 class="song-card-title">
                    <?= htmlspecialchars($c['title']) ?>
                </h3>
                <p class="song-card-artist">
                    <?= htmlspecialchars($c['artist']) ?>
                </p>
                <p class="song-card-info">
                    <?= htmlspecialchars($c['genre'] ?? '') ?>
                    <?php if (!empty($c['year'])): ?>
                        - <?= htmlspecialchars($c['year']) ?>
                    <?php endif; ?>
                </p>
                <div class="song-card-actions">
                    <button
                        class="btn-outline"
                        onclick="if(confirm('¿Eliminar esta canción?')){ window.location.href='canciones.php?eliminar=<?= $c['id'] ?>'; }"
                    >
                        Eliminar
                    </button>

                    <button
                        class="btn-dark"
                        onclick="window.location.href='editar-cancion.php?id=<?= $c['id'] ?>';"
                    >
                        Editar
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
