<?php
class Clanarina
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function valjajuceClanarine()
    {
        $this->db->query('SELECT * FROM clanarina WHERE clanarina_vrijedi =1');

        $clanovi = $this->db->resultSet();
        return $clanovi;
    }

    public function dohvatiClanarine()
    {
        $this->db->query('SELECT * FROM clanarina ORDER BY clanarina_ID ASC');

        $clanarine = $this->db->resultSet();
        return $clanarine;
    }

    public function provjeriClanarinu($clan_knjiznice_ID)
    {
        $this->db->query('SELECT clanarina_vrijedi FROM clanarina WHERE :clan_knjiznice_ID = clan_knjiznice_ID AND clanarina_vrijedi=1');

        $this->db->bind(':clan_knjiznice_ID', $clan_knjiznice_ID);

        $clanarina = $this->db->single();
        return $clanarina;
    }
}
