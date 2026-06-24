<?php
namespace App\Models;

use App\Core\Database;

class Program
{
  public function allActive(): array
  {
    $pdo = Database::pdo();
    return $pdo->query("SELECT * FROM programas WHERE status='ativo' ORDER BY id DESC")->fetchAll();
  }

  public function all(): array
  {
    $pdo = Database::pdo();
    return $pdo->query("SELECT * FROM programas ORDER BY id DESC")->fetchAll();
  }

  public function find(int $id): ?array
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT * FROM programas WHERE id=:id");
    $st->execute(['id'=>$id]);
    $row = $st->fetch();
    return $row ?: null;
  }

  public function create(array $data): int
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("INSERT INTO programas (nome,descricao,imagem,status) VALUES (:n,:d,:i,:s)");
    $st->execute([
      'n'=>$data['nome'],
      'd'=>$data['descricao'] ?? null,
      'i'=>$data['imagem'] ?? null,
      's'=>$data['status'] ?? 'ativo'
    ]);
    return (int)$pdo->lastInsertId();
  }

  public function update(int $id, array $data): void
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("UPDATE programas SET nome=:n, descricao=:d, imagem=:i, status=:s WHERE id=:id");
    $st->execute([
      'id'=>$id,
      'n'=>$data['nome'],
      'd'=>$data['descricao'] ?? null,
      'i'=>$data['imagem'] ?? null,
      's'=>$data['status'] ?? 'ativo'
    ]);
  }

  public function delete(int $id): void
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("DELETE FROM programas WHERE id=:id");
    $st->execute(['id'=>$id]);
  }
}