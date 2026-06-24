<?php
namespace App\Models;

use App\Core\Database;

class Lesson
{
  public function byModule(int $moduleId): array
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT * FROM aulas WHERE modulo_id=:mid AND status='publicada' ORDER BY ordem ASC, id ASC");
    $st->execute(['mid'=>$moduleId]);
    return $st->fetchAll();
  }

  public function byModuleAll(int $moduleId): array
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT * FROM aulas WHERE modulo_id=:mid ORDER BY ordem ASC, id ASC");
    $st->execute(['mid'=>$moduleId]);
    return $st->fetchAll();
  }

  public function find(int $id): ?array
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT a.*, m.programa_id
                         FROM aulas a
                         JOIN modulos m ON m.id=a.modulo_id
                         WHERE a.id=:id");
    $st->execute(['id'=>$id]);
    $row = $st->fetch();
    return $row ?: null;
  }

  public function create(int $moduleId, array $data): int
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("INSERT INTO aulas
      (modulo_id,titulo,descricao,video_url,texto,pdf,status,ordem)
      VALUES (:mid,:t,:d,:v,:tx,:p,:s,:o)");
    $st->execute([
      'mid'=>$moduleId,
      't'=>$data['titulo'],
      'd'=>$data['descricao'] ?? null,
      'v'=>$data['video_url'] ?? null,
      'tx'=>$data['texto'] ?? null,
      'p'=>$data['pdf'] ?? null,
      's'=>$data['status'] ?? 'publicada',
      'o'=>(int)($data['ordem'] ?? 0),
    ]);
    return (int)$pdo->lastInsertId();
  }

  public function countLessonsByProgram(int $programId): int
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT COUNT(*) as c
      FROM aulas a
      JOIN modulos m ON m.id=a.modulo_id
      WHERE m.programa_id=:pid AND a.status='publicada'");
    $st->execute(['pid'=>$programId]);
    return (int)($st->fetch()['c'] ?? 0);
  }
  public function update(int $id, array $data): void
{
  $pdo = Database::pdo();
  $st = $pdo->prepare("UPDATE aulas SET
    titulo=:t, descricao=:d, video_url=:v, texto=:tx, pdf=:p, status=:s, ordem=:o
    WHERE id=:id
  ");
  $st->execute([
    'id'=>$id,
    't'=>$data['titulo'],
    'd'=>$data['descricao'] ?? null,
    'v'=>$data['video_url'] ?? null,
    'tx'=>$data['texto'] ?? null,
    'p'=>$data['pdf'] ?? null,
    's'=>$data['status'] ?? 'publicada',
    'o'=>(int)($data['ordem'] ?? 0),
  ]);
}

public function delete(int $id): void
{
  $pdo = Database::pdo();
  $st = $pdo->prepare("DELETE FROM aulas WHERE id=:id");
  $st->execute(['id'=>$id]);
}
}
