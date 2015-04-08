<?php
// list_products.php
require_once "./doctrine.php";
require_once "../../model/Product.php";
require_once "../../model/Buyer.php";
require_once "../../model/Color.php";

// $buyerId = $argv[1];

// if($buyerId==null)
// {
// 	//$productRepository = $entityManager->getRepository('Product');
// 	$products = $entityManager->getRepository('Product')->findAll();
// }
// else
// {
// 	$buyer = $entityManager->find('Buyer', $buyerId);
// 	$products = $buyer->getProducts();
// }

$products = $entityManager->getRepository('Product')->findAll();

foreach ($products as $product) {
	$colorobj = $product->getColor();
	$buyer = $product->getBuyer();
    echo sprintf("-%s\n", $product->getName());
    if($colorobj[0]!=null) echo $colorobj[0]->getName();
    if($buyer!=null) echo $buyer->getName();
}
?>