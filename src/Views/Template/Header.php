<header>
    <nav>
        <a href='index.php'>Home</a>
        <?php if (isset($connected) && $connected === true): ?>
        <a href='index.php?page=createproject'>Create new project</a>
        <a href='index.php?page=accountdetails'>Your account</a>
        <a href='index.php?page=index&session=0'>Log out</a>
        <?php endif; ?>
    </nav>
</header>