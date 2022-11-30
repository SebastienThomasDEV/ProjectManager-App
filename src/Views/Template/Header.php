<header>
    <nav>
        <a href='index.php'>Home</a>
        <?php if (isset($connected) && $connected === true): ?>
        <a href='index.php?page=displayproject'>Project</a>
        <a href='index.php?page=displayuser'>Your account</a>
        <a href='index.php?page=index&session=0'>Log out</a>
        <div>Logged as <?php echo $_SESSION['email'] ?></div>
        <?php endif; ?>
    </nav>
</header>