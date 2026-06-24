<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
  public function findByEmail(string $email): ?array
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
    $st->execute(['email' => $email]);
    $row = $st->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
  }

  public function create(string $nome, string $email, string $senhaHash): int
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("INSERT INTO usuarios (nome,email,senha,tipo,status) VALUES (:n,:e,:s,'aluno','ativo')");
    $st->execute(['n'=>$nome,'e'=>$email,'s'=>$senhaHash]);
    return (int)$pdo->lastInsertId();
  }

  public function find(int $id): ?array
  {
    $pdo = Database::pdo();
    $st = $pdo->prepare("SELECT id,nome,email,foto,tipo,status,created_at FROM usuarios WHERE id = :id");
    $st->execute(['id' => $id]);
    $row = $st->fetch();
    return $row ?: null;
  }
}