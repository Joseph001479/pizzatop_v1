<?php
header('Content-Type: application/json');
session_start();

$item_id = $_POST['item_id'] ?? 0;

if (isset($_SESSION['cart']['items'])) {
    $_SESSION['cart']['items'] = array_values(array_filter($_SESSION['cart']['items'], fn($i) => $i['id'] != $item_id));
    $_SESSION['cart']['subtotal'] = array_sum(array_map(fn($i) => $i['unit_price'] * $i['quantity'], $_SESSION['cart']['items']));
    $_SESSION['cart']['total_qty'] = array_sum(array_map(fn($i) => $i['quantity'], $_SESSION['cart']['items']));
}

echo json_encode(['success' => true]);