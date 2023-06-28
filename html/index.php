<?php

include("config.php");

$db_link = mysqli_connect('mysql', 'root', 'root', 'newsdb');
if (!$db_link) {
    die('ошибка соединения: ' . mysqli_connect_error());
}
mysqli_query($db_link, "SET NAMES utf8");


if (session_id() == '') {
    session_start();
}

if(isset($_GET["action"])) {
    if($_GET["action"] == "logout") {
        setcookie("login", "");
        header("Location: index.php");
    }
}

if(isset($_POST["login"]) && isset($_POST["password"])) {
    $login = mysqli_real_escape_string($db_link,$_POST["login"]);
    $password = $_POST["password"];
    $result = mysqli_query($db_link,"SELECT `login`, `password` FROM `users` WHERE `login` = '{$login}'");
    $row = mysqli_fetch_assoc($result);
    if(!empty($row)) {
        if($password == $row["password"]) {
            setcookie("login", $row["login"]);
            $_SESSION["auth"]=true;
            header("Location: index.php");
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Incorrect login!";
    }
}

if(isset($_GET["remove"])) {
    $id = $_GET["remove"];
    if ($_COOKIE["login"] == "admin") {
        $result = mysqli_query($db_link,"SELECT * FROM `news` WHERE `id` = {$id}");
    } else {
        $result = mysqli_query($db_link,"SELECT * FROM `news` WHERE `id` = {$id} and `author` = '{$_COOKIE['login']}'");
    }
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $result = mysqli_query($db_link,"DELETE FROM `comments` WHERE `news_id` = {$id}");
        $error = "Comments cleared.";
    } else {
        $error = "This article doesn't belong to you.";
    }
}

?>

<html>
<head>
    <title>Positive News</title>
    <style type="text/css">
        textarea {
            width: 100%;
            height: 200px;
            resize: none;
            background: #CEF6D8;
            border: solid 1px black;
        }
		input {
			float: right;
			background: #CEF6D8;
			border: solid 1px black;
		}
		.button {
			width: 100%;
			margin: auto;
		}
        .error {
            width: 700px;
			padding: 5px;
            background: #E6E6E6;
            margin: auto;
            border: solid 1px black;
			color: red;
        }
        .input {
			float: left;
			width: 100%;
        }
        .logo {
            width: 700px;
            background: #E6E6E6;
            margin: auto;
			padding: 5px;
            border: solid 1px black;
        }
        .news {
            padding: 5px;
			width: 700px;
            background: #E6E6E6;
            margin: auto;
            border: solid 1px black;
        }
        .comment {
            width: 700px;
			padding: 5px;
            background: #E6E6E6;
            margin: auto;
            border: solid 1px black;
        }
		.content {
			padding: 5px;
			width: 300px;
			background: #E6E6E6;
			border: solid 1px black;
			float: right;
			top: 0px;
		}
		.test {
			
		}
    </style>
</head>
<body bgcolor="#CEE3F6">

<?php

$auth = false;

if(isset($_COOKIE["login"])&&($_COOKIE["login"])) {
        $auth = true;
}

// отображаем форму ввода логина/пароля если аутентификация не пройдена
if(!$auth) {
    echo("<div class=\"content\"><form action=\"index.php\" method=\"post\"><div class=\"input\">Login:<input type=\"text\" name=\"login\" ></div><div class=\"input\">Password:<input type=\"password\" name=\"password\"></div><br><input type=\"submit\" value=\"Enter\" class=\"button\"></form>");
    echo("</div>");
} else {
    echo("<div class=\"content\">");
	echo("logged in as <b>");
	echo($_COOKIE["login"]);
	echo("</b><br>");
    echo("<a href=\"index.php?action=add_news\">Add news</a>&nbsp;&nbsp;&nbsp;");
    echo("<a href=\"index.php?action=change_password\">Change Password</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?action=logout\">Logout</a></div><br>");
}

// шапка
echo('<div class="logo"><h1>Positive News</h1></div><br>');

// отображаем сообщение об ошибке
if(!empty($error)) {
    echo("<div class=\"error\"><b>{$error}</b></div>");
}

if(isset($_GET["action"])) {
    switch ($_GET["action"]) {
            case "add_news":
                if(isset($_POST["small_text"]) && isset($_POST["full_text"])) {
                        $small_text = mysqli_real_escape_string($db_link,$_POST["small_text"]);
                        $full_text = mysqli_real_escape_string($db_link,$_POST["full_text"]);
                        mysqli_query($db_link,"INSERT INTO `news` (`small_text`, `full_text`) VALUES ('{$small_text}', '{$full_text}');");
                }
                echo("<div class=\"content\" align=\"center\"><form action=\"index.php?action=add_news\" method=\"post\"><textarea name=\"small_text\">Small text</textarea><br><textarea name=\"full_text\">Full text</textarea><br><input type=\"submit\" value=\"Add\" class=\"button\"></form></div>");
                break;
            case "change_password":
                if(isset($_POST["password"]) && isset($_POST["password2"])) {
                    if($_POST["password"] == $_POST["password2"]) {
                            $new_password = $_POST["password"];
                            $new_hash = md5($_POST["password"]);
                            mysqli_query($db_link,"UPDATE `users` SET password = '{$new_password}' WHERE `login` = '{$_COOKIE["login"]}';");
                        }
                }
                echo("<div class=\"content\" align=\"center\"><form action=\"index.php?action=change_password\" method=\"post\">New password: <input type=\"text\" name=\"password\" class=\"input\"><br>Repeat: <input type=\"text\" name=\"password2\" class=\"input\"><br><input type=\"submit\" value=\"Add\" class=\"button\"></form></div>");
                break;
        }
}

echo("</div><br>");


if(isset($_GET["news_id"])or isset($id)) {
    // выводится новость c id = news_id
    if (!(isset ($id))) $id = $_GET["news_id"];
    $result = mysqli_query($db_link,"SELECT * FROM `news` WHERE `id` = {$id}");
    $row = mysqli_fetch_assoc($result);
    echo("<div class=\"news\"><a href=\"index.php\"><b>Back</b></a><br><br>{$row["full_text"]}<br><br>&nbsp;&nbsp;<a href=\"index.php?remove={$row["id"]}\" style=\"color:red\"><b>Clear comments</b></a></div><br>");

    // выводится форма добавления комментария
    echo("<div class=\"comment\" align=\"left\"><b>Add comment</b><br><form action=\"index.php?news_id={$id}\" method=\"post\">Name: <input type=\"text\" name=\"name\" class=\"input\"><br>Comment:<br><textarea name=\"comment\"></textarea><br><input type=\"submit\" value=\"Add\" class=\"button\"></form></div><br>");

    // добавление нового комментария
    if(isset($_POST["comment"]) && isset($_POST["name"])) {
        $comment = mysqli_real_escape_string($db_link,$_POST["comment"]);
        $name = mysqli_real_escape_string($db_link,$_POST["name"]);
        mysqli_query($db_link,"INSERT INTO `comments` (`news_id`, `comment`, `name`) VALUES ('{$id}', '{$comment}', '{$name}');");
    }
    
    // выводятся комментарии к выбранной новости
    $result = mysqli_query($db_link,"SELECT * FROM `comments` WHERE `news_id` = '{$id}';");
    while($row = mysqli_fetch_assoc($result)) {
        echo("<div class=\"comment\">{$row["comment"]}<br><div align=\"right\">by <b>{$row["name"]}</b></div></div><br>");
    }
} else {
    // выводится список новостей
    $result = mysqli_query($db_link,"SELECT * FROM `news`;");
    while($row = mysqli_fetch_assoc($result)) {
        echo("<div class=\"news\">{$row["small_text"]} ...<br><p><i>Author: {$row["author"]}</i></p><a href=\"index.php?news_id={$row["id"]}\"><b>Read more</b></a></div><br>");
    }
}

?>

</body>
</html>

<?php

mysqli_close($db_link);

?>
