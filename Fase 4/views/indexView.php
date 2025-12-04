<?php
// views/indexView.php
?>

<h1 class="greeting">Buenas tardes</h1>

<!-- Tarjetas grandes -->
<div class="cards-container">
    <!-- Card Canciones -->
    <div class="card" onclick="window.location.href='canciones.php'">
        <?php if (!empty($firstSong) && !empty($firstSong['image_path'])): ?>
            <div class="card-image"
                 style="background-image: url('<?= htmlspecialchars($firstSong['image_path']) ?>');
                        background-size: cover;
                        background-position: center;">
            </div>
        <?php else: ?>
            <div class="card-image"></div>
        <?php endif; ?>

        <h3 class="card-title">Canciones</h3>
        <p class="card-description">Gestiona tu biblioteca musical</p>
    </div>

    <!-- Card Playlist -->
    <div class="card" onclick="window.location.href='playlist.php'">
        <?php if (!empty($firstPlaylist) && !empty($firstPlaylist['image_path'])): ?>
            <div class="card-image"
                 style="background-image: url('<?= htmlspecialchars($firstPlaylist['image_path']) ?>');
                        background-size: cover;
                        background-position: center;">
            </div>
        <?php else: ?>
            <div class="card-image"></div>
        <?php endif; ?>

        <h3 class="card-title">Playlist</h3>
        <p class="card-description">Organiza tus favoritas</p>
    </div>

    <!-- Card Perfil -->
    <div class="card" onclick="window.location.href='perfil.php'">
        <?php if (!empty($headerAvatar)): ?>
            <div class="card-image"
                 style="background-image: url('<?= htmlspecialchars($headerAvatar) ?>');
                        background-size: cover;
                        background-position: center;">
            </div>
        <?php else: ?>
            <div class="card-image"></div>
        <?php endif; ?>

        <h3 class="card-title">Perfil</h3>
        <p class="card-description">Configuración y datos</p>
    </div>
</div>

<!-- Canciones recientes -->
<section class="recent-section">
    <h2 class="section-title">Canciones Recientes</h2>

    <?php if (empty($recentSongs)): ?>
        <p>No hay canciones registradas todavía.</p>
    <?php else: ?>
        <div class="song-list">
            <?php foreach ($recentSongs as $song): ?>
                <div class="song-item">
                    <div class="song-title">
                        <?= htmlspecialchars($song['title']) ?>
                    </div>
                    <div class="song-info">
                        <?= htmlspecialchars($song['artist'] ?? 'Artista desconocido') ?>
                        <?php if (!empty($song['genre'])): ?>
                            - <?= htmlspecialchars($song['genre']) ?>
                        <?php endif; ?>
                        <?php if (!empty($song['year'])): ?>
                            - <?= htmlspecialchars($song['year']) ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
