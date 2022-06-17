<?php
class Korisnik
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function pronadiNadredenoga($nadredeni)
    {

        $this->db->query("SELECT zaposlenik_ID FROM zaposlenik WHERE :nadredeni = CONCAT(ime_zaposlenika,' ',prezime_zaposlenika)");

        $this->db->bind(':nadredeni', $nadredeni);

        $nadredeni_ID = $this->db->single();
        return $nadredeni_ID->zaposlenik_ID;
    }

    public function register($data)
    {

        $data['nadreden_ID'] = $this->pronadiNadredenoga($data['nadreden_ID']);

        $this->db->query("INSERT INTO zaposlenik (ime_zaposlenika, prezime_zaposlenika, datum_rodenja, razina_obrazovanja_ID, vrsta_zaposlenika_ID, nadreden_ID, email_zaposlenika, lozinka) 
        VALUES(:ime_zaposlenika, :prezime_zaposlenika, :datum_rodenja, :razina_obrazovanja_ID, :vrsta_zaposlenika_ID, :nadreden_ID, :email_zaposlenika, :lozinka)");

        $this->db->bind(':ime_zaposlenika', $data['ime_zaposlenika']);
        $this->db->bind(':prezime_zaposlenika', $data['prezime_zaposlenika']);
        $this->db->bind(':datum_rodenja', $data['datum_rodenja']);
        $this->db->bind(':razina_obrazovanja_ID', $data['razina_obrazovanja_ID']);
        $this->db->bind(':vrsta_zaposlenika_ID', $data['vrsta_zaposlenika_ID']);
        $this->db->bind(':nadreden_ID', $data['nadreden_ID']);
        $this->db->bind(':email_zaposlenika', $data['email_zaposlenika']);
        $this->db->bind(':lozinka', $data['lozinka']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email_zaposlenika, $lozinka)
    {
        $this->db->query('SELECT * FROM zaposlenik WHERE email_zaposlenika = :email_zaposlenika');

        //Bind vrijednosti
        $this->db->bind(':email_zaposlenika', $email_zaposlenika);

        $zapis = $this->db->single();

        $hashedLozinka = $zapis->lozinka;
        if (password_verify($lozinka, $hashedLozinka)) {
            return $zapis;
        } else {
            return false;
        }
    }

    //Find user by email. Email is passed in by the Controller.
    public function nadiZaposlenikaPoEmailu($email_zaposlenika)
    {
        //Prepared statement
        $this->db->query('SELECT * FROM zaposlenik WHERE email_zaposlenika = :email_zaposlenika');

        //Bind vrijednosti
        $this->db->bind(':email_zaposlenika', $email_zaposlenika);

        //provjera da li postoji zapis s istim emailom
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function pronadiNadredene()
    {

        $this->db->query('SELECT ime_zaposlenika, prezime_zaposlenika FROM zaposlenik WHERE nadreden_ID IS NULL ORDER BY prezime_zaposlenika ASC');

        $popisNadredenih = $this->db->resultSet();
        return $popisNadredenih;
    }
}
