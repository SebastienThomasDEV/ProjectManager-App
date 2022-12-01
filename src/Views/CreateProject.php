<?php


if (isset($message)) {
    echo '<div>' . $message . '</div>';
}
?>

<form class="real_project" method='POST' action='index.php?page=<?php echo $_GET['page'].$action; ?>'>
    <input type='text' name='projectName' value="<?php echo isset($projectName) ? $projectName: ''; ?>" placeholder='Project name'>
    <input type='submit' name='create' value='<?php echo $submit; ?>'>
</form>

