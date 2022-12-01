<?php

echo "<h2>" . $project->getProjectName() . "</h2><br>";
echo "<h3>$pageTitle</h3>";
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
    } else if ($idAdmin == $_SESSION['id']) {
?>
        <form method="POST" action="" id="selectuser">
            <input name='assignuser' type='submit' value='Assign User'>
        </form>
        <select name="users_list" form="selectuser">
            <option value=""></option>
            <?php
            foreach ($users as $user) {
                echo '<option value="' . $user->getEmail() . '">' . $user->getEmail() . '</option>';
            }
            ?>
        </select>
<?php
    }
    if ($idAdmin == $_SESSION['id']) {
        echo "<a href='index.php?page=" . $_GET['page'] . "&idproject=" . $project->getId() . "&delete=" . $task->getId() . "'>Supprimer</a> ";
        echo "<a href='index.php?page=" . $_GET['page'] . "&update=" . $task->getId() . "'>Modifier</a><br>";
    }
}
if ($idAdmin == $_SESSION['id']) {
    echo "<a href='index.php?page=" . $_GET['page'] . "&idproject=" . $project->getId() . "&insert=1'>Add new task</a>";
}


?>

<ul>
    <?php
    foreach ($users as $user) {
        echo "<li>" . $user->getFirstName() . $user->getLastName() . $user->getEmail() . "</li>";
    }
    ?>
    <form method="POST" action="">
        <input name='adduser' type='submit' value='Add User'>
        <input name='createuser' type='submit' value='Create User'>
    </form>
</ul>