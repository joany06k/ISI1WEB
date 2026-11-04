<?php
declare(strict_types=1);

$prenom = $_POST['prenom'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Exercice 5 - POST</title>
</head>
<body>
    <?php if ($prenom !== ''): ?>
        <h1>Bonjour <?= htmlspecialchars($prenom, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> !</h1>
    <?php else: ?>
        <form method="post" action="">
            <label>Prénom :</label>
            <input type="text" name="prenom" required>
            <button type="submit">Envoyer</button>
        </form>
    <?php endif; ?>
</body>
</html>