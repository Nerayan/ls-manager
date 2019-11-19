<?php
require_once "common.php";
require_once "set.php";
//echo '<br>auth.php file...'.$ACC->comm;
//echo '<br>auth.php file...'.$ACC->checkS();
//if (isAuth($pdo))
if ($ACC->checkS())
{
?>
    <input type="hidden"  name="logout" value="go" required>
    <input type="button" value="Logout" onClick="getXmlHttp(this.form, 'logForm', 'auth.php');">
<?php
}else{
?>
    <input type="email"  name="usermail" placeholder="you@mail.com" required>
    <input type="password" name="passwd" placeholder="password"     required>
    <input type="button" value="Login" onClick="getXmlHttp(this.form, 'logForm', 'auth.php');">
<?php
}
?>
