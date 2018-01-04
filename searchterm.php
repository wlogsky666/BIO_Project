<!DOCTYPE html>
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
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>MeSH Term Query</title>
    <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="dist/css/sticky-footer-navbar.css">
    <!-- Add jQuery library -->
    <script type="text/javascript" src="fancybox/lib/jquery-1.10.1.min.js"></script>
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <script type="text/javascript">
        // fancybox
        $('.named_entity').fancybox({
                type : 'iframe',
                padding : 5
        });
    </script>
</head>
<body role="document">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="https://meshb.nlm.nih.gov/search">NTNU MeSH Browser</a>
                <span>&nbsp&nbsp&nbsp</span>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="hierarchy.php">MeSH Hierarchy</a></li>
                    <li class="active"><a href="searchterm.php">MeSH Term Query</a></li>
                    <li><a href="mapping.php">MeSH on Demand</a></li>
                </ul>
            </div>
            
        </div>
                
    </nav>
    <div class="container" role="main">
        <div class="jumbotron">
            <h1>MeSH Term Query</h1>
            <h2>Search What You Want.</h2>
        </div>
        <div class="jumbotron">
            <form style="text-align: center;" action="searchterm.php" method="get" name="search" onsubmit="return validateForm()">
                <div class="form-group">
                    <input class="form-control" type="text" name="query">
                    <input type="hidden" name="action" value="submit">
                </div>
                <button class="btn btn-lg btn-primary" type="submit">Submit</button>
            </form>
        </div>
        <?php
        if(isset($_GET['action'])) {
            $query = $_GET['query'];

            $sql2 = "SELECT * FROM meshheadling natural join meshtree WHERE mh = \"$query\"";

            $result = mysqli_query($conn, $sql2) or die("Error Message:".mysql_error( ));

            
            echo "<h1>Exact Match</h1>";
            if (mysqli_num_rows($result) > 0) {
                $row1 = mysqli_fetch_assoc($result);
                
                echo "<table class='table table-striped'>";
                echo "<tr><th>MeSH_Heading</th><td>" . $row1["mh"] . "</td></tr>";
                echo "<tr><th>Scope Note</th><td>" . $row1["ms"] . "</td></tr>";
                echo "<tr><th>Unique ID</th><td>" . $row1["ui"] . "</td></tr>";
                $tree = preg_split('//', $row1["mn"], -1, PREG_SPLIT_NO_EMPTY);
                echo "<tr><th>Tree Number</th><td>";
                $length = strlen($row1["mn"]);
                for($j=0; $j<$length; $j+=1) 
                {
                    if($j!=0 && $j % 3 == 0)
                        echo '.';
                    print $tree[$j];
                }
                //echo "</td></tr>";


                while($row1 = mysqli_fetch_assoc($result))
                {
                    $tree = preg_split('//', $row1["mn"], -1, PREG_SPLIT_NO_EMPTY);
                    //echo "<tr><th>Tree Number</th><td>" . $row1->mn . "</td></tr>";
                    //echo "<tr><th>Tree Number</th><td>";
                    echo "<br>";
                    $length = strlen($row1["mn"]);
                    for($j=0; $j<$length; $j+=1) 
                    {
                        if($j!=0 && $j % 3 == 0)
                            echo '.';
                        print $tree[$j];
                    }
                }
                echo "</td></tr></table>";
            } 
            else {
                echo "no exact match.";
            }
            





            echo "<h1>Terms</h1>";
            $sql = "SELECT * FROM meshheadling WHERE mh LIKE \"%$query%\" OR ms LIKE \"%$query%\"  order by ui";

            $result_list = mysqli_query($conn, $sql) or die("Error Message:".mysql_error( ));

            echo "<table class='table table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>#</th>";
            echo "<th>Unique_ID</th>";
            echo "<th>MeSH_Heading</th>";
            echo "<th>Scope Note</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            if (mysqli_num_rows($result_list) > 0) {
                $i = 0;
                while ($row = mysqli_fetch_assoc($result_list)) {
                    $i+=1;
                    echo "<tr><td>" . $i . "</td>";
                    echo "<td>" . $row["ui"] . "</td><td>" . $row["mh"] . "</td><td>" . $row["ms"] . "</td>";
                    echo "</tr>";
                }

            } else {
                echo "<td colspan=\"5\">0 results</td>";
            }
            echo "</tbody>";
            echo "</table>";
        }

        mysqli_close($conn);
        ?>
    </div>
    <footer class="footer">
        <div class="container" style="text-align: center">
            <p class="text-muted">
            Copyright 2017-2018 &copy; NTNU CSIE BIOINFORMATICS
            </p>
        </div>
    </footer>

    <script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    function validateForm() {
        var x = document.forms["search"]["query"].value;
        if (x == "") {
            return false;
        }
    }
    </script>
</body>
</html>
