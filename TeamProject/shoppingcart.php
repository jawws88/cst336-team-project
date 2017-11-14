<!DOCTYPE html>
<html>
    
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
    </head>
    
    <?php
        
        
        
        if(!isset($_SESSION['cart'])){
            session_start();
        }
        $cartItems = $_SESSION['cart'];
        
        
        
    ?>
    
    
    <body>
        
        <h1>Your Shopping Cart</h1>
        <hr>
        
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
        
        
        
    </body>
    
</html>