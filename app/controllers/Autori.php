<?php
class Autori extends controller
{

    public function __construct()
    {
        $this->autorModel = $this->model('Autor');
        $this->autorstvoKnjigeModel = $this->model('AutorstvoKnjige');
    }

    public function index()
    {

        $data = [
            'autori' => $this->autorModel->dohvatiAutore(),
            'autorstva' => $this->autorstvoKnjigeModel->dohvatiAutorstva(),
        ];

        $this->view('autori/index', $data);
    }
}
