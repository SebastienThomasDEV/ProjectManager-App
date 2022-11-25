<?php
if ($connected !== true): ?>
<form method='POST' action=''>
    <input name='user' type='text' placeholder='Votre email'>
    <input name='pwd' type='password' placeholder="Votre mot de passe">
    <input type='submit' name='submit' value='Se connecter'>
</form>
<?php endif;
