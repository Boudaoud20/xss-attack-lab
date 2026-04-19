<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<body>


<div class="navbar">
    <h2>XSS Lab Pro</h2>
</div>

<div class="container">

<div class="card">
<h2>⚡ DOM XSS</h2>

<div id="output"></div>

</div>

</div>

<script>
let input = location.hash.substring(1);

// vulnerable
document.getElementById("output").innerHTML = input;
</script>

</body>
</html>