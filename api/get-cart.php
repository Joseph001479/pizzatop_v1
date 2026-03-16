<?php
header('Content-Type: application/json');
session_start();

$cart = $_SESSION['cart'] ?? ['items' => [], 'subtotal' => 0, 'total_qty' => 0];
echo json_encode($cart);