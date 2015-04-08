<?php
// create_color.php
require_once "./doctrine.php";
require_once "../../model/Product.php";
require_once "../../model/Buyer.php";
require_once "../../model/Color.php";

$newColorName = $argv[1];

$color = new Color();
$color->setName($newColorName);

$entityManager->persist($color);
$entityManager->flush();

echo "Created Color with ID " . $color->getId() . "\n";

?>