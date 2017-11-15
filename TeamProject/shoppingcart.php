<!DOCTYPE html>
<html>
    <head>
        <title>Brokebuster: Shopping Cart</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <?php
        if(!isset($_SESSION['cart'])){
            session_start();
        }
        $cartItems = $_SESSION['cart'];
    ?>
    <body>
        <div class="container text-center">
            <h1>Brokebuster: Shopping Cart</h1>
            <hr id="line">
            <?php
                if(count($cartItems) == 0){
                    echo "There are no items in your cart!";
                }else{
                    
                    foreach($cartItems as $item){
                        echo "<span id='item'>".$item.'</span><br>';
                    }
                }
            ?>
            <form method="post">
                <button class="btn btn-warning" formaction="clear.php" type="submit">Clear Cart</button><br>
                <button class="btn btn-primary" formaction="index.php" type="submit">Keep Shopping</button>
            </form>
        </div>
    </body>
</html>