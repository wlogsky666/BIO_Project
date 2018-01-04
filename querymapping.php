<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * from meshheadling ORDER BY CHAR_LENGTH(mh) DESC";

$headling = array();
$definition = array();
$id = array();

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($headling, " ".$row["mh"]);
        array_push($definition, $row["ms"]);
        array_push($id, $row["ui"]);
    }
}


// Get parse from request
$phrase = $_REQUEST["s"];
$link = array();

for ($i = 0; $i < count($headling); $i++) {
        $link[$i] = "<a class=\"named_entity\" href='queryterm.php?mh=".substr($headling[$i],1)."'>".$headling[$i]."</a>";
}

$parsephrase = str_ireplace($headling, $id, $phrase);
$new_phrase = str_ireplace($id, $link, $parsephrase);

echo $new_phrase;

?>


