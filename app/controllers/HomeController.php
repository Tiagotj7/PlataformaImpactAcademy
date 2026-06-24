<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Program;

class HomeController extends Controller
{
  public function index(): void
  {
    $programs = (new Program())->allActive();
    $this->view('home/index', [
      'title' => 'Início',
      'programs' => $programs
    ]);
  }

  public function programs(): void
  {
    $programs = (new Program())->allActive();
    $this->view('home/programs', [
      'title' => 'Programas',
      'programs' => $programs
    ]);
  }
}