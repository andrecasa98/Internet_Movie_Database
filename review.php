
<html>
    <body>
        <form action = "<?php $_PHO_SELF ?>" method = "POST">

<?php
    
    //1 retrieve "id" from get
    //2 put id inside <form>
    //3 submit form
    //4 retrieve form data by $_POST, including id

    echo "<h1>User Review Page</h1>";
    $movie_id = $_GET["id"];

    if($movie_id) {
        $db = new mysqli('localhost', 'cs143', '', 'class_db');
        if ($db->connect_errno > 0) { 
            die('Unable to connect to database [' . $db->connect_error . ']'); 
        }

        $query1 = "SELECT title FROM Movie WHERE id='$movie_id'";
        $rs = $db->query($query1);
        if(!$rs) {
            $errmsg = $db->error;
            print "Query failed: $errmsg <br>";
            exit(1);
        }

        while ($row = $rs->fetch_assoc()) { 
            $title = $row['title'];
            echo "<h2>Movie selected: $title<h2>";
        }

        $_POST["mid"] = $movie_id;

        if($_GET["name"] AND $_GET["rating"] AND $_GET["comment"]) {
            $_POST["name"] = $_GET["name"];
            $_POST["rating"] = $_GET["rating"];
            $_POST["comment"] = $_GET["comment"];

            $datetime = date_default_timezone_set('America/Los_Angeles');
            $dt=date("Y-m-d H:i:s"); 

            $query2 = "INSERT INTO Review(name,time,mid,rating,comment) VALUES ('".$_POST["name"]."', '$dt', '".$_POST["mid"]."' , '".$_POST["rating"]."', '".$_POST["comment"]."')";

            $rs2 = $db->query($query2);

            echo "Review added successfully, thanks for your feedback!";
            $db->close();

            
            exit();
        }

?>
            <input type="hidden" name="mid" value="<?php $movie_id ?>"><br>
            Name: <input type = "text" name = "name" /><br>
            Rating: <select name = "rating" />
                    <option value = '1'>1</option>
                    <option value = '2'>2</option>
                    <option value = '3'>3</option>
                    <option value = '4'>4</option>
                    <option value = '5'>5</option>
                </select><br>
            Comment: <br><textarea name = "comment" rows = "10" cols= "50"> </textarea><br>
            <button type = "submit">Rate it!</button><br>
        </form>

       
<?php
        if($_POST["mid"] AND $_POST["name"] AND $_POST["rating"] AND $_POST["comment"]) {

            $datetime = date_default_timezone_set('America/Los_Angeles');
            $dt=date("Y-m-d H:i:s"); 

            $query2 = "INSERT INTO Review(name,time,mid,rating,comment) VALUES ('".$_POST["name"]."', '$dt', '".$_POST["mid"]."' , '".$_POST["rating"]."', '".$_POST["comment"]."')";

            $rs2 = $db->query($query2);

            echo "Review added successfully, thanks for your feedback!";
            $db->close();

        }

        exit();

     
       }
?>
    </body>
</html>