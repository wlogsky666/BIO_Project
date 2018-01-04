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
    <title>MeSH Hierarchy</title>
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
                    <li class="active"><a href="hierarchy.php">MeSH Hierarchy</a></li>
                    <li><a href="searchterm.php">MeSH Term Query</a></li>
                    <li><a href="mapping.php">MeSH on Demand</a></li>
                </ul>
            </div>
            
        </div>
                
    </nav>
    <div class="container" role="main">
        
        <div class="jumbotron">
            <h1>MeSH Hierarchy</h1>
            <h2>Display All Terms.</h2>
        </div>
        <div>
        <?php
              if(!isset($_GET['id']) || $_GET['id'] == ""){
                    $id = '';
                }
                else{
                    echo "<a class=\"btn btn-sm btn-primary\" href='hierarchy.php?id=''>Top</a>";
                    $id = $_GET['id'];
                    $upperid = "";
                    for($i = 0 ; $i < strlen($id)-3 ; ++$i)
                    {
                        $upperid = $upperid.$id[$i];
                    }
                    echo "&nbsp<a class=\"btn btn-sm btn-primary\" href='hierarchy.php?id=".$upperid."'>Up</a>";
                }
        ?>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mesh Number</th>
                    <th>Mesh Headings</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT mn, mh FROM `meshtree`;";

                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    if($id == '' && strlen($row["mn"]) == 3){
                        echo "<tr>";
                        echo "<td>" . $row["mn"] . "</td>";
                        echo "<td><a class=\"named_entity\" href='queryterm.php?mh=" . $row["mh"]."'>".$row["mh"]."</a></td>";
                        echo "<td><a class=\"btn btn-sm btn-primary \" href='hierarchy.php?id=" . $row["mn"] . "'>+</a></td>";
                        echo "</tr>";
                    }
                    else if($id != '')
                    {
                        if(strpos($row["mn"], $id) !== FALSE && strlen($row["mn"]) == strlen($id)+3)
                        {
                            $newmn = "";
                            $copy = $row["mn"];
                            $len = strlen($copy);
                            for ($i=0 ; $i<$len ; $i+=3)
                            {
                                $newmn = $newmn.substr($copy,0, 3);
                                if($i != $len-3)    $newmn = $newmn.".";
                                $copy = substr($copy,3);
                            }
                            echo "<tr>";
                            echo "<td>" . $newmn . "</td>";
                            echo "<td><a class=\"named_entity\"href='queryterm.php?mh=" . $row["mh"]."'>".$row["mh"]."</a></td>";
                            $sql2 = "SELECT mn, mh FROM `meshtree`;";
                            $result2 = mysqli_query($conn, $sql2);
                            $find = FALSE;
                            while($row2 = mysqli_fetch_assoc($result2))
                            {
                                if(strpos($row2["mn"], $row["mn"]) !== FALSE && strlen($row2["mn"]) == strlen( $row["mn"])+3)
                                {
                                     echo "<td><a class=\"btn btn-sm btn-primary \" href='hierarchy.php?id=" . $row["mn"] . "'>+</a></td>";
                                     $find = TRUE;
                                     break;
                                }
                            }                     
                            if($find == FALSE)
                            {
                                echo "<td></td>";
                            }      
                            echo "</tr>";
                        }
                    }
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>

    </div>
    <footer class="footer">
        <div class="container" style="text-align: center">
            <p class="text-muted">
             Copyright 2017-2018 &copy; NTNU CSIE BIOINFORMATICS
            </p>
        </div>
    </footer>
</body>
</html>
