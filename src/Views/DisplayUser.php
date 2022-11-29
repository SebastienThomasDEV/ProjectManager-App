<?php 

echo "<h2>$title</h2>";
echo $users -> getFirstName() ."<br>";
echo $users -> getLastName() ."<br>";
echo $users -> getEmail()."<br>";
echo "<a href='index.php?page=" . $_GET['page'] . "&update=" . $users->getId() . "'>Modifier </a>";
echo "<a href='index.php?page=" . $_GET['page'] . "&delete=" . $users->getId() . "'>Supprimer </a>";