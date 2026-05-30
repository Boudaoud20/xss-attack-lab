<?php
$q = $_GET['q'] ?? '';
$safe_q = htmlspecialchars($q, ENT_QUOTES, 'UTF-8');
?>

<link rel="stylesheet" href="style.css">

<div class="navbar">
    <h2>XSS Lab Pro</h2>
</div>

<div class="container">

<div class="card">
<h2>🔎 Search</h2>

<form method="GET">
    <input name="q" placeholder="Search...">
    <button>Search</button>
</form>

<p>Results for: <?php echo $safe_q; ?></p>

</div>
</div>