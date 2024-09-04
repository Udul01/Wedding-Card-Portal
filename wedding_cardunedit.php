
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        p {
            color: #666;
        }
        iframe {
            margin-top: 20px;
            display: block;
            width: 100%;
            height: 400px;
            border: 0;
            border-radius: 5px;
        }
        img {
            display: block;
            margin-top: 20px;
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        form {
            margin-top: 20px;
            text-align: center;
        }
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            resize: vertical;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .wishes {
            margin-top: 20px;
        }
        .wish {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .wish p {
            margin: 0;
        }
        .approve-btn, .reject-btn {
            padding: 5px 10px;
            margin-right: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .approve-btn {
            background-color: #4CAF50;
            color: white;
        }

        .reject-btn {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Wedding Card</h1>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sweetcoco";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Function to update wish status
        function updateWishStatus($conn, $id, $status) {
            $sql_update = "UPDATE wedding_cards SET status = $status WHERE id = $id";
            if ($conn->query($sql_update) === TRUE) {
                echo "Wish status updated successfully";
            } else {
                echo "Error updating wish status: " . $conn->error;
            }
        }

        // Check if approve or reject button clicked
        if (isset($_GET['action']) && isset($_GET['id'])) {
            $action = $_GET['action'];
            $id = $_GET['id'];
            if ($action == 'approve') {
                updateWishStatus($conn, $id, 1); // Set status to approved (1)
            } elseif ($action == 'reject') {
                updateWishStatus($conn, $id, 0); // Set status to rejected (0)
            }
        }

        // Retrieve wedding card data based on ID from the URL
        $id = $_GET['id'];
        $sql = "SELECT * FROM wedding_cards WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output the wedding card
            $row = $result->fetch_assoc();
            // Your code to display the wedding card details goes here
            echo "<h2>" . $row['bride_name'] . " & " . $row['groom_name'] . "'s Wedding</h2>";
            echo "<p>Son of " . $row['groom_father_name'] . " & " . $row['groom_mother_name'] . "</p>";
            echo "<p>Daughter of " . $row['bride_father_name'] . " & " . $row['bride_mother_name'] . "</p>";
            echo "<p>Poruwa Ceremony Time: " . $row['poruwa_ceremony_time'] . "</p>";
            echo "<p>Going Away Time: " . $row['going_away_time'] . "</p>";
            echo "<iframe src='" . $row['location'] . "' frameborder='0' allowfullscreen='' aria-hidden='false' tabindex='0'></iframe>";
            echo "<img src='" . $row['pre_shoot_image1'] . "' alt='Pre-shoot Image 1'>";
            echo "<img src='" . $row['pre_shoot_image2'] . "' alt='Pre-shoot Image 2'>";
            // Form for adding wishes
            echo "<form action='process_wish.php' method='POST'>";
            echo "<input type='hidden' name='card_id' value='" . $_GET['id'] . "'>";
            echo "<label for='wish'>Your Wish:</label>";
            echo "<textarea id='wish' name='wish' rows='4' placeholder='Add your wish to the couple...' required></textarea><br>";
            echo "<button type='submit'>Submit Wish</button>";
            echo "</form>";

            // Display wishes for this wedding card with status 1 (approved)
            $sql_wishes = "SELECT * FROM wedding_cards WHERE id = $id AND status = 1 AND wishes IS NOT NULL";
            $result_wishes = $conn->query($sql_wishes);

            if ($result_wishes->num_rows > 0) {
                echo "<div class='wishes'>";
                echo "<h2> Wishes</h2>";
                while ($row_wish = $result_wishes->fetch_assoc()) {
                    echo "<div class='wish'>";
                    echo "<p>" . $row_wish['wishes'] . "</p>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p>No approved wishes yet.</p>";
            }
        } else {
            echo "Wedding card not found.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
