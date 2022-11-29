<?php

echo "<h2>$pageTitle</h2>";
echo "<h3>" . $project->getProjectName() . "</h3><br>";
$tasks = $project->getTasks();
foreach ($tasks as $task) {
    echo $task->getTitle() . ' ';
    echo $task->getDescription() . ' ';
    echo $task->getPriority() . ' ';
    echo $task->getLifecycle() . ' ';
    if ($task->getIduser() !== NULL) {
        echo $task->getUser()->getFirstName() . ' ';
        echo $task->getUser()->getLastName() . ' ';
        echo $task->getUser()->getEmail();
    } else {
?>
        <form method="POST" action="">
            <input name='adduser' type='submit' value='Add User'>
            <input name='createuser' type='submit' value='Create User'>
        </form>
<?php
    }

    echo "<a href='index.php?page=". $_GET['page'] ."&idproject=" . $project->getId() . "&delete=" . $task->getId() . "'>Supprimer</a> ";
    echo "<a href='index.php?page=" . $_GET['page'] . "&update=" . $task->getId() . "'>Modifier</a><br>";
}
echo "<a href='index.php?page=" . $_GET['page'] . "&idproject=" . $project->getId() . "&insert=1'>Add new task</a>";
