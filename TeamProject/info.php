<?php
include "./simple_html_dom.php";
$search_keyword = $_GET['title'];
$search_keyword=str_replace(' ','+',$search_keyword);
$newhtml = file_get_html("https://www.google.com/search?q=".$search_keyword."&tbm=isch");
$result_image_source = $newhtml->find('img', 0)->src;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Brokebuster: Info</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container text-center">
            <h1>Brokebuster: Item Info</h1>
            <hr id="line">
            <h3>Title: <?php echo $_GET['title']; ?></h3>
            <?php echo '<img src="'.$result_image_source.'">' ?>
            <h3>Year Released: <?php echo $_GET['yearReleased']; ?></h3>
            <h3>Genre: <?php echo $_GET['genre']; ?></h3>
            <h3>Runtime: <?php echo $_GET['runtime']; ?> minutes</h3>
            <h3>Director: </h3>
            <h3>Actor: </h3>
            <h3>Cast: </h3>
            	
            
            
            <form method="post">
                <button class="btn btn-primary btn-sm"formaction="index.php" type="submit">Keep Shopping</button>
            </form>
        </div>
    </body>
</html>