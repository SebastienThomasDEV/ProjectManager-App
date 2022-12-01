<?php


if (isset($message)) {
    echo '<div>' . $message . '</div>';
}
?>


<form class="create_task" method="POST" action='' id="taskform">
    <input name='title' type='text' placeholder='Add Task Name' value="<?= isset($title) ? $title: ''; ?>">
    <input name='description' type='text' placeholder='Add Task Description' value="<?= isset($description) ? $description: ''; ?>">
    <input class="addTaskPriority" name='priority' type='number' placeholder='Add Task Priority' value="<?= isset($priority) ? $priority: ''; ?>">
    <select class="taskLifeCycle" name="lifeCycle" form="taskform">
        <option value="started">Start</option>
        <option value="inprogress">In progress</option>
        <option value="finished">Finished</option>
    </select>
    <input type='submit' name='create' value='<?= $submit; ?>'>
</form>
