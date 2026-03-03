<?php
include 'connect.php';

$sql = "SELECT * FROM menu ORDER BY name ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Food Menu</h1>
    <form id="orderForm" action="order.php" method="post">
        <div class="row mt-4">
            
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagePath = !empty($row['image']) ? 'images/' . $row['image'] : 'images/default.jpg';
                    ?>

                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg">
                            <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text">Price: $<?php echo number_format($row['price'], 2); ?></p>
                                <input type="checkbox" name="items[]" value="<?php echo $row['id']; ?>"> Select
                            </div>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<h3 class='text-center'>No menu items found.</h3>";
            }
            ?>

        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">Place Order</button>
        </div>
    </form>
</div>

</body>
</html>

<?php
$conn->close();
?>
