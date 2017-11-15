<!DOCTYPE html>
<html>
    <head>
        <title>Brokebuster</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    
    <?php 
    
    if(!isset($_SESSION['cart'])){
        session_start();
    }
    
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    
    if(strlen($_GET['addToCart']) > 0){
        array_push($_SESSION['cart'], $_GET['addToCart']);
    }
    
    ?>
    
    <body>
        <div class="container text-center">
            <h1>Brokebuster</h1>
            <form><button class="btn btn-primary" formaction="shoppingcart.php">Go to Shopping Cart</button></form>
            <hr id="line">
            <nav>
                <form method="post">
                    <span id="Filter"><strong>Sort - </strong></span>
                    <select name = "sorttype">
                        <option value="name">Name</option>
                        <option value="year">Year</option>
                        <option value="genre">Genre</option>
                        <option value="runtime">Runtime</option>
                    </select>
                    <select name = "sortorder">
                        <option value="ascending">Asc</option>
                        <option value="descending">Desc</option>
                    </select>
                    <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Submit">
                    <br>
                        
                    <strong><span id="Filter">Filter - </span> Name:</strong>  <input type="text" name="typedtext" placeholder="Movie Name" value="<?=$_GET['typedtext']?>"/>
                    <br>
                    <strong>Genre:</strong>
                    <input type="checkbox" name="action" value="true">Action
                    <input type="checkbox" name="comedy" value="true">Comedy
                    <strong> Year:</strong>
                    <input type="number" name="year" width:"4" style="width: 4em" value="year">
                    <br>
                </form>
            </nav>
        
            <?php
                //login: root
                //I didn't set a password should just be able to login
                
                //still adding to database but tables look as follows:
                //Table: movie - movieID, title, yearReleased, directorID, runtime, genre
                //Table: actor - actorID, firstName, lastName, dob, gender
                //Table: cast - castID, movieID, actorID, characterName
                //Table: director - directorID, firstName, lastName, dob, gender
                
                //Filter fields: Title, Genre, Year
                //Sory by: Name, Year, Genre, Runtime [ASC, DESC]
                
                include 'database.php';
                $dbConn = getDatabaseConnection();
                $dispatch = "SELECT * FROM movie ";
                
                $i = 0; # counter
                $tempfilter = array();
                # Filter
                if (!empty($_POST['typedtext'])) {# Name
                    $tempfilter[$i] = " title LIKE '%" . $_POST['typedtext'] . "%' ";
                    $i++;
                }
                
                if ($_POST['action'] == "true") { # Action
                    $tempfilter[$i] = " genre = 'Action' ";
                    $i++;
                }
                if ($_POST['comedy'] == "true") { # Comedy
                    $tempfilter[$i] = " genre = 'Comedy' ";
                    $i++;
                }
                if ($_POST['year'] != null){
                    $tempfilter[$i] = " yearReleased = ".$_POST['year']." ";
                    $i++;
                }
                
                for ($j = 0; $j < count($tempfilter); $j++) #concat that filter string!
                {
                    if ($j == 0 && !empty($tempfilter[0]))
                    {
                        $dispatch = $dispatch . "WHERE";
                    }
                    $dispatch = $dispatch . $tempfilter[$j];
                    if (strpos($tempfilter[$j], 'title') && !empty($tempfilter[$j+1]))
                    {
                        $dispatch = $dispatch . " AND";
                    }
                    else if (strpos($tempfilter[$j], 'genre') && strpos($tempfilter[$j+1],'yearReleased'))
                    {
                        $dispatch = $dispatch . " AND";
                    }
                    else {
                        if (!empty($tempfilter[$j+1]))
                        {
                            $dispatch = $dispatch . " OR";
                        }
                    }
                }
                
                # Sort
                if ($_POST['sorttype'] == "name" && $_POST['sortorder'] == "ascending") # Name
                    $dispatch = $dispatch . "ORDER BY title ASC";
                else if ($_POST['sorttype'] == "name" && $_POST['sortorder'] == "descending")
                    $dispatch = $dispatch . "ORDER BY title DESC";
                else if ($_POST['sorttype'] == "year" && $_POST['sortorder'] == "ascending") # Year
                    $dispatch = $dispatch . "ORDER BY yearReleased ASC";
                else if ($_POST['sorttype'] == "year" && $_POST['sortorder'] == "descending")
                    $dispatch = $dispatch . "ORDER BY yearReleased DESC";
                else if ($_POST['sorttype'] == "genre" && $_POST['sortorder'] == "ascending") # Genre
                    $dispatch = $dispatch . "ORDER BY genre ASC";
                else if ($_POST['sorttype'] == "genre" && $_POST['sortorder'] == "descending")
                    $dispatch = $dispatch . "ORDER BY genre DESC";
                else if ($_POST['sorttype'] == "runtime" && $_POST['sortorder'] == "ascending") # Runtime
                    $dispatch = $dispatch . "ORDER BY runtime ASC";
                else if ($_POST['sorttype'] == "runtime" && $_POST['sortorder'] == "descending")
                    $dispatch = $dispatch . "ORDER BY runtime DESC";
                
                
                $dbData = $dbConn->query($dispatch);
                $dbArray = $dbData->fetchAll();
                #echo $dispatch."<br>";
                echo "<br>";
                #print_r($_SESSION);
                /*?><strong>Title</strong> (Year) Genre <i>Runtime</i><br> <?php
                for ($i = 0; $i < sizeof($dbArray); $i++)
                {
                    echo '<span class="movielist">';
                    echo "<strong><td class='movielist'><a href=\"info.php?name=".$dbArray[$i]['title']. "&id=" .$dbArray[$i]['movieID']."\">" . $dbArray[$i]['title'] ."</a></td></strong>";
                    //echo "<strong>".$dbArray[$i]['title']."</strong> ";
                    echo " (".$dbArray[$i]['yearReleased'].") ";
                    echo $dbArray[$i]['genre']." ";
                    echo "<i>".$dbArray[$i]['runtime']."min</i> ";
                    echo '</span>';
                    echo '<form><button class="btn btn-info" name="addToCart" value="'.$dbArray[$i]['title'].'">Add to Cart</button></form>';
                    echo "<br>";
                  
                }*/
                
                //This is just a foreach version of the above loop
                echo "<table align='center' id=\"t1\">
                <tr>
                <thead>
                <th>Title </th>
     	        <th>Year </th>
             	</thead>
                </tr>";
                    foreach($dbArray as $result) {
                    echo "<tr>";
                    echo "<strong><td class='movielist'><a href=\"info.php? title=".$result['title']. "&id=" .$result['movieID']."&yearReleased=".
                          $result['yearReleased']."&genre=".$result['genre']."&runtime=".$result['runtime']."\">" . $result['title'] ."</a></td></strong>";
                    echo "<td>".$result['yearReleased']."</td>";
                    //echo "<td>".$result['genre']."</td>";
                    //echo "<td>".$result['runtime']." min</td>";
                    echo '<td><form><button class="btn btn-info btn-sm" name="addToCart" value="'.$result['title'].'">Add to Cart</button></form></td>';
                    }
                    
                    echo "</table>";
                ?>
            
            
            
            
            
            
            
    </div>
    </body>
</html>