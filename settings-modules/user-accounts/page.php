<script src="settings-modules/user-accounts/jquery.js" type="text/javascript"></script>

<div id="user-accounts-box">
 <div id="user-list-div">
    <?php
        require "settings-modules/user-accounts/functions.php";

        $users = list_users();
        foreach ($users as $user) {
	    echo "<a href=\"#\" class=\"user-accounts-select\">".$user[0]."</a>";
       }
    ?>
    <a href="#" class="user-accounts-select">New User</a>
 </div>
 <div id="user-settings-div">
  <table>
    <tr>
      <td>Username:</td>
      <td><input type="text" id="username" /></td>
    </tr>
    <tr>
      <td>Admin's Password:</td>
      <td><input type="password" id="admin-password" /></td>
    </tr>
    <tr>
      <td>New Password:</td>
      <td><input type="password" id="new-password" /></td>
    </tr>
    <tr>
      <td>Retype Password:</td>
      <td><input type="password" id="re-password" /></td>
    </tr>
    <tr>
      <td>Account type:</td>
      <td><select id="account-type"><option>Regular</option><option>Admin</option></select></td>
    <tr>
      <td />
      <td><input type="submit" id="submit"value="Submit" /></td>
    </tr>
  </table>
 </div>
</div>

