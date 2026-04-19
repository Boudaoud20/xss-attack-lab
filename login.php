<?php
if ($_POST) {
    setcookie("session", "admin_session", time()+3600);
    header("Location: dashboard.php");
}
?>
<link rel="stylesheet" href="style.css">
<form method="POST">
    <button>Login</button>
</form>