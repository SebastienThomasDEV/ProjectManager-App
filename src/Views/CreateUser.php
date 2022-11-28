<?php
if ($connected !== true):

    echo '<h2>' . $title . '</h2>';
    if (isset($message)) {
        echo '<div>' . $message . '</div>';
    }
    ?>

<form method='POST' action='index.php?page=<?php echo $_GET['page']."&insert=1"; ?>'>
    <input name='firstname' type='text' placeholder='Name'>
    <input name='lastname' type='text' placeholder='LastName'>
    <input name='email' type='text' placeholder='email'>
    <input name='pwd' type='password' placeholder="Password">
    <input name='pwdconfirm' type='password' placeholder="Confirm password">
    <input type='submit' name='submit' value='Create account'>
</form>
<?php
endif; ?>


