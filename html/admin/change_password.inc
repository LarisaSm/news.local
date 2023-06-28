<?php

if(isset($_POST["password"]) && isset($_POST["password2"])) {
    if($_POST["password"] == $_POST["password2"]) {
        $new_password = $_POST["password"];
        $new_hash = md5($_POST["password"]);
        mysql_query("UPDATE `users` SET password = '{$new_password}' WHERE `login` = '{$_COOKIE["login"]}';");
    }
}

echo("<div class=\"content\" align=\"center\"><form action=\"index.php?action=change_password\" method=\"post\">New password: <input type=\"text\" name=\"password\" class=\"input\"><br>Repeat: <input type=\"text\" name=\"password2\" class=\"input\"><br><input type=\"submit\" value=\"Add\" class=\"button\"></form></div>");

?>