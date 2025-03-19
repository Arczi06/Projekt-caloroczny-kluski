<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Bibliotekarz</h2>
    </div>
    <nav class="sidebar-nav">
        <a href="biblio.php" class="<?= basename($_SERVER['PHP_SELF']) == 'biblio.php' ? 'active' : '' ?>">Dashboard</a>
        <a href="biblio_users.php" class="<?= basename($_SERVER['PHP_SELF']) == 'biblio_users.php' ? 'active' : '' ?>">Użytkownicy</a>
        <a href="biblio_books.php" class="<?= basename($_SERVER['PHP_SELF']) == 'biblio_books.php' ? 'active' : '' ?>">Książki</a>
        <a href="biblio_mess.php" class="<?= basename($_SERVER['PHP_SELF']) == 'biblio_mess.php' ? 'active' : '' ?>">Wiadomości</a>
        <a href="logout.php" id="Logout">Wyloguj</a>
    </nav>
</aside>
