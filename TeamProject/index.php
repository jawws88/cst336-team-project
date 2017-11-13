<body>
    <div id="title">Brokebuster</div>
    <nav>
        <form>         <!-- temporary, will sort by pressing name on column later -->
            <span id="Filter">Sort - </span>
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
            
            <span id="Filter">Filter - </span>
            Name:
            <input type="text" name="typedtext" placeholder="Movie Name" value="<?=$_GET['typedtext']?>"/>
            Category:
            <input type="checkbox" name="tbd" value="true">N/A
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
    
    echo "Title (Year) Genre Runtime<br>";
    for ($i = 0; $i < sizeof($dbArray); $i++)
    {
        echo $dbArray[$i]['title']." ";
        echo "(".$dbArray[$i]['yearReleased'].") ";
        echo $dbArray[$i]['genre']." ";
        echo $dbArray[$i]['runtime']."min ";
        echo "<br>";
    }
    ?>
</body>