<?php
header('Content-Type: application/json');
session_start();

$product_id = $_POST['product_id'] ?? 0;
$price = $_POST['total_price'] ?? 0;
$qty = $_POST['quantity'] ?? 1;

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = ['items' => [], 'subtotal' => 0, 'total_qty' => 0];
}

$products = [
    155 => ['name'=>'2 Pizzas GG + Pizza Doce G','image'=>'images/product_1772665229_69a8b98dd27e1.webp'],
    156 => ['name'=>'2 Pizzas G + Pizza Doce G','image'=>'images/product_1772665501_69a8ba9d91a75.webp'],
    157 => ['name'=>'2 Pizzas G + Refri 2L','image'=>'images/product_1772666423_69a8be37aec34.webp'],
    158 => ['name'=>'Pizza P','image'=>'images/product_1772667521_69a8c281561a2.webp'],
    159 => ['name'=>'Pizza M','image'=>'images/product_1772668117_69a8c4d5975bf.webp'],
    160 => ['name'=>'Pizza G','image'=>'images/product_1772668290_69a8c582b71c7.webp'],
    161 => ['name'=>'Pizza GG','image'=>'images/product_1772668479_69a8c63fc0547.webp'],
    162 => ['name'=>'Combo 4 Esfirras','image'=>'images/product_1772668597_69a8c6b575574.webp'],
    163 => ['name'=>'Combo 5 Esfirras','image'=>'images/product_1772668636_69a8c6dc4711f.webp'],
    125 => ['name'=>'Refrigerante Lata','image'=>'images/product_1772651599_69a8844f37559.webp'],
    126 => ['name'=>'Refrigerante 1L','image'=>'images/product_1772651637_69a88475e4637.webp'],
];

$info = $products[$product_id] ?? ['name'=>'Produto','image'=>''];

$item = [
    'id' => time(),
    'product_id' => $product_id,
    'name' => $info['name'],
    'image' => $info['image'],
    'unit_price' => $price,
    'quantity' => $qty,
    'observations' => $_POST['observations'] ?? '',
    'complements' => []
];

$_SESSION['cart']['items'][] = $item;
$_SESSION['cart']['subtotal'] += $price * $qty;
$_SESSION['cart']['total_qty'] += $qty;

echo json_encode(['success' => true]);