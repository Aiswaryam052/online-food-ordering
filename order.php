<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['items'])) {
        $items = $_POST['items'];
        $itemNames = [];
        $totalPrice = 0;

        foreach ($items as $itemID) {
            $sql = "SELECT * FROM menu WHERE id = $itemID";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()) {
                $itemNames[] = $row['name'];
                $totalPrice += $row['price'];
            }
        }

        // Insert order into database
        $itemsList = implode(", ", $itemNames);
        $sql = "INSERT INTO orders (items, total_price) VALUES ('$itemsList', '$totalPrice')";
        $conn->query($sql);
    } else {
        echo "<h2 class='text-center mt-5'>No items selected!</h2>";
        exit();
    }
} else {
    header("Location: menu.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5 text-center">
    <h1>Order Summary</h1>
    <h3>Items Ordered:</h3>
    <p><?php echo $itemsList; ?></p>
    <h3>Total Price: $<?php echo number_format($totalPrice, 2); ?></h3>
    <a href="menu.php" class="btn btn-primary mt-3">Back to Menu</a>
</div>

</body>
</html>

<?php
$conn->close();
?>
