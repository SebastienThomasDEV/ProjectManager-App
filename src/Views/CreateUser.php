<?php


    echo '<h2>' . $pageTitle . '</h2>';
    if (isset($message)) {
        echo '<div>' . $message . '</div>';
    }
    ?>

<form method='POST' action='index.php?page=<?php echo $_GET['page']."&insert=1"; ?>'>
    <input name='firstname' type='text' placeholder='First name'>
    <input name='lastname' type='text' placeholder='Last name'>
    <input name='email' type='text' placeholder='email'>
    <input name='pwd' type='password' placeholder="Password">
    <input name='pwdconfirm' type='password' placeholder="Confirm password">
    <?php
        if ($connected == true):
    ?>
    <p>Will be added to task: placeholder of project: placeholder</p>
    <?php
        endif; 
    ?>
    <input type='submit' name='submit' value='Create account'>
</form>



