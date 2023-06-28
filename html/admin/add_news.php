<?php

if(isset($_POST["small_text"]) && isset($_POST["full_text"])) {
        $small_text = mysqli_real_escape_string($_POST["small_text"]);
        $full_text = mysqli_real_escape_string($_POST["full_text"]);
        mysqli_query("INSERT INTO `news` (`small_text`, `full_text`) VALUES ('{$small_text}', '{$full_text}');");
}

echo("<div class=\"content\" align=\"center\"><form action=\"index.php?action=add_news\" method=\"post\"><textarea name=\"small_text\">Small text</textarea><br><textarea name=\"full_text\">Full text</textarea><br><input type=\"submit\" value=\"Add\" class=\"button\"></form></div>");

?>
