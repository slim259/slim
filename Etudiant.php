<?php
class Etudiant {
    private $nom;
    private $notes = [];

    public function __construct($nom, $notes) {
        $this->nom = $nom;
        $this->notes = $notes;
    }

    public function afficherNotesTableau() {
        echo "<td>";
        foreach($this->notes as $note) {
            $style = $note < 10 ? 'background:red;' :
                ($note > 10 ? 'background:green;' : 'background:orange;');
            echo "<div style='$style;padding:5px;margin:2px;text-align:center'>$note</div>";
        }

        $moyenne = $this->calculerMoyenne();
        echo "<div style='border-top:1px solid #000;margin-top:5px;padding-top:3px;'>Moyenne: ".number_format($moyenne, 2)."</div>";
        echo "</td>";
    }

    public function calculerMoyenne() {
        return array_sum($this->notes) / count($this->notes);
    }
}

// TEST
$etudiants = [
    new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]),
    new Etudiant("Skander", [15, 9, 8, 16])
];
?>

<!DOCTYPE html>
<html lang="">
<head>
    <title>Résultats étudiants</title>
    <style>
        table { border-collapse: collapse; width: 300px; }
        th, td { border: 1px solid #ddd; padding: 8px; vertical-align: top; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<table>
    <tr>
        <th>Aymen</th>
        <th>Skander</th>
    </tr>
    <tr>
        <?php
        foreach($etudiants as $etudiant) {
            $etudiant->afficherNotesTableau();
        }
        ?>
    </tr>
</table>
</body>
</html>