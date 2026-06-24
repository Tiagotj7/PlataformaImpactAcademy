<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Csrf;
use App\Models\Program;
use App\Models\Module;
use App\Models\Lesson;

class AdminController extends Controller
{
  public function dashboard(): void
  {
    $this->view('admin/dashboard', ['title' => 'Admin']);
  }

  public function programs(): void
  {
    $programs = (new Program())->all();
    $this->view('admin/programs', [
      'title' => 'Programas',
      'programs' => $programs
    ]);
  }

  public function programCreate(): void
  {
    $this->view('admin/program_form', [
      'title' => 'Novo Programa',
      'program' => null
    ]);
  }

  public function programStore(): void
  {
    if (!Csrf::validate($_POST['_csrf'] ?? null)) {
      flash('error', 'CSRF inválido.');
      $this->redirect('admin/programas/novo');
    }

    $nome = trim((string)($_POST['nome'] ?? ''));
    if (!$nome) {
      flash('error', 'Nome é obrigatório.');
      $this->redirect('admin/programas/novo');
    }

    (new Program())->create([
      'nome' => $nome,
      'descricao' => $_POST['descricao'] ?? null,
      'imagem' => $_POST['imagem'] ?? null,
      'status' => $_POST['status'] ?? 'ativo'
    ]);

    flash('success', 'Programa criado.');
    $this->redirect('admin/programas');
  }

  public function programEdit(int $id): void
  {
    $program = (new Program())->find($id);
    if (!$program) {
      flash('error', 'Programa não encontrado.');
      $this->redirect('admin/programas');
    }

    $this->view('admin/program_form', [
      'title' => 'Editar Programa',
      'program' => $program
    ]);
  }

  public function programUpdate(int $id): void
  {
    if (!Csrf::validate($_POST['_csrf'] ?? null)) {
      flash('error', 'CSRF inválido.');
      $this->redirect("admin/programas/$id/editar");
    }

    $nome = trim((string)($_POST['nome'] ?? ''));
    if (!$nome) {
      flash('error', 'Nome é obrigatório.');
      $this->redirect("admin/programas/$id/editar");
    }

    (new Program())->update($id, [
      'nome' => $nome,
      'descricao' => $_POST['descricao'] ?? null,
      'imagem' => $_POST['imagem'] ?? null,
      'status' => $_POST['status'] ?? 'ativo'
    ]);

    flash('success', 'Programa atualizado.');
    $this->redirect('admin/programas');
  }

  public function programDelete(int $id): void
  {
    if (!Csrf::validate($_POST['_csrf'] ?? null)) {
      flash('error', 'CSRF inválido.');
      $this->redirect('admin/programas');
    }

    (new Program())->delete($id);
    flash('success', 'Programa excluído.');
    $this->redirect('admin/programas');
  }

  public function modules(int $programId): void
  {
    $program = (new Program())->find($programId);
    if (!$program) {
      flash('error', 'Programa não encontrado.');
      $this->redirect('admin/programas');
    }

    $modules = (new Module())->byProgram($programId);

    $this->view('admin/modules', [
      'title' => 'Módulos',
      'program' => $program,
      'modules' => $modules
    ]);
  }

  public function moduleCreate(int $programId): void
  {
    $program = (new Program())->find($programId);
    if (!$program) {
      flash('error', 'Programa não encontrado.');
      $this->redirect('admin/programas');
    }

    $this->view('admin/module_form', [
      'title' => 'Novo Módulo',
      'program' => $program
    ]);
  }

  public function moduleStore(int $programId): void
  {
    if (!Csrf::validate($_POST['_csrf'] ?? null)) {
      flash('error', 'CSRF inválido.');
      $this->redirect("admin/programas/$programId/modulos/novo");
    }

    $titulo = trim((string)($_POST['titulo'] ?? ''));
    $ordem = (int)($_POST['ordem'] ?? 0);

    if (!$titulo) {
      flash('error', 'Título é obrigatório.');
      $this->redirect("admin/programas/$programId/modulos/novo");
    }

    (new Module())->create($programId, $titulo, $ordem);
    flash('success', 'Módulo criado.');
    $this->redirect("admin/programas/$programId/modulos");
  }

  public function lessons(int $moduleId): void
  {
    $module = (new Module())->find($moduleId);
    if (!$module) {
      flash('error', 'Módulo não encontrado.');
      $this->redirect('admin/programas');
    }

    $lessons = (new Lesson())->byModuleAll($moduleId);

    $this->view('admin/lessons', [
      'title' => 'Aulas',
      'module' => $module,
      'lessons' => $lessons
    ]);
  }

  public function lessonCreate(int $moduleId): void
  {
    $module = (new Module())->find($moduleId);
    if (!$module) {
      flash('error', 'Módulo não encontrado.');
      $this->redirect('admin/programas');
    }

    $this->view('admin/lesson_form', [
      'title' => 'Nova Aula',
      'module' => $module
    ]);
  }

  public function lessonStore(int $moduleId): void
  {
    if (!Csrf::validate($_POST['_csrf'] ?? null)) {
      flash('error', 'CSRF inválido.');
      $this->redirect("admin/modulos/$moduleId/aulas/novo");
    }

    $titulo = trim((string)($_POST['titulo'] ?? ''));
    if (!$titulo) {
      flash('error', 'Título é obrigatório.');
      $this->redirect("admin/modulos/$moduleId/aulas/novo");
    }

    (new Lesson())->create($moduleId, [
      'titulo' => $titulo,
      'descricao' => $_POST['descricao'] ?? null,
      'video_url' => $_POST['video_url'] ?? null,
      'texto' => $_POST['texto'] ?? null,
      'pdf' => $_POST['pdf'] ?? null,
      'status' => $_POST['status'] ?? 'publicada',
      'ordem' => (int)($_POST['ordem'] ?? 0),
    ]);

    flash('success', 'Aula criada.');
    $this->redirect("admin/modulos/$moduleId/aulas");
  }
}