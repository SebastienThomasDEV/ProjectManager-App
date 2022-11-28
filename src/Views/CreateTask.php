<?php


if (isset($message)) {
    echo '<div>' . $message . '</div>';
}
?>


<form method="POST" action='index.php?page=<?php echo $_GET['page'] . "&idproject=" . $_GET['idproject'] . "&insert=1"; ?>'>
    <input name='title' type='text' placeholder='Add Task Name'>
    <input name='description' type='text' placeholder='Add Task Description'>
    <input name='priority' type='num' placeholder='Add Task Priority'>
    <input name='lifeCycle' type='text' placeholder='Add Task Lifecycle'>
    <input type='submit' name='create' value='<?php echo $submit; ?>'>
</form>