<?php

echo "<h2>$title</h2>";
echo "<h3>".$project->getProjectName()."</h3><br>";
$tasks = $project->getTasks();
foreach ($tasks as $task) {
    echo $task->getTitle().' ';
    echo $task->getDescription().' ';
    echo $task->getPriority().' ';
    echo $task->getLifecycle().' ';
    echo $task->getUser()->getFirstName().' ';
    echo $task->getUser()->getLastName().' ';
    echo $task->getUser()->getEmail();
    echo "<a href='index.php?page=".$_GET['page']."&delete=".$task->getId()."'>Supprimer</a> ";
    echo "<a href='index.php?page=".$_GET['page']."&update=".$task->getId()."'>Modifier</a><br>";
}
echo "<a href='index.php?page=".$_GET['page']."&insert=1'>Add new task</a>";