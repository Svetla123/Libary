<?php
class Knjige extends controller
{

    public function __construct()
    {
        $this->knjigaModel = $this->model('Knjiga');
    }

    public function index()
    {

        $data = [
            'knjige' => $this->knjigaModel->dohvatiKnjigeSve()

        ];


        $this->view('knjige/index', $data);
    }
}
