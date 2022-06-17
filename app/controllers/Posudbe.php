<?php
class Posudbe extends controller
{

    public function __construct()
    {
        $this->posudbaModel = $this->model('Posudba');
        $this->clanKnjizniceModel = $this->model('ClanKnjiznice');
        $this->inventarModel = $this->model('Inventar');
        $this->clanarinaModel = $this->model('Clanarina');
    }

    public function index()
    {
        $posudbe = $this->posudbaModel->dohvatiPosudbe();
        $clanoviKnjiznice = $this->clanKnjizniceModel->dohvatiClanove();
        $slobodneKnjige = $this->inventarModel->pronadiSlobodneKnjigeUInventaru();
        $brojPosudbe = $this->posudbaModel->pronadiBrojPosudbe();
        $data = [
            'posudbe' => $posudbe,
            'clanoviKnjiznice' => $clanoviKnjiznice,
            'slobodneKnjige' => $slobodneKnjige,
            'brojPosudbe' => $brojPosudbe,

            'datum_posudbe' => '',
            'clan_knjiznice_ID' => '',
            'inventarni_broj_ID' => '',

            'datum_posudbeError' => '',
            'clan_knjiznice_IDError' => '',
            'inventarni_broj_IDError' => '',
            'clanarinaError' => '',
            'datum_vracanjaError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $clan_knjiznice_ID = trim($_POST['clan_knjiznice_ID']);
            $inventarni_broj_ID = trim($_POST['inventarni_broj_ID']);
            $data = [
                'posudbe' => $posudbe,
                'clanoviKnjiznice' => $clanoviKnjiznice,
                'slobodneKnjige' => $slobodneKnjige,
                'brojPosudbe' => $brojPosudbe,

                'datum_posudbe' => trim($_POST['datum_posudbe']),
                'clan_knjiznice_ID' => preg_replace('/\D/', '', $clan_knjiznice_ID),
                'inventarni_broj_ID' => trim(preg_replace('/\D/', '', $inventarni_broj_ID)),

                'datum_vracanjaError' => '',

                'datum_posudbeError' => '',
                'clan_knjiznice_IDError' => '',
                'inventarni_broj_IDError' => '',
                'clanarinaError' => '',

            ];

            if ($data['datum_posudbe'] == "") {
                $data['datum_posudbeError'] = "Unesite datum posudbe!";
            }

            if (empty($data['clan_knjiznice_ID'])) {
                $data['clan_knjiznice_IDError'] = "Unesite člana knjižnice!";
            } else if ($this->clanarinaModel->provjeriClanarinu($data['clan_knjiznice_ID']) == FALSE) {
                $data['clanarinaError'] = "Član nema valjajuću članarinu!";
            }

            if ($this->posudbaModel->provjeraClanaKnjiznice($data['clan_knjiznice_ID']) == 3  && $this->clanKnjizniceModel->dohvatiClanovuClanarinu($data['clan_knjiznice_ID']) != 3) {
                $data['clan_knjiznice_IDError'] = "Član (" . $data['clan_knjiznice_ID'] . ") je već posduio 3 knjige!";
            }

            if (empty($data['inventarni_broj_ID'])) {
                $data['inventarni_broj_IDError'] = "Unesite knjigu!";
            }


            if (empty($data['datum_posudbeError']) && empty($data['clan_knjiznice_IDError']) && empty($data['inventarni_broj_IDError']) && empty($data['clanarinaError'])) {

                if ($this->posudbaModel->dodajPosudbu($data)) {
                    $data = [
                        'posudbe' => $posudbe,
                        'clanoviKnjiznice' => $clanoviKnjiznice,
                        'slobodneKnjige' => $slobodneKnjige,
                        'brojPosudbe' => $brojPosudbe,

                        'datum_posudbe' => '',
                        'clan_knjiznice_ID' => '',
                        'inventarni_broj_ID' => '',

                        'datum_vracanjaError' => '',

                        'datum_posudbeError' => '',
                        'clan_knjiznice_IDError' => '',
                        'inventarni_broj_IDError' => '',
                        'clanarinaError' => '',
                    ];
                    header("Location: " . URLROOT . "/posudbe/index");
                } else {
                    die("Došlo je do pogreške, probajte ponovo!");
                }
            } else {

                $this->view('posudbe/index', $data);
            }
        }
        $this->view('posudbe/index', $data);
    }

    public function delete($id)
    {
        $posudba = $this->posudbaModel->pronadiPosudbu($id);

        if (!isLoggedIn()) {
            header("Location: " . URLROOT . "/posudbe/index");
        }

        $data = [
            'posudbe' => '',
            'clanoviKnjiznice' => '',
            'slobodneKnjige' => '',
            'brojPosudbe' => '',

            'datum_posudbe' => '',
            'clan_knjiznice_ID' => '',
            'inventarni_broj_ID' => '',

            'datum_vracanjaError' => '',

            'datum_posudbeError' => '',
            'clan_knjiznice_IDError' => '',
            'inventarni_broj_IDError' => '',
            'clanarinaError' => '',

            'posudba' => $posudba
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //senetize data, second param is to string
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($this->posudbaModel->izbrisiPosudbu($id)) {
                header("Location: " . URLROOT . "/posudbe/index");
            } else {
                die("Došlo je do pogreške, probajte ponovo!");
            }
        }
    }

    public function update($id)
    {
        if (!isLoggedIn()) {
            header("Location: " . URLROOT . "/clanoviKnjiznice/index");
        }

        $posudbe = $this->posudbaModel->dohvatiPosudbe();
        $clanoviKnjiznice = $this->clanKnjizniceModel->dohvatiClanove();
        $slobodneKnjige = $this->inventarModel->pronadiSlobodneKnjigeUInventaru();
        $brojPosudbe = $this->posudbaModel->pronadiBrojPosudbe();
        $posudba = $this->posudbaModel->pronadiPosudbu($id);

        $data = [
            'posudbe' => $posudbe,
            'clanoviKnjiznice' => $clanoviKnjiznice,
            'slobodneKnjige' => $slobodneKnjige,
            'brojPosudbe' => $brojPosudbe,

            'posudena_knjiga_ID' => '',
            'datum_vracanja' => '',

            'datum_vracanjaError' => '',

            'datum_posudbeError' => '',
            'clan_knjiznice_IDError' => '',
            'inventarni_broj_IDError' => '',
            'clanarinaError' => '',

            'posudba' => $posudba,
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'posudbe' => $posudbe,
                'clanoviKnjiznice' => $clanoviKnjiznice,
                'slobodneKnjige' => $slobodneKnjige,
                'brojPosudbe' => $brojPosudbe,

                'datum_vracanja' => trim($_POST['datum_vracanja']),

                'posudena_knjiga_ID' => $id,
                'datum_vracanjaError' => '',

                'datum_posudbeError' => '',
                'clan_knjiznice_IDError' => '',
                'inventarni_broj_IDError' => '',
                'clanarinaError' => '',

                'posudba' => $posudba,
            ];

            if (empty($data['datum_vracanja'])) {
                $data['datum_vracanjaError'] = "Unesite datum vračanja!";
            }

            if (empty($data['datum_vracanjaError'])) {
                if ($this->posudbaModel->updatePosudbe($data)) {
                    header("Location: " . URLROOT . "/posudbe/index");
                } else {
                    die("Došlo je do pogreške, probajte ponovo!");
                }
            } else {
                $this->view('posudbe/index', $data);
            }
        }
        $this->view('posudbe/index', $data);
    }
}
