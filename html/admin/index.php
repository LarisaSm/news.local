<?php

include("../config.php");
$db_link = mysqli_connect($db["host"], $db["user"], $db["pass"]);
mysqli_select_db($db["name"], $db_link);

$error = "";

if(isset($_GET["action"])) {
    if($_GET["action"] == "logout") {
            setcookie("login", "1");
            setcookie("hash", "1");
            header("Location: index.php");
    }
}

if(isset($_POST["login"]) && isset($_POST["password"])) {
    $login = mysqli_real_escape_string($_POST["login"]);
    $password = $_POST["password"];
    $result = mysqli_query("SELECT `login`, `password` FROM `users` WHERE `login` = '{$login}'");
    $row = mysqli_fetch_assoc($result);
    if(!empty($row)) {
        if($password == $row["password"]) {
            setcookie("login", $row["login"], 0, "/", "", false, false);
            setcookie("hash", md5($row["password"]), 0, "/");
            header("Location: index.php");
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Incorrect login!";
    }
}

?>

<html>
<head>
    <title>vuln-web-01</title>
    <style type="text/css">
        textarea {
            width: 600px;
            height: 200px;
            resize: none;
            background: #CEF6D8;
            border: solid 1px black;
        }
        .button {
            width: 600px;
            background: #CEF6D8;
            border: solid 1px black;
        }
        .input {
            width: 100px;
            background: #CEF6D8;
            border: solid 1px black;
        }
        .content {
            width: 700px;
            background: #E6E6E6;
            margin: auto;
            border: solid 1px black;
        }
    </style>
</head>
<body bgcolor="#CEE3F6">

<?php

$auth = false;

if(isset($_COOKIE["login"]) && isset($_COOKIE["hash"])) {
    $login = mysqli_real_escape_string($_COOKIE["login"]);
    $hash = $_COOKIE["hash"];
    $result = mysqli_query("SELECT `login`, `password` FROM `users` WHERE `login` = '{$login}'");
    $row = mysqli_fetch_assoc($result);
    if($hash == md5($row["password"])) {
        $auth = true;
    }
}

// отображаем сообщение об ошибке
if(!empty($error)) {
    echo("<div class=\"content\"><b>{$error}</b></div><br>");
}

// отображаем форму ввода логина/пароля если аутентификация не пройдена
if(!$auth) {
    echo("<div class=\"content\"><form action=\"index.php\" method=\"post\"><b>Login:</b> <input type=\"text\" name=\"login\" class=\"input\"><br><br><b>Password:</b> <input type=\"password\" name=\"password\" class=\"input\"><br><br>&nbsp;<input type=\"submit\" value=\"Enter\" class=\"button\"></form>");
    echo("</div></body></html>");
    die();
}

echo("<div class=\"content\"><a href=\"../\">Back to site</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?action=add_news\">Add news</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?action=change_password\">Change Password</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?action=logout\">Logout</a></div><br>");

if(isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add_news":
            include("add_news.php");
            break;
        case "change_password":
            include("change_password.inc");
            break;
    }
}

?>

</body>
</html>

<?php

mysqli_close($db_link);

?>