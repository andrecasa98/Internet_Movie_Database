<?php
    echo "<h1>Actor Information Page</h1>";
    $actor_id = $_GET["id"];
    if($actor_id) {
        $db = new mysqli('localhost', 'cs143', '', 'class_db');
        if ($db->connect_errno > 0) { 
            die('Unable to connect to database [' . $db->connect_error . ']'); 
        }

        //Retrieve actor information
        $query1 = "SELECT first, last, sex, dob, dod FROM Actor as A WHERE A.id = '$actor_id'";

        $rs = $db->query($query1);
        if(!$rs) {
            $errmsg = $db->error;
            print "Query failed: $errmsg <br>";
            exit(1);
        }

        while ($row = $rs->fetch_assoc()) { 
        $name = $row['first'] . " " . $row['last']; 
        $sex= $row['sex']; 
        $dob= $row['dob']; 
        if($row['dod']==NULL) {
            $dod = "still alive";
        } else {
            $dod = $row['dod'];
        }
      

        print "Name : $name <br>
        Sex : $sex <br>
        Date of birth: $dob <br>
        Date of death: $dod <br>"; 
        }

        //Retrive movies where the actor was in
        $query2 = "SELECT MA.role, M.title, mid FROM MovieActor AS MA, Movie AS M WHERE MA.aid = '$actor_id' AND MA.mid = M.id";

        $rs2 = $db->query($query2);
        if(!$rs2) {
            $errmsg = $db->error;
            print "Query failed: $errmsg <br>";
            exit(1);
        }

        echo "<h2>Movies</h2>";

        echo "<table border = '1'>
        <tr>
        <th> Movie title</th>
        <th> Role</th>
        </tr>";
      
        while ($row = $rs2->fetch_assoc()) { 
        $title = $row['title'];
        $role = $row['role'];
        $mid = $row['mid'];

        echo "<tr>";
        echo "<td>" . "<a href=./movie.php?id=$mid>$title</a>" . "</td <br>";
        echo "<td>" . $role . "</td>";
        echo "</td>";
        }

        echo "</table>";
  
        exit();

}

?>
<html>
    <body>
        <form action = "<?php $_PHO_SELF ?>" method = "GET">
        First: <input type = "text" name = "first" />
        Last: <input type = "text" name = "last" />
        Sex: <input type = "text" name = "sex" />
        Date of birth: <input type = "text" name = "dob" />
        Date of death: <input type = "text" name = "dod" />
        Title : <input type = "text" name = "title" />
        Role : <input type = "text" name = "role" />
       <input type = "submit" />
       </form>
    </body>
</html> 