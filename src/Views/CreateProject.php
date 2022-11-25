<?php


echo "<h2>$title</h2>";

if (isset($message)) {
    echo '<div>'.$message.'</div>';
}
?>
<form method="POST" action='index.php?page=<?php echo $_GET['page'].$action; ?>'>
    <input type='text' name='projectTitle' placeholder="Project title" required>
    <input type='submit' name='create' value='<?php echo $submit; ?>'>
</form>