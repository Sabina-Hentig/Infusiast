<?php
include 'config/db.php';

$query = "SELECT o.id, o.order_number, p.product_name, pa.product_name AS accessory_name, 
                 o.quantity, o.created_date, p.price AS product_price, pa.price AS accessory_price, 
                 p.picture AS product_picture, pa.picture AS accessory_picture, 
                 p.description AS product_description, pa.description AS accessory_description
          FROM orders o
          LEFT JOIN product p ON o.product_id = p.id
          LEFT JOIN product_accessories pa ON o.product_accessory_id = pa.id
          WHERE o.user_id = 8";

$result = mysqli_query($cnx, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($cnx));
}

$total_cost = 0;

echo "<table>";
echo "<thead>
        <tr>
            <th>Order Number</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Picture</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Order Date</th>
            <th>Actions</th>
        </tr>
      </thead>";
echo "<tbody>";

while ($row = mysqli_fetch_assoc($result)) {
    $product_name = $row['product_name'] ? $row['product_name'] : $row['accessory_name'];
    $description = $row['product_description'] ? $row['product_description'] : $row['accessory_description'];
    $price = $row['product_price'] ? $row['product_price'] : $row['accessory_price'];
    $item_total = $price * $row['quantity'];
    $total_cost += $item_total;
    $picture = $row['product_picture'] ? $row['product_picture'] : $row['accessory_picture'];
    
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['order_number'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($product_name, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>";
    if ($picture) {
        $imgData = base64_encode($picture);
        $src = 'data:image/jpeg;base64,' . $imgData;
        echo "<img src='{$src}' class='tea-table-img' alt='Product Image' style='width: 50px; height: 50px;'/>";
    } else {
        echo "No Image";
    }
    echo "</td>";
    echo "<td>
            <form action='update_quantity.php' method='post'>
                <input type='hidden' name='order_id' value='" . $row['id'] . "'>
                <input style='width:2rem' type='number' name='quantity' value='" . htmlspecialchars($row['quantity'], ENT_QUOTES, 'UTF-8') . "' min='1'>
                <br>
                <br>
                <button class='tea-table-btn' type='submit'>Update</button>
            </form>
          </td>";
    echo "<td>" . htmlspecialchars(number_format($price, 2), ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars(number_format($item_total, 2), ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($row['created_date'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>
            <form action='delete_order.php' method='post'>
                <input type='hidden' name='order_id' value='" . $row['id'] . "'>
                <button class='tea-table-btn' type='submit'>Remove</button>
            </form>
          </td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

echo "<h2>Total Cost: " . htmlspecialchars(number_format($total_cost, 2), ENT_QUOTES, 'UTF-8') . "</h2>";

echo "<td>
                 <form action='add_basket.php' method='post'>
                 </form>
               </td>";
echo "</tr>";


echo '<button class="tea-table-btn" onclick="window.location.href=\'collect_address.php\'">Place Order</button>';
echo '<br> <br>';

mysqli_close($cnx);
?>
