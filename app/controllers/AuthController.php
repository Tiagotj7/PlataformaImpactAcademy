<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Csrf;
use App\Models\User;

class AuthController extends Controller
{
  public function showLogin(): void
  {
    $this->view('auth/login', ['title' => 'Login']);
  }

  public function login(): void
  {
    if (!Csrf::validate($_POST['_csrf'] ?? null)) {
      flash('error', 'CSRF inválido.');
      $this->redirect('login');
    }

    $email = trim((string)($_POST['email'] ?? ''));
    $senha = (string)($_POST['senha'] ?? '');

    if (!$email || !$senha) {
      flash('error', 'Informe email e senha.');
      $this->redirect('login');
    }

    if (!Auth::attempt($email, $senha)) {
      flash('error', 'Credenciais inválidas.');
      $this->redirect('login');
    }

    $u = Auth::user();
    if (($u['tipo'] ?? '') === 'admin') $this->redirect('admin');
    $this->redirect('dashboard');
  }

  public function showRegister(): void
  {
    $this->view('auth/register', ['title' => 'Cadastro']);
  }

  public function register(): void
  {
    if (!Csrf::validate($_POST['_csrf'] ?? null)) {
      flash('error', 'CSRF inválido.');
      $this->redirect('cadastro');
    }

    $nome  = trim((string)($_POST['nome'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $senha = (string)($_POST['senha'] ?? '');

    if (!$nome || !$email || strlen($senha) < 6) {
      flash('error', 'Preencha nome, email e uma senha (mín. 6).');
      $this->redirect('cadastro');
    }

    $userModel = new User();
    if ($userModel->findByEmail($email)) {
      flash('error', 'Email já cadastrado.');
      $this->redirect('cadastro');
    }

    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $userId = $userModel->create($nome, $email, $hash);

    // Login automático
    Auth::attempt($email, $senha);
    flash('success', 'Cadastro realizado com sucesso.');
    $this->redirect('dashboard');
  }

  public function logout(): void
  {
    if (!Csrf::validate($_POST['_csrf'] ?? null)) {
      flash('error', 'CSRF inválido.');
      $this->redirect('');
    }

    Auth::logout();
    $this->redirect('');
  }
}