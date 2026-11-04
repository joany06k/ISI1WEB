<?php
declare(strict_types=1);

require_once __DIR__ . '/modele.php';

$etudiants = [
    new Etudiant('Ada', 17.5),
    new Etudiant('Alan', 14.0),
    new Etudiant('Grace', 9.5)
];

$erreurReadonly = '';
try {
    $etudiants[0]->note = 20; 
} catch (Error $e) {
    $erreurReadonly = "Tentative de modification interdite.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Exercice 4</title>
</head>
<body>
    <p style="color: red;"><?= $erreurReadonly ?></p>
    
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Note</th>
            <th>Mention</th>
            <th>Admis</th>
        </tr>
        <?php foreach ($etudiants as $etudiant): ?>
            <tr>
                <td><?= $etudiant->nom ?></td>
                <td><?= $etudiant->note ?></td>
                <td><?= $etudiant->mention()->value ?></td>
                <td><?= $etudiant->estAdmis() ? 'Oui' : 'Non' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>