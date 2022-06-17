<?php
class clanoviKnjiznice extends controller
{


    public function __construct()
    {
        $this->clanModel = $this->model("ClanKnjiznice");
        $this->clanarinaModel = $this->model("Clanarina");
        $this->gradModel = $this->model('Grad');
        $this->vrstaClanarineModel = $this->model('VrstaClanarine');
    }

    public function index()
    {

        $vrsteClanarine =  $this->vrstaClanarineModel->prondaiVrsteClanarina();
        $gradovi = $this->gradModel->pronadiGradove();
        $clanovi = $this->clanModel->dohvatiClanove();
        $valjajuceClanarine = $this->clanarinaModel->valjajuceClanarine();

        $data = [
            'gradovi' => $gradovi,
            'vrsteClanarine' => $vrsteClanarine,
            'clanoviKnjiznice' => $clanovi,
            'valjajuceClanarine' => $valjajuceClanarine,

            'clan_knjiznice_ID' => '',
            'ime_clana' => '',
            'prezime_clana' => '',
            'adresa_clana' => '',
            'email_clana' => '',
            'telefosnki_broj_clana' => '',
            'grad_ID' => '',
            'vrsta_clanarine_ID' => '',

            'clan_knjiznice_IDError' => '',
            'ime_clanaError' => '',
            'prezime_clanaError' => '',
            'adresa_clanaError' => '',
            'email_clanaError' => '',
            'telefosnki_broj_clanaError' => '',
            'grad_IDError' => '',
            'vrsta_clanarine_IDError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $data = [
                'gradovi' => $gradovi,
                'vrsteClanarine' => $vrsteClanarine,
                'clanoviKnjiznice' => $clanovi,
                'valjajuceClanarine' => $valjajuceClanarine,

                'clan_knjiznice_ID' => trim($_POST['clan_knjiznice_ID']),
                'ime_clana' => trim($_POST['ime_clana']),
                'prezime_clana' => trim($_POST['prezime_clana']),
                'adresa_clana' => trim($_POST['adresa_clana']),
                'email_clana' => trim($_POST['email_clana']),
                'telefosnki_broj_clana' => trim($_POST['telefosnki_broj_clana']),
                'grad_ID' => $this->gradModel->pronadiGrad(trim($_POST['grad_ID'])),
                'vrsta_clanarine_ID' => $this->vrstaClanarineModel->pronadiVrstuClanarine(trim($_POST['vrsta_clanarine_ID'])),

                'clan_knjiznice_IDError' => '',
                'ime_clanaError' => '',
                'prezime_clanaError' => '',
                'adresa_clanaError' => '',
                'email_clanaError' => '',
                'telefosnki_broj_clanaError' => '',
                'grad_IDError' => '',
                'vrsta_clanarine_IDError' => ''
            ];


            if (empty($data['clan_knjiznice_ID'])) {
                $data['clan_knjiznice_IDError'] = "Unesite broj člana!";
            }

            $clanKnjizniceID = $this->clanModel->provjeraBrojaČlana($data['clan_knjiznice_ID']);
            if ($clanKnjizniceID != NULL) {
                $data['clan_knjiznice_IDError'] = "Nevaljajući broj!";
            }

            if (empty($data['ime_clana'])) {
                $data['ime_clanaError'] = "Unesite ime člana!";
            }

            if (empty($data['prezime_clana'])) {
                $data['prezime_clanaError'] = "Unesite prezime člana!";
            }
            if (empty($data['adresa_clana'])) {
                $data['adresa_clanaError'] = "Unesite adresu člana!";
            }

            if (empty($data['email_clana'])) {
                $data['email_clanaError'] = "Unesite email člana!";
            }

            if (empty($data['telefosnki_broj_clana'])) {
                $data['telefosnki_broj_clanaError'] = "Unesite tel.broj člana!";
            }
            if (empty($data['grad_ID'])) {
                $data['grad_IDError'] = "Unesite grad člana!";
            }

            if (empty($data['vrsta_clanarine_ID'])) {
                $data['vrsta_clanarine_IDError'] = "Unesite članarinu člana!";
            }


            if (empty($data['clan_knjiznice_IDError']) && empty($data['ime_clanaError']) && empty($data['prezime_clanaError']) && empty($data['adresa_clanaError']) && empty($data['email_clanaError']) && empty($data['telefosnki_broj_clanaError'])  && empty($data['grad_IDError']) && empty($data['vrsta_clanarine_IDError'])) {


                if ($this->clanModel->dodajČlanaKnjižnice($data)) {
                    header("Location: " . URLROOT . "/clanoviKnjiznice/index");
                } else {
                    die("Došlo je do pogreške, probajte ponovo!");
                }
            } else {
                $this->view('clanoviKnjiznice/index', $data);
            }
        }

        $this->view('clanoviKnjiznice/index', $data);
    }

    public function delete($id)
    {

        $clanKnjiznice = $this->clanModel->pronadiClanaKnjiznice($id);

        if (!isLoggedIn()) {
            header("Location: " . URLROOT . "/clanoviKnjiznice/index");
        }

        $data = [
            'gradovi' => '',
            'vrsteClanarine' => '',
            'clanoviKnjiznice' => '',
            'valjajuceClanarine' => '',

            'clan_knjiznice_ID' => '',
            'ime_clana' => '',
            'prezime_clana' => '',
            'adresa_clana' => '',
            'email_clana' => '',
            'telefosnki_broj_clana' => '',
            'grad_ID' => '',
            'vrsta_clanarine_ID' => '',

            'clan_knjiznice_IDError' => '',
            'ime_clanaError' => '',
            'prezime_clanaError' => '',
            'adresa_clanaError' => '',
            'email_clanaError' => '',
            'telefosnki_broj_clanaError' => '',
            'grad_IDError' => '',
            'vrsta_clanarine_IDError' => '',

            'clanKnjiznice' => $clanKnjiznice
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //senetize data, second param is to string
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($this->clanModel->izbrisiClanaKnjiznice($id)) {
                header("Location: " . URLROOT . "/clanoviKnjiznice/index");
            } else {
                die("Došlo je do pogreške, probajte ponovo!");
            }
        }
    }

    public function update($id)
    {

        $clanKnjiznice = $this->clanModel->pronadiClanaKnjiznice($id);
        $vrsteClanarine =  $this->vrstaClanarineModel->prondaiVrsteClanarina();
        $gradovi = $this->gradModel->pronadiGradove();

        if (!isLoggedIn()) {
            header("Location: " . URLROOT . "/clanoviKnjiznice/index");
        }

        $data = [
            'clanKnjiznice' => $clanKnjiznice,
            'vrsteClanarine' => $vrsteClanarine,
            'gradovi' => $gradovi,
            'ime_grada' => $this->gradModel->pronadiGradPoID($id),
            'ime_vrste_clanarine' => $this->vrstaClanarineModel->pronadiVrstuClanarinePoID($id),

            'clan_knjiznice_ID' => '',
            'ime_clana' => '',
            'prezime_clana' => '',
            'adresa_clana' => '',
            'email_clana' => '',
            'telefosnki_broj_clana' => '',
            'grad_ID' => '',
            'vrsta_clanarine_ID' => '',

            'clan_knjiznice_IDError' => '',
            'ime_clanaError' => '',
            'prezime_clanaError' => '',
            'adresa_clanaError' => '',
            'email_clanaError' => '',
            'telefosnki_broj_clanaError' => '',
            'grad_IDError' => '',
            'vrsta_clanarine_IDError' => ''

        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'clanKnjiznice' => $clanKnjiznice,
                'vrsteClanarine' => $vrsteClanarine,
                'gradovi' => $gradovi,
                'ime_grada' => $this->gradModel->pronadiGradPoID($id),
                'ime_vrste_clanarine' => $this->vrstaClanarineModel->pronadiVrstuClanarinePoID($id),

                'clan_knjiznice_ID' => trim($_POST['clan_knjiznice_ID']),
                'ime_clana' => trim($_POST['ime_clana']),
                'prezime_clana' => trim($_POST['prezime_clana']),
                'adresa_clana' => trim($_POST['adresa_clana']),
                'email_clana' => trim($_POST['email_clana']),
                'telefosnki_broj_clana' => trim($_POST['telefosnki_broj_clana']),
                'grad_ID' => $this->gradModel->pronadiGrad(trim($_POST['grad_ID'])),
                'vrsta_clanarine_ID' => $this->vrstaClanarineModel->pronadiVrstuClanarine(trim($_POST['vrsta_clanarine_ID'])),

                'clan_knjiznice_IDError' => '',
                'ime_clanaError' => '',
                'prezime_clanaError' => '',
                'adresa_clanaError' => '',
                'email_clanaError' => '',
                'telefosnki_broj_clanaError' => '',
                'grad_IDError' => '',
                'vrsta_clanarine_IDError' => ''
            ];

            if (empty($data['clan_knjiznice_ID'])) {
                $data['clan_knjiznice_IDError'] = "Unesite broj člana!";
            }


            // $clanKnjizniceIDafter = $this->clanModel->provjeraBrojaČlana($data['clan_knjiznice_ID']);
            $uneseniID = (int) $data['clan_knjiznice_ID'];
            if ($clanKnjiznice->clan_knjiznice_ID != $uneseniID) {
                $data['clan_knjiznice_IDError'] = "Uneseni broj se već koristi!";
            }

            if (empty($data['ime_clana'])) {
                $data['ime_clanaError'] = "Unesite ime člana!";
            }

            if (empty($data['prezime_clana'])) {
                $data['prezime_clanaError'] = "Unesite prezime člana!";
            }
            if (empty($data['adresa_clana'])) {
                $data['adresa_clanaError'] = "Unesite adresu člana!";
            }

            if (empty($data['email_clana'])) {
                $data['email_clanaError'] = "Unesite email člana!";
            }

            if (empty($data['telefosnki_broj_clana'])) {
                $data['telefosnki_broj_clanaError'] = "Unesite tel.broj člana!";
            }
            if (empty($data['grad_ID'])) {
                $data['grad_IDError'] = "Unesite grad člana!";
            }

            if (empty($data['vrsta_clanarine_ID'])) {
                $data['vrsta_clanarine_IDError'] = "Unesite članarinu člana!";
            }

            if (empty($data['clan_knjiznice_IDError']) && empty($data['ime_clanaError']) && empty($data['prezime_clanaError']) && empty($data['adresa_clanaError']) && empty($data['email_clanaError']) && empty($data['telefosnki_broj_clanaError'])  && empty($data['grad_IDError']) && empty($data['vrsta_clanarine_IDError'])) {

                if ($this->clanModel->updateClanaKnjiznice($data)) {
                    header("Location: " . URLROOT . "/clanoviKnjiznice/index");
                } else {
                    die("Došlo je do pogreške, probajte ponovo!");
                }
            } else {
                $this->view('clanoviKnjiznice/update', $data);
            }
        }
        $this->view('clanoviKnjiznice/update', $data);
    }
}
