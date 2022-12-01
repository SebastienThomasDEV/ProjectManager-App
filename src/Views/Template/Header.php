<header>
    <img src="logo.png" alt="logo" class="logo">
    <nav>
        <a href='index.php'>Home</a>
        <?php if (isset($connected) && $connected === true): ?>
        <a href='index.php?page=displayproject'>Projects</a>
        <a href='index.php?page=displayuser'>Your account</a>
        <a href='index.php?page=index&session=0'>Log out</a>
        <div class="logged">Logged as <?php echo $_SESSION['email'] ?></div>
        <?php endif; ?>
    </nav>
</header>