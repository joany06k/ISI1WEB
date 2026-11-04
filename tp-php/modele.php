-<?php
declare(strict_types=1);

enum Mention: string {
    case Ajourne = 'Ajourné';
    case Passable = 'Passable';
    case Bien = 'Bien';
    case TresBien = 'Très bien';
}

final readonly class Etudiant {
    public function __construct(
        public string $nom,
        public float $note
    ) {}

    public function mention(): Mention {
        return match (true) {
            $this->note >= 16 => Mention::TresBien,
            $this->note >= 14 => Mention::Bien,
            $this->note >= 10 => Mention::Passable,
            default => Mention::Ajourne,
        };
    }

    public function estAdmis(): bool {
        return $this->note >= 10;
    }
}