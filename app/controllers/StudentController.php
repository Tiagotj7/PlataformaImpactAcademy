<?php
class StudentController extends Controller
{
    public function dashboard(): void
    {
        $this->view('student/dashboard');
    }

    public function myPrograms(): void
    {
        $this->view('student/my_programs');
    }

    public function program(): void
    {
        $this->view('student/program');
    }

    public function lesson(): void
    {
        $this->view('student/lesson');
    }

    public function ranking(): void
    {
        $this->view('student/ranking');
    }
}
