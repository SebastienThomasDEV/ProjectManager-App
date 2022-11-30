<?php 

// echo "<h2>$pageTitle</h2>";
echo $users -> getFirstName() ."<br>";
echo $users -> getLastName() ."<br>";
echo $users -> getEmail()."<br>";
echo "<a href='index.php?page=" . $_GET['page'] . "&update=" . $users->getId() . "'>Modify account </a>";
echo "<a href='index.php?page=" . $_GET['page'] . "&updatepwd=" . $users->getId() . "'>Modify password </a>";
echo "<a href='index.php?page=" . $_GET['page'] . "&delete=" . $users->getId() . "'>Delete </a>";