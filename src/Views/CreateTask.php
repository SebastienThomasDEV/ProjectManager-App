<?php


if (isset($message)) {
    echo '<div>' . $message . '</div>';
}
?>


<form method="POST" action=''>
    <input name='title' type='text' placeholder='Add Task Name' value="<?php echo isset($title) ? $title: ''; ?>">
    <input name='description' type='text' placeholder='Add Task Description' value="<?php echo isset($description) ? $description: ''; ?>">
    <input name='priority' type='text' placeholder='Add Task Priority' value="<?php echo isset($priority) ? $priority: ''; ?>">
    <input name='lifeCycle' type='text' placeholder='Add Task Lifecycle' value="<?php echo isset($lifeCycle) ? $lifeCycle: ''; ?>">
    <input type='submit' name='create' value='<?php echo $submit; ?>'>
</form>