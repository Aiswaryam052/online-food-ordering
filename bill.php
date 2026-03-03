<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['food_items'])) {
    $total = 0;
    echo "<h2>Your Bill</h2><ul>";

    foreach ($_POST['food_items'] as $item) {
        list($id, $price) = explode(',', $item);
        $total += $price;
        echo "<li>Item ID: $id - Price: $$price</li>";
    }

    echo "</ul><h3>Total Amount: $$total</h3>";
} else {
    echo "<h2>No items selected!</h2>";
}
?>
