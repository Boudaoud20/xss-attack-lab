<?php include "config.php"; ?>

<link rel="stylesheet" href="style.css">

<div class="navbar">
    <h2>XSS Lab Pro</h2>
</div>

<div class="container">

<div class="card">
<h2>💬 Comments</h2>

<form method="POST">
    <input name="comment" placeholder="Write comment...">
    <button>Post</button>
</form>
</div>

<div class="card">

<?php
if ($_POST) {
    $comment = $_POST['comment'];

    // Prevent SQL Injection
    $stmt = $conn->prepare("INSERT INTO comments(content) VALUES(?)");
    $stmt->bind_param("s", $comment);
    $stmt->execute();
}

$result = $conn->query("SELECT * FROM comments");

while ($row = $result->fetch_assoc()) {
    // Prevent XSS
    echo "<p>" . htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8') . "</p>";
}
?>

</div>
</div>