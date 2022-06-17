<?php
class Inventari extends controller
{

    public function __construct()
    {
        $this->inventarModel = $this->model('Inventar');
        $this->posdbaModel = $this->model('Posudba');
    }

    public function index()
    {

        $data = [
            'inventar' => $this->inventarModel->dohvatiInventar(),
            'posudbe' => $this->posdbaModel->pronadiPosudbe(),
            'trenutnaPosudba' => $this->posdbaModel->trenutnaPosudba(),
        ];


        $this->view('inventari/index', $data);
    }
}
