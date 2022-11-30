<?php

echo "<h2>$pageTitle</h2>";
foreach ($projects as $project) {
    echo "<a href='index.php?page=displaytask&idproject=" . $project->getId() . "'>" . $project->getProjectName() . "</a>";
    echo "<a href='index.php?page=" . $_GET['page'] . "&delete=" . $project->getId() . "'>Supprimer</a> ";
    echo "<a href='index.php?page=" . $_GET['page'] . "&update=" . $project->getId() . "'>Modifier</a><br>";
}

echo "<h2>Project you are participating in</h2>";
foreach ($projectsParticipant as $project) {
    echo "<a href='index.php?page=displaytask&idproject=" . $project->getId() . "'>" . $project->getProjectName() . "</a>";
}
echo "<a href='index.php?page=" . $_GET['page'] . "&insert=1'>Create new project</a>";
