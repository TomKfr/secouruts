<?php
// create_product.php
require_once "./doctrine.php";
require_once "../../model/Buyer.php";
require_once "../../model/Product.php";

$name = $argv[1];

$buyer = new Buyer();

$buyer->setName($name);

$entityManager->persist($buyer);
$entityManager->flush();

echo "Created Buyer with ID " . $buyer->getId() . "\n";

?>