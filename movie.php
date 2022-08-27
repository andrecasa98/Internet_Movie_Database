<?php
    echo "<h1>Movie Information Page</h1>";
    $movie_id = $_GET["id"];
    if($movie_id) {
        $db = new mysqli('localhost', 'cs143', '', 'class_db');
        if ($db->connect_errno > 0) { 
            die('Unable to connect to database [' . $db->connect_error . ']'); 
        }

        //Retrieve movie information: title, year, company, rating, genre
        $query1 = "SELECT title, year, rating, company FROM Movie AS M WHERE M.id = '$movie_id'";
        $query2 = "SELECT genre FROM MovieGenre AS MG WHERE MG.mid = '$movie_id'"; 

        $rs1 = $db->query($query1);
        $rs2 = $db->query($query2);
        if(!$rs1 OR !$rs2) {
            $errmsg = $db->error;
            print "Query failed: $errmsg <br>";
            exit(1);
        }

        while ($row = $rs1->fetch_assoc()) { 
            $title = $row['title']; 
            $year= $row['year'];
            $rating= $row['rating']; 
            $company= $row['company']; 
      

            print "Title : $title <br>
            Year of production : $year <br>
            Produced by: $company <br>
            MPAA Rating : $rating <br>"; 
        }

        print "Genre: ";

        while ($row = $rs2->fetch_assoc()) {
            $genre = $row['genre'];
            print "$genre ";
        }
        print"<br>";


        //Hyperlinks to the actor pages in tables
        $query3 = "SELECT aid, first, last, role FROM MovieActor, Actor WHERE mid='$movie_id' AND aid=id";

        $rs3 = $db->query($query3);
        if(!$rs3) {
            $errmsg = $db->error;
            print "Query failed: $errmsg <br>";
            exit(1);
        }

        echo "<table border = '1'>
        <tr>
        <th> Name</th>
        <th> Role</th>
        </tr>";

        echo "<h2>Actors involved</h2>";

         while ($row = $rs3->fetch_assoc()) { 
            $actor = $row['first'] ." ". $row['last'];
            $aid = $row['aid'];
            $role = $row['role'];

            echo "<tr>";
            echo "<td>" . "<a href=./actor.php?id=$aid>$actor</a>" . "</td <br>";
            echo "<td>" . $role . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        //Retrieve the average score based on user feedback 
        $query4 = "SELECT COUNT(*) AS count, AVG(rating) AS average_rating FROM Review WHERE mid='$movie_id'";
        $rs4 = $db->query($query4);
        if(!$rs4) {
            $errmsg = $db->error;
            print "Query failed: $errmsg <br>";
           exit(1);
        }

        echo "<h2>User review</h2>";

        while ($row = $rs4->fetch_assoc()) {  
           if($row['count']==0) {
               print "The movie hasn't been reviewed yet! <br>";
               echo "<a href=./review.php?id=$movie_id>Review it here</a>";
               echo "<h2>User Comments</h2>";
               print "There are no comments!";

           } else {
              $average_rating = $row['average_rating'];
              $count = $row['count'];
               print "This movie has an average user rating of $average_rating / 5 based on $count people's reviews <br>";
               echo "<a href=./review.php?id=$movie_id>Review it here</a>";

               //Retrieve user comments
               $query5 = "SELECT name, time, rating AS user_rating, comment FROM Review WHERE mid='$movie_id'";
               $rs5 = $db->query($query5);
               if(!$rs5) {
                    $errmsg = $db->error;
                    print "Query failed: $errmsg <br>";
                    exit(1);
                }

                echo "<h2>User comments</h2>";

                while ($row = $rs5->fetch_assoc()) {  
                    $name = $row['name'];
                    $time = $row['time'];
                    $user_rating = $row['rating'];
                    $comment = $row['comment'];

                    print "$name rated this movie $user_rating at $time <br>
                    Comment: <br>
                    $comment <br><br>";
                }


            }

        }

        exit();

        

    }

?>
<html>
    <body>
        <form action = "<?php $_PHO_SELF ?>" method = "GET">
        Title: <input type = "text" name = "title" />
        Year: <input type = "text" name = "year" />
        Rating: <input type = "text" name = "rating" />
        Company: <input type = "text" name = "company" />
        Genre: <input type = "text" name = "genre" />
        Actor: <input type = "text" name = "actor" />
        Role: <input type = "text" name = "role" />
        Average Rating: <input type = "text" name = "average_rating" />
        Count: <input type = "text" name = "count" />
        MID: <input type = "text" name = "movie_id" />
        Name: <input type = "text" name = "name" />
        Time: <input type = "text" name = "time" />
        User Rating: <input type = "text" name = "user_rating" />
        Comment: <input type = "text" name = "comment" />
       <input type = "submit" />
       </form>
    </body>
</html> 