<?php

echo "<h2>$title</h2>";

if (isset($message)) {
    echo '<div>'.$message.'</div>';
}
if ($connected !== true):
?>
<form method='POST' action=''>
    <input name='user' type='text' placeholder='Your email'>
    <input name='pwd' type='password' placeholder="Your password">
    <input type='submit' name='submit' value='Sign in'>
</form>
<?php
echo $message;
echo $_GET['page'];
?>

<a href='index.php?page=createuser'>Sign up</a>


