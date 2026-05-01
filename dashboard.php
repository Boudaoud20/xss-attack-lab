<?php
$session = $_COOKIE['session'] ?? 'none';
?>

<link rel="stylesheet" href="style.css">

<h1>Dashboard</h1>
<p>Cookie: <?php echo htmlspecialchars($session, ENT_QUOTES, 'UTF-8'); ?></p>