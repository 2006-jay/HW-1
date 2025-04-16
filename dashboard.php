<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}
include("db/config.php");

$result = $conn->query("SELECT notes.*, users.name FROM notes JOIN users ON notes.user_id = users.id ORDER BY upload_date DESC");
?>
<link rel="stylesheet" href="css/style.css">
<h2>Welcome, <?= $_SESSION["name"] ?> | <a href="upload.php">Upload Notes</a> | <a href="logout.php">Logout</a></h2>
<table border="1">
    <tr><th>Title</th><th>Subject</th><th>Uploaded By</th><th>File</th></tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row["title"] ?></td>
            <td><?= $row["subject"] ?></td>
            <td><?= $row["name"] ?></td>
            <td><a href="uploads/<?= $row["file_path"] ?>" download>Download</a></td>
        </tr>
    <?php } ?>
</table>
