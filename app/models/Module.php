<?php
namespace App\Models;

use App\Core\Database;

class Module
{
  public function byProgram(int $programId): array
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT * FROM modulos WHERE programa_id=:pid ORDER BY ordem ASC, id ASC");
    $st->execute(['pid'=>$programId]);
    return $st->fetchAll();
  }

  public function find(int $id): ?array
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT * FROM modulos WHERE id=:id");
    $st->execute(['id'=>$id]);
    $row = $st->fetch();
    return $row ?: null;
  }

  public function create(int $programId, string $titulo, int $ordem): int
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("INSERT INTO modulos (programa_id,titulo,ordem) VALUES (:pid,:t,:o)");
    $st->execute(['pid'=>$programId,'t'=>$titulo,'o'=>$ordem]);
    return (int)$pdo->lastInsertId();
  }
}