<?php
class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home/index');
    }

    public function programs(): void
    {
        $this->view('home/programs');
    }
}
