<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweetcoco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the delete button is clicked
if (isset($_POST['delete_card'])) {
    $card_id = $_POST['card_id'];

    // Prepare SQL to delete the card from database
    $delete_sql = "DELETE FROM wedding_cards WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $card_id);

    // Execute the delete query
    if ($stmt->execute()) {
        echo "<script>alert('Wedding card deleted successfully');</script>";
    } else {
        echo "<script>alert('Failed to delete wedding card');</script>";
    }

    // Redirect back to the same page to refresh the card list
    echo "<script>window.location.href = 'card.php';</script>";
    exit;
}

// Retrieve wedding card data from the database
$sql = "SELECT id, bride_name, groom_name FROM wedding_cards"; // Selecting necessary fields including invitees
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Coco Admin - Wedding cards</title>

    <style>
        #content main {
            width: 100%;
            padding: 0px 0px;
            font-family: var(--poppins);
            max-height: calc(100vh - 56px);
            overflow-y: auto;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 100%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 1.8rem;
            margin-bottom: 20px;
            font-family: var(--poppins) !important;
            color: #212529 !important;
        }

        .wedding-card {
            display: block;
            text-decoration: none;
            color: #333;
            background-color: #fff;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .wedding-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .copy-url {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">Sweet Coco</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="dashboard.php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="create_card.php">
                    <i class='bx bxs-shopping-bag-alt' ></i>
                    <span class="text">Create Wedding cards</span>
                </a>
            </li>
            <li>
                <a href="wish_list.php">
                    <i class='bx bxs-doughnut-chart' ></i>
                    <span class="text">Manage Wishes</span>
                </a>
            </li>
            <li class="active">
                <a href="card.php">
                    <i class='bx bx-list-ul' ></i>
                    <span class="text">Wedding Card List</span>
                </a>
            </li>

            <li>
                <a href="attendance.php">
                    <i class='bx bx-check'></i>
                    <span class="text">Confirmation of Attendance</span>
                </a>
            </li>

            <li>
                <a href="innerreg.php">
                    <i class='bx bxs-group' ></i>
                    <span class="text">Add Admin</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="login.php" class="logout">
                    <i class='bx bxs-log-out-circle' ></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu' ></i>
            <a href="#" class="nav-link">Minimize  </a>
            <form action="#">
                <div class="form-input">
                    <input type="hidden" placeholder="Search...">
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <a href="#" class="notification">
                <i class='bx bxs-bell' ></i>
                <span class="num">0</span>
            </a>
            <a href="#" class="profile">
                <img src="img/people.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="container" style="max-width: 800px">
                <h1>View and Generate Wedding Cards</h1>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $bride_name = $row["bride_name"];
                        $groom_name = $row["groom_name"];

                        // Generate link to the wedding card page with groom's and bride's names and ID
                        echo "<div>";
                        echo "<a class='wedding-card' href='https://sweetcocoaonline.com/wedding_card.php?id=$id&bride=$bride_name&groom=$groom_name' target='_blank'>$bride_name & $groom_name's Wedding</a>";
                        echo "<button class='copy-url' onclick='copyURL(\"$bride_name\", \"$groom_name\", \"$id\")'>Copy URL</button>";
                        echo "<form method='post' style='display: inline-block;'>";
                        echo "<input type='hidden' name='card_id' value='$id'>";
                        echo "<button type='submit' name='delete_card' class='delete-btn'>Delete</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "No wedding cards found.";
                }

                $conn->close();
                ?>
            </div>
        </main>
    </section>
</body>
</html>

<script>
    function copyURL(brideName, groomName, id) {
        const url = `https://sweetcocoaonline.com/wedding_card.php?id=${id}&bride=${brideName}&groom=${groomName}`;
        
        // Copy URL to clipboard
        navigator.clipboard.writeText(url).then(() => {
            alert('URL copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy URL: ', err);
        });
    }
</script>
