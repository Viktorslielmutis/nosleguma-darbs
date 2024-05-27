<?php

include 'db.php';
// Fetch product details from the database using the product ID from the URL
// Fetch product details from the database based on the product ID from the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Query to fetch product details from the database
    $query = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        // Product not found
        echo "Product not found.";
        exit;
    }
} else {
    // No product ID provided
    echo "Product ID not specified.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-z8Esh+4kymgcWTnF2ODFr/lF+2f1CRRfHxWZuT7g1PiV+Lly3Q2NwCJhY9P+dweA" crossorigin="anonymous">
    <title><?php echo $product['virsraksts']; ?></title>
</head>
<body>

    <div class="container-single-product">
        <nav class="navigation-home">
                    <a class="homesignout" href="home.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"   height="25px" width="25px"><path d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg></a>
                    <a class="homesignout" href="ievietot.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="25px" width="25px"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg></a>
                    <a class="homesignout" href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"  height="25px" width="25px"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg></a>
                    <a class="homesignout" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"   height="25px" width="25px"><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg></a>
        </nav>

        <div class="product-detail-single">
            <img class="resize-product-single" src="<?php echo $product['img_url']; ?>" alt="<?php echo $product['virsraksts']; ?>">
            <div class="Nosaukums"><?php echo $product['virsraksts']; ?></div>
            <div class="Apraksts-product-single"><?php echo $product['teksts']; ?></div>
            <div class="Cena"><?php echo $product['cena']; ?>€</div>
            <button class="homebox1-poga">Pirkt</button>
        </div>
</body>
</html>