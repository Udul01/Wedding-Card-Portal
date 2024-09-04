<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $name = $_POST['name'];
    $attendance = $_POST['attendance'];
    $attendance_count = $_POST['attendance_count']; // Make sure this matches the form field name
    $wish = $_POST['wish'];
    $card_id = $_POST['card_id']; // Assuming you have a hidden input field in your form containing the wedding card ID

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sweetcoco";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into the Attendance table
    $sql = $conn->prepare("INSERT INTO Attendance (card_id, name, attendance, attendance_count, wish) VALUES (?, ?, ?, ?, ?)");

    // Bind parameters
    $sql->bind_param("issis", $card_id, $name, $attendance, $attendance_count, $wish);

    // Execute the query
    if ($sql->execute()) {
        // Set success message
        $success_message = "Attendance and wish added successfully";
        // Redirect to the same wedding card page after a delay
        echo "<script>setTimeout(function() {
            window.location.href = 'wedding_card.php?id=$card_id';
        }, 1500);</script>";
    } else {
        echo "Error inserting record: " . $conn->error;
    }

    // Close prepared statement
    $sql->close();

    // Close connection
    $conn->close();
}
?>
