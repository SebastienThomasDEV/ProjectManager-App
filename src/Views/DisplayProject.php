<?php

echo "<h2>$title</h2>";
foreach ($projects as $project) {
    echo "<a href='index.php?page=" . $_GET['page'] . "&idproject=" . $project->getId() . "'>" . $project->getProjectName() . "</a>";
    echo "<a href='index.php?page=" . $_GET['page'] . "&delete=" . $project->getId() . "'>Supprimer</a> ";
    echo "<a href='index.php?page=" . $_GET['page'] . "&update=" . $project->getId() . "'>Modifier</a><br>";
}
echo "<a href='index.php?page=" . $_GET['page'] . "&insert=1'>Create new project</a>";
