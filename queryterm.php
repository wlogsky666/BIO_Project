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

?>
<!DOCTYPE html>
<html>
<head>
    <title>Single Term</title>
    <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">
    <script type="text/javascript" src="fancybox/lib/jquery-1.10.1.min.js"></script>
        <!-- Add mousewheel plugin (this is optional) -->
        <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <!-- Add fancyBox main JS and CSS files -->
        <script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
        <link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
        <!-- Add Button helper (this is optional) -->
        <link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
        <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <!-- Add Thumbnail helper (this is optional) -->
        <link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
        <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <!-- Add Media helper (this is optional) -->
        <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
</head>
<body>
	<ul class="list-group">
    <?php
		$headling = $_GET['mh'];
		$sql = "SELECT * FROM meshheadling WHERE mh='" . $headling . "';";

		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
	?>
		<li class="list-group-item"><h4 style="display: inline-block;"><span class="label label-default">Unique ID</span></h4><?="\t" . $row["ui"]?></li>
		<li class="list-group-item"><h4 style="display: inline-block;"><span class="label label-default">Headling</span></h4><?="\t" . $row["mh"]?></li>
		<li class="list-group-item"><h4 style="display: inline-block;"><span class="label label-default">Definition</span></h4><?="\t" . $row["ms"]?></li>
	
	<?php
		} else {
			echo "0 results";
		}

		mysqli_close($conn);
    ?>
	</ul>
	<script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
</body>
</html>
