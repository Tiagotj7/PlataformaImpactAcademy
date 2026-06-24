<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Csrf;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Program;
use App\Models\Progress;
use App\Models\XpLog;

class StudentController extends Controller
{
  public function dashboard(): void
  {
    $userId = Auth::id();
    $enroll = new Enrollment();
    $xp = new XpLog();
    $progress = new Progress();

    $programs = $enroll->myPrograms($userId);
    $totalXp = $xp->total($userId);
    $level = $xp->levelFromXp($totalXp);
    $last = $progress->lastCompletedLesson($userId);

    $this->view('student/dashboard', [
      'title' => 'Dashboard',
      'programs' => $programs,
      'xp' => $totalXp,
      'level' => $level,
      'last' => $last
    ]);
  }

  public function myPrograms(): void
  {
    $userId = Auth::id();
    $programs = (new Enrollment())->myPrograms($userId);

    // Se não estiver matriculado em nada, matricula automaticamente em todos ativos (MVP)
    if (!$programs) {
      $all = (new Program())->allActive();
      $en = new Enrollment();
      foreach ($all as $p) $en->enroll($userId, (int)$p['id']);
      $programs = $en->myPrograms($userId);
    }

    $this->view('student/my_programs', [
      'title' => 'Meus Programas',
      'programs' => $programs
    ]);
  }

  public function program(int $id): void
  {
    $userId = Auth::id();
    $program = (new Program())->find($id);
    if (!$program) {
      flash('error', 'Programa não encontrado.');
      $this->redirect('meus-programas');
    }

    $enroll = new Enrollment();
    if (!$enroll->isEnrolled($userId, $id)) {
      // MVP: auto-matricula ao acessar
      $enroll->enroll($userId, $id);
    }

    $modules = (new Module())->byProgram($id);
    $lessonModel = new Lesson();

    $this->view('student/program', [
      'title' => $program['nome'],
      'program' => $program,
      'modules' => $modules,
      'lessonModel' => $lessonModel,
    ]);
  }

  public function lesson(int $id): void
  {
    $lesson = (new Lesson())->find($id);
    if (!$lesson) {
      flash('error', 'Aula não encontrada.');
      $this->redirect('dashboard');
    }

    $completed = (new Progress())->isLessonCompleted(Auth::id(), $id);

    $this->view('student/lesson', [
      'title' => $lesson['titulo'],
      'lesson' => $lesson,
      'completed' => $completed,
    ]);
  }

  public function concludeLesson(int $id): void
  {
    if (!Csrf::validate($_POST['_csrf'] ?? null)) {
      flash('error', 'CSRF inválido.');
      $this->redirect("aula/$id");
    }

    $userId = Auth::id();
    $progress = new Progress();
    $xp = new XpLog();

    $lesson = (new Lesson())->find($id);
    if (!$lesson) {
      flash('error', 'Aula não encontrada.');
      $this->redirect('dashboard');
    }

    $inserted = $progress->completeLesson($userId, $id);
    if ($inserted) {
      // Regra V1: concluir aula = +10
      $xp->add($userId, 'AULA_CONCLUIDA', $id, 10);
      flash('success', 'Aula concluída! +10 XP');
    } else {
      flash('success', 'Aula já estava concluída.');
    }

    $this->redirect("aula/$id");
  }

  public function ranking(): void
  {
    $xp = new XpLog();
    $top = $xp->top10();

    $this->view('student/ranking', [
      'title' => 'Ranking',
      'top' => $top,
      'xpModel' => $xp
    ]);
  }
}