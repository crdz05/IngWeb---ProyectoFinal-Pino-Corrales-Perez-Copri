    </main>

    <footer>
        © 2025 Ingeniería Web - Proyecto Final
    </footer>

    <script>
        function toggleUserMenu() {
            const menu = document.getElementById("userDropdown");
            menu.style.display = (menu.style.display === "flex") ? "none" : "flex";
        }

        document.addEventListener("click", function(event) {
            const userMenu = document.querySelector(".user-menu-container");
            const dropdown = document.getElementById("userDropdown");

            if (!userMenu.contains(event.target)) {
                dropdown.style.display = "none";
            }
        });
    </script>
</body>
</html>
