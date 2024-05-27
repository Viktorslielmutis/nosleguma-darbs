<?php

require 'db.php';
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$welcome_message = ($_SESSION["username"] === "admin") ? "Admin" : "" . $_SESSION["username"] . "";

$sql = "SELECT virsraksts, teksts, cena, img_url FROM products WHERE user_id = ?";

// Prepare the SQL statement
if ($stmt = mysqli_prepare($conn, $sql)) {
    // Bind the user ID parameter
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["id"]);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // Bind result variables
        mysqli_stmt_bind_result($stmt, $virsraksts, $teksts ,$cena, $img_url);
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

    <div class="container-profile">

        <nav class="navigation-home">
                    <a class="homesignout" href="home.php"><svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 576 512"   height="25px" width="25px"><path d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg></a>
                    <a class="homesignout" href="ievietot.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"   height="25px" width="25px"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg></a>
                    <a class="homesignout" href="profile.php"><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 448 512"   height="25px" width="25px"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg></a>
                    <a class="homesignout" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg"   viewBox="0 0 512 512"   height="25px" width="25px"><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg></a>
        </nav>

        <div class="profile-boxmain">
            <div class="profile-boxtop">

                <img class="profile-picture" src="assets/pfp.png" alt="Profile Picture">
                
                <div class="profile-welcome">
                    <?php echo $welcome_message; ?>
                </div>

                <div class="product-text">
                    Tavi produkti:
                </div>

            </div>

            <div class="profile-boxbot">
            
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nosaukums</th>
                                <th>Apraksts</th>
                                <th>Cena</th>
                                <th>Bilde</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>
                            <?php
                            // Fetch each row from the result set
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<tr>";
                                echo "<td>" . $virsraksts . "</td>";
                                echo "<td>" . $teksts . "</td>";
                                echo "<td>$" . $cena . "</td>";
                                ?><td class="profile-pictureicon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="25px" width="25px">
                                        <path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                    </svg>
                                </td>
                                <td class="profile-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" height="25px" width="25px">
                                            <path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/>
                                        </svg>
                                    </a>
                                </td>

                                <td class="profile-delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="25px" width="25px">
                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                    </svg>
                                </td>
                                <?echo "</tr>";
                            }
                            ?>
                    </tbody>
                    </table>
                </div>

            </div>

        </div>
        <?
 } else {
    echo "Oops! Something went wrong. Please try again later.";
}

// Close the statement
mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>


</body>
</html>