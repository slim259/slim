<?php
require_once 'config.php';
require_once 'classes/User.php';
require_once 'classes/Student.php';

session_start();


if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: listStudents.php');
    exit();
}

$student = new Student($pdo);
$studentDetails = $student->findById($_GET['id']);

if (!$studentDetails) {
    header('Location: listStudents.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Détails de l'Étudiant</title>
</head>
<body>
<h1>Détails de l'Étudiant</h1>
<p>ID: <?= htmlspecialchars($studentDetails['id']) ?></p>
<p>Nom: <?= htmlspecialchars($studentDetails['name']) ?></p>
<p>Date de naissance: <?= htmlspecialchars($studentDetails['birthday']) ?></p>
<a href="listStudents.php">Retour à la liste</a>
</body>
</html>