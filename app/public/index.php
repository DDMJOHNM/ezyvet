<?php
//include product class
include("../Products.php");

//Required see docs folder 
error_reporting(E_STRICT);

//display html
//header("Content-type: text/html");  

//Seed Data 
// ######## please do not alter the following code ########
$products = [ 
    [ "name" => "Sledgehammer", "price" => 125.75 ], 
    [ "name" => "Axe", "price" => 190.50 ], 
    [ "name" => "Bandsaw", "price" => 562.131 ], 
    [ "name" => "Chisel", "price" => 12.9 ], 
    [ "name" => "Hacksaw", "price" => 18.45 ], 
];
// ########################################################

//instanciate class
$p = new Products($products);
//display basic list
$p->displayProductList();

