<?php

    echo "<h1>User Search Page</h1>";
    if($_GET["actor"]) {
        $db = new mysqli('localhost', 'cs143', '', 'class_db');
        $actor = explode(" ",$_GET["actor"]);
        if ($db->connect_errno > 0) { 
            die('Unable to connect to database [' . $db->connect_error . ']'); 
        }
        $words = count($actor);
        if($words==1) {
            $query1 = "SELECT first, last, id FROM Actor WHERE LOWER(first) LIKE LOWER('%$actor[0]%') OR LOWER(last) LIKE LOWER('%$actor[0]%')";
            $rs = $db->query($query1);
            if(!$rs) {
                $errmsg = $db->error;
                print "Query failed: $errmsg <br>";
                exit(1);
            }

            echo "<h2>Results: </h2><br>";

            while ($row = $rs->fetch_assoc()) { 
                $name = $row['first'] . " " . $row['last']; 
                $id = $row['id'];
                echo "<a href=./actor.php?id=$id>$name</a><br>";
            }

            exit();

        } else {

            $query1 = "SELECT first, last, id FROM Actor WHERE (LOWER(first) LIKE LOWER('%$actor[0]%') OR LOWER(last) LIKE LOWER('%$actor[0]%'))";

            for($i = 1; $i < count($actor); $i++) {
                if(!empty($actor[$i])) {
                    $query1 .= " AND (LOWER(first) LIKE LOWER('%$actor[$i]%') OR LOWER(last) LIKE LOWER('%$actor[$i]%'))";
                }
            }
            $rs = $db->query($query1);

            echo "<h2>Results: </h2><br>";

            while ($row = $rs->fetch_assoc()) { 
                $name = $row['first'] . " " . $row['last']; 
                $id = $row['id'];
                echo "<a href=./actor.php?id=$id>$name</a><br>";
            }

            exit(); 
        }

    } else if($_GET["movie"]) {

        $movie = explode(" ",$_GET["movie"]);
        $db = new mysqli('localhost', 'cs143', '', 'class_db');
        if ($db->connect_errno > 0) { 
            die('Unable to connect to database [' . $db->connect_error . ']'); 
        }
        $words = count($actor);
        if($words==1) {
            $query1 = "SELECT id, title FROM Movie WHERE LOWER(title) LIKE LOWER('%$movie[0]%')";
            $rs = $db->query($query1);
            if(!$rs) {
                $errmsg = $db->error;
                print "Query failed: $errmsg <br>";
                exit(1);
            }

            echo "<h2>Results: </h2><br>";

            while ($row = $rs->fetch_assoc()) { 
                $id = $row['id'];
                $title = $row['title'];
                echo "<a href=./movie.php?id=$id>$title</a><br>";
            }

            exit();

        } else {

            $query1 = "SELECT id, title FROM Movie WHERE (LOWER(title) LIKE LOWER('%$movie[0]%'))";

            for($i = 1; $i < count($movie); $i++) {
                if(!empty($movie[$i])) {
                    $query1 .= " AND (LOWER(title) LIKE LOWER('%$movie[$i]%'))";
                }
            }
            $rs = $db->query($query1);

            echo "<h2>Results: </h2><br>";

            while ($row = $rs->fetch_assoc()) { 
                $id = $row['id'];
                $title = $row['title'];
                echo "<a href=./movie.php?id=$id>$title</a><br>";
            }

            exit();
        }

    }

    if($_POST["actor"]) {
        $db = new mysqli('localhost', 'cs143', '', 'class_db');
        $actor = explode(" ",$_POST["actor"]);
        if ($db->connect_errno > 0) { 
            die('Unable to connect to database [' . $db->connect_error . ']'); 
        }
        $words = count($actor);
        if($words==1) {
            $query1 = "SELECT first, last, id FROM Actor WHERE LOWER(first) LIKE LOWER('%$actor[0]%') OR LOWER(last) LIKE LOWER('%$actor[0]%')";
            $rs = $db->query($query1);
            if(!$rs) {
                $errmsg = $db->error;
                print "Query failed: $errmsg <br>";
                exit(1);
            }

            echo "<h2>Results: </h2><br>";

            while ($row = $rs->fetch_assoc()) { 
                $name = $row['first'] . " " . $row['last']; 
                $id = $row['id'];
                echo "<a href=./actor.php?id=$id>$name</a><br>";
            }
        } else {

            $query1 = "SELECT first, last, id FROM Actor WHERE (LOWER(first) LIKE LOWER('%$actor[0]%') OR LOWER(last) LIKE LOWER('%$actor[0]%'))";

            for($i = 1; $i < count($actor); $i++) {
                if(!empty($actor[$i])) {
                    $query1 .= " AND (LOWER(first) LIKE LOWER('%$actor[$i]%') OR LOWER(last) LIKE LOWER('%$actor[$i]%'))";
                }
            }
            $rs = $db->query($query1);

            echo "<h2>Results: </h2><br>";

            while ($row = $rs->fetch_assoc()) { 
                $name = $row['first'] . " " . $row['last']; 
                $id = $row['id'];
                echo "<a href=./actor.php?id=$id>$name</a><br>";
            }

        }

    } else if($_POST["movie"]) {
        $movie = explode(" ",$_POST["movie"]);
        $db = new mysqli('localhost', 'cs143', '', 'class_db');
        if ($db->connect_errno > 0) { 
            die('Unable to connect to database [' . $db->connect_error . ']'); 
        }
        $words = count($movie);
        if($words==1) {
            $query1 = "SELECT id, title FROM Movie WHERE LOWER(title) LIKE LOWER('%$movie[0]%')";
            $rs = $db->query($query1);
            if(!$rs) {
                $errmsg = $db->error;
                print "Query failed: $errmsg <br>";
                exit(1);
            }

            echo "<h2>Results: </h2><br>";

            while ($row = $rs->fetch_assoc()) { 
                $id = $row['id'];
                $title = $row['title'];
                echo "<a href=./movie.php?id=$id>$title</a><br>";
            }
        } else {

            $query1 = "SELECT id, title FROM Movie WHERE (LOWER(title) LIKE LOWER('%$movie[0]%'))";

            for($i = 1; $i < count($movie); $i++) {
                if(!empty($movie[$i])) {
                    $query1 .= " AND (LOWER(title) LIKE LOWER('%$movie[$i]%'))";
                }
            }
            $rs = $db->query($query1);

            echo "<h2>Results: </h2><br>";

            while ($row = $rs->fetch_assoc()) { 
                $id = $row['id'];
                $title = $row['title'];
                echo "<a href=./movie.php?id=$id>$title</a><br>";
            }

        }

    }


?>
<html>
    <body>
        <form action = "<?php $_PHO_SELF ?>" method = "POST">
        <br>
        Actor Search: <input type = "text" name = "actor" /><br>
        <input type = "submit" /><br><br>
        Movie Search: <input type = "text" name = "movie" /><br>
       <input type = "submit" />
       </form>
    </body>
</html> 