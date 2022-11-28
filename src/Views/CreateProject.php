<?php


if (isset($message)) {
    echo '<div>'.$message.'</div>';
}
?>

<form method="POST" action='index.php?page=<?php echo $_GET['page']."&insert=1"; ?>'>
    <input type='text' name='projectName' placeholder='Project name'>
    <input type='submit' name='create' value='<?php echo $submit; ?>'>
</form>