<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

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

    // SAFE: no HTML parsing
    document.getElementById("output").textContent = decodeURIComponent(input);
</script>

</body>

</html>