<?php
declare(strict_types=1);

function moyenne(array $notes): float {
    if (count($notes) === 0) {
        return 0.0;
    }
    return array_sum($notes) / count($notes);
}

function estAdmis(float $note, float $seuil = 10.0): bool {
    return $note >= $seuil;
}

function meilleurEtudiant(array $notes): ?string {
    if (count($notes) === 0) {
        return null;
    }
    $noteMax = max($notes);
    return array_search($noteMax, $notes);
}

function h(string $string): string {
    return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
//test