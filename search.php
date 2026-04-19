<?php
$q = $_GET['q'] ?? '';
?>
<link rel="stylesheet" href="style.css">

<div class="navbar">
    <h2>XSS Lab Pro</h2>
</div>

<div class="container">

<div class="card">
<h2>🔎 Search</h2>

<form>
    <input name="q" placeholder="Search...">
    <button>Search</button>
</form>

<?php
$q = $_GET['q'] ?? '';
?>

<p>Results for: <?php echo $q; ?></p> <!-- vulnerable -->

</div>

</div>