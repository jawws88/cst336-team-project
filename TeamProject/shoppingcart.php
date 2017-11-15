<!DOCTYPE html>
<html>
    <head>
        <title>Brokebuster: Shopping Cart</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
    </head>
    <?php
        if(!isset($_SESSION['cart'])){
            session_start();
        }
        $cartItems = $_SESSION['cart'];
    ?>
    <body>
        <div id="container">
            <h1>Your Shopping Cart</h1>
            <hr id="line">
            <?php
                if(count($cartItems) == 0){
                    echo "There are no items in your cart!";
                }else{
                    
                    foreach($cartItems as $item){
                        echo $item.'<br>';
                    }
                }
            ?>
            <form method="post">
                <button formaction="clear.php" type="submit">Clear Cart</button><br>
                <button formaction="index.php" type="submit">Keep Shopping</button>
            </form>
        </div>
    </body>
</html>