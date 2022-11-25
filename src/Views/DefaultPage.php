<?php
if ($connected !== true): ?>
<form method='POST' action=''>
    <input name='user' type='text' placeholder='Your email'>
    <input name='pwd' type='password' placeholder="Your password">
    <input type='submit' name='submit' value='Sign in'>
</form>
<?php endif;
