<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>News Portal</title>
</head>
<body>
    <h1>Latest News</h1>
    <?php
    $sql = "SELECT * FROM news ORDER BY created_at DESC";
    $result = $conn->query($sql);
    
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<p>" . $row['content'] . "</p>";
        echo "<p>Posted on: " . $row['created_at'] . "</p>";
        echo "</div>";
    }
    ?>
</body>
</html>
