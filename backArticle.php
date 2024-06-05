<?php
require_once("../topicsall.connect.php");
$id = $_GET["id"];
$sql="UPDATE articles SET valid = 1 WHERE articles.id ='$id'";
$result = $conn->query($sql);





header("location: Articles.php");
?>