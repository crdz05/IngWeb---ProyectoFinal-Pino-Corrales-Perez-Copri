<?php
// views/ayudaView.php
?>

<!-- Breadcrumb -->
<nav class="breadcrumb">
    <a href="index.php">Inicio</a>
    <span>/</span>
    <span class="current">Ayuda</span>
</nav>

<!-- Page Title -->
<h1 class="page-title">Centro de Ayuda</h1>

<div class="form-container-wide">

    <!-- Guía rápida -->
    <section class="help-section">
        <h2 class="section-subtitle">Guía rápida</h2>
        <p>
            Esta aplicación te permite gestionar tu biblioteca musical, administrar playlists,
            editar canciones y visualizar la información de tu perfil. Aquí encontrarás respuestas
            a las dudas más comunes sobre cómo usar cada sección.
        </p>
    </section>

    <hr class="form-separator">

    <!-- Cómo usar la aplicación -->
    <section class="help-section">
        <h2 class="section-subtitle">¿Cómo usar la aplicación?</h2>

        <h3 class="faq-title">Inicio</h3>
        <p class="faq-text">
            En la página de <strong>Inicio</strong> verás un resumen general de la aplicación y,
            opcionalmente, una lista de canciones recientes o accesos rápidos a las funciones
            principales como <strong>Canciones</strong> y <strong>Playlist</strong>.
        </p>

        <h3 class="faq-title">Canciones</h3>
        <p class="faq-text">
            En la sección <strong>Canciones</strong> puedes ver el listado de todas las canciones
            registradas en el sistema. Desde aquí puedes:
        </p>
        <ul class="contact-list">
            <li>Buscar canciones por título o artista.</li>
            <li>Filtrar por género musical.</li>
            <li>Agregar nuevas canciones.</li>
            <li>Editar o eliminar canciones existentes.</li>
        </ul>

        <h3 class="faq-title">Playlist</h3>
        <p class="faq-text">
            La sección de <strong>Playlist</strong> te permite crear listas de reproducción personalizadas.
            Podrás ver tus playlists, crear nuevas y editar las existentes para elegir qué canciones
            incluye cada una.
        </p>

        <h3 class="faq-title">Perfil</h3>
        <p class="faq-text">
            En <strong>Perfil</strong> se muestra información básica del usuario que está usando la
            aplicación. En este proyecto es solo una vista ilustrativa para dar la idea de un usuario
            logeado, por lo que los datos mostrados son de ejemplo.
        </p>
    </section>

    <hr class="form-separator">

    <!-- Preguntas frecuentes -->
    <section class="help-section">
        <h2 class="section-subtitle">Preguntas frecuentes</h2>

        <div class="faq-item">
            <h3 class="faq-title">¿Cómo agrego una canción nueva?</h3>
            <p class="faq-text">
                Ve a la sección <strong>Canciones</strong> y haz clic en
                <strong>Agregar canción</strong>. Completa el formulario con el título,
                artista, género, año y demás datos que desees registrar, y luego guarda
                la información.
            </p>
        </div>

        <div class="faq-item">
            <h3 class="faq-title">¿Cómo creo una playlist?</h3>
            <p class="faq-text">
                En la página <strong>Playlist</strong>, selecciona el botón
                <strong>Nueva Playlist</strong> (o <strong>Crear Playlist</strong>).
                Asigna un nombre y una descripción, guarda la playlist y luego podrás
                agregarle canciones desde la opción de <strong>Editar</strong>.
            </p>
        </div>

        <div class="faq-item">
            <h3 class="faq-title">¿Puedo editar mis playlists?</h3>
            <p class="faq-text">
                Sí. En la sección <strong>Playlist</strong>, ubica la playlist que deseas
                modificar y haz clic en <strong>Editar</strong>. Desde ahí puedes cambiar
                su nombre, descripción y seleccionar las canciones que formarán parte de ella.
            </p>
        </div>

        <div class="faq-item">
            <h3 class="faq-title">¿Los datos de perfil son reales?</h3>
            <p class="faq-text">
                No. En este proyecto, la sección <strong>Perfil</strong> es únicamente
                decorativa. Los datos que se muestran son estáticos y sirven para simular
                cómo se vería un usuario logeado en una versión futura con sistema de inicio
                de sesión.
            </p>
        </div>
    </section>

    <hr class="form-separator">

    <!-- Contacto -->
    <section class="help-section">
        <h2 class="section-subtitle">Contacto</h2>
        <p class="faq-text">
            Para soporte técnico o dudas relacionadas con este proyecto académico, puedes
            comunicarte con el equipo responsable del curso de
            <strong>Ingeniería Web</strong>.
        </p>
        <br>
        <ul class="contact-list">
            <li><strong>Correo:</strong> Grupo9@Ingweb.com</li>
            <li><strong>Grupo:</strong> Proyecto Final - Grupo 9</li>
            <li><strong>Año:</strong> 2025</li>
        </ul>
    </section>
</div>
