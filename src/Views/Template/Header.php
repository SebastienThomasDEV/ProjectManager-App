<header>
    <nav>
        <a href='index.php'>Accueil</a>
        <?php if (isset($connected) && $connected === true): ?>
        <a href='index.php?page=index&session=0'>Déconnexion</a>
        <?php endif; ?>
    </nav>
</header>