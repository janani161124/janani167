<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = $_SESSION['user_id'];

    $sql = "INSERT INTO news (title, content, author_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $content, $author_id);
    $stmt->execute();
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Manage News</h1>
    <form method="POST" action="">
        Title: <input type="text" name="title" required><br>
        Content: <textarea name="content" required></textarea><br>
        <button type="submit">Add News</button>
    </form>
    
    <h2>News List</h2>
    <?php
    $sql = "SELECT * FROM news ORDER BY created_at DESC";
    $result = $conn->query($sql);
    
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['content'] . "</p>";
        echo "<p>Posted on: " . $row['created_at'] . "</p>";
        echo "</div>";
    }
    ?>
</body>
</html>
