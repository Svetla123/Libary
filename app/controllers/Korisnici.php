<?php
class Korisnici extends Controller
{

    private $danasnjiDatum = "";

    public function __construct()
    {
        $this->korisnikModel = $this->model('Korisnik');
        $this->razinaObrazovanjaModel = $this->model('RazinaObrazovanja');
        $this->vrstaZaposlenikaModel = $this->model('VrstaZaposlenika');
        $this->danasnjiDatum = date("Y-m-d");
    }

    public function register()
    {

        $popisNadredenih = $this->korisnikModel->pronadiNadredene();
        $data = [
            'popisNadredenih' => $popisNadredenih,

            'ime_zaposlenika' => '',
            'prezime_zaposlenika' => '',
            'datum_rodenja' => '',
            'razina_obrazovanja_ID' => '',
            'vrsta_zaposlenika_ID' => '',
            'nadreden_ID' => '',
            'email_zaposlenika' => '',
            'lozinka' => '',

            'imeError' => '',
            'prezimeError' => '',
            'datumRodenjaError' => '',
            'razinaObrazovanjaError' => '',
            'vrstaZaposlenikaError' => '',
            'lozinkaError' => '',
            'emailError' => '',
        ];


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [

                'popisNadredenih' => $popisNadredenih,

                'ime_zaposlenika' => trim($_POST['ime_zaposlenika']),
                'prezime_zaposlenika' => trim($_POST['prezime_zaposlenika']),
                'datum_rodenja' => trim($_POST['datum_rodenja']),
                'razina_obrazovanja_ID' => $this->razinaObrazovanjaModel->pronadiRazinuObrazovanja(trim($_POST['razina_obrazovanja_ID'])),
                'vrsta_zaposlenika_ID' => $this->vrstaZaposlenikaModel->pronadiVrstuZaposlenika(trim($_POST['vrsta_zaposlenika_ID'])),
                'nadreden_ID' => trim($_POST['nadreden_ID']),
                'email_zaposlenika' => trim($_POST['email_zaposlenika']),
                'lozinka' => trim($_POST['lozinka']),

                'imeError' => '',
                'prezimeError' => '',
                'datumRodenjaError' => '',
                'razinaObrazovanjaError' => '',
                'vrstaZaposlenikaError' => '',
                'lozinkaError' => '',
                'emailError' => '',
            ];

            $provjeraImena = "/^[a-žA-Ž0-9]*$/";
            $provjeraLozinke = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //provjera imena
            if (empty($data['ime_zaposlenika'])) {
                $data['imeError'] = 'Unesite ime.';
            } elseif (!preg_match($provjeraImena, $data['ime_zaposlenika'])) {
                $data['imeError'] = 'Ime može sadržavati samo slova.';
            }

            //provjera prezimena
            if (empty($data['prezime_zaposlenika'])) {
                $data['prezimeError'] = 'Unesite prezime.';
            } elseif (!preg_match($provjeraImena, $data['prezime_zaposlenika'])) {
                $data['prezimeError'] = 'Prezime može sadržavati samo slova.';
            }

            // !empty($data['datum_rodenja']) && 
            // $data['datum_rodenja']=="00/00/0000"
            // provjera datuma rodenja
            if (empty($data['datum_rodenja'])) {
                $data['dateError'] = 'Unesite datum rođenja.';
            } elseif (($data['datum_rodenja'] > $this->danasnjiDatum)) {
                $data['dateError'] = "Datum rođenja je u budučnosti.";
            }

            // provjera razine obrazovanja
            if (empty($data['razina_obrazovanja_ID'])) {
                $data['razinaObrazovanjaError'] = 'Unesite razinu obrazovanja.';
            }

            // provjera vrste zaposlenika
            if (empty($data['vrsta_zaposlenika_ID'])) {
                $data['vrstaZaposlenikaError'] = 'Unesite radno mjesto.';
            }

            // provjera lozink
            if (empty($data['lozinka'])) {
                $data['lozinkaError'] = 'Unesite lozinku.';
            } elseif (strlen($data['lozinka']) < 6) {
                $data['lozinkaError'] = 'Lozinka mora imati barem 8';
            } elseif (preg_match($provjeraLozinke, $data['lozinka'])) {
                $data['lozinkaError'] = 'Lozinka mora sadržavati barem jednu numeričku vrijednost.';
            }

            //provjera email
            if (empty($data['email_zaposlenika'])) {
                $data['emailError'] = 'Unesite email.';
            } elseif (!filter_var($data['email_zaposlenika'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Koristite dozvoljeni format.';
            } else {
                //Check if email exists.
                if ($this->korisnikModel->nadiZaposlenikaPoEmailu($data['email_zaposlenika'])) {
                    $data['emailError'] = 'Email se vec koristi.';
                }
            }

            // provjera prije unosa
            if (empty($data['imeError']) && empty($data['prezimeError']) && empty($data['datumRodenjaError']) && empty($data['razinaObrazovanjaError']) && empty($data['vrstaZaposlenikaError']) && empty($data['lozinkaError']) && empty($data['emailError'])) {

                // hashiranje lozinke
                $data['lozinka'] = password_hash($data['lozinka'], PASSWORD_DEFAULT);

                //Register user from model function
                if ($this->korisnikModel->register($data)) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/korisnici/login');
                } else {
                    die('Nešto je pošlo po krivu, probajte ponovo.');
                }
            }
        }
        $this->view('korisnici/register', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'Login page',
            'email_zaposlenika' => '',
            'lozinka' => '',
            'emailError' => '',
            'lozinkaError' => ''
        ];

        //Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email_zaposlenika' => trim($_POST['email_zaposlenika']),
                'lozinka' => trim($_POST['lozinka']),
                'emailError' => '',
                'lozinkaError' => '',
            ];
            //Validate username
            if (empty($data['email_zaposlenika'])) {
                $data['emailError'] = 'Unesite email!';
            }

            //Validate password
            if (empty($data['lozinka'])) {
                $data['lozinkaError'] = 'Unesite lozinku!';
            }

            //Check if all errors are empty
            if (empty($data['emailError']) && empty($data['lozinkaError'])) {
                $korisnik = $this->korisnikModel->login($data['email_zaposlenika'], $data['lozinka']);

                if ($korisnik) {
                    $this->kreirajKorisnickuSekciju($korisnik);
                } else {
                    $data['lozinkaError'] = 'Lozinka ili email su netočni!';

                    $this->view('korisnici/login', $data);
                }
            }
        } else {
            $data = [
                'email_zaposlenika' => '',
                'lozinka' => '',
                'emailError' => '',
                'lozinkaError' => ''
            ];
        }
        $this->view('korisnici/login', $data);
    }

    public function kreirajKorisnickuSekciju($kor)
    {
        $_SESSION['zaposlenik_ID'] = $kor->zaposlenik_ID;
        $_SESSION['ime_zaposlenika'] = $kor->ime_zaposlenika;
        $_SESSION['prezime_zaposlenika'] = $kor->prezime_zaposlenika;
        $_SESSION['email_zaposlenika'] = $kor->email_zaposlenika;
        header('location:' . URLROOT . "/index");
    }

    public function logout()
    {
        unset($_SESSION['zaposlenik_ID']);
        unset($_SESSION['ime_zaposlenika']);
        unset($_SESSION['prezime_zaposlenika']);
        unset($_SESSION['email_zaposlenika']);
        header('location:' . URLROOT);
    }
}
