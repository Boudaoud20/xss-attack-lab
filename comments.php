<?php include "config.php"; ?>

<link rel="stylesheet" href="style.css">
<?php include "config.php"; ?>

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
    $conn->query("INSERT INTO comments(content) VALUES('$comment')");
}

$result = $conn->query("SELECT * FROM comments");

while ($row = $result->fetch_assoc()) {
    echo "<p>" . $row['content'] . "</p>"; // vulnerable
}
?>

</div>

</div>