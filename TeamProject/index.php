<?php
//login: root
//I didn't set a password should just be able to login
//(works without a password confirmed  -Ryan)

//still adding to database but tables look as follows:
//Table: movie - movieID, title, yearReleased, directorID, runtime, genre
//Table: actor - actorID, firstName, lastName, dob, gender
//Table: cast - castID, movieID, actorID, characterName
//Table: director - directorID, firstName, lastName, dob, gender

include 'database.php';
$dbConn=getDatabaseConnection();
$dispatch = "SELECT * FROM movie ";
$dbData = $dbConn->query($dispatch);
$dbArray = $dbData->fetchAll();
for ($i = 0; $i < sizeof($dbArray); $i++)
{
    echo $dbArray[$i]['title']."<br>";
}
?>
