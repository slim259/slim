<?php
require_once 'config.php';
require_once 'classes/User.php';

$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $authUser = $user->authenticate($username, $password);

    if ($authUser) {
        session_start();
        $_SESSION['user'] = $authUser;
        header('Location: listStudents.php');
        exit();
    } else {
        $error = "Identifiants incorrects";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
<h1>Connexion</h1>
<?php if (isset($error)): ?>
    <p style="color: red;"><?= $error ?></p>
<?php endif; ?>
<form method="POST">
    <div>
        <label>Nom d'utilisateur:</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label>Mot de passe:</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Se connecter</button>
</form>
</body>
</html>
