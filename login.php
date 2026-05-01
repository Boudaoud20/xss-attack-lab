<?php
if ($_POST) {
    setcookie("session", "admin_session", [
        'expires' => time()+3600,
        'httponly' => true,
        'secure' => false, // set true if using HTTPS
        'samesite' => 'Strict'
    ]);

    header("Location: dashboard.php");
    exit();
}
?>
<link rel="stylesheet" href="style.css">

<form method="POST">
    <button>Login</button>
</form>