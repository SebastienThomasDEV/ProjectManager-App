<?php

// echo "<h2>$pageTitle</h2>";

if (isset($message)) {
    echo '<div class="welcome">'.$message.'</div>';// Welcome message at home page
}
if ($connected !== true) :
?>

<form method='POST' action='' class="connection">
    <input name='user' type='text' placeholder='Your email'>
    <input name='pwd' type='password' placeholder="Your password">
    <input type='submit' name='submit' value='Sign in'>
</form>
<a href="index.php?page=displayuser&insert=1" class="newUser">New user? Create an account</a>


<?php
endif;
?>