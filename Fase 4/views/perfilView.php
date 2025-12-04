<?php
// views/perfilView.php
?>

<!-- Breadcrumb -->
<nav class="breadcrumb">
    <a href="index.php">Inicio</a>
    <span>/</span>
    <span class="current">Perfil</span>
</nav>

<h1 class="page-title">Mi Perfil</h1>

<div class="profile-layout">
    <!-- Columna izquierda: avatar y resumen -->
    <aside class="profile-sidebar">
        <div class="profile-card">
            <!-- Avatar grande -->
            <div
                class="profile-avatar-large"
                <?php if (!empty($currentAvatar)): ?>
                    style="background-image: url('<?= htmlspecialchars($currentAvatar) ?>');
                           background-size: cover;
                           background-position: center;"
                <?php endif; ?>
            ></div>

            <!-- Form para cambiar foto SOLO avatar -->
            <form method="post" action="" enctype="multipart/form-data" style="margin-top: 15px;">
                <input
                    type="file"
                    id="avatar"
                    name="avatar"
                    accept="image/*"
                    style="display: none;"
                >
                <label for="avatar" class="btn-secondary" style="display: inline-block; text-align: center; cursor: pointer;">
                    Cambiar foto
                </label>

                <button type="submit" class="btn-submit" style="margin-top: 10px; width: 100%;">
                    Guardar avatar
                </button>
            </form>

            <?php if (!empty($message)): ?>
                <p style="color: green; margin-top: 10px; font-size: 0.9rem;">
                    <?= htmlspecialchars($message) ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <ul style="color: red; margin-top: 10px; font-size: 0.9rem;">
                    <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <!-- Info rápida dummy -->
            <div class="profile-summary">
                <h3 class="section-subtitle">Resumen</h3>
                <p><strong>Usuario:</strong> Usuario</p>
                <p><strong>Plan:</strong> Premium</p>
                <p><strong>Miembro desde:</strong> 2024</p>
            </div>
        </div>
    </aside>

    <!-- Columna derecha: formulario dummy (solo visual) -->
    <section class="profile-main">
        <div class="form-container">
            <h2 class="section-title">Información de la cuenta</h2>

            <!-- ESTE FORM ES SOLO VISUAL, NO SE GUARDA NADA -->
            <form class="profile-form">
                <!-- Nombre de usuario -->
                <div class="form-group">
                    <label for="username" class="form-label">Nombre de usuario</label>
                    <input type="text" id="username" name="username" class="form-input" value="Usuario">
                </div>

                <!-- Correo electrónico -->
                <div class="form-group">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="form-input" value="usuario@ejemplo.com">
                </div>

                <!-- Nombre completo -->
                <div class="form-group">
                    <label for="fullname" class="form-label">Nombre completo</label>
                    <input type="text" id="fullname" name="fullname" class="form-input" value="Nombre Apellido">
                </div>

                <!-- Fecha de nacimiento -->
                <div class="form-group">
                    <label for="birthdate" class="form-label">Fecha de nacimiento</label>
                    <input type="date" id="birthdate" name="birthdate" class="form-input" value="2000-01-01">
                </div>

                <!-- País -->
                <div class="form-group">
                    <label for="country" class="form-label">País</label>
                    <select id="country" name="country" class="form-select form-select-filled">
                        <option value="panama" selected>Panamá</option>
                        <option value="mexico">México</option>
                        <option value="colombia">Colombia</option>
                        <option value="argentina">Argentina</option>
                        <option value="españa">España</option>
                    </select>
                </div>

                <!-- Separator -->
                <hr class="form-separator">

                <!-- Cambiar contraseña (solo visual) -->
                <h3 class="section-subtitle">Cambiar contraseña</h3>

                <div class="form-group">
                    <label for="current-password" class="form-label">Contraseña actual</label>
                    <input type="password" id="current-password" name="current-password" class="form-input" placeholder="••••••••">
                </div>

                <div class="form-group">
                    <label for="new-password" class="form-label">Nueva contraseña</label>
                    <input type="password" id="new-password" name="new-password" class="form-input" placeholder="••••••••">
                </div>

                <div class="form-group">
                    <label for="confirm-password" class="form-label">Confirmar nueva contraseña</label>
                    <input type="password" id="confirm-password" name="confirm-password" class="form-input" placeholder="••••••••">
                </div>

                <!-- Botones dummy -->
                <div class="form-actions">
                    <button type="button" class="btn-cancel">
                        Cancelar
                    </button>

                    <button type="button" class="btn-submit">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
