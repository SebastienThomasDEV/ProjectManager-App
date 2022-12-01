<?php

echo "<h2>$pageTitle</h2>";
foreach ($projects as $project) {
    echo "<a class=\"list_task\" href='index.php?page=displaytask&idproject=" . $project->getId() . "'>" . $project->getProjectName() . "</a>" . "<br>";
    echo "<a class=\"list_task\" href='index.php?page=" . $_GET['page'] . "&delete=" . $project->getId() . "'>Delete</a> ";
    echo "<a class=\"list_task\" href='index.php?page=" . $_GET['page'] . "&update=" . $project->getId() . "'>Modify</a><br>";
}
echo "<a class=\"list_task\" href='index.php?page=" . $_GET['page'] . "&insert=1'>Create new project</a>";

echo "<h2>Projects you are participating in</h2>";
foreach ($projectsParticipant as $project) {
    if ($project->getIdAdmin() !== $_SESSION['id']) {
        echo "<a class=\"list_task\" href='index.php?page=displaytask&idproject=" . $project->getId() . "'>" . $project->getProjectName() . "</a>" . "<br>";
    }
}
