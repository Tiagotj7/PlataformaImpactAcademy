<?php
namespace App\Models;

use App\Core\Database;

class Enrollment
{
  public function enroll(int $userId, int $programId): void
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("INSERT IGNORE INTO matriculas (usuario_id,programa_id) VALUES (:u,:p)");
    $st->execute(['u'=>$userId,'p'=>$programId]);
  }

  public function myPrograms(int $userId): array
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT p.*
      FROM matriculas m
      JOIN programas p ON p.id=m.programa_id
      WHERE m.usuario_id=:u
      ORDER BY m.created_at DESC");
    $st->execute(['u'=>$userId]);
    return $st->fetchAll();
  }

  public function isEnrolled(int $userId, int $programId): bool
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT 1 FROM matriculas WHERE usuario_id=:u AND programa_id=:p LIMIT 1");
    $st->execute(['u'=>$userId,'p'=>$programId]);
    return (bool)$st->fetchColumn();
  }
}