<div id="login-div">
Login to SSC Attendance System
<form id="login-form" method="post" action="?p=check-login<?php if ($_GET["redirect"]) echo "&redirect=".$_GET["redirect"] ?>">
  <table>
    <tr>
      <td>Username:</td>
      <td><input type="text" name="username" id="username" /></td>
    </tr>
    <tr>
      <td>Password:</td>
      <td><input type="password" name="password" id="password" /></td>
    </tr>
    <tr>
      <td />
      <td><input type="submit" value="Login" /></td>
    </tr>
  </table>
</form>

<?php
if ($_GET["fail"]) {
    echo "Login failed";
}
?>

</div>