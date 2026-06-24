<?php
class AdminController extends Controller
{
    public function dashboard(): void
    {
        $this->view('admin/dashboard');
    }

    public function programs(): void
    {
        $this->view('admin/programs');
    }

    public function programForm(): void
    {
        $this->view('admin/program_form');
    }

    public function modules(): void
    {
        $this->view('admin/modules');
    }

    public function moduleForm(): void
    {
        $this->view('admin/module_form');
    }

    public function lessons(): void
    {
        $this->view('admin/lessons');
    }

    public function lessonForm(): void
    {
        $this->view('admin/lesson_form');
    }
}
