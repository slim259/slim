<?php
require_once 'config.php';
require_once 'classes/User.php';
require_once 'classes/Student.php';

session_start();


if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$student = new Student($pdo);
$students = $student->findAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Étudiants</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>
<body>
<h1>Liste des Étudiants</h1>
<table id="studentsTable">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Date de naissance</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $s): ?>
        <tr>
            <td><?= htmlspecialchars($s['id']) ?></td>
            <td><?= htmlspecialchars($s['name']) ?></td>
            <td><?= htmlspecialchars($s['birthday']) ?></td>
            <td>
                <a href="detailEtudiant.php?id=<?= $s['id'] ?>">Détails</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#studentsTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'csv', 'pdf'
            ]
        });
    });
</script>
</body>
</html>