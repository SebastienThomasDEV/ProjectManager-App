<?php

echo "<h2>" . $project->getProjectName() . "</h2><br>";
echo "<h3>$pageTitle</h3>";
$tasks = $project->getTasks();

foreach ($tasks as $task) {
    echo "<div>".$task->getTitle() . "</div>";
    echo $task->getDescription() . ' ';
    echo $task->getPriority() . ' ';
    echo $task->getLifecycle() . ' ';
    if ($task->getIduser() !== NULL) {
        echo $task->getUser()->getFirstName() . ' ';
        echo $task->getUser()->getLastName() . ' ';
        echo $task->getUser()->getEmail();
    } else if ($idAdmin == $_SESSION['id']) {
?>
        <form class="list_task" method="POST" action='index.php?page=<?php echo $_GET['page'] . "&idproject=" . $project->getId() . "&updatetask=" . $task->getId(); ?>' id="selectuser<?php echo $task->getID(); ?>">
            <input name='assignuser' type='submit' value='Assign a user to this task'>
        </form>
        <select name="users_list" form="selectuser<?php echo $task->getID(); ?>">
            <option value="">Select user</option>
            <?php
            foreach ($users as $user) {
                echo '<option value="' . $user->getEmail() . '">' . $user->getEmail() . '</option>';
            }

            ?>
        </select>
<?php
    }
    if ($idAdmin == $_SESSION['id']) {
        echo "<a class=\"list_task\" href='index.php?page=" . $_GET['page'] . "&idproject=" . $project->getId() . "&delete=" . $task->getId() . "'>Delete</a> ";
        echo "<a class=\"list_task\" href='index.php?page=" . $_GET['page'] . "&update=" . $task->getId() . "'>Modify</a><br>";
    }
    
}

if ($idAdmin == $_SESSION['id']) {
    echo "<a class=\"list_task\" href='index.php?page=" . $_GET['page'] . "&idproject=" . $project->getId() . "&insert=1'>Add new task</a>";
}


?>

<h3>User list</h3>

<?php
if (isset($message)) {
    echo '<div>' . $message . '</div>';
}
?>
<ul class='list_task'>
    <?php
    foreach ($users as $user) {
        echo "<li>" . $user->getFirstName() . $user->getLastName() . $user->getEmail() . "</li>";
    }
    if ($idAdmin == $_SESSION['id']) :
    ?>
        <form class="addUserToProject" method="POST" action="">
            <input name='email' type='email' placeholder='Enter an email'>
            <input name='adduser' type='submit' value='Add user to project'>
        </form>

        <a href='index.php?page=displayuser&insert=1'>Create User</a>

    <?php
    endif;
    ?>
</ul>