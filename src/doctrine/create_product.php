<?php
// create_product.php
require_once "./doctrine.php";
require_once "../../model/Product.php";
require_once "../../model/Buyer.php";
require_once "../../model/Color.php";

$newProductName = $argv[1];
$buyerName = $argv[2];
$colorName = $argv[3];

$product = new Product();
$product->setName($newProductName);

$color = $entityManager->getRepository("Color")->findOneByName($colorName);

$buyer = $entityManager->getRepository("Buyer")->findOneByName($buyerName);

$product->setBuyer($buyer);
$product->setColor($color);

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . "\n";

?>