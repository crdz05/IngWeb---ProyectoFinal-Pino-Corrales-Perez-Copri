<?php
// views/playlistView.php
?>

<!-- Breadcrumb -->
<nav class="breadcrumb">
    <a href="index.php">Inicio</a>
    <span>/</span>
    <span class="current">Playlist</span>
</nav>

<!-- Page Header -->
<div class="page-header">
    <h1 class="page-title">Playlists</h1>
    <button class="btn-primary" onclick="window.location.href='crear-playlist.php'">
        <img src="icons/plus.svg" alt="Nueva playlist" class="icon">
        Crear playlist
    </button>
</div>

<?php if (!empty($message)): ?>
    <p style="color: green; margin-bottom: 15px;">
        <?= htmlspecialchars($message) ?>
    </p>
<?php endif; ?>

<!-- Grid de playlists -->
<div class="playlists-grid">
    <?php if (empty($playlists)): ?>
        <p>No hay playlists registradas.</p>
    <?php else: ?>
        <?php foreach ($playlists as $p): ?>
            <div class="playlist-card">
                <?php if (!empty($p['image_path'])): ?>
                    <div class="playlist-card-image"
                         style="background-image: url('<?= htmlspecialchars($p['image_path']) ?>');
                                background-size: cover;
                                background-position: center;">
                    </div>
                <?php else: ?>
                    <!-- Cuadro gris por defecto -->
                    <div class="playlist-card-image"></div>
                <?php endif; ?>

                <h3 class="playlist-card-title">
                    <?= htmlspecialchars($p['name']) ?>
                </h3>

                <?php if (!empty($p['description'])): ?>
                    <p class="playlist-card-description">
                        <?= htmlspecialchars($p['description']) ?>
                    </p>
                <?php endif; ?>

                <p class="playlist-card-count">
                    <?= (int)$p['song_count'] ?> canciones
                </p>

                <!-- Botón ROJO grande arriba -->
                <div class="playlist-card-actions-top">
                    <button
                        class="btn-danger btn-full"
                        onclick="window.location.href='editar-playlist.php?id=<?= $p['id'] ?>';"
                    >
                        Agregar canciones
                    </button>
                </div>

                <!-- Botones inferiores: Eliminar / Editar -->
                <div class="playlist-card-actions">
                    <button
                        class="btn-outline"
                        onclick="if(confirm('¿Eliminar esta playlist?')){ window.location.href='playlist.php?eliminar=<?= $p['id'] ?>'; }"
                    >
                        Eliminar
                    </button>

                    <button
                        class="btn-dark"
                        onclick="window.location.href='editar-playlist.php?id=<?= $p['id'] ?>';"
                    >
                        Editar
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
