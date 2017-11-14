<!DOCTYPE html>
<html>
    <head>
        <title>Brokebuster</title>
        <link  href="css/styles.css" rel="stylesheet" type="text/css" />
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
            <form><button formaction="shoppingcart.php">Go to Shopping Cart</button></form>
            <hr>
            <nav>
                <form>         <!-- temporary, will sort by pressing name on column later -->
                    <span id="Filter"><strong>Sort - </strong></span>
                    <select name = "sort">
                        <option value="name">Name</option>
                        <option value="nascending">-->Ascending</option>
                        <option value="ndescending">-->Descending</option>
                        <option value="year">Year</option>
                        <option value="yascending">-->Ascending</option>
                        <option value="ydescending">-->Descending</option>
                        <option value="genre">Genre</option>
                        <option value="gascending">-->Ascending</option>
                        <option value="gdescending">-->Descending</option>
                        <option value="runtime">Runtime</option>
                        <option value="rascending">-->Ascending</option>
                        <option value="rdescending">-->Descending</option>
                    </select>
                    <input type="submit" name="submit" value="Submit">
                    <br>
                        
                    <strong><span id="Filter">Filter - </span> Name:</strong>  <input type="text" name="typedtext" placeholder="Movie Name" value="<?=$_GET['typedtext']?>"/>
                    <strong>Category:</strong> <input type="checkbox" name="tbd" value="true">N/A
                    <br>
                </form>
            </nav>
        
            <?php
            //login: root
            //I didn't set a password should just be able to login
            //(works without a password confirmed  -Ryan)
            
            //still adding to database but tables look as follows:
            //Table: movie - movieID, title, yearReleased, directorID, runtime, genre
            //Table: actor - actorID, firstName, lastName, dob, gender
            //Table: cast - castID, movieID, actorID, characterName
            //Table: director - directorID, firstName, lastName, dob, gender
            
            //Filter fields: Category(genre), Director, Filter between years maybe
            //Sory by: Name, Year, Category(genre), Runtime
            
            include 'database.php';
            $dbConn = getDatabaseConnection();
            $dispatch = "SELECT * FROM movie ";
            $dbData = $dbConn->query($dispatch);
            $dbArray = $dbData->fetchAll();
            
            print_r($_SESSION);
            echo "Title (Year) Genre Runtime<br>";
            for ($i = 0; $i < sizeof($dbArray); $i++)
            {
                echo '<span>';
                echo $dbArray[$i]['title']." ";
                echo "(".$dbArray[$i]['yearReleased'].") ";
                echo $dbArray[$i]['genre']." ";
                echo $dbArray[$i]['runtime']."min ";
                echo '<form><button name="addToCart" value="'.$dbArray[$i]['title'].'">Add to Cart</button></form>';
                echo '</span>';
                echo "<br>";
            }
            ?>
            
            
            
            
            
    </div>
    </body>
</html>