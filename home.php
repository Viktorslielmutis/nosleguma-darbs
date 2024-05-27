<?php

session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include 'db.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
$categories = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Handle category filter
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;
$whereClause = '';
if ($selectedCategory) {
    $whereClause = "WHERE pc.category_id = $selectedCategory";
}

// Fetch products based on selected category
$sql = "SELECT p.* FROM products p
        INNER JOIN product_categories pc ON p.product_id = pc.product_id
        $whereClause";
$result = $conn->query($sql);
$products = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-z8Esh+4kymgcWTnF2ODFr/lF+2f1CRRfHxWZuT7g1PiV+Lly3Q2NwCJhY9P+dweA" crossorigin="anonymous">
    <title>Veikals</title>
</head>
<body>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <div class="admin-nav">
                ADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMIN
            </div>
        <?php endif; ?>

    <div class="container">
        <nav class="navigation-home">
                    <a class="homesignout" href="home.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"   height="25px" width="25px"><path d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg></a>
                    <a class="homesignout" href="ievietot.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="25px" width="25px"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg></a>
                    <a class="homesignout" href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"  height="25px" width="25px"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg></a>
                    <a class="homesignout" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"   height="25px" width="25px"><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg></a>
        </nav>


        <div class="second-nav">
            <div class="meklet">Meklēt:</div>
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <button><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="12" width="12"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                </button>
            </div>

            <div class="meklet">Kategorijas:</div>
            <div class="second-nav-inside">
                <?php foreach ($categories as $category): ?>
                    <a href="?category=<?php echo $category['category_id']; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20">
                            <path d="M176 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64c-35.3 0-64 28.7-64 64H24c-13.3 0-24 10.7-24 24s10.7 24 24 24H64v56H24c-13.3 0-24 10.7-24 24s10.7 24 24 24H64v56H24c-13.3 0-24 10.7-24 24s10.7 24 24 24H64c0 35.3 28.7 64 64 64v40c0 13.3 10.7 24 24 24s24-10.7 24-24V448h56v40c0 13.3 10.7 24 24 24s24-10.7 24-24V448h56v40c0 13.3 10.7 24 24 24s24-10.7 24-24V448c35.3 0 64-28.7 64-64h40c13.3 0 24-10.7 24-24s-10.7-24-24-24H448V280h40c13.3 0 24-10.7 24-24s-10.7-24-24-24H448V176h40c13.3 0 24-10.7 24-24s-10.7-24-24-24H448c0-35.3-28.7-64-64-64V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H280V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H176V24zM160 128H352c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H160c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32zm192 32H160V352H352V160z"/>
                        </svg>
                        <?php echo $category['name']; ?>
                    </a>
                    <?php endforeach; ?>
            </div>

    </div>

            <div class="homeboxmain">
                <?php foreach ($products as $product): ?>
                    <div class="homebox1">
                        <img class="resize" src="<?php echo $product['img_url']; ?>" alt="<?php echo $product['virsraksts']; ?>">
                        <div class="description">
                            <div class="Nosaukums"><?php echo $product['virsraksts']; ?></div>
                            <?php echo mb_strimwidth($product['teksts'], 0, 25, "..."); // Shortened description ?>
                            <div class="Cena"><?php echo $product['cena']; ?>€</div>
                        </div>
                        <div class="homebox-abas-pogas">
                            <a href="product-detail.php?id=<?php echo $product['product_id']; ?>" class="read-more-btn">Apskatiit vairaak</a> <!-- Include product_id in the URL -->
                            <button class="homebox1-poga">Pirkt</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
</body>
</html>
