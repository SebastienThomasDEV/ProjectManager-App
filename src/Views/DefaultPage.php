<?php

echo "<h2>$pageTitle</h2>";

if (isset($message)) {
    echo '<div>'.$message.'</div>';
}
if ($connected !== true):
?>
<form method='POST' action=''>
    <input name='user' type='text' placeholder='Your email'>
    <input name='pwd' type='password' placeholder="Your password">
    <a href="">Forgot password?</a>
    <input type='submit' name='submit' value='Sign in'>
</form>
<a href="index.php?page=displayuser&insert=1">New user? Sign in</a>

<?php
endif;
?>




