<?php


if (isset($message)) {
    echo '<div>' . $message . '</div>';
}
?>


<form method="POST" action='' id="taskform">
    <input name='title' type='text' placeholder='Add Task Name' value="<?= isset($title) ? $title: ''; ?>">
    <input name='description' type='text' placeholder='Add Task Description' value="<?= isset($description) ? $description: ''; ?>">
    <input name='priority' type='text' placeholder='Add Task Priority' value="<?= isset($priority) ? $priority: ''; ?>">
    <select name="lifeCycle" form="taskform">
        <option value="started">Started</option>
        <option value="inprogress">In progress</option>
        <option value="finished">Finished</option>
    </select>
    <input type='submit' name='create' value='<?= $submit; ?>'>
</form>
