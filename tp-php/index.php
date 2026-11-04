<?php
declare(strict_types=1);
$prenom = 'Joany';
$dateDuJour = date('d/m/Y');
$langages = ['Python', 'JAVA', 'SQL'];

?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"><title>Bonjour PHP</title></head>
<body>

<h1>Exercice 1</h1>
<h2>Bonjour <?= $prenom ?> !</h1>
    <p>Nous sommes le <?= $dateDuJour ?>.</p>
    
    <h2>Mes langages préférés :</h2>
    <ul>
        <?php foreach ($langages as $langage): ?>
            <li><?= $langage ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>