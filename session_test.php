<?php
require_once 'SessionManager.php';

$session = new SessionManager();
$session->incrementVisit();

if (isset($_POST['reset'])) {
    $session->resetSession();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Sessions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .message {
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c82333;
        }
        .debug {
            margin-top: 30px;
            padding: 10px;
            background-color: #e9ecef;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
<h1>Gestion des Visites</h1>

<div class="message">
    <?php echo $session->getWelcomeMessage(); ?>
</div>

<form method="post">
    <button type="submit" name="reset">Réinitialiser la session</button>
</form>

<div class="debug">
    <h3>Debug Info :</h3>
    <pre><?php print_r($session->getSessionData()); ?></pre>
</div>
</body>
</html>