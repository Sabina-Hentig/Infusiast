<?php
global $cnx;
include 'config/db.php';

$query = "SELECT pa.id, pa.product_name, pa.picture, pa.price, pa.description
          FROM product_accessories pa
          WHERE pa.is_active = 'Active'";
$result = mysqli_query($cnx, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($cnx));
}

echo "<table>";
echo "<thead>
        <tr>
            <th>Product Name</th>
            <th>Description</th>
            <th>Picture</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
      </thead>";
echo "<tbody>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>";
    if ($row['picture']) {
        $imgData = base64_encode($row['picture']);
        $src = 'data:image/jpeg;base64,' . $imgData;
        echo "<img src='{$src}' class='tea-table-img' alt='Product Image'/>";
    } else {
        echo "No Image";
    }
    echo "</td>";
    echo "<td>" . htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>
            <form action='add_basket.php' method='post'>
                <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                <button type='submit' class='tea-table-btn' >Add to Basket</button>
            </form>
          </td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

mysqli_close($cnx);
?>
