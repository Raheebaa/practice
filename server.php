<?php
// MySQL connection settings
$host = 'localhost';
$db = 'register'; // your database name
$user = 'root';
$pass = '1234';  // <--- Add the password you set here

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $gender = htmlspecialchars($_POST['gender']);
    $phone = htmlspecialchars($_POST['phone']);

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO users (name, email, gender, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $gender, $phone);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='success.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
