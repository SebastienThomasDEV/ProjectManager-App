<?php

    echo '<h2>' . $pageTitle . '</h2>';
    if (isset($message)) {
        echo '<div>' . $message . '</div>';
    }
    ?>

<form method='POST' action='index.php?page=<?php echo $_GET['page'].$action; ?>'>
<div class="newUserAccount">
    <?php
        if (isset($_GET['update']) || isset($_GET['insert']) ):
    ?>
    <input name='firstname' type='text' placeholder='First name' value="<?php echo isset($firstName) ? $firstName: ''; ?>">
    <input name='lastname' type='text' placeholder='Last name'value="<?php echo isset($lastName) ? $lastName: ''; ?>">
    <input name='email' type='text' placeholder='Email' value="<?php echo isset($email) ? $email: ''; ?>">
    <?php
        endif; 
        if (isset($_GET['updatepwd'])):
    ?>
    <input name='oldpwd' type='password' placeholder="Current password" >
    <?php
        endif; 
        if (isset($_GET['updatepwd'])|| isset($_GET['insert'])):
    ?>
    <input name='pwd' type='password' placeholder="New password" >
    <input name='pwdconfirm' type='password' placeholder="Confirm new password">
    <?php
        endif; 
    ?>
</div>
<div class="newUserAccountSubmitButton">
    <input type='submit' name='submit' value='<?php echo $submit; ?>'>
</div>
</form>



