<?php 
class Clanarine extends controller {

    public function __construct () {
        $this->clanarineModel = $this->model('Clanarina');
    }

    public function index () {

        $data = [
            'clanarine' => $this->clanarineModel->dohvatiClanarine()
        ];


        $this->view('clanarine/index', $data);
    }
}