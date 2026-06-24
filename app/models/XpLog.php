<?php
namespace App\Models;

use App\Core\Database;

class XpLog
{
  public function add(int $userId, string $tipo, ?int $refId, int $pontos): void
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("INSERT INTO xp_logs (usuario_id,tipo,referencia_id,pontos) VALUES (:u,:t,:r,:p)");
    $st->execute(['u'=>$userId,'t'=>$tipo,'r'=>$refId,'p'=>$pontos]);
  }

  public function total(int $userId): int
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT COALESCE(SUM(pontos),0) as total FROM xp_logs WHERE usuario_id=:u");
    $st->execute(['u'=>$userId]);
    return (int)($st->fetch()['total'] ?? 0);
  }

  public function top10(): array
  {
    $pdo = Database::pdo();
    return $pdo->query("
      SELECT u.id, u.nome, COALESCE(SUM(x.pontos),0) as xp
      FROM usuarios u
      LEFT JOIN xp_logs x ON x.usuario_id=u.id
      WHERE u.tipo='aluno' AND u.status='ativo'
      GROUP BY u.id
      ORDER BY xp DESC
      LIMIT 10
    ")->fetchAll();
  }

  public function levelFromXp(int $xp): string
  {
    if ($xp >= 10000) return 'Lendário';
    if ($xp >= 5000)  return 'Olímpico';
    if ($xp >= 2500)  return 'Ouro';
    if ($xp >= 1000)  return 'Prata';
    return 'Bronze';
  }
}