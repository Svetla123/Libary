<?php
class Prevoditelji extends controller
{

    public function __construct()
    {
        $this->prevoditeljModel = $this->model('Prevoditelj');
        $this->prevodiModel = $this->model('Prevodi');
    }

    public function index()
    {

        $data = [
            'prevoditelji' => $this->prevoditeljModel->dohvatiPrevoditelje(),
            'jezici' =>  $this->prevodiModel->pronadiJezike(),
        ];

        $this->view('prevoditelji/index', $data);
    }
}
