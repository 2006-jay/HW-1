<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}
include("db/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $desc = $_POST["description"];
    $subject = $_POST["subject"];
    $file = $_FILES["file"]["name"];
    $target = "uploads/" . basename($file);
    move_uploaded_file($_FILES["file"]["tmp_name"], $target);

    $stmt = $conn->prepare("INSERT INTO notes (user_id, title, description, subject, file_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $_SESSION["user_id"], $title, $desc, $subject, $file);
    $stmt->execute();
    echo "Note uploaded successfully!";
}
?>
<link rel="stylesheet" href="css/style.css">
<form method="POST" enctype="multipart/form-data">
    <h2>Upload Notes</h2>
    <input type="text" name="title" placeholder="Title" required><br>
    <input type="text" name="subject" placeholder="Subject" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="file" name="file" required><br>
    <button type="submit">Upload</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>
