<?php
class Posudba
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function dohvatiPosudbe()
    {
        $this->db->query('SELECT * FROM posudba ORDER BY posudena_knjiga_ID ASC');

        $this->db->query("SELECT p.posudena_knjiga_ID, p.datum_posudbe, ck.prezime_clana, p.datum_predvidenog_vracanja, p.datum_vracanja, p.novcani_zaostatak, ck.ime_clana, ck.prezime_clana, s.ime_statusa_posudbe, k.ime_knjiznice, i.isbn, i.inventarni_broj_ID,
        (SELECT k.naslov_knjige FROM knjiga k WHERE i.isbn = k.isbn) AS naslov_knjige
        
        FROM posudba p
        INNER JOIN status_posudbe s ON s.status_posudbe_ID = p.status_posudbe_ID
        INNER JOIN clan_knjiznice ck ON ck.clan_knjiznice_ID = p.clan_knjiznice_ID
        INNER JOIN inventar i ON p.inventarni_broj_ID = i.inventarni_broj_ID
        INNER JOIN knjiznica k ON k.knjiznica_ID = i.knjiznica_ID
        ORDER BY p.posudena_knjiga_ID ASC");


        // $this->db->query("SELECT ck.clan_knjiznice_ID, ck.ime_clana, ck.prezime_clana, ck.adresa_clana, ck.email_clana, ck.telefosnki_broj_clana, g.ime_grada, vc.ime_vrste_clanarine,
        // (SELECT COUNT(*) FROM posudba p WHERE p.clan_knjiznice_ID = ck. clan_knjiznice_ID AND p.status_posudbe_ID =1 OR p.status_posudbe_ID =3) AS broj_posudba

        // FROM clan_knjiznice ck
        // INNER JOIN grad g ON g.grad_ID = ck.grad_ID
        // INNER JOIN vrsta_clanarine vc ON vc.vrsta_clanarine_ID = ck.vrsta_clanarine_ID
        // ORDER BY ck.clan_knjiznice_ID ASC");

        $posudbe = $this->db->resultSet();
        return $posudbe;
    }


    public function pronadiBrojPosudbe()
    {
        $this->db->query('SELECT COUNT(*) AS broj_posudbe FROM posudba');

        $brojPosudbe = $this->db->single();
        return $brojPosudbe->broj_posudbe;
    }

    public function dodajPosudbu($data)
    {
        $this->db->query("INSERT INTO posudba (datum_posudbe, clan_knjiznice_ID, inventarni_broj_ID) 
            VALUES(:datum_posudbe, :clan_knjiznice_ID, :inventarni_broj_ID)");
        // STR_TO_DATE(:datum_rodenja, '%Y%m%d')

        //Bind vrijednosti
        $this->db->bind(':datum_posudbe', $data['datum_posudbe']);
        $this->db->bind(':clan_knjiznice_ID', $data['clan_knjiznice_ID']);
        $this->db->bind(':inventarni_broj_ID', $data['inventarni_broj_ID']);

        //izvršavanje function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function provjeraClanaKnjiznice($clan_knjiznice_ID)
    {
        $this->db->query('SELECT COUNT(:clan_knjiznice_ID) AS broj_clanovih_posudbe FROM posudba WHERE datum_vracanja IS NULL AND :clan_knjiznice_ID =clan_knjiznice_ID');

        $this->db->bind(':clan_knjiznice_ID', $clan_knjiznice_ID);
        $brojPosudba = $this->db->single();
        return $brojPosudba->broj_clanovih_posudbe;
    }

    public function pronadiPosudbu($id)
    {
        $this->db->query('SELECT p.posudena_knjiga_ID, p.datum_posudbe, p.datum_predvidenog_vracanja, p.datum_vracanja, p.novcani_zaostatak, ck.clan_knjiznice_ID, sp.status_posudbe_ID, i.inventarni_broj_ID FROM posudba p
        INNER JOIN clan_knjiznice ck ON p.clan_knjiznice_ID = ck.clan_knjiznice_ID
        INNER JOIN status_posudbe sp ON p.status_posudbe_ID = sp.status_posudbe_ID 
        INNER JOIN inventar i ON p.inventarni_broj_ID = i.inventarni_broj_ID
        WHERE p.posudena_knjiga_ID = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    public function izbrisiPosudbu($id)
    {
        $this->db->query('DELETE FROM posudba WHERE posudena_knjiga_ID = :id');

        // $this->db->bind(':notification_ID', $id);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePosudbe($data)
    {
        $this->db->query('UPDATE posudba SET datum_vracanja = :datum_vracanja WHERE posudena_knjiga_ID =:posudena_knjiga_ID');

        //Bind vrijednosti
        $this->db->bind(':datum_vracanja',  $data['datum_vracanja']);
        $this->db->bind(':posudena_knjiga_ID',  $data['posudena_knjiga_ID']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function pronadiPosudbe()
    {
        $this->db->query('SELECT ck.ime_clana, ck.prezime_clana, p.inventarni_broj_ID, p.posudena_knjiga_ID, ck.clan_knjiznice_ID
         FROM clan_knjiznice ck, posudba p WHERE ck.clan_knjiznice_ID =p.clan_knjiznice_ID ORDER BY p.posudena_knjiga_ID DESC');

        $posudbe = $this->db->resultSet();
        return $posudbe;
    }


    public function trenutnaPosudba()
    {
        $this->db->query('SELECT ck.ime_clana, ck.prezime_clana, p.inventarni_broj_ID, p.posudena_knjiga_ID, ck.clan_knjiznice_ID
         FROM clan_knjiznice ck, posudba p WHERE datum_vracanja IS NULL AND ck.clan_knjiznice_ID =p.clan_knjiznice_ID');

        $posudbe = $this->db->resultSet();
        return $posudbe;
    }
}
