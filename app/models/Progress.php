<?php
namespace App\Models;

use App\Core\Database;

class Progress
{
  public function isLessonCompleted(int $userId, int $lessonId): bool
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT 1 FROM progresso WHERE usuario_id=:u AND aula_id=:a LIMIT 1");
    $st->execute(['u'=>$userId,'a'=>$lessonId]);
    return (bool)$st->fetchColumn();
  }

  public function completeLesson(int $userId, int $lessonId): bool
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("INSERT IGNORE INTO progresso (usuario_id,aula_id,concluido) VALUES (:u,:a,1)");
    $st->execute(['u'=>$userId,'a'=>$lessonId]);
    return $st->rowCount() > 0; // true se inseriu agora
  }

  public function completedCountByProgram(int $userId, int $programId): int
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT COUNT(*) as c
      FROM progresso pr
      JOIN aulas a ON a.id=pr.aula_id
      JOIN modulos m ON m.id=a.modulo_id
      WHERE pr.usuario_id=:u AND m.programa_id=:pid");
    $st->execute(['u'=>$userId,'pid'=>$programId]);
    return (int)($st->fetch()['c'] ?? 0);
  }

  public function lastCompletedLesson(int $userId): ?array
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT a.id, a.titulo, pr.completed_at
      FROM progresso pr
      JOIN aulas a ON a.id=pr.aula_id
      WHERE pr.usuario_id=:u
      ORDER BY pr.completed_at DESC
      LIMIT 1");
    $st->execute(['u'=>$userId]);
    $row = $st->fetch();
    return $row ?: null;
  }
}