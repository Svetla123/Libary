<?php
class Autor
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function dohvatiAutore()
    {
        $this->db->query('SELECT a.autor_ID, a.ime_autora, a.prezime_autora, a.datum_rodenja, a.datum_smrti FROM autor a ORDER BY a.autor_ID ASC');

        $clanarine = $this->db->resultSet();
        return $clanarine;
    }
}
