<?php
ob_start();
session_start();
include 'Cart.php';

// $testData = [
//     ["name"=>"John","quantity"=>1,"price"=>2.00],
//     ["name"=>"John","quantity"=>1,"price"=>2.00]
// ];

//set initial session data if not previously populated
if (empty($_SESSION['cart'])) {
    $_SESSION["cart"] = [];
    $_SESSION["total"] = 0;
}

//initialise cart
$c = new Cart($_SESSION["cart"]);
$c->displayCartList();
$cnt = count($_SESSION["cart"]);
var_dump($cnt);

//handlers effectively for actions 
if (isset($_GET['add'])){    

    if($cnt > 0){   
        for ($i = 0; $i < $cnt; ++$i) {
            if($_SESSION["cart"][$i]["name"] == $_GET['name']){
                $c->addToCart($_GET['name'],$_GET['price'], $_SESSION["cart"][$i]["quantity"]+=1);           
            }   
        }

    }
    //just add it if it isnt there 
    $c->addToCart($_GET['name'],$_GET['price'],1);  
   
   
}

if (isset($_GET['delete'])){
   $c->deleteFromCart($_GET['name'],$_GET['price']);
}


//This is the class for the product list and its methods 

/*
    interface 
    - this is a view type class so like cart I want to use class interchangeably with the contained methods
    - as each class requires output to the template 
*/

interface Template
{
   public function displayProductList(); 
   //todo: extend to a more generic templating function   
   //todo: extend to include a function to getData from DB 
}


class Products implements Template

{     
   //I am making this private as side effects cannot be introduced if the class is used elsehere  
   private $products;       

   //initial display 
   public function __construct($products){
        $this->products = $products;       
    }
    
    public function displayProductList() {
                
        //Output html template        
         echo "<h1>Products List</h1>";
         echo "<table>";
         echo "<tbody>";    
         echo "<tr><th>Product Name</th><th>Price</th><th></th></tr>"; 
         foreach($this->products as $product) {
             echo "<tr><td>",$product["name"],'</td><td>$',number_format($product["price"], 2, '.', ''),'</td><td><a href="index.php?add=true&name=',$product["name"],'&price=',number_format($product["price"], 2, '.', ''),'">Add To Cart</a></td></tr>'; 
         }       
         echo "</tbody>";
         echo "</table>";
      
    }

}

?>

