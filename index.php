<?php echo 'yes we did'; ?>
<?php
require __DIR__ . "/src/Newsletter.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $age = (int)($_POST["age"] ?? 0);
    $email = $_POST["email"] ?? "";

    if (isAdult($age) && isValidEmail($email)) {
        $message = "Inscription acceptée";
    } else {
        $message = "Inscription refusée";
    }
}
?>
<form method="post">
  <p><label>age : <input id="age" name="age" type="number"></label></p>
  <p><label>email : <input id="email" name="email" type="text"></Label></p>
  <button id="btn" type="submit">Envoyer</button>
</form>
<p id="result"><?= htmlspecialchars($message) ?></p>

