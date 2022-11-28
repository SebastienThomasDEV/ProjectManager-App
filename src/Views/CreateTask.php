<form method="POST" action='index.php?page=<?php echo $_GET['page'] . "&idproject=" . $_GET['idproject'] . "&insert=1"; ?>'>
    <input name='title' type='text' placeholder='Add Task Name'>
    <input name='description' type='text' placeholder='Add Task Description'>
    <input name='priority' type='num' placeholder='Add Task Priority'>
    <input name='lifecycle' type='text' placeholder='Add Task Lifecycle'>
    <input name='idProject' type='text' value="<?php echo $_GET['idproject']; ?>" style="display:none">
    <input name='idUser' type='text' value="NULL" style="display:none">
    <input type='submit' name='create' value='<?php echo $submit; ?>'>
</form>