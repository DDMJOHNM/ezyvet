<?php
ob_start();
/*
    This is the class for the cart its methods
    call methods from cart products class
*/ 

class Cart 

{        
   private $cart;  
  
   public function __construct($cart){
        $this->cart = $cart;   
     
   }

   public function addToCart($name,$price) {    
    //checks not in cart before adding    
    if(in_array(array('name'=>$name,'quantity'=>1,'price'=>$price),$_SESSION["cart"]) === false){
        array_push($_SESSION["cart"],array('name'=>$name,'quantity'=>1,'price'=>$price));  
        $_SESSION["total"] += $price;         
        echo 'item added to cart ',$name;
        header("Location: /");
        exit(0);  
        
    } else {
        echo 'item cannot be added to cart ',$name;
    }


   }

   public function deleteFromCart($name,$price) {
    //removes specific array from array
    array_splice($_SESSION["cart"], array_search($name,$_SESSION["cart"] ), 1);
    $_SESSION["total"] -= $price;         
    echo 'item deleted from cart ',$name;
    header("Location: /");
    exit(0);  
    }
    
    public function displayCartList() {
          
        //Output html template        
         echo "<h2>Cart</h2>";
         echo "<table>";
         echo "<tbody>";    
         echo "<tr><th>Product Name</th><th>Qty</th><th>Price</th><th></th></tr>"; 
         if(count($_SESSION['cart']) != 0){
            foreach($this->cart as $cart) {
                echo "<tr><td>",$cart["name"],'</td><td>',$cart["quantity"],'</td><td>$',number_format($cart["price"], 2, '.', ''),'</td><td><a href="index.php?delete=true&name=',$cart["name"],'&price=',number_format($cart["price"], 2, '.', ''),'">Delete From Cart</a></td></tr>'; 
            }       
         } else {
            echo "<tr><td colpsan='4'>There are no products in your cart</td></tr>"; 
         }
         echo "</tbody>";
         echo "<tfoot>";
         echo "<tr>";
         echo "<th colspan='4'>";
         echo $_SESSION['total']? "$". $_SESSION['total'] : "";
         echo "</th>";
         echo "</tr>";         
         echo "</table>";
      
    }

}

?>