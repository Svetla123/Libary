<?php
class ClanKnjiznice
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function dohvatiClanove()
    {
        $this->db->query("SELECT ck.clan_knjiznice_ID, ck.ime_clana, ck.prezime_clana, ck.adresa_clana, ck.email_clana, ck.telefosnki_broj_clana, g.ime_grada, vc.ime_vrste_clanarine,
        (SELECT COUNT(*) FROM posudba p WHERE p.clan_knjiznice_ID = ck. clan_knjiznice_ID AND p.status_posudbe_ID =1 OR p.status_posudbe_ID =3) AS broj_posudba,
        (SELECT c.clanarina_vrijedi FROM clanarina c WHERE  ck.clan_knjiznice_ID = c. clan_knjiznice_ID AND c.clanarina_vrijedi = 1) AS clanarina_vrijedi
        
        FROM clan_knjiznice ck
        INNER JOIN grad g ON g.grad_ID = ck.grad_ID
        INNER JOIN vrsta_clanarine vc ON vc.vrsta_clanarine_ID = ck.vrsta_clanarine_ID
        ORDER BY ck.clan_knjiznice_ID ASC");

        $clanovi = $this->db->resultSet();
        return $clanovi;
    }

    public function dodajČlanaKnjižnice($data)
    {

        $this->db->query("INSERT INTO clan_knjiznice (clan_knjiznice_ID, ime_clana, prezime_clana, adresa_clana, email_clana, telefosnki_broj_clana, grad_ID, vrsta_clanarine_ID) 
        VALUES(:clan_knjiznice_ID, :ime_clana, :prezime_clana, :adresa_clana, :email_clana, :telefosnki_broj_clana, :grad_ID, :vrsta_clanarine_ID)");
        // STR_TO_DATE(:datum_rodenja, '%Y%m%d')

        //Bind vrijednosti
        $this->db->bind(':clan_knjiznice_ID', $data['clan_knjiznice_ID']);
        $this->db->bind(':ime_clana', $data['ime_clana']);
        $this->db->bind(':prezime_clana', $data['prezime_clana']);
        $this->db->bind(':adresa_clana', $data['adresa_clana']);
        $this->db->bind(':email_clana', $data['email_clana']);
        $this->db->bind(':telefosnki_broj_clana', $data['telefosnki_broj_clana']);
        $this->db->bind(':grad_ID', $data['grad_ID']);
        $this->db->bind(':vrsta_clanarine_ID', $data['vrsta_clanarine_ID']);

        //izvršavanje function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function provjeraBrojaČlana($id)
    {

        $this->db->query('SELECT ck.clan_knjiznice_ID FROM clan_knjiznice ck 
        WHERE ck.clan_knjiznice_ID = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    public function pronadiClanaKnjiznice($id)
    {

        $this->db->query('SELECT ck.clan_knjiznice_ID, ck.ime_clana, ck.prezime_clana, ck.adresa_clana, ck.email_clana, ck.telefosnki_broj_clana, g.ime_grada, vc.ime_vrste_clanarine FROM clan_knjiznice ck 
        INNER JOIN grad g ON g.grad_ID = ck.grad_ID
        INNER JOIN vrsta_clanarine vc ON vc.vrsta_clanarine_ID = ck.vrsta_clanarine_ID  WHERE ck.clan_knjiznice_ID = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }

    public function izbrisiClanaKnjiznice($id)
    {
        $this->db->query('DELETE FROM clan_knjiznice WHERE clan_knjiznice_ID = :id');

        // $this->db->bind(':notification_ID', $id);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateClanaKnjiznice($data)
    {
        $this->db->query('UPDATE clan_knjiznice SET clan_knjiznice_ID = :clan_knjiznice_ID, ime_clana = :ime_clana, prezime_clana = :prezime_clana, adresa_clana = :adresa_clana, email_clana = :email_clana, telefosnki_broj_clana = :telefosnki_broj_clana, grad_ID = :grad_ID, vrsta_clanarine_ID = :vrsta_clanarine_ID WHERE clan_knjiznice_ID = :clan_knjiznice_ID');

        //Bind vrijednosti
        $this->db->bind(':clan_knjiznice_ID', $data['clan_knjiznice_ID']);
        $this->db->bind(':ime_clana', $data['ime_clana']);
        $this->db->bind(':prezime_clana', $data['prezime_clana']);
        $this->db->bind(':adresa_clana', $data['adresa_clana']);
        $this->db->bind(':email_clana', $data['email_clana']);
        $this->db->bind(':telefosnki_broj_clana', $data['telefosnki_broj_clana']);
        $this->db->bind(':grad_ID', $data['grad_ID']);
        $this->db->bind(':vrsta_clanarine_ID', $data['vrsta_clanarine_ID']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function dohvatiClanovuClanarinu($clan_knjiznice_ID)
    {
        $this->db->query('SELECT vrsta_clanarine_ID FROM clan_knjiznice
        WHERE clan_knjiznice_ID = :clan_knjiznice_ID');

        $this->db->bind(':clan_knjiznice_ID', $clan_knjiznice_ID);


        $clanovaClanarina = $this->db->single();
        var_dump($clanovaClanarina);
        return $clanovaClanarina->vrsta_clanarine_ID;
    }
}
