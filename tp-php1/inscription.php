<?php
declare(strict_types=1);

session_start();
require_once __DIR__ . '/fonctions.php';

enum Filiere: string {
    case Info = 'INFO';
    case Math = 'MATH';
    case Phys = 'PHYS';
    case Autre = 'AUTRE';
}

$erreurs = [];
$nom = '';
$email = '';
$age = '';
$filiere = '';
$langages = [];
$message = '';
$reglement = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $filiere = $_POST['filiere'] ?? '';
    $langages = $_POST['langages'] ?? [];
    $message = trim($_POST['message'] ?? '');
    $reglement = isset($_POST['reglement']);

    if (mb_strlen($nom) < 2 || mb_strlen($nom) > 50) {
        $erreurs['nom'] = 'Invalide';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = 'Invalide';
    }

    if (!filter_var($age, FILTER_VALIDATE_INT, ['options' => ['min_range' => 16, 'max_range' => 99]])) {
        $erreurs['age'] = 'Invalide';
    }

    if (Filiere::tryFrom($filiere) === null) {
        $erreurs['filiere'] = 'Invalide';
    }

    $langagesAutorises = ['PHP', 'JS', 'Python'];
    if (empty($langages)) {
        $erreurs['langages'] = 'Invalide';
    } else {
        foreach ($langages as $lang) {
            if (!in_array($lang, $langagesAutorises, true)) {
                $erreurs['langages'] = 'Invalide';
                break;
            }
        }
    }

    if (mb_strlen($message) > 300) {
        $erreurs['message'] = 'Invalide';
    }

    if (!$reglement) {
        $erreurs['reglement'] = 'Invalide';
    }

    if (empty($erreurs)) {
        $_SESSION['succes'] = 'Inscription réussie !';
        header('Location: inscription.php');
        exit;
    }
}

$succes = $_SESSION['succes'] ?? null;
unset($_SESSION['succes']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>

    <?php if ($succes): ?>
        <p style="color: green;"><?= h($succes) ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <p>
            <label>Nom :</label><br>
            <input type="text" name="nom" value="<?= h($nom) ?>">
            <?php if (isset($erreurs['nom'])): ?><span style="color: red;"><?= h($erreurs['nom']) ?></span><?php endif; ?>
        </p>

        <p>
            <label>E-mail :</label><br>
            <input type="email" name="email" value="<?= h($email) ?>">
            <?php if (isset($erreurs['email'])): ?><span style="color: red;"><?= h($erreurs['email']) ?></span><?php endif; ?>
        </p>

        <p>
            <label>Âge :</label><br>
            <input type="number" name="age" value="<?= h($age) ?>">
            <?php if (isset($erreurs['age'])): ?><span style="color: red;"><?= h($erreurs['age']) ?></span><?php endif; ?>
        </p>

        <p>
            <label>Filière :</label><br>
            <select name="filiere">
                <option value="">-- Choisir --</option>
                <?php foreach (Filiere::cases() as $f): ?>
                    <option value="<?= $f->value ?>" <?= $filiere === $f->value ? 'selected' : '' ?>><?= $f->value ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($erreurs['filiere'])): ?><span style="color: red;"><?= h($erreurs['filiere']) ?></span><?php endif; ?>
        </p>

        <p>
            <label>Langages :</label><br>
            <input type="checkbox" name="langages[]" value="PHP" <?= in_array('PHP', $langages, true) ? 'checked' : '' ?>> PHP
            <input type="checkbox" name="langages[]" value="JS" <?= in_array('JS', $langages, true) ? 'checked' : '' ?>> JS
            <input type="checkbox" name="langages[]" value="Python" <?= in_array('Python', $langages, true) ? 'checked' : '' ?>> Python
            <?php if (isset($erreurs['langages'])): ?><br><span style="color: red;"><?= h($erreurs['langages']) ?></span><?php endif; ?>
        </p>

        <p>
            <label>Message :</label><br>
            <textarea name="message"><?= h($message) ?></textarea>
            <?php if (isset($erreurs['message'])): ?><br><span style="color: red;"><?= h($erreurs['message']) ?></span><?php endif; ?>
        </p>

        <p>
            <label>
                <input type="checkbox" name="reglement" value="1" <?= $reglement ? 'checked' : '' ?>> Règlement
            </label>
            <?php if (isset($erreurs['reglement'])): ?><br><span style="color: red;"><?= h($erreurs['reglement']) ?></span><?php endif; ?>
        </p>

        <button type="submit">Valider</button>
    </form>
</body>
</html>