<?php
class VrstaClanarine
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function prondaiVrsteClanarina()
    {
        $this->db->query('SELECT ime_vrste_clanarine FROM vrsta_clanarine ORDER BY ime_vrste_clanarine ASC');

        $vrsteClanarina = $this->db->resultSet();
        return $vrsteClanarina;
    }

    public function pronadiVrstuClanarine($vrsteClanarina)
    {

        $this->db->query('SELECT vrsta_clanarine_ID FROM vrsta_clanarine WHERE :vrsteClanarina = ime_vrste_clanarine');

        $this->db->bind(':vrsteClanarina', $vrsteClanarina);

        $vrstaClanarine = $this->db->single();
        return $vrstaClanarine->vrsta_clanarine_ID;
    }

    public function pronadiVrstuClanarinePoID($id)
    {

        $this->db->query('SELECT ime_vrste_clanarine FROM vrsta_clanarine WHERE :id = vrsta_clanarine_ID');

        $this->db->bind(':id', $id);

        $vrstaClanarine = $this->db->single();
        return $vrstaClanarine->ime_vrste_clanarine;
    }
}
