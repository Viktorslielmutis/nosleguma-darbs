<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';

$category_query = "SELECT * FROM categories";
$category_result = $conn->query($category_query);

if ($category_result) {
    $categories = $category_result->fetch_all(MYSQLI);
} else {
    $categories = array();
}

if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
    $sql = "SELECT p.product_id, p.virsraksts, p.teksts, p.cena, p.img_url
            FROM products p
            INNER JOIN product_categories pc ON p.product_id = pc.product_id
            WHERE pc.category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT product_id, virsraksts, teksts, cena, img_url FROM products";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-<correct_hash_here>" crossorigin="anonymous">
    <title>Home - CityStore</title>
</head>
<body>
    <div class="wrapper">
        <header>a
            <?php include 'header.php'; ?> 
        </header>
        <div class="container" style="display: flex; flex-direction: column; align-items: center;">
            <div class="main-page-wrapper">
                <div class="products" style="justify-content: flex-start; margin: 0px 50px;">
                    <div class="category-dropdown"> 
                        <select id="category-dropdown" onchange="window.location.href=this.value"> 
                            <option value="#" <?php if (!isset($_GET['category'])) echo 'selected'; ?>>Select Category</option> 
                            <?php foreach ($categories as $category) : ?> 
                                <option value="?category=<?php echo $category['category_id']; ?>" 
                                    <?php if (isset($_GET['category']) && $_GET['category'] == $category['category_id']) echo 'selected'; ?>>
                                    <?php echo $category['name']; ?>
                                </option> 
                            <?php endforeach; ?> 
                        </select> 
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                </div>
                <div class="products">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($product = $result->fetch_assoc()) {
                            echo "<div class='product-card'>";
                            echo "<div class='product-card-top'>";
                            echo "<img class='product-card-img' src='" . $product['img_url'] . "' alt='" . $product['virsraksts'] . "'>";
                            echo "</div>";
                            echo "<div class='box-down'>";
                            echo "<div class='card-footer'>";
                            echo "<div class='img-info'>";
                            echo "<span class='p-name'>" . $product['virsraksts'] . "</span>";
                            echo "</div>";
                            echo "<div class='img-price'>";
                            echo "<span>" . $product['cena'] .  " €</span>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No products found.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>